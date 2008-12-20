#!/usr/bin/php -q
<?php
/**********************************************************************
*                      PSI - PHP Simple Informer                      *
*                              Version 1.5                            *
*                   By Pablo Godel - pablo@godel.com.ar               *
*                    http://www.godel.com.ar/psi/                     *
*                                                                     *
*  SUPPORT FURTHER DEVELOPMENT, DONATE: http://www.godel.com.ar/psi/  *
*                                                                     *
*                                                                     *
*          This is code is distributed under the GPL license          *
**********************************************************************/

include_once(dirname(__FILE__) .'/psi.inc.php');

$psi = new Psi();
$psi->load_config();
$psi->check();

?>
