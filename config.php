<?php  
	function myAutoLoad($class) {
		if(file_exists('../Classes/'.$class.'.php')) {
			include('../Classes/'.$class.'.php');
		}else if(file_exists('Classes/'.$class.'.php')){
			include('Classes/'.$class.'.php');
		}
	}

	spl_autoload_register('myAutoLoad');
?>