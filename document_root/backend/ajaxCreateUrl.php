<?php
//echo $_POST["longUrl"];

include_once('bitly.php');
$params = array();
$params['access_token'] = 'c72133a9e5e37436282d87d6d95af8a74f48c425';
$params['longUrl'] = $_POST["longUrl"];//'http://knowabout.it';
$params['domain'] = '';
//print_r($params);
$results = bitly_get('shorten', $params);
//var_dump($results);
echo json_encode($results);

?>