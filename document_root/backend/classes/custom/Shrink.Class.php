<?
class Shrink extends AutoObj{

    public $Ao;
    private $tableTarget;

    function __construct(){
        $this->tableTarget = 'shrink';
        parent::__construct($this->tableTarget);
        $this->Ao = new AutoObj($this->tableTarget);
        //var_dump($this->Ao);
    }

    function getRandomCode(){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-";

        //Prefered length for random code
        $codeLenght = 5;

        $str = "";
        for($i=0; $i<strlen($chars); $i++){
            $index = rand(0,strlen($chars));
            $str .= substr($chars, $index,1);
        }
        $pos = rand(0,strlen($chars))-$codeLenght-1;
        $str = substr($str, $pos,$codeLenght);
        return $str;
    }

    function getUrl(){
        $fullUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $fullUrl = explode('=', $fullUrl);
        $numSegments = count($fullUrl);
        $longUrl = '';

        //Glues the url with the segment passed by user
        for ($i = 2; $i < $numSegments; $i++) {
            $longUrl .= $fullUrl[$i] . "=";
        }

        $longUrl = substr($longUrl, 0, -1);
        return $longUrl;
    }

    //Credits: Jose Veja on https://stackoverflow.com/questions/4348912/get-title-of-website-via-link
    function getUrlOriginalTitle($url){
        $str = file_get_contents($url);
        if(strlen($str)>0){
            $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
            preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
            return $title[1];
        }else{
            return false;
        }
    }


}

?>
