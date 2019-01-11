<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Conjunto;
use Auth;
use DB;
use Input;
use Crypt;
use Session;
use Redirect;
use Carbon\Carbon;
use Illuminate\Routing\Route;

class ReportesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
		$conjuntos= Conjunto::all();
		$total_conjuntos = $conjuntos->count();
		return view('backend.superadmin.reportes.index',["total_conjuntos" => $total_conjuntos]);
      
    }
   
}