<?php 
	if(file_exists('../config.php')){
		require_once('../config.php');
	}elseif(file_exists('config.php')){
		require_once('config.php');
	}
	class Phone
	{
		private $commercialPhone;
		private $residentialPhone;
		private $cell_phone;

		function __construct($commercialPhone, $residentialPhone, $cell_phone){
			$this->commercialPhone = $commercialPhone;
			$this->residentialPhone = $residentialPhone;
			$this->cell_phone = $cell_phone;
		}

		public function get_commercialPhone() {
			if($this->commercialPhone == "" || $this->commercialPhone == null || $this->commercialPhone == "N/A"){
  				return "N/A";
  			}
    		return Connection::formatData($this->commercialPhone);
  		}

  		public function get_residentialPhone() {
  			if($this->residentialPhone == "" || $this->residentialPhone == null || $this->commercialPhone == "N/A"){
  				return "N/A";
  			}
    		return Connection::formatData($this->residentialPhone);
  		}

  		public function get_cell_phone() {
    		return Connection::formatData($this->cell_phone);
  		}

  		public static function getPhoneData($idContact, $update = 1){
			try{
				$pdo = Connection::conn();
				$sql = $pdo->prepare("SELECT idContact,commercial_phone,residential_phone,cell_phone FROM phone WHERE idContact='$idContact'");
				$sql->execute();
				$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
				if($update != 1){
					return $resultado;
				}
				if($resultado != null){
					echo json_encode($resultado[0]);
				}else{
					echo "";
				}
			}catch(PDOException $e){
				echo "Error: " . $e->getMessage();
			}
		}

		private function validaOptionalPhone($phone, $data){
			if(strlen($phone) != 10){
				return "invalido";
			}
			$pdo = Connection::conn();
		    $sql = $pdo->prepare("SELECT $data FROM phone WHERE $data= $phone");
		    $sql->execute();
		    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
		    if($resultado != null){
		    	return "existente";
		    }
		    return "valido";
		}

		private function validaCellPhone($phone, $contact = 0){
			if(strlen($phone)!= 11){
				return "invalido";
			}
			$pdo = Connection::conn();
			if($contact === 0){
				$sql = $pdo->prepare("SELECT cell_phone FROM phone WHERE cell_phone = $phone");
			}else{
				$sql = $pdo->prepare("SELECT cell_phone FROM phone WHERE cell_phone = $phone AND idContact != $contact");
			}
		    $sql = $pdo->prepare("SELECT cell_phone FROM phone WHERE cell_phone = $phone AND idContact != $contact");
		    $sql->execute();
		    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
		    if($resultado != null){
		    	return "existente";
		    }
		    return "valido";
		}

  		public function savePhone($contactReceived,$phonesReceived){
  			
  			// validando telefone celular
  			$celularValidado = Phone::validaCellPhone($phonesReceived->get_cell_phone());
  			if($celularValidado == "invalido"){
  				return "celularC invalido";
  					
  			}elseif($celularValidado == "existente"){
  				return "celularC existente";
  			}
  			try{
  				$pdo = Connection::conn();
  				$sql = $pdo->prepare("INSERT INTO phone(idContact,commercial_phone, residential_phone, cell_phone) VALUES (?,?,?,?)");
  				$sql->execute(array($contactReceived, $phonesReceived->get_commercialPhone(), $phonesReceived->get_residentialPhone(), $phonesReceived->get_cell_phone()));
  			}catch(PDOException $e){
  				echo "Error: " . $e->getMessage();
  			}
  		}

  		public function updatePhone($contactReceived, $phonesReceived){
  			if($contactReceived == ""){
  				return "sem nome";
  			}
  			// validando telefone comercial
  			if(!(empty($phonesReceived->get_commercialPhone())) && ($phonesReceived->get_commercialPhone() != "N/A")){
  				$comercialValidado = Phone::validaOptionalPhone($phonesReceived->get_commercialPhone(), "commercial_phone");
  				if($comercialValidado == "invalido"){
  					return "comercial invalido";
  					
  				}elseif($comercialValidado == "existente"){
  					return "comercial existente";
  				}
  			}
  			// validando telefone residencial
  			if(!(empty($phonesReceived->get_residentialPhone())) && ($phonesReceived->get_residentialPhone() != "N/A")){
  				$residencialValidado = Phone::validaOptionalPhone($phonesReceived->get_commercialPhone(), "residential_phone");
  				if($residencialValidado == "invalido"){
  					return "residencial invalido";
  					
  				}elseif($residencialValidado == "existente"){
  					return "residencial existente";
  				}
  			}
  			// validando telefone celular
  			$celularValidado = Phone::validaCellPhone($phonesReceived->get_cell_phone(), $contactReceived);
  			if($celularValidado == "invalido"){
  				return "celular invalido";
  					
  			}elseif($celularValidado == "existente"){
  				return "celular existente";
  			}
			try{
				$pdo = Connection::conn();
				$sql = $pdo->prepare("UPDATE phone SET commercial_phone=?, residential_phone=?, cell_phone=? WHERE `phone`.`idContact`=$contactReceived");
				$sql->execute(array($phonesReceived->get_commercialPhone(), $phonesReceived->get_residentialPhone(), $phonesReceived->get_cell_phone()));
				return "validado";
			}catch(PDOException $e){
				echo "Error: " . $e->getMessage();
			}
	
		}
	}
if(isset($_GET['getDataPhone'])){
		Phone::getPhoneData($_GET['getDataPhone']);
	}

?>