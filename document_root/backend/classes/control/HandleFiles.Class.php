<?

class HandleFiles extends Control{

	private $affectedDirs = array();


	function uploadImg($fileName, $newName, $fileTemp, $erro, $validExtensions, $myMaxSize, $pathUpload, $redirectPage="", $feedbackMsg=""){

		set_time_limit (0);

		//caminho absoluto onde os arquivos ser�o armazenados
		$dirImgs = "usuarioImg";
		$caminho_absoluto = $pathUpload;

		//// VERIFICA��ES ///

		// Seria o error code '4' ?
		if (empty($fileName) || $erro == 4) {
			handleError(4);
			return 0;
			/*
			$mensagem = "Selecione um arquivo para enviar.";
			die(header("Location: ../index.php?p=status&status=erro&msg=$mensagem&id_item=$id_item"));
			*/
		}

		//Verifica se a extens�o � v�lida
		$checkExtension = $this->checkFileExtension($validExtensions, $fileName);

		if(!$checkExtension) return 0;

		//Verifica se o tamanho excede o limite estipulado
		$size = filesize($fileTemp);
		$maxSize = $myMaxSize;

		if ($size>$maxSize || $erro == 1){
			handleError(7);
			return 0;
			/*
			$mensagem = "O arquivo selecionado excedeu o limite de tamanho. <br>Caso precise de mais espaco, por favor, entre em contato com o webmaster.";
			require('control/SingleEncrypt.Class.php');
			$encrypt = new singleEncrypt();
			$encrypting = $encrypt->hideString($mensagem);
			die(header("Location: ../index.php?p=status&status=erro&msg=$encrypting&id_item=$id_item"));
			*/
		}

		if ($size == 0){
			handleError(8);
			return 0;
			/*
			$mensagem = "Arquivo Vazio ? ";
			require('control/SingleEncrypt.Class.php');
			$encrypt = new singleEncrypt();
			$encrypting = $encrypt->hideString($mensagem);
			die(header("Location: ../index.php?p=status&status=erro&msg=$encrypting&id_item=$id_item"));
			*/
		}

		//Verifica se o dir existe. Se n�o, cria.
		if(!file_exists($pathUpload)){
			mkdir($pathUpload, 0777);
		}

		/// FIM DAS VERIFICA��ES ///

		if(move_uploaded_file($fileTemp, $pathUpload."/".$fileName)) {

			$ext = strrchr($fileName,'.');
			rename($pathUpload.'/'.$fileName, $pathUpload.'/'.$newName.$ext);
			
			if(empty($redirectPage)){

				//header("Location: mostraStatus.php?status=ok&msg=".$feedbackMsg);
			}else{
				//die($redirectPage);
				header("Location: ".$redirectPage);
			}
			handleError(0);
			return 1;
		}

		return 0;
	}

	//Verifica as extens�es do arquivo
	function checkFileExtension($validExtensions, $fileName){
		$myExt = strrchr($fileName,'.');

		if (!in_array($myExt, $validExtensions)) {
			handleError(6);
			return 0;
			/*
			$mensagem = "Extens&atildeo de arquivo inv&aacute;lida para upload.";
			die(header("Location: ../index.php?p=status&status=erro&msg=$mensagem&id_item=$id_item"));
			*/
		}else{
			return $myExt;
		}
	}

	function copyTo($file, $to){
		if (!copy($file, $to)) {
   			die("erro copiando arquivo $arquivo...<br>\n");
			echo "erro copiando arquivo $arquivo...<br>\n";
		}
	}

	//Verifica se existem arquivos em diret�rio
	function checkForFiles($path){

		$i=0;
		//Verifica se existem arquivos no diret�rio pessoal
		if ($handle = @opendir($path)) {

			$myArray = array();
			while (false !== ($file = readdir($handle))) {
				$i++;
				if($file != "." && $file != "..")
					array_push($myArray, $file);
			}

			closedir($handle);

			if(!empty($myArray)){
				//echo "tem imgs";
				return $myArray;
			}else{
				return false;
			}

		} else {
			//echo "Não foi possível abrir o diretório.";
			return false;
		}
	}

	//Verifica se existe um arquivo espec�fico em um diret�rio
	function checkForEspcificFile($path, $searchFile){

		if ($handle = @opendir($path)) {

			$myArray = array();
			while (false !== ($file = readdir($handle))) {
				if($file != "." && $file != ".."){
					if($file == $searchFile){$fileFound = true;}
				}
			}
			closedir($handle);

			if(isset($fileFound) && $fileFound==true)
				return true;
			else
				return false;
		}

	}

	function cleanDir($path){

		//Verifica se existem arquivos no diret�rio pessoal
		if ($handle = opendir($path)) {
			$myArrayCount = array();
			$myArray = array();
			$i=0;

			while (false !== ($file = readdir($handle))) {
				$i++;
				if($file != "." && $file != ".."){
					array_push($myArrayCount, $file);
				}
			}

			//Apaga os arquivos se existirem
			if(count($myArrayCount)!= 0){
				for($j=0; $j<count($myArrayCount); $j++){
					@unlink($path.$myArrayCount[$j]);
				}
			}
			closedir($handle); // encerra o handler
		}

	}

	/*
	//Remove todos arquivos de um caminho e todos arquivos de seus subdiretorios (Recursivamente).
	//*Nao remove os diretorios*
	//
	// $path -> caminho completo ou relativo de um diretorio.
	// Retorna um array com os caminhos dos diretorios afetados.
	*/
	function cleanDirR($path){

		//Verifica os  arquivos no diret�rio pessoal
		$path = $path."/";
		$must = "/anuncios/files/";

		if((strpos($path, $must)) === 0) die("Kill with power! DIE DIE ! ");

		if ($handle = opendir($path)) {

			$myArrayCount = array();
			$myArray = array();

			$i=0;
			//clearstatcache();

			$this->cleanDir($path);
			print("Removing files from: ".$path."<br>");
			array_push($this->affectedDirs, $path);

			while (false !== ($file = readdir($handle))) {
				$i++;
				if(is_dir($path.$file) && ($file != "." && $file != "..")){
					array_push($myArrayCount, $file);
				}
			}

			if(count($myArrayCount)!= 0){
				for($j=0; $j<count($myArrayCount); $j++){
					$this->cleanDirR($path.$myArrayCount[$j]);
				}
			}
			closedir($handle); // encerra o handler
		}


		return $this->affectedDirs;
	}

	/*
	// Remove uma lista de diretorios especificados em um array,
	// do nivel mais alto para o nivel mais baixo.
	//
	// $dirArray -> Array com os caminhos completos ou relativos dos diretorios.
	*/
	function remDir($dirArray){

		for($i=sizeof($dirArray)-1;$i>-1;$i--){
			rmdir($dirArray[$i]);
			print("Erasing directory: ".$dirArray[$i]."<br>");
		}
	}
}

?>
