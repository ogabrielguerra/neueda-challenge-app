<?php
	Class Route extends AutoObj{

		function __construct(){
			parent::__construct('route');
			$errorMsg = 'Impossible to reach target file';

            if(isset($_GET["pag"]) && !empty($_GET["pag"])){
				$key = $_GET["pag"];
				$filter = 'route_key = \''.$key.'\' ORDER BY route_id LIMIT 0,1';

				if($data = $this->getObjData($filter)) {
					require($data[0]->route_file_path);
				}else{
					echo "<br>$errorMsg";
				}
			}else{
				header("Location: ?pag=listarClientes");
			}
		}
	}
?>
