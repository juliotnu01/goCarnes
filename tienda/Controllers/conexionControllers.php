<?php 
require_once '../config/config.php';

class conexionController extends mysqli
{
	
	public function __construct()
	{
		parent::__construct(HOST,USER,PASS,DATABASE);
			$this->connect_errno ? die('Error en la conexion') : $c = 'Conectado' ;
			echo $c;
			unset($c);
	}
}
$a = new conexionController();

 ?>