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
		$nombre = $_POST['nombre'];
		$email = $_POST['email'];
		$sexo = $_POST['sexo'];
		$area = $_POST['area'];
		$boletin = $_POST['boletin'];
		$descripcion = $_POST['descripcion'];

		for ($i = 1; $i <= 30 ; $i++) {
			if (isset($_POST['rol_'.$i])) {
				$rol[] = $_POST['rol_'.$i];
			}
		}

		$crea_empleado = new Model();
		$result = $crea_empleado->crea($nombre, $email, $sexo, $area, $boletin, $descripcion, $rol);

		if ($result == 'insert') {
			header("location:tabla_empleados.php?insert");
		}
	}

	function actualizaEmpleado() {

		$id_empleado = $_POST['id_empleado'];
		$nombre = $_POST['nombre'];
		$email = $_POST['email'];
		$area = $_POST['area'];
		$descripcion = $_POST['descripcion'];

		$edita_empleado = new Model();
		$result = $edita_empleado->modifica($id_empleado, $nombre, $email, $area, $descripcion);

		if ($result == 'update') {
			header("location:tabla_empleados.php?update");
		}		
	}

	function eliminaEmpleado() {
		$id = $_POST['id'];

		$elimina_empleado = new Model();
		$result = $elimina_empleado->elimina($id);

		if ($result == 'delete') {
			header("location:tabla_empleados.php?delete");
		}		
	}
}

if (isset($_POST['btn_guardar'])) {
	$crea = new Controller();
	$crea->creaEmpleado();
}

if (isset($_POST['btn_actualizar'])) {
	$actualiza = new Controller();
	$actualiza->actualizaEmpleado();
}

if (isset($_POST['btn_eliminar'])) {
	$actualiza = new Controller();
	$actualiza->eliminaEmpleado();
}

?>