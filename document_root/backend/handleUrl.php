<?php

    //Check if url is being passed
    if (!isset($_POST["userUrl"]) || empty($_POST["userUrl"])) {
        echo "Invalid request.";
        die();
    } else {

    //Fire up the Obj
    $shrink = new Shrink();
    $longUrl = $_POST["userUrl"];

    //Gen a new url
    //@TODO Encapsulate the checking against existing urls with the same code
    $urlCode = $shrink->getRandomCode();

    $title = "none";
    $title = strip_tags($shrink->getUrlOriginalTitle($longUrl));
    $title = substr($title, 0, 140);
    //Get url title
    /*
        try {
        $title = $shrink->getUrlOriginalTitle($longUrl);
    } catch (Exception $e) {
        throw new Exception('Title unreachable');
    }
    */
    //Insert the long url and the shortened one into db
    $insert = $shrink->Ao;
    $values = array($longUrl, $urlCode, $title);

    try {
        $insert->addObjToDb($values, "");
    } catch (Exception $e) {
        //@TODO Log this exception with exact error
        throw new Exception('Db operation error.');
        http_response_code(500);
    }

    http_response_code(200);
    echo '{"urlCode" : "' . APPURL . '?r=' . $urlCode . '"}';
}