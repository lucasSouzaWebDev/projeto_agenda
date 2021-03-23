<?php 
	if(file_exists('../config.php')){
		include_once('../config.php');
	}elseif(file_exists('config.php')){
		include_once('config.php');
	}
	class Address
	{
		private $cep;
		private $rua;
		private $numero;
		private $bairro;
		private $cidade;
		private $uf;

		function __construct($cep, $rua, $numero, $bairro, $cidade, $uf)
		{
			$this->cep = $cep;
			$this->rua = $rua;
			$this->numero = $numero;
			$this->bairro = $bairro;
			$this->cidade = $cidade;
			$this->uf = $uf;
		}

		public function get_cep() {
			if($this->cep == "" || $this->cep == null){
  				return "N/A";
  			}
    		return Connection::formatData($this->cep);
  		}

  		public function get_rua() {
  			if($this->rua == "" || $this->rua == null){
  				return "N/A";
  			}
    		return $this->rua;
  		}

  		public function get_numero() {
  			if($this->numero == "" || $this->numero == null){
  				return "N/A";
  			}
    		return Connection::formatData($this->numero);
  		}

  		public function get_bairro() {
  			if($this->bairro == "" || $this->bairro == null){
  				return "N/A";
  			}
    		return $this->bairro;
  		}

  		public function get_cidade() {
  			if($this->cidade == "" || $this->cidade == null){
  				return "N/A";
  			}
    		return $this->cidade;
  		}

  		public function get_uf() {
  			if($this->uf == "" || $this->uf == null){
  				return "N/A";
  			}
    		return $this->uf;
  		}


		public static function getAddressData($idContact, $update = 1){
			try{
				$pdo = Connection::conn();
				$sql = $pdo->prepare("SELECT idContact,cep, logradouro, numero, bairro, localidade, uf FROM address WHERE idContact='$idContact'");
				$sql->execute();
				$resultado = $sql->fetchAll(PDO::FETCH_BOTH);
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

		public function saveAddress($contactReceived, $addressReceived){
			try{
				$pdo = Connection::conn();
				$sql = $pdo->prepare("INSERT INTO address(idContact, cep, logradouro, numero, bairro, localidade, uf) VALUES(?,?,?,?,?,?,?)");
				$sql->execute(array($contactReceived, $addressReceived->get_cep(), $addressReceived->get_rua(), $addressReceived->get_numero(), $addressReceived->get_bairro(), $addressReceived->get_cidade(), $addressReceived->get_uf()));	
			}catch(PDOException $e){
				echo "Error: " . $e->getMessage();
			}
			
		}

		public function updateAddress($contactReceived, $addressReceived){
			try{
				$pdo = Connection::conn();
				$sql = $pdo->prepare("UPDATE address SET cep=?, logradouro=?, numero=?, bairro=?, localidade=?, uf=? WHERE `address`.`idContact`=$contactReceived");
				$sql->execute(array($addressReceived->get_cep(), $addressReceived->get_rua(), $addressReceived->get_numero(), $addressReceived->get_bairro(), $addressReceived->get_cidade(), $addressReceived->get_uf()));
			}catch(PDOException $e){
				echo "Error: " . $e->getMessage();
			}
	
		}


	}
if(isset($_GET['getData'])){
	Address::getAddressData($_GET['getData']);
}

?>