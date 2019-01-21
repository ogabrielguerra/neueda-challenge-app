<?
class HandleMsgs extends View{

	function setMsg($msg){
		
		@session_start();
		$_SESSION["statusMessage"] = $msg;
		$_SESSION["statusMessageCheck"] = false;
	}

	function getMsg(){
		@session_start();

		if(isset($_SESSION["statusMessage"])){
			return $_SESSION["statusMessage"];
		}else{
			return false;
		}
	}

	function msgView(){
		@session_start();

		if( $this->getMsg() && $_SESSION["statusMessageCheck"]==false ){

			$output = '
			<script>
			function autoDestruct(obj){
			function clearAlert(){
	    		$(\'.alert\').fadeOut(\'slow\');
	    		clearInterval(close);
	    	}
	    	let close = setInterval(clearAlert, 3000);    	
	    	}
	    	</script>

			<div class="alert alert-success alert-dismissable fade-in">
				<script type="text/javascript">autoDestruct();</script>
		        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		        <h3 class="font-w300 push-15">Successo!</h3>
		        <p>'.$this->getMsg().'</p>
	    	</div>
	    	';
	    	
	    	$_SESSION["statusMessageCheck"] = true;
	    	return $output;

    	}else{
    		return false;
    	}
	}



	function showErrorMsg($msg){
		echo "<p class='mensagem-de-erro'>".$msg."</p>";
	}
	
	function showStatusMsg($msg){
		echo "<p class='mensagem-status'>".$msg."</p>";
	}
	
	function getMsgFromUrl(){
		
		if (isset($_GET['msg']) && !empty($_GET['msg'])){
			$handleStrings = new HandleStrings();
			$msg = $handleStrings->showString($_GET['msg']);
		}else{
			$msg = '';
		}
		
		return $msg;
		
	}	
	
}

?>