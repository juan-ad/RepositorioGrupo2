<?php
    include("conecta.php");
    $bd = conectar();

    $ced = $_POST["txtCed"];
    $nom = $_POST["txtNom"];
    $ape = $_POST["txtApe"];
    $fechNaci = $_POST["txtFechNaci"];
    $comuna = $_POST["txtComuna"];

    $mensaje = "";

    $sql = "SELECT cedula FROM persona WHERE cedula = '$ced'";
    $query_select = mysqli_query($bd, $sql);

    if (mysqli_num_rows($query_select) > 0){
        $mensaje = "ya existe";
        
    }else{
        $sql_insert = "INSERT INTO persona VALUES(NULL,'$ced','$nom','$ape','$fechNaci','$comuna')";

        $query_insert = mysqli_query($bd, $sql_insert);       

        if ($query_insert){
            $mensaje = "registrado";
        }
        else {
            $mensaje = "no registrado";
        }
    }            

    mysqli_close($bd);
    echo json_encode($mensaje);
?>
