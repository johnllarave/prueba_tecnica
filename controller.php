<?php

require_once ("model.php");

class Controller {

	function validaDatos() {
        $instancia_datos = new UsuarioModel();
		$result = $instancia_datos->datos();

		return $result;
	}

	function buscaDatos($id_usuario) {
        $instancia_datos = new UsuarioModel();
		$result = $instancia_datos->buscaUsuario($id_usuario);

		return $result;
	}

	function creaEmpleado() {
		echo "<br>" . $nombre = $_POST['nombre'];
		echo "<br>" . $documento = $_POST['documento'];
		echo "<br>" . $email = $_POST['email'];
		echo "<br>" . $sexo = $_POST['sexo'];
		echo "<br>" . $area = $_POST['area'];
		echo "<br>" . $descripcion = $_POST['descripcion'];
		echo "<br>" . $boletin = $_POST['boletin'];

		for ($i=1; $i <= 30 ; $i++) {
			if ($_POST['rol_'.$i] != '') {
				$rol[] = $_POST['rol_'.$i];
			}
		}

		echo "<br>" . $rol[];

		//$crea_empleado = new Model();
		//$result = $crea_empleado->crea($nombre, $documento, $email, $sexo, $area, $descripcion, $boletin, $rol[]//);

		/*if ($result == 'ok') {
			header("location:../View/usuarios.php");
		}*/
	}




	function actualizaUsuario() {

		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$documento = $_POST['documento'];
		$correo = $_POST['correo'];
		$telefono = $_POST['telefono'];
		$id = $_POST['id'];

		$instancia_actualiza = new UsuarioModel();
		$result = $instancia_actualiza->actualiza($nombre, $apellido, $documento, $correo, $telefono, $id);

		if ($result == 'ok') {
			header("location:../View/usuarios.php");
		}		
	}
}

if (isset($_POST['btn_guardar'])) {
	$crea = new Controller();
	$crea->creaEmpleado();
}

if (isset($_POST['btn_usuario_act'])) {
	$actualiza = new UsuarioController();
	$actualiza->actualizaUsuario();
}
?>