<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(
	!isset ($_SESSION['id_fon'])
	)
	{
		echo '<script>window.location="index.php"</script>';
	}

// session_start([
//     'cookie_lifetime' => 86400,
//     'read_and_close'  => true,
// ]);

// if(
// 	!isset ($_SESSION['id_fon'])
// 	)
// 	{
// 		echo '<script>window.location="index.php"</script>';
// 	}
?>
