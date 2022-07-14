<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Examen Matriculados</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <h3 class="pb-3 pt-5">Agregar Archivos</h3>
            <!-- Para Agregar CSV -->
            <div class="col-12 pb-3">
                <div class="mb-3">
                    <form action="index.php" method="post" enctype="multipart/form-data">
                            <label for="formFile" class="form-label">Matriculados General 2022 (.csv)</label>
                            <input class="form-control mb-3" name="archivo" type="file" id="formFile">
                            <label for="formFile" class="form-label">Distribución docente de tutorias en 2021-1 (.csv)</label>
                            <input class="form-control mb-3" name="archivo1" type="file" id="formFile">
                            <input type="submit" class="btn btn-primary" value="Cargar">
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 p-3">
                <!-- TABLAS de los archivos CSV -->
                <h3 class="pb-3">Tablas</h3>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs pb-3">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#DxD">Matriculados 2022</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#Alumno">Distribución docente</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3">
                    <div class="tab-pane container" id="DxD">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <!--<th>Estado</th>-->
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include 'AllFunctions.php';

                                    if (!isset($_FILES["archivo"])) {
                                        throw new Exception("Selecciona un archivo CSV válido.");
                                    }
                                    $file     = $_FILES["archivo"];
                                    $file1     = $_FILES["archivo1"];
                                    
                                    $Mox=new Group73();
                                    $Arreglo_Matriculados=$Mox->csv_Array($file);
                                    $Mox->Imprimir($Arreglo_Matriculados);
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane container fade" id="Alumno">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <!--<th>Estado</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (!isset($_FILES["archivo"])) {
                                    throw new Exception("Selecciona un archivo CSV válido.");
                                }
                                $file     = $_FILES["archivo"];
                                $file1     = $_FILES["archivo1"];
                                
                                $Mox=new Group73();
                                $Arreglo_Dis_Docentes=$Mox->csv_Array($file1);
                                $Mox->Imprimir($Arreglo_Dis_Docentes);
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6 text p-3">
                <h3 class="pb-3">Resultados</h3>
                <!-- Resultados -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs pb-3">
                    <li class="nav-item">
                        <a class="nav-link " data-bs-toggle="tab" href="#AST">Alumnos Sin Tutor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#ASM">Alumnos Sin Matricula</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3">
                    <div class="tab-pane container active" id="AST">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                 <!--<th>Estado</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $AlumnosSinTutor=$Mox->Diferencia($Arreglo_Matriculados,$Arreglo_Dis_Docentes);
                                $Mox->Imprimir($AlumnosSinTutor);

                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane container fade" id="ASM">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                 <!--<th>Estado</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                
                                $AlumnosSinMatricula=$Mox->Diferencia($Arreglo_Dis_Docentes,$Arreglo_Matriculados);
                                $Mox->Imprimir($AlumnosSinMatricula);
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>