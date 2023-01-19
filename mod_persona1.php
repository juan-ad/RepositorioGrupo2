<?php
    include("conecta.php");
    $bd = conectar();
    $idPersona = $_POST["id_persona"];

    $sql = "SELECT id, cedula, nombre, apellido, fech_naci, comuna FROM persona WHERE id = '$idPersona'";
    $datos = mysqli_query($bd, $sql);
    $arr = mysqli_fetch_array($datos);
?>

<form id="frmModPersona" action="mod_persona2.php" method="POST">
    <div class="modal-body">
        <input type="hidden" class="form-control" name="txtIdPersona" value="<?php echo $idPersona ?>">

        <div class="mb-4">
            <label for="txtCed" class="form-label">Cédula</label>
            <input type="text" class="form-control" name="txtCed" pattern="[0-9]{1,11}" title="Solo debe ingresar números" required maxlength="100" value="<?php echo $arr[1] ?>">
        </div> 

        <div class="mb-4">
            <label for="txtNom" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="txtNom" required maxlength="100" value="<?php echo $arr[2] ?>">
        </div> 

        <div class="mb-4"> 
            <label for="txtApe" class="form-label">Apellido</label>
            <input type="text" class="form-control" name="txtApe" required maxlength="100" value="<?php echo $arr[3] ?>">
        </div> 

        <div class="mb-4">
            <label for="txtFechNaci" class="form-label">Fecha Nacimiento</label>
            <input type="date" class="form-control" name="txtFechNaci" required max="2023-01-30" value="<?php echo $arr[4] ?>">
        </div>

        <div class="mb-4">
            <label for="txtComuna" class="form-label">Comuna</label>
            <input type="text" class="form-control" name="txtComuna"  pattern="[0-9]{1}|[0-9]{1}[0-2]{1}" title="La comuna debe estar entre 0 y 12" required value="<?php echo $arr[5] ?>">
        </div>
    
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary py-2">Modificar</button>
    </div>

</form>

<script src="js/persona.js"></script>
