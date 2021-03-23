<?php
	if(file_exists('../config.php')){
		require_once('../config.php');
	}elseif(file_exists('config.php')){
		require_once('config.php');
	}
	
	class Connection
	{
		
		public static function conn(){
			try{
				$pdo = new PDO('mysql:host=localhost;dbname=dbdiary', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				return $pdo;
			}catch(Exception $e){
				echo "<h1>Erro ao conectar</h1>";
			}
		}

		public static function formatData($data){
			return preg_replace("/[^0-9]/", "",$data);
		}

		public static function validaCampos($array){

		}

	}
 
?>