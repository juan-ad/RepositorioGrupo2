<?php
    function conectar(){
        $bd = mysqli_connect("localhost","root","","persona");
        if (!$bd){
            echo "<h3>Error de conexión</h3>Base de datos persona no diponible";
            return NULL;
        }
        else{
            return $bd;
        }
    }
?>