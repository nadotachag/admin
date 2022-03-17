<?php

session_start();

if(
	!isset ($_SESSION['id_fon']) 
	)
	{
		echo '<script>window.location="../index.php"</script>';
	}

?>