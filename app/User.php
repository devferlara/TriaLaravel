<?php

namespace App;
use DB;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**The database table used by the model.
     * @var string
     */
    protected $table = 'usuarios';
    /**The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'nombres',
        'apellidos',
        'genero',
        'identificacion',
        'email',
        'fecha_nacimiento',
        'telefono',
        'celular',
        'rol',
        'img_perfil',
        'username',
        'password'];

    /**The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /* Funcion para Encriptar del password*/

    /*public function setPasswordAttribute($valor){
        if(!empty($valor)){
            $this->attributes['password'] = \Hash::make($valor);
        }
    }*/
    //*Relaciones con otros modelos /ORM Eloquent
    public function apartamentos()
    {
        return $this->belongsToMany('App\Apartamento','usuario_apartamentos','usuario_id','apartamento_id');
    }

     public function administrador(){
        return $this->hasOne('App\Administrador', 'usuario_id', 'id');
    }

     public function socios(){
        return $this->hasOne('App\Socio', 'usuario_id', 'id');
    }

    public function configuracion(){
        return $this->hasOne('App\Configuracion'); //cada usuario tiene un configuracion
    }

     public function mascotas(){
        return $this->hasMany('App\Mascota', 'usuario_id');
    }

    public function vehiculos(){
        return $this->hasMany('App\Vehiculo', 'usuario_id');
    }

    public function respuesta(){
        return $this->belongsToMany('App\Respuesta', 'mensajes'); //multiples mensajes -multiples respuestas
    }

    public function mensaje()
    {
        return $this->belongsToMany('App\Mensaje', 'mensaje_usuarios'); // relacion muchos a muchos - usuarios y mensajes
    }

    public function publicidad()
    {
        return $this->belongsToMany('App\Publicidad', 'usuario_publicidad', 'usuario_id', 'publicidad_id'); // relacion muchos a muchos - usuarios y mensajes
    }
	

    public static function obtenerUsuariosConjunto($conjunto){

        $query = DB::table('usuarios as usuario')
            ->join('usuario_apartamentos as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('usuario.id','usuario.identificacion','usuario.nombres','usuario.apellidos','usuario.email','usuario.telefono','usuario.celular','zona.tipo','zona.zona','apartamento.apartamento','u_a.propietario')
            ->where('conjunto.id', '=', $conjunto)
            ->paginate(20);

        return $query;
    }

    public static function obtenerUsuariosZona($zona){

        $query = DB::table('usuarios as usuario')
            ->join('usuario_apartamentos as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->select('usuario.id','usuario.identificacion','usuario.nombres','usuario.apellidos','usuario.email','usuario.telefono','usuario.celular','zona.tipo','zona.zona','apartamento.apartamento','u_a.propietario')
            ->where('zona.id', '=', $zona)
            ->get();

        return $query;
    }

     public function scopeNombres($query, $nombres)
    {
        if (trim($nombres) != "")
        {
            $query->where(\DB::raw ("CONCAT(nombres, '', apellidos)"), "LIKE", "%$nombres%");
        }
    }

    public function contarNoRegistrados($nombres){

        $query = DB::table('usuarios as usuario')
            ->select('usuario.id', 'usuario.nombres')
            ->where('usuario.nombres', '=', '')
            ->count();
        return $query;
    }

    /**Get the unique identifier for the user.
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**Get the password for the user.
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**Get the token value for the "remember me" session.
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**Set the token value for the "remember me" session.
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**Get the column name for the "remember me" token
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /* Get the e-mail address where password reminders are sent.
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function checkEmail($email,$id = null)
    {
        if($id == null)
        {
            $query = DB::table('usuarios as usuario')
            ->select('usuario.id')
            ->where('usuario.email',$email)
            ->orWhere('usuario.username',$email)
            ->whereNull('usuario.deleted_at')
            ->get();
        }

        if($id != null)
        {
            $query = DB::table('usuarios as usuario')
            ->select('usuario.id')
            ->where('usuario.id','!=',$id)
            ->whereNull('usuario.deleted_at')
            ->where(function($busqueda) use($email){
                    return $busqueda
                    ->orWhere('usuario.username',$email)
                    ->orWhere('usuario.email',$email);
                })
            ->get();
        }
        

        return count($query) > 0?true:false;
    }
}