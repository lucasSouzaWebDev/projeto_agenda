<?php
	if(file_exists('../config.php')){
		include_once('../config.php');
	}elseif(file_exists('config.php')){
		include_once('config.php');
	}

	class Contact
	{
		private $name;
		private $cpf;
		private $email;
		private $cellPhone;
		private $birthDate;

		function __construct($name, $cpf, $email, $birthDate)
		{
			$this->name = $name;
			$this->cpf = $cpf;
			$this->email = $email;
			$this->birthDate = $birthDate;
		}

		public function get_name() {
    		return $this->name;
  		}

  		public function get_cpf() {
  			if($this->cpf == "" || $this->cpf == null){
  				return "N/A";
  			}
    		return Connection::formatData($this->cpf);
  		}

  		public function get_email() {
  			if($this->email == "" || $this->email == null){
  				return "N/A";
  			}
    		return $this->email;
  		}

  		public function get_birthDate() {
    		return $this->birthDate;
  		}

  		private function validaCPF($cpf) {
     
		    // Verifica se foi informado todos os digitos corretamente
		    if (strlen($cpf) != 11) {
		        return "invalido";
		    }

		    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
		    if (preg_match('/(\d)\1{10}/', $cpf)) {
		        return "invalido";
		    }

		    // Faz o calculo para validar o CPF
		    for ($t = 9; $t < 11; $t++) {
		        for ($d = 0, $c = 0; $c < $t; $c++) {
		            $d += $cpf[$c] * (($t + 1) - $c);
		        }
		        $d = ((10 * $d) % 11) % 10;
		        if ($cpf[$c] != $d) {
		            return "invalido";
		        }
		    }
		    $pdo = Connection::conn();
		    $sql = $pdo->prepare("SELECT cpf FROM contact WHERE cpf = $cpf");
		    $sql->execute();
		    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
		    if($resultado != null){
		    	return "existente";
		    }
		    return "valido";

		}

		private function validaEmail($email){
			if(!(strrpos($email, "."))){
				return "invalido";
			}
			$pdo = Connection::conn();
		    $sql = $pdo->prepare("SELECT email FROM contact WHERE email = '$email'");
		    $sql->execute();
		    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
		    if($resultado != null){
		    	return "existente";
		    }
		    return "valido";

		}

  		public function saveContact($contactReceived){
  			// validando cpf
  			if(!(empty($contactReceived->get_cpf())) && ($contactReceived->get_cpf() != "N/A")){
  				$cpfValidado = Contact::validaCPF($contactReceived->get_cpf());
  				if($cpfValidado == "invalido"){
  					return "cpf invalido";
  					
  				}elseif($cpfValidado == "existente"){
  					return "cpf existente";
  				}
  			}
  			//validando email
  			if(!(empty($contactReceived->get_email())) && ($contactReceived->get_email() != "N/A")){
  				$emailValidado = Contact::validaEmail($contactReceived->get_email());
  				if($emailValidado == "invalido"){
  					return "email invalido";
  					
  				}elseif($emailValidado == "existente"){
  					return "email existente";
  				}
  			}

  			try{
		  		$pdo = Connection::conn();
		  		$sql = $pdo->prepare("INSERT INTO contact(nome, cpf, email, data_nasc) VALUES (?,?,?,?)");
		  		$sql->execute(array($contactReceived->get_name(), $contactReceived->get_cpf(), $contactReceived->get_email(), $contactReceived->get_birthDate()));
		  		return $pdo->lastInsertId();
		  	}catch(PDOException $e){
		  		echo "Error: " . $e->getMessage();
		}
  			
  			
  		}

  		public static function getContactsDb(){
  			try{
  				$pdo = Connection::conn();
  				$sql = $pdo->prepare("SELECT id, nome FROM contact");
  				$sql->execute();
  				$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  				foreach ($resultado as $key => $value) {
  					echo "<option value='".$value['id']."'>".$value['nome']."</option>";

  				}
  				echo "<option value='0'>Selecione</option>";
  			}catch(PDOException $e){
  				echo "Error: ". $e->getMessage();
  			}
  		}

	}
	if(isset($_GET['getContacts'])){
		Contact::getContactsDb();
	}
	




?>