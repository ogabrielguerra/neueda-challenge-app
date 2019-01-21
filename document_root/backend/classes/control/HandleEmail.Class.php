<?
class HandleEmail extends Control{
	
	function sendEmail($myDestination, $mySender, $myMsg, $mySubject, $mySenderAlias, $redirectPage="", $feedbackMsg=""){
			
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
			$headers .= "From: ".$mySenderAlias."<".$mySender.">\r\n";

			//to: , subject: , msg: , headers
			if(mail($myDestination, $mySubject, $myMsg, $headers)){
				if(!empty($redirectPage)){
					header("Location: ".$redirectPage."&msg=".$feedbackMsg);
				}
				//echo $myDestination . " - ". $mySender. " - ". $myMsg . " - ".$mySubject . " - ".$mySenderAlias;
			}else {
				header("Location: $baseUrl/erroEmail.php");
				die();
			}
	}
	
	function validateEmail($email){
		if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) 
			return true;
		else 
			return false;
	}

}

?>