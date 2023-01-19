<?php
        
    include("conecta.php");
    $bd = conectar();
    $idPersona = $_POST["id_persona"];

    $sql = "DELETE FROM persona where id = '$idPersona'";
    $query_del = mysqli_query($bd,$sql);

    $mensaje = "eliminado";

    mysqli_close($bd);
    echo json_encode($mensaje);
?>