<? Class HandleStrings extends Control{

	function removeBlankSpaces($myString){
		$stringReplaced = str_replace(" ", "", $myString);
		return $stringReplaced;
	}

	function cleanString(string $str) : string{
        return preg_replace('/[^A-Za-z0-9]/', '', $str);
	}

	function switchConcat($redirect){
		$myString = $redirect;
		$concat   = '?';
		$pos = strpos($myString, $concat);
		if ($pos === false) {
			$concat = '?';
		} else {
			$concat = '&';
		}
		return $concat;
	}

	function checkUrlGets(){
			if(empty($_GET)){
				$concat = "?";
			}else{
				$concat = "&amp;";
			}
			return $concat;
	}
}
?>
