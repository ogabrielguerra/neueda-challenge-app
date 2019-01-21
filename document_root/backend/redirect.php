<?php

//Check if url is being passed
if (!isset($_GET["r"]) || empty($_GET["r"])) {

    echo "Invalid request.";
    die();

} else {

    $destination = $_GET["r"];

    //Fire up the Obj
    $shrink = new Shrink();
    $get = $shrink->Ao;

    //Query the db with the code passed and get the long url
    $info = $get->getObjData("shrink_code='".$destination."'");

    //Update the view for this url
    $shrinkViews = new ShrinkViews();
    $insert = $shrinkViews->Ao;

    $id = $info[0]->shrink_id;
    $date = date('Y-m-d H:i:s');
    $values = Array($id, '0', $date);

    try {
        $insert->addObjToDb($values, "");
    } catch (Exception $e) {
        //@TODO Log this exception with exact error
        throw new Exception('Db operation error.');
        header("Location: http://192.168.99.100/500.php");
        die();
        //http_response_code(500);
    }

    //Send user to his destination
    header("Location:".$info[0]->shrink_url);
    die();
}
