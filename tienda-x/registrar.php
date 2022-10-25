<?php
include("registrar.html");
include("funciones.php");
include("conexion.php");
if(isset($_POST["enviar"])){
    $aviso = "";
    $nombre = htmlspecialchars($_POST["nombre"]);
    $apellido = htmlspecialchars($_POST["apellido"]);
    $nombreCompleto = $nombre . " " .$apellido;
    $direccion = htmlspecialchars($_POST["direccion"]);
    $codigoPostal = htmlspecialchars($_POST["codigo_postal"]);
    $ciudad = htmlspecialchars($_POST["ciudad"]);
    $correo = htmlspecialchars($_POST["correo_electronico"]);
    $contrasena = htmlspecialchars($_POST["contrasena"]);
    $contrasenaCifrada = password_hash($contrasena,PASSWORD_DEFAULT);
    //comprobamos que el correo exista o no en la DB;
    $sql = "SELECT * FROM cliente WHERE  correo_electronico = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute(array($correo));
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    if($resultado){
        $aviso="El correo $correo ya esta registado, intenta con uno nuevo";
    }else{
        try{
        $sql = "INSERT INTO cliente (nombre,apellido,direccion,codigo_postal,ciudad,correo_electronico,contrasena) VALUES(?,?,?,?,?,?,?);";
        $set = $conexion->prepare($sql);
        $set->execute(array($nombre,$apellido,$direccion,$codigoPostal,$ciudad,$correo,$contrasenaCifrada));
        $aviso = "Te has registado con exito";
        /*
        // preparar mensaje
        $asunto = "Registro";
        $mensaje = "Estimado $nombreCompleto, por este medio confirmamos la creacion de tu cuenta en la tienda en linea";
        // Enciar correo
        enviarCorreo($correo,$nombreCompleto,$asunto,$mensaje);
        */
        }catch(PDOException $e ){
            $aviso = "No se ha podido realizar el registro";
            echo $e->getMessage();
        }

        
    }
    echo "<div id='aviso'>".$aviso."</div>";

}
?>
