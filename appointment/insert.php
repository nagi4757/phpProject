<?php
	include "../common/dbconn.php";

	$mem_userid = mysqli_real_escape_string($db_conn, $_POST['mem_userid']);

	$sql = "SELECT * FROM pt_member where mem_userid = '$mem_userid'";
	$result = mysqli_query($db_conn, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$mem_id = mysqli_real_escape_string($db_conn, $row['mem_id']);
	$mem_username = mysqli_real_escape_string($db_conn, $row['mem_username']);
	$city = mysqli_real_escape_string($db_conn, $row['mem_photo_city']);
	$cst_name = mysqli_real_escape_string($db_conn, $_POST['cst_name']);
	$cst_phone = mysqli_real_escape_string($db_conn, $_POST['cst_phone']);
	$cst_email = mysqli_real_escape_string($db_conn, $_POST['cst_email']);
	$cst_message = mysqli_real_escape_string($db_conn, $_POST['cst_message']);
	$cst_date = mysqli_real_escape_string($db_conn, $_POST['cst_date']);
	$key = rand_keyString();

	$query = "INSERT INTO pt_appointment (".
				"appmt_no,
				appmt_mem_id,
				appmt_mem_userid,
				appmt_mem_username,
				appmt_city,
				appmt_cst_name,
				appmt_cst_email,
				appmt_cst_phone,
				appmt_cst_message,
				appmt_cst_date,
				appmt_cst_key,
				appmt_moddate".
			 ")VALUES(".
				 "NULL,
				 $mem_id,
				 '$mem_userid',
				 '$mem_username',
				 $city,
				 '$cst_name',
				 '$cst_email',
				 '$cst_phone',
				 '$cst_message',
				 '$cst_date',
				 '$key',
				 NULL
			  )";

	mysqli_query($db_conn, $query);

	function rand_keyString()
	{
    	$len = 30;
    	$chars = "ABCDEFGHIJFHNMOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwkyz";

    	srand((double)microtime()*1000000);

    	$i = 0;
    	$str = "";

    	while ($i < $len) {
        	$num = rand() % strlen($chars);
        	$tmp = substr($chars, $num, 1);
        	$str .= $tmp;
        	$i++;
    	}

    	return $str;
	}

	mysqli_close($db_conn);

	echo("
		<script>
			location.href = '../';
		</script>
	");
?>