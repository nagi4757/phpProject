<?php
	include "../common/dbconn.php";
	session_start();
	
	$userid = mysqli_real_escape_string($db_conn, $_POST['re-id']);
	$password = mysqli_real_escape_string($db_conn, $_POST['re-pw']);
	$email = mysqli_real_escape_string($db_conn, $_POST['re-mail']);
	$username = mysqli_real_escape_string($db_conn, $_POST['re-name']);
	$city = mysqli_real_escape_string($db_conn, $_POST['re-city']);
	$content = mysqli_real_escape_string($db_conn, $_POST['pf-content']);
	$portfolio_num = $_POST['portfolio_num'];

	$uploads_dir = '../uploads';

	if($_POST['pt-0']==2){
		$name = $_FILES['0']['name'];

		move_uploaded_file( $_FILES['0']['tmp_name'], "$uploads_dir/$name");
		$profile_photo = "$uploads_dir/$name";
	}else if($_POST['pt-0']==1){
		$profile_photo = $_POST['fileName0'];
	}

	$portfolio_st = "";

	for($i=1; $i<$portfolio_num+1 ;$i++){

		$portfolio_st = $i;

		if($_POST["pt-".$portfolio_st]==2){
			$name = $_FILES[$portfolio_st]['name'];
			move_uploaded_file( $_FILES[$portfolio_st]['tmp_name'], "$uploads_dir/$name");
			$portfolio_photo .= "$uploads_dir/$name";
		}else if($_POST["pt-".$portfolio_st]==1){
			$portfolio_photo .= $_POST["fileName".$portfolio_st];
		}
		
		if($portfolio_num != $i){
			$portfolio_photo .= ",";
		}
	}

	$query = "UPDATE pt_member ".
			"SET ".
				"mem_userid='$userid',
				mem_password='$password',
				mem_email='$email',
				mem_username='$username',
				mem_profile_content='$content',
				mem_profile_photo='$profile_photo',
				mem_photo_city=$city,
				mem_portfolio_photo='$portfolio_photo'
			WHERE mem_userid='$userid'";

	mysqli_query($db_conn, $query);
	mysqli_close($db_conn);
	
	echo("
		<script>
			location.href = '../admin/all_list.php';
		</script>
	");
?>