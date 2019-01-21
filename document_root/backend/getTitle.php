<?php

$shrink = new Shrink();
//Get url title
$title = $shrink->getUrlOriginalTitle("http://agenciapulse.com.br");

echo $title;
die();