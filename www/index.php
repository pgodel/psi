<?
include( dirname(__FILE__).'/inc/variables.inc.php');

include(PSI_DIR.'psi.inc.php');

$psi = new Psi();
$psi->load_config();

session_start();

if ( !empty($_POST['userid'] )  )
{
	if ( $_POST['userid'] == $psi->conf['WWW_USERID'] && $_POST['passwd'] == $psi->conf['WWW_PASSWD'] )
	{
		$_SESSION['userid'] = $_POST['userid'];
		header('Location: index.php');
		exit;
	}
	else
	{
		$m = 'Authentication failed. Retry.';
	}
}
if ( isset( $_GET['logout'] ) )
{
	$_SESSION['userid'] = '';
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
<head>
	<title>PSI | Server Status Interface</title>
	<link rel="StyleSheet" href="psi.css" type="text/css">
	<script language=javascript>
	function addNew(url){
     window.open(url,'add','scrollbars=auto,resizable=no,width=400,height=400,status=no');
	}
	function viewLog(url){
     window.open(url,'log','scrollbars=auto,resizable=no,width=500,height=400,status=no');
	}	
	</script> 
	<meta http-equiv="refresh" content="60">
</head>
<body topmargin="0" leftmargin="5">
<!---Header Table--->

<table border="0" width="740" height="20" cellpadding="0" cellspacing="0">
 <tr>
 <td>
   <table border="0" width="740" height="20" cellpadding="0" cellspacing="0">
   <tr>
   <!--Interface Name--->
   <td class="mainTitle">PSI</td>
   <td align="left"><a href="index.php">REFRESH</a></td>
   </tr>
   <tr><!--Interface Name--->
   <td width="400" class="mainSubTitle" valign="top">Server Status Interface v0.1<?=(!empty($_SESSION['userid'] ) ? ' - user: '.$_SESSION['userid'].' - <a href="index.php?logout">Log out</a>' : '')?></td></tr>
   <tr><td colspan="2"><hr width="740" align="left"></td></tr>
   </table>
 </td>
 </tr>
 <tr>
 <td>
   <table border="0" width="740" height="20" cellpadding="0" cellspacing="0">
   <tr>
   <!--Legend Here--->
   <td align="right"><!--<a href="javascript:addNew('addNew.php')";><img src="images/addNewServer.gif" width="100" height="17" border="0"></a>--></td>
   </tr>
   </table>
 </td>
 </tr>
 </table><!---End Header Table--->
 <?php
if ( !check_session( $psi ) )
{
?>
<form name="loginform" method="post" action="<?=$_SERVER['PHP_SELF']?>" class="mainSubTitle">
  User ID 
  <input type="text" name="userid">
  Password 
  <input type="password" name="passwd">
  <input type="submit" name="Submit" value="Login">
</form>
<?=(!empty($m) ? $m : '')?>
<script language="javascript">
document.loginform.userid.focus();
document.loginform.userid.select();
</script>
<?php
	exit;
}
?>
<br>
<table border="0" width="740" cellpadding="0" cellspacing="5">
<tr><td class="secondarySubTitle" colspan="10">SERVER IDENTIFICATION & STATISTICS</td></tr>
<tr><td colspan="10">&nbsp;</td></tr>
<tr class="columnTitle">
<!--Interface Columns--->
<td>ENTRY NAME</td>
<td align="center">PORT</td>
<td align="center">HOST/IP</td>
<td align="center">UPTIME</td>
<td align="center">% UPTIME</td>
<td align="center">STATUS</td>
<td align="center">TIMEOUT</td>
<td align="center">CONTACT ID</td>
<td align="center">VIEW LOG</td>
<!--<td class="columnTitle" align="center">&nbsp;MAINTENANCE</td>  -->
</tr>

<?php
reset($psi->hosts);
while (list($key, $h) = each($psi->hosts))
{
	
	$usage = 'N/A';	
	$users = 'N/A';
	
	if (is_array($res = $h->host_status('extended_check')))
	{
		$statusIMG = '<script language="Javascript"> viewLog(\'view_log.php?alert='.(empty($_GET['noalert']) ? 'yes' : '').'&host='.urlencode($h->name).'&port='.urlencode($h->port).'\')</script><img src=images/serverDOWN.gif alt="'.$res[0].'">';
	}
	else
	{
		$statusIMG = "<img src=images/serverUP.gif>";
	}
	
	
	$name = (empty($h->additional_parms['name']) ? $h->name : $h->additional_parms['name']);

?>
<tr class="bodyContent">
<!--Interface data--->
<td><?=$name?></td>
<td align="center"><?=$h->port?></td>
<td align="center"><?=$h->name?></td>
<td align="center"><?=$usage?></td>
<td align="center"><?=$users?></td>
<td align="center"><?=$statusIMG?></td>
<td align="center"><?=$h->timeout?></td>
<td align="center"><?=$h->list_contacts()?></td>
<td align="center"><a href="javascript:viewLog('view_log.php?host=<?=urlencode($h->name)?>&port=<?=urlencode($h->port)?>')"><img src="images/notificationOn.gif" border=0></a></td>
<!--<td class="bodyContent" align="center"><a href="javascript:addNew('contacts.php?action=edit_host&id=<?=urlencode($h->name)?>&port=<?=urlencode($h->port)?>')">EDIT</a> | <a href="">DELETE</a></td> --> 
</tr>
<?php
} // end while


?>
</table><!---End Header Table--->
<br><br>
<table border="0" width="320" cellpadding="0" cellspacing="0">
<tr>
<td colspan="3" class="withborder">
	   <table border="0" width="370" cellpadding="5" cellspacing="0">
	   <tr>
	   <td class="bodyContent" colspan="2">
	   <iframe src="view_log.php" height="100" width="725" marginheight="0" marginwidth="0" scrolling="yes" frameborder="0"></iframe>
	   </td></tr>
	   </table><!---contact List ends here--->
</td>
</tr>
<tr>
<td colspan="3" class="withborder">
<!--contanct List starts here--->
	   <table border="0" width="370" cellpadding="5" cellspacing="0">
       <tr><td class="secondarySubTitle">Contact List</td><td align="right"><!--<a href="javascript:addNew('contacts.php?action=new_contact')">Add New Contact</a>--></td></td></tr>
<!--	   <tr><td class="bodyContent" colspan="2">To see an individual record, click on the contact ID.</td></tr>-->
	   <tr>
	   <td class="bodyContent" colspan="2">
	   <iframe src="contacts.php" height="100" width="725" marginheight="0" marginwidth="0" scrolling="yes" frameborder="0"></iframe>
	   </td></tr>
	   </table><!---contact List ends here--->
</td>
</tr>
<tr>
 <td class="legend">
 <br><br><br>
 <u><b>LEGEND</b></u><br><br>
  <img src="images/serverUP.gif" width="15" height="15"> = <span class="legend">SERVER IS UP</span>
  &nbsp;
  <img src="images/serverDOWN.gif" width="15" height="15"> = <span class="legend">SERVER IS DOWN</span>
 </td>
</tr>
<tr>
<td align="center" class="legend">
<hr width="100%" size="1">
<a href="http://www.godel.com.ar/psi/" target="_blank">PSI v1.0</a> - Pablo Godel - Copyright (c) 2004
</td>
</tr>
</table><!---End Footer Table--->


</body>
</html>
