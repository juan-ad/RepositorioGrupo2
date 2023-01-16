<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="shortcut icon" href="./img/user.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/styles.css">

</head>
<body>
    <div class="container mt-4 mb-3">
    
        <?php 
            include('conecta.php');
            $bd = conectar();

            $sql = "SELECT id, cedula, nombre, apellido, fech_naci, comuna FROM persona";

            $datos = mysqli_query($bd, $sql);
        ?>
        <div class="table-wrapper table-responsive">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Gestión de <b>Personas</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a onclick="añadir()" href="#addPersonModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir Persona</span></a>
                    </div>
                </div>
            </div>
            <table id="tblUsuarios" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class='p-3' width='300px'>Identificación</th>
                        <th class='p-3' width='300px'>Nombre</th>
                        <th class='p-3' width='300px'>Apellido</th>
                        <th class='p-3' width='300px'>Fecha Nacimiento</th>
                        <th class='p-3 text-center' width='300px'>Comuna</th>
                        <th class='p-3 text-center' width='300px'>Opciones</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($arr = mysqli_fetch_array($datos)) {
                            echo "<tr>";
                                echo "<td class='p-3' width='300px'>$arr[1]</td>";
                                echo "<td class='p-3' width='400px'>$arr[2]</td>";
                                echo "<td class='p-3' width='400px'>$arr[3]</td>";
                                echo "<td class='p-3' width='300px'>$arr[4]</td>";
                                echo "<td class='p-3 text-center' width='200px'>$arr[5]</td>";
                                echo "<td class='p-3 text-center' width='300px'>";                
                                    echo "<a href='#' onclick=editar('$arr[0]') class='edit'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>";
                                    echo "<a href='#' onclick=eliminar('$arr[0]') class='delete'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>";
                                echo "</td>";
                            echo "<tr>";
                        }
                        mysqli_close($bd);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Añadir -->
    <div class="modal fade" tabindex="-1" id="modalAdd">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white fw-bold text-center">
                    <h5 class="modal-title">Registrar Persona</h5>
                </div>
                
                <form id="frmAddPersona" action="add_persona.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="txtCed" class="form-label">Identificación</label>
                            <input type="text" class="form-control" name="txtCed" required pattern="[0-9]{1,11}" title="Solo debe ingresar números">
                        </div>

                        <div class="mb-4">
                            <label for="txtNom" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="txtNom" required maxlength="100">
                        </div>

                        <div class="mb-4">
                            <label for="txtApe" class="form-label">Apellido</label>
                            <input type="text" class="form-control" name="txtApe" required maxlength="100">
                        </div>

                        <div class="mb-4">
                            <label for="txtFechNaci" class="form-label">Fecha Nacimiento</label>
                            <input type="date" class="form-control" name="txtFechNaci" required max="2023-01-30">
                        </div>

                        <div class="mb-4">
                            <label for="txtComuna" class="form-label">Comuna</label>
                            <input type="text" class="form-control" name="txtComuna" pattern="[0-9]{1}|[0-9]{1}[0-2]{1}" title="La comuna debe estar entre 0 y 12" required">
                        </div>
                    </div>    
                    <div class="modal-footer">
                        <button onclick="cancelar()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" tabindex="-1" id="modalEdit">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white fw-bold text-center">
                    <h5 class="modal-title">Modificar Persona</h5>
                </div>
                <div id="divres"></div>
            </div>
        </div>
    </div>

    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/persona.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
