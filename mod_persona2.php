<?php
    include("conecta.php");
    $bd = conectar();

    $idPersona = $_POST["txtIdPersona"];
    $ced = $_POST["txtCed"];
    $nom = $_POST["txtNom"];
    $ape = $_POST["txtApe"];
    $fech_naci = $_POST["txtFechNaci"];
    $comuna = $_POST["txtComuna"];

    $mensaje = "no modificado";

    $sql = "UPDATE persona set cedula = '$ced', nombre = '$nom', apellido = '$ape', fech_naci = '$fech_naci', comuna = '$comuna' where id = '$idPersona'";
    
    try{
        $query_update = mysqli_query($bd, $sql);
        $mensaje = "modificado";
    }catch (Exception $e){
        $mensaje = "ya existe";
    }
    
    mysqli_close($bd);
    echo json_encode($mensaje);
?>
