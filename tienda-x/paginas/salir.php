<?php
if(!isset($_SESSION["ID"]) && $_SESSION["STATUS"]!="ACTIVA"){
    echo "<script>
            alert('No estas autorizado para ver esta pagina');
            location.href = '../index.php';
            </script>";
}
unset($_SESSION["ID"]);
unset($_SESSION["STATUS"]);
unset($_SESSION["USUARIO"]);
unset($_SESSION["CORREO"]);
unset($_SESSION["ROL"]);
//destruir sesion
session_destroy();
//cerrar conexion
$conexion =  null;
echo "<script> 
    location.href = '".$_SERVER["PHP_SELF"]."'
    </script>";
?>