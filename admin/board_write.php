<?php
	session_start();
	
	$is_admin = $_SESSION['is_admin'];
	
	if($is_admin != 'Y'){
		echo("
			<script>
				location.href = './login.php';
			</script>
		");
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

  	<title>Summernote</title>

	<!-- Summernote -->
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

	<!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">

	<script>
    	$(document).ready(function() {
        	$('#summernote').summernote({
				height: 600,
				callbacks: {
					onImageUpload: function(files, editor, welEditable) {
                		sendFile(files[0], editor, welEditable);
            		}
				}
			});
			function sendFile(file, editor, welEditable) {
				data = new FormData();
            	data.append("file", file);
            	$.ajax({
                	data: data,
                	type: "POST",
                	url: "saveimage.php",
                	cache: false,
                	contentType: false,
                	processData: false,
                	success: function(data) {
						var image = $('<img>').attr({'src' : data, 'width': "650px", 'class': "img-fluid"});
						$('#summernote').summernote('insertNode', image[0]);
                	}
            	});
			}
		});
	</script>

</head>
<body>
	<div class="container">
		
			<form method="post" action="board_insert.php">
				제목:<input type="text" name="board_title" style="width:500px"></br></br>
				서비스 선택:
				<select name="board_service" id="board_service">
                    <option value="1">TRAVLE</option>
                    <option value="2">PHOTO</option>
                </select></br></br>
				<center>
					<textarea id="summernote" name="content"></textarea>
					<input type="submit" value="등록">
				</center>
			</form>
	</div>
</body>
</html>