<?php
    function conectar(){
        $bd = mysqli_connect("localhost","root","","grupo2");
        if (!$bd){
            echo "<h3>Error de conexión</h3>Base de datos grupo2 no diponible";
            return NULL;
        }
        else{
            return $bd;
        }
    }
?>
