<?php
ob_start();
@session_start();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
header ('Content-type: text/html; charset=UTF-8');

//IS THE ENV PRODUCTION ?
DEFINE ('ENV_PRODUCTION', false);

/* GLOBAL CONFIGS */
DEFINE ('APPURL', 'http://192.168.99.100/backend/');
DEFINE ('SITEPATH', getcwd());
DEFINE ('CLASSPATH', SITEPATH.'/classes/');
DEFINE ('DEBUG', true);

if(DEBUG){
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}
