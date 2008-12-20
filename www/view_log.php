<?php
include(dirname(__FILE__).'/inc/variables.inc.php');
include(PSI_DIR.'psi.inc.php');

$psi = new Psi();
$psi->load_config();

session_start();
if (! check_session( $psi ) )
{
	echo "Must login. Go to <a href='index.php'>PSI home</a>";
	exit;
}


$log = new Logger(PSI_LOG_FILE);

if (empty($_GET['host']) || $_GET['host'] == 'all')
{
	$log->load();
}
else
{
	$log->load($_GET['host']);
}

$content = array_reverse($log->content);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>PSI - View Log</title>
	<link rel="StyleSheet" href="psi.css" type="text/css">
</head>
<SCRIPT language="javascript">
function h_alert(str)
{
window.alert(str);
opener.location.href="index.php?noalert=yes&t=<?=time()?>";

}
</SCRIPT>
<body <?=(empty($_GET['alert']) ? '' : ' onLoad="h_alert(\''.$_GET['host'].':'.$_GET['port'].' alert!\')"')?>>
<table border="0" width="100%" cellpadding="0" cellspacing="5">
<tr><td class="secondarySubTitle" colspan="10">SERVER STATUS LOG</td></tr>
<tr class="columnTitle">
<!--Interface Columns--->
<td align="center">Date</td>
<td align="center">Host</td>
<td align="center">PORT</td>
<td align="center">TIMEOUT</td>
<td align="center">ERROR NO.</td>
<td>ERROR DESC</td>
</tr>

<?php
reset($content);
while (list($key, $str) = each($content))
{
	
	$arr = explode(chr(9), $str);
	if ( count( $arr ) > 1 )
	{
?>
<tr class="bodyContent">
<!--Interface data--->
<td align="center"><?=$arr[0]?></td>
<td align="center"><?=$arr[1]?></td>
<td align="center"><?=$arr[2]?></td>
<td align="center"><?=$arr[3]?></td>
<td align="center"><?=$arr[4]?></td>
<td><?=$arr[5]?></td>
</tr>
<?php
	}
} // end while


?>
</table>
</body>
</html>