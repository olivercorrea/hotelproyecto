<?php 
$contrasena = "AVNS_kKSkflCp2xGgajXHnqB";
$usuario = "doadmin";
$nombre_bd = "defaultdb";

try {
	$bd = new PDO (
		'db-mysql-nyc1-28475-do-user-14089120-0.b.db.ondigitalocean.com;
		dbname='.$nombre_bd,
		$usuario,
		$contrasena,
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
	);
} catch (Exception $e) {
	echo "Problema con la conexion: ".$e->getMessage();
}
?>
