<?php
DEFINE("USUARIO","Lousy");
DEFINE("CONTRASEÑA","Ichl1eved!sh");
try{
 $host = "localhost";
 $database = "Compras_en_linea";
 $conexion = new
 
 PDO("mysql:host=$host;dbname = Compras_en_linea",USUARIO,CONTRASEÑA);
 $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 echo "Conexion realizada";
 $consulta = "USE $database";
   $consulta = $conexion->prepare($consulta);
   $consulta->execute();
}catch(PDOException $e){
 echo $e->getMessage();
 echo "No se pudo realizar la conexion";
}
?>