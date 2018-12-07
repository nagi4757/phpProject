<?php
	include "../common/dbconn.php";

	$id = mysqli_real_escape_string($db_conn, $_POST['re-id']);
	$password = mysqli_real_escape_string($db_conn, $_POST['re-pw']);
	$email = mysqli_real_escape_string($db_conn, $_POST['re-mail']);
	$username = mysqli_real_escape_string($db_conn, $_POST['re-name']);
	$city = mysqli_real_escape_string($db_conn, $_POST['re-city']);
	$content = mysqli_real_escape_string($db_conn, $_POST['pf-content']);
	$portfolio_num = $_POST['portfolio_num'];

	$uploads_dir = '../uploads';

	$name = $_FILES['0']['name'];

	move_uploaded_file( $_FILES['0']['tmp_name'], "$uploads_dir/$name");
	$profile_photo = "$uploads_dir/$name";

	$portfolio_st = "";

	for($i=1; $i<$portfolio_num+1 ;$i++){
		$portfolio_st = $i;
		$name = $_FILES[$portfolio_st]['name'];

		move_uploaded_file( $_FILES[$portfolio_st]['tmp_name'], "$uploads_dir/$name");

		$portfolio_photo .= "$uploads_dir/$name";

		if($portfolio_num != $i){
			$portfolio_photo .= ",";
		}
	}

	$query = "INSERT INTO pt_member(".
				"mem_id, 
				mem_userid, 
				mem_password, 
				mem_email, 
				mem_username, 
				mem_profile_content, 
				mem_profile_photo, 
				mem_photo_city,
				mem_portfolio_photo,
				mem_is_admin,
				mem_star".
			") VALUES(".
				"NULL,
				'$id',
				'$password',
				'$email',
				'$username',
				'$content',
				'$profile_photo',
				$city,
				'$portfolio_photo',
				'N',
				0".
			")";

	mysqli_query($db_conn, $query);
	mysqli_close($db_conn);

	echo("
		<script>
			location.href = '../admin/all_list.php';
		</script>
	");
?>