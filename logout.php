<?php
session_start();

if (isset($_SESSION['id_fon']))
{
	// $_SESSION=[];
	// $ses_param = session_get_cookie_params();

	// $options = array(
	// 	'lifetime'=> time() - 3600
	// 	'path'=> $ses_param['path'],
	// 	'domain'=> $ses_param['domain'],
	// 	'secure'=> $ses_param['secure'],
	// 	'httponly'=> $ses_param['httponly'],
	// 	'samesite'=> $ses_param['samesite']
	// );

	// setcookie(session_name(),,$options);

	session_destroy();
	header('Location:index.php');
}

?>
