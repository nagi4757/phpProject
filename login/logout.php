<?php
	session_start();
	unset($_SESSION['userno']);
	unset($_SESSION['userid']);
	unset($_SESSION['username']);
	unset($_SESSION['is_admin']);

	echo("
		<script>
	   		location.href = '../admin/login.php'; 
	  	</script>
	");
?>