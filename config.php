<?php

session_start();
error_reporting(0);

class Config {

	private $host;
	private $user;
	private $pass;
	private $bd;

	function __construct() {
		$this->host = "localhost";
		$this->user = "root";
		$this->pass = "";
		$this->bd = "prueba_tecnica_dev";
	}

	//Realiza la conexión a la base de datos
	public function conexion() {

		$parametros = mysqli_connect($this->host, $this->user, $this->pass, $this->bd) or die("Error de conexion: ".mysqli_connect_errno().PHP_EOL);
		$parametros->set_charset("utf8");

		return $parametros;
	}

	//Fecha y hora exacta de Colombia
	public function fecha() {
		$fecha = new DateTime("now", new DateTimeZone('America/Bogota'));
		$dato = $fecha->format('Y-m-d H:i:s');

		return $dato;
	}
}

?>