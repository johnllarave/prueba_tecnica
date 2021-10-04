<?php
include 'config.php';

class Model {

	private $con;
	private $conexion;

	public function __construct() {
		$this->con = new Config();
		$this->conexion = $this->con->conexion();
	}

	function area() {
        $query_area="SELECT * FROM areas";
		$result = mysqli_query($this->conexion, $query_area);

        return $result;
	}

	function rol() {
        $query_rol="SELECT * FROM roles";
		$result = mysqli_query($this->conexion, $query_rol);

        return $result;
	}

	function empleados() {
        $query_empleado="SELECT a.id, a.nombre, email, sexo, boletin, b.nombre AS area
						 FROM empleado a
						 INNER JOIN areas b ON a.area_id = b.id";

		$result = mysqli_query($this->conexion, $query_empleado);

        return $result;
	}

	function busca_empleado($id) {
        $query_empleado="SELECT a.id, a.nombre, email, sexo, boletin, a.area_id, b.nombre AS area, descripcion
						 FROM empleado a
						 INNER JOIN areas b ON a.area_id = b.id
						 WHERE a.id = '".$id."'";

		$result = mysqli_query($this->conexion, $query_empleado);

        return $result;
	}

	function crea($nombre, $email, $sexo, $area, $boletin, $descripcion, $rol) {
	    $nombre = mysqli_real_escape_string($this->conexion, $nombre);
	    $email = mysqli_real_escape_string($this->conexion, $email);
	    $sexo = mysqli_real_escape_string($this->conexion, $sexo);
	    $area = mysqli_real_escape_string($this->conexion, $area);
    	$boletin = mysqli_real_escape_string($this->conexion, $boletin);
	    $descripcion = mysqli_real_escape_string($this->conexion, $descripcion);

        $query="INSERT INTO empleado (nombre, email, sexo, area_id, boletin, descripcion) 
                VALUES ('".$nombre."','".$email."','".$sexo."','".$area."','".$boletin."','".$descripcion."')";

	    //Inserta información en la tabla empleado
    	$this->conexion->query($query) or die(mysqli_errno($this->conexion) . ": " . mysqli_error($this->conexion) . " ");

    	//Busca el id del empleado que inserto
        $query_id="SELECT MAX(id) AS id FROM empleado";
		$result = mysqli_query($this->conexion, $query_id);

		while ($row_id = $result->fetch_assoc()) {
			$id_usuario = $row_id['id'];
        }

        foreach ($rol as $id_rol) {
        	$query_rol="INSERT INTO empleado_rol (empleado_id, rol_id) 
                		VALUES ('".$id_usuario."','".$id_rol."')";
            //Inserta información en la tabla empleado_rol
            $this->conexion->query($query_rol) or die(mysqli_errno($this->conexion) . ": " . mysqli_error($this->conexion) . " ");
        }
        return "insert";
	}

	function modifica($id_empleado, $nombre, $email, $area, $descripcion) {
	    $id_empleado = mysqli_real_escape_string($this->conexion, $id_empleado);
	    $nombre = mysqli_real_escape_string($this->conexion, $nombre);
	    $email = mysqli_real_escape_string($this->conexion, $email);
	    $area = mysqli_real_escape_string($this->conexion, $area);
	    $descripcion = mysqli_real_escape_string($this->conexion, $descripcion);

        $query="UPDATE empleado
        		SET nombre='".$nombre."', email='".$email."', area_id='".$area."', descripcion='".$descripcion."'
                WHERE id = '".$id_empleado."'";

    	$this->conexion->query($query) or die(mysqli_errno($this->conexion) . ": " . mysqli_error($this->conexion) . " ");

        return "update";
	}

	function elimina($id) {

        $query="DELETE FROM empleado
				WHERE id = '".$id."'";
		mysqli_query($this->conexion, $query);

		$query_2 = "DELETE FROM empleado_rol
					WHERE empleado_id = '".$id."'";
		mysqli_query($this->conexion, $query_2);

        return "delete";
	}












	function datos() {
		if ($_SESSION['id_rol'] == 2) {
			$condicion =  " AND id_jefe = '".$_SESSION['id_usuario']."'";
		}

        $query="SELECT id_usuario, CONCAT(nombre, ' ', apellido) AS usuario, documento, correo, telefono, nombre_rol
                FROM usuario
                INNER JOIN rol ON usuario.id_rol = rol.id_rol
                WHERE estado = '1'".$condicion."";
		$result = mysqli_query($this->conexion, $query);

        return $result;
	}





	function buscaUsuario($id_usuario) {
		$id_usuario = mysqli_real_escape_string($this->conexion, $id_usuario);

        $query="SELECT id_usuario, documento, nombre, apellido, correo, telefono FROM usuario WHERE id_usuario = '".$id_usuario."'";
		$result = mysqli_query($this->conexion, $query);

        return $result;
	}

	

	function actualiza($nombre, $apellido, $documento, $correo, $telefono, $id) {
	    $nombre = utf8_decode(mysqli_real_escape_string($this->conexion, $nombre));
	    $apellido = utf8_decode(mysqli_real_escape_string($this->conexion, $apellido));
	    $documento = utf8_decode(mysqli_real_escape_string($this->conexion, $documento));
	    $correo = utf8_decode(mysqli_real_escape_string($this->conexion, $correo));
	    $telefono = utf8_decode(mysqli_real_escape_string($this->conexion, $telefono));
	    $id = utf8_decode(mysqli_real_escape_string($this->conexion, $id));

        $query="UPDATE usuario SET nombre='".$nombre."', apellido='".$apellido."', documento='".$documento."', correo='".$correo."', telefono='".$telefono."'  
                WHERE id_usuario = '".$id."'";
    	$this->conexion->query($query) or die(mysqli_errno($this->conexion) . ": " . mysqli_error($this->conexion) . " ");

        return "ok";
	}
}

?>