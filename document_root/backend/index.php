<?php


require 'bootstrap.php';


/*
A simple front controller in order to handle all the requests
without the need to install a more complex router system.
*/

if (isset($_GET["p"]) && !empty($_GET["p"])) {

    $p = $_GET["p"];

    switch ($p) {
        case "handleUrl":
            require_once 'handleUrl.php';
            break;

        case "getUrls":

            require_once 'getUrls.php';
            break;

        case "getTopViews":
            require_once 'getTopViews.php';
            break;

        case "getStats":
            require_once 'getStats.php';
            break;

        case "getTitle":
            require_once 'getTitle.php';
            break;
    }

} else if (isset($_GET["r"]) && !empty($_GET["r"])) {
    require_once 'redirect.php';
} else {
    echo "Invalid request.";
    die();
}



