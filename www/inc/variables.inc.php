<?
//index vars

define('PSI_DIR',	dirname( __FILE__). '/../../');

$notification = "<img src=images/notificationOn.gif>";
//$notification = "<img src=images/notificationOff.gif>";

//footer vars
$message = "There are currently no messages.";
$notificationStatus = "notification on.";

function check_session( $psi )
{
	if ( empty($_SESSION['userid']) && !empty( $psi->conf['WWW_USERID'] ) )
	{
		return false;
	}
	
	return true;
}
?>
