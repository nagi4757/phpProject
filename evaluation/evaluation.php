<?php
	include "../common/dbconn.php";

	$key = $_GET["key"];
	$sql = "SELECT * FROM pt_appointment where appmt_cst_key = '$key'";
	$result = mysqli_query($db_conn, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$count = mysqli_num_rows($result);

	if($count!=1){
		echo("
			<script>
				location.href = '../index.php';
			</script>
		");
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>

	<!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="../star/dist/starrr.css">
  	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  	<script src="../star/dist/starrr.js"></script>
</head>
<body>
	<div class="container">
		<center>
			<h2>사진사 평가하기</h2>
			<form name="evaluation_insert" action="insert.php" method="post">
				<div class='starrr' id='star2'></div>
				<input type='hidden' name='mem_id' value='<?=$row["appmt_mem_id"]?>' />
				<input type='hidden' name='key' value='<?=$key?>' />
				<input type='hidden' name='rating' value='3' id='star2_input' />
				<div>
					<textarea rows="10" cols="80" class="form-control" name="comment_content" style="resize:none"></textarea>
				</div>
				<br /><button type="submit" class="btn btn-secondary btn-block" id="sendMessageButton">Send Evaluation</button>
			</form>
		</center>
	</div>
  
	<script>
		var $s2input = $('#star2_input');
		$('#star2').starrr({
			max: 5,
			rating: $s2input.val(),
			change: function(e, value){
				$s2input.val(value).trigger('input');
			}
		});
	</script>

</body>
</html>