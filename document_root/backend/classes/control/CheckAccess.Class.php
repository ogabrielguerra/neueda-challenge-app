<?
	Class CheckAccess extends AutoObj{

		function __construct($db=""){
			parent::__construct();
		}

		function registerSession(int $id, string $login="", string $nome=""){
			@session_start();
			$_SESSION["registeredLogin"] = $login;
			$_SESSION["idUser"] = $id;
			$_SESSION["nomeUser"] = $nome;
		}

		function checkSession(string $redirectPage, string $url="") : array{
			@session_start();
			if(isset($_SESSION["registeredLogin"]) && !empty($_SESSION["registeredLogin"])){
				return array($_SESSION["idUser"], $_SESSION["registeredLogin"]);

			} else {
				$check = new HandleStrings();
				$concat = $check->switchConcat($redirectPage);

				if($redirectPage)
					header("Location:".$redirectPage.$concat."url=".$url);

				return array();
			}
		}

		function destroySession(string $redirectPage){
			session_start();
			$_SESSION = array();
			session_destroy();
			header("Location:".$redirectPage);
		}

		function errorRedirect(string $url){
			header("Location:".$url);
			die('Erro de login');
		}

		function testLoginAdmin(string $login, string $password, string $tableTarget, string $errorRedirect="loginErro.php", string $url="loginOk.php"){
			if(empty($login)||empty($password))
				die("All fields required! <br> <a href='javascript:history.back();'>voltar</a>");

			$query2 = 'SELECT id_usuario, usuario_login, usuario_senha, usuario_nome FROM '.$tableTarget.' WHERE usuario_login = \''.$login.'\'';
			$queryResult = $this->resource->prepare($query2);

			try{
	        	$queryResult->execute();
	        	if($queryResult->rowCount() != 0){
					//This email exists, good! Let's check the password
					$data  = $queryResult->fetch(PDO::FETCH_OBJ);

					if(password_verify($password, $data->usuario_senha)){
						//You shall pass!
						$this->registerSession($data->id_usuario, $data->usuario_login, $data->usuario_nome);
						header("Location:".$url);
						die();
					}else{
						$this->errorRedirect($errorRedirect);
					}
				}else{
					$this->errorRedirect($errorRedirect);
				}
		    }
		    catch(PDOException $exception){
				$this->errorRedirect($errorRedirect);
		    }
		}

	}
	//$options = ['cost' => 8];
	//$hash = password_hash($password, PASSWORD_DEFAULT, $options);
?>
