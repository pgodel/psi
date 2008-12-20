<?
include(dirname(__FILE__).'/inc/variables.inc.php');
include(PSI_DIR.'psi.inc.php');

$psi = new Psi();
$psi->load_config();

session_start();
if (! check_session( $psi ) )
{
	echo "Must login. Go to <a target='_parent' href='index.php'>PSI home</a>";
	exit;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>PSI - Contacts</title>
	<link rel="StyleSheet" href="psi.css" type="text/css">
</head>
<body>

 <table border="0" width="690" cellpadding="0" cellspacing="0">
 <tr class="columnTitle">
 <td width="75">ID</td>
 <td width="166">Name</td>
 <td width="158">Destination</td>
 </tr>
 
<?php
reset($psi->contacts);
while (list($key, $c) = each($psi->contacts))
{
?>
 <tr class="bodyContent">
 <td width="75"><?=$c->id?></td>
 <td width="166"><?=$c->name?></td>
 <td width="158"><?=$c->contact_method?></td>
<!-- <td width="158" class="bodyContent"><a href="javascript:addNew('contacts.php?action=edit_contact&id=<?=$c->id?>')">EDIT</a> &nbsp;|&nbsp; <a href="#" target="_new">DELETE</a></td>-->
 </tr>
<?php
} // end while
?>
 </table>
</body>
</html>
