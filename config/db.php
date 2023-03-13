<?php 
session_start();
setLocale(LC_TIME, 'fr');
    $host = "127.0.0.1";
	$dbname = "vente_provande";
	$username = "root";
	$password = "";

	try{
		$db = new PDO("mysql:host=".$host.";dbname=".$dbname,$username,$password);
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	}catch(PDOException $e){
		die("Une erreur est survenue lors de la connexion à la base de donnee <br>".$e->getMessage());
	}

	function setFlash($message,$type='success'){
		$_SESSION['flash']['message'] = $message;
		$_SESSION['flash']['type'] = $type;
	}
?>