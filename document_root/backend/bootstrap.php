<?php

	/* Calls ENV configuration */
	require 'config/env.php';
	/* ********************** */

	/* Calls DB configuration */
	require 'config/db.php';
	/* ********************** */

	spl_autoload_register("loadClasses");

	function loadClasses($Class){
		
		$modelClasses = CLASSPATH.'model/'.$Class.'.Class.php';
		$controlClasses = CLASSPATH.'control/'.$Class.'.Class.php';
		$customClasses = CLASSPATH.'custom/'.$Class.'.Class.php';
		$viewClasses = CLASSPATH.'view/'.$Class.'.Class.php';

		if(file_exists($modelClasses)){
			require $modelClasses;
		}else if(file_exists($controlClasses)){
			require $controlClasses;
		}else if(file_exists($viewClasses)){
			require $viewClasses;
		}else if(file_exists($customClasses)){

			require $customClasses;
		}else{
			echo $customClasses;
			die('<br>Unable to load class '.$Class.'. Crash!');
		}
	}

?>
