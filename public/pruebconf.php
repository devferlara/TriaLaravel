<?php
//$prueba = $_POST;

$prueba = array('esto' => "aaa",'otro' => "22222",'aquellos' => 23423);

$mensajeLog = '';
$mensajeLog .= print_r($prueba,true) . "\r\n";
if(strlen($mensajeLog)>0){
$filename = "pruebconf.txt";
$fp = fopen($filename, "a");
if($fp) {
fwrite($fp, $mensajeLog, strlen($mensajeLog));
fclose($fp);

}
}

?>