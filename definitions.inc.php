<?php

/**********************************************
*        PSI definititions file
*        Version 1.5
*        Please, refer to the README file
***********************************************/


	define('FTP', 				21);
	define('SMTP', 				25);
	define('POP3', 				110);
	define('IMAP', 				143);
	define('HTTP', 				80);
	define('HTTPS',				443);
	define('MYSQL',				3306);
	
	define('PSI_SVC_WEBPAGE',	'WEB');
	define('PSI_SVC_CPU',		'CPU');
	define('PSI_SVC_PROC',		'PROC');
	define('PSI_SVC_QMAILQUEUE',		'QMAILQUEUE');
	define('PSI_SVC_OPENVZ',	'OPENVZ');
	
	
	/*
	Options are:
	openssl, curl_functions, curl_commandline (default)
	*/
	define('HTTPS_DEFAULT_METHOD', 	'curl_commandline');
	
	define('DEFAULT_TIMEOUT', 	30);
	
	define('PSI_MAIN_DIR',		dirname(__FILE__));
	
	define('CONFIG_FILE', 		PSI_MAIN_DIR.'/psi.conf');

	define('PSI_LOG_DIR',		PSI_MAIN_DIR.'/logs');
	define('PSI_LOG_FILE',		PSI_LOG_DIR.'/psi.log');
?>
