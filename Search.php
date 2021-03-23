<?php  
	if(file_exists('../config.php')){
        include_once('../config.php');
    }elseif(file_exists('config.php')){
        include_once('config.php');
    }


    class Search
    {
    	
    	public static function searchContacts($value){
    		$pdo = Connection::conn();
    		$sql = $pdo->prepare("SELECT `contact`.`id`, `contact`.`nome`, `contact`.`cpf`, `contact`.`email`, `contact`.`data_nasc`, `address`.`cep`, `address`.`logradouro`, `address`.`numero`, `address`.`numero`, `address`.`bairro`, `address`.`localidade`, `address`.`uf`, `phone`.`commercial_phone`, `phone`.`residential_phone`, `phone`.`cell_phone` FROM ((address RIGHT JOIN contact ON `address`.`idContact`=`contact`.`id`)LEFT JOIN phone ON `phone`.`idContact`=`contact`.`id`) WHERE `contact`.`nome` LIKE '%$value%'");
    		$sql->execute();
    		$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    		if($resultado != null){

    			foreach ($resultado as $key => $value) {
	    			echo "<tr>";
	    			echo "<td class='text-center'>".$value['id']."</td>";
	    			echo "<td class='text-center'>".$value['nome']."</td>";
	    			echo "<td class='text-center'>".$value['cpf']."</td>";
	    			echo "<td class='text-center'>".$value['email']."</td>";
	    			$ano = substr($value['data_nasc'], 0, 4);
	    			$mes = substr($value['data_nasc'], 5, 2);
	    			$dia = substr($value['data_nasc'], 8, 2);
	    			$dma = $dia.$mes.$ano;
	    			$dateFormated = preg_replace("/(\d{2})(\d{2})(\d{4})/", "$1/$2/$3", $dma);
	    			echo "<td class='text-center'>".$dateFormated."</td>";
	    			if(isset($value['logradouro'])){
	    				echo "<td class='text-center'>".$value['cep']." - ".$value['logradouro'].", ".$value['numero']." - ".$value['bairro'].", ".$value['localidade']." - ".$value['uf']."</td>";
	    			}else{
	    				echo "<td class='text-center'>N/A</td>";	
	    			}
	    			
	    			echo "<td class='text-center'>".$value['commercial_phone']." - ".$value['residential_phone']." - ".$value['cell_phone']."</td>";

    			}
    		}else{
    			echo "<tr><td><td><td>";
    			echo "<td>Nenhum contato encontrado.";
    			echo "</tr>";
    		}
    		
    	} 
    }
    if(isset($_GET['search'])){
    	Search::searchContacts($_GET['search']);
    }


?>