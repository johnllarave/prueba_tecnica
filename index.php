<?php
    require_once ("model.php");

    $datos_area = new Model();
    $array_area = $datos_area->area();

    $datos_rol = new Model();
    $array_rol = $datos_rol->rol();

    if (isset($_POST['btn_editar'])) {

        $tipo_formulario = "Actualizar";
        $op_boton = "btn_actualizar";
        $boton = "Actualizar";

        $datos_empleado = new Model();
        $array_empleado = $datos_empleado->busca_empleado($_POST['id']);
        $info_empleado = $array_empleado->fetch_array();
    } else {
        $tipo_formulario = "Crear";
        $op_boton = "btn_guardar";
        $boton = "Guardar";
    }



?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Prueba tecnica</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
</head>

<body>   
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="form-group">
                        <div class="col-sm-3 col-sm-offset-2">
                            <h2><?php echo $tipo_formulario;?> Empleado</h2>
                        </div>
                        <a href="tabla_empleados.php"><button class="btn btn-primary text-right">Visualizar empleados</button></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="post" action="controller.php" class="form-horizontal" id="valida_datos">
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-7">
                                <small>Los campos marcados con (*) son obligatorios</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nombre completo *</label>
                            <div class="col-sm-7">
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre completo del empleado" class="form-control" value="<?php echo $info_empleado['nombre'];?>">
                                <input type="hidden" name="id_empleado" value="<?php echo $info_empleado['id'];?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Correo electrónico *</label>
                            <div class="col-sm-7">
                                <input type="email" name="email" id="email" placeholder="Correo electrónico" class="form-control" value="<?php echo $info_empleado['email'];?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Sexo *</label>
                            <div class="col-sm-7">
                                <div>
                                    <input type="radio" value="M" id="sexo" name="sexo"> Masculino
                                </div>
                                <div>
                                    <input type="radio" value="F" id="sexo" name="sexo"> Femenino
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Área *</label>
                            <div class="col-sm-7">
                                <select name="area" id="area" class="form-control" required>
                                    <option value="<?php echo $info_empleado['area_id'];?>"><?php echo $info_empleado['area'];?></option>
                                    <?php
                                        while ($row_area = $array_area->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $row_area['id'];?>"><?php echo $row_area['nombre'];?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Descripción *</label>
                            <div class="col-sm-7">
                                <textarea name="descripcion" id="descripcion" placeholder="Descripción de la experienca del empleado" class="form-control" rows="4"><?php echo $info_empleado['descripcion'];?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-7">
                                <div class="i-checks">
                                    <label>
                                        <input type="checkbox" id="boletin" name="boletin" value="1"> Deseo recibir boletín informativo
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Roles *</label>
                            <div class="col-sm-7">
                                <div class="i-checks">
                                    <label>
                                        <?php
                                            while ($row_rol = $array_rol->fetch_assoc()) {
                                        ?>
                                            <input type="checkbox" name="rol_<?php echo $row_rol['id'];?>" value="<?php echo $row_rol['id'];?>"> <?php echo $row_rol['nombre'];?><br>
                                        <?php
                                            }
                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit" name="<?php echo $op_boton;?>"><?php echo $boton;?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script src="js/plugins/toastr/toastr.min.js"></script>
    <script src="js/jquery.validate.js"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 7000
                };
                toastr.success('John Alexander Llarave Herrán', 'Prueba Tecnica');

            }, 100);

            $("#valida_datos").validate({
                rules: {
                    nombre: {
                        required: true
                    },

                    documento: {
                        required: true,
                        digits: true
                    },

                    email: {
                        required: true,
                        email: true
                    },

                    area: {
                        required: true
                    },

                    descripcion: {
                        required: true
                    }
                },
            });
        });
    </script>
</body>

</html>
