<div class="contenido">
    <form action="" name="entrar" method="post" enctype="multipart/form-data">
        <p id="titulo_de_pagina">Iniciar</p>
        <input required type="email" name="correo_electronico" id="" placeholder="correo@correo.com">
        <input required type="password" name="contrasena" id="" placeholder="********">
        <div class="contenedorIcon">
            <input type="submit" value="&rarr;" name="enviar" class="icon" id="enviar">
        </div>
        <a href="registrar.php">Registrate</a>
        <a href="solicitar_contrasena">Olvide mi contrasena</a>
    </form>
</div>
<?php
if(isset ($_POST["enviar"])){
    $aviso="";
    $correoElectronico=htmlspecialchars($_POST["correo_electronico"]);
    $contrasena= htmlspecialchars($_POST["contrasena"]);
    try{
        $sql = "SELECT * FROM cliente WHERE correo_electronico = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute(array($correoElectronico));
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if($resultado){
            $contrasenaDB = $resultado["contrasena"];
            $rol = $resultado["rol"];
            if (password_verify($contrasena,$contrasenaDB)){
                $_SESSION["ID"] = session_id();
                $_SESSION["NUMERO_DE_CLIENTE"] = $resultado["numero_de_cliente"];
                $_SESSION["USUARIO"] = $resultado["nombre"];
                $_SESSION["CORREO"] = $resultado["correo_electronico"];
                $_SESSION["STATUS"] = "ACTIVA";
                $_SESSION["ROL"] = $rol;
                if($rol == 0 ){
                    echo "<script>
                        location.href = index.php?pagina=tienda'
                        </script>";
                }elseif($rol == 1){
                    echo "<script>
                        location.href = index.php?pagina=mostrar_albumes'
                        </script>";
                }
            }else{
                $aviso .= "Autentificacion incorrecta <br>";
            }
        }else{
            $aviso .= "Autentificacion incorrecta <br>";
        }

    }catch(PDOException $e){
        echo $e->getMessage();
        echo "hubo un error";
    }
    echo "<div id='aviso'>".$aviso."</div>";

}
?>
