<?php
	include "../common/dbconn.php";

	$rating = mysqli_real_escape_string($db_conn, $_POST['rating']);
	$key = mysqli_real_escape_string($db_conn, $_POST['key']);
	$mem_id = mysqli_real_escape_string($db_conn, $_POST['mem_id']);
	$content = mysqli_real_escape_string($db_conn, $_POST['comment_content']);

	$sql = "SELECT * FROM pt_comment where comment_key = '$key' AND comment_mem_id = $mem_id";
	$result = mysqli_query($db_conn, $sql);

	$count = mysqli_num_rows($result);

	if($count==1){
		$query = "UPDATE pt_comment ".
				"SET ".
					"comment_content='$content',
					comment_star='$rating',
					comment_moddate = NULL 
				WHERE comment_mem_id = $mem_id AND comment_key = '$key'";
	}else{
		$query = "INSERT INTO pt_comment (".
				"comment_no,
				comment_mem_id,
				comment_content,
				comment_star,
				comment_key,
				comment_regdate,
				comment_moddate
			 )VALUES(".
				 "NULL,
				 $mem_id,
				 '$content',
				 $rating,
				 '$key',
				 NULL,
				 NULL
			  )";
	}
	
	mysqli_query($db_conn, $query);

	$result_comment = mysqli_query($db_conn, "SELECT * FROM pt_comment where comment_mem_id = $mem_id");

	$starTotal = 0.0;
	$starAve = 0.0;


	while($row_comment = mysqli_fetch_assoc($result_comment)) {
		$starTotal += $row_comment['comment_star'];
	}

	$starAve = round($starTotal/mysqli_num_rows($result_comment), 1);

	$queryMem = "UPDATE pt_member SET mem_star = $starAve where mem_id = $mem_id";

	mysqli_query($db_conn, $queryMem);
	mysqli_close($db_conn);

	echo("
		<script>
			location.href = '../index.php';
		</script>
	");
?>