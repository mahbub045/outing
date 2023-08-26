<?php

$host="localhost";
$user="root";
$pass="";
$dataBaseName="outing";

$connection=new mysqli($host,$user,$pass,$dataBaseName);

if($connection -> connect_error ){
	die($connection -> error);
}
else{
	// echo "Database Connected";
}

?>