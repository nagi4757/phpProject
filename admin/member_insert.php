<?php
	// 데이터베이스 연결하기
	include "../common/dbconn.php";

	session_start();
	$userno = $_SESSION['userno'];
	$userid = $_SESSION['userid'];
	$username = $_SESSION['username'];
	$is_admin = $_SESSION['is_admin'];
	
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
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Registration|MY-TRIPOD</title>

	<!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
	<link href="../css/modern-business.css" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../js/login.js" type="text/javascript"></script>
    <script src="../js/registration.js" type="text/javascript"></script>
	
</head>
<body>
	<!-- Navigation -->
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    	<div class="container">
        	<a class="navbar-brand" href="./member_insert.php">MY-TRIPOD</a>
        	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          		<span class="navbar-toggler-icon"></span>
        	</button>
        	<div class="collapse navbar-collapse" id="navbarResponsive">
          		<ul class="navbar-nav ml-auto">
					<?php 
						if($is_admin == 'Y'){
					?>
                			&nbsp;<a class="navbar-brand" href="">관리자&nbsp;<?= $username ?></a>
                			<input type="button" class="btn btn-outline-secondary" value="ADMIN" onclick = "location.href='/admin/all_list.php'" >
            		<?php
              			}else{
            		?>
                			&nbsp;<a class="navbar-brand" href="">사진사&nbsp;<?= $username ?></a>
                			<input type="button" class="btn btn-outline-secondary" value="MYPAGE" onclick = "location.href='/admin/all_list.php'" >
					<?php
						}
					?>
            		&nbsp;<input type="button" class="btn btn-outline-secondary" value="로그아웃" onclick = "location.href='/login/logout.php'">
          		</ul>
        	</div>
      	</div>
	</nav>
	
	<!-- Page Content -->
    <div class="container">
      <div class="row">

        <div class="col-lg-2">
          <h2 class="my-4">등록</h2>
          <div class="list-group">
            <a href="/admin/all_list.php" class="list-group-item">일람</a>
            <a href="/admin/board_list.php" class="list-group-item">게시판</a>
			<a href="/admin/member_insert.php" class="list-group-item active">사진사 등록</a>
          </div>

        </div>
		<!-- /.col-lg-2 -->
		
		<div class="col-lg-10">
			<h3 class="my-4">사진사 등록</h3>
			
			    <form enctype="multipart/form-data" name="insert_form" method="post" action="../member/insert.php" onsubmit="return regCheck()">
				 
					<div class="modal-dialog modal-lg" role="document">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title" id="exampleModalLongTitle">사진사 등록</h5>
						</div>
						<div class="modal-body">
						  <div class="form-group">
							<label for="ID" class="col-sm-3 control-label">ID</label>
							<div class="col-sm-9">
							  <input type="text" id="re-id" name="re-id" class="form-control">
							  <label id="re-idErr" class="col-sm-9 control-label" style="color:red"></label>
							</div>
							<label for="Password" class="col-sm-3 control-label">Password</label>
							<div class="col-sm-9">
							  <input type="password" id="re-pw" name="re-pw" class="form-control">
							  <label id="re-pwErr" class="col-sm-9 control-label" style="color:red"></label>
							</div>
							<label for="password-cof" class="col-sm-6 control-label">Password확인</label>
							<div class="col-sm-9">
							  <input type="password" id="re-pw-cof" class="form-control">
							  <label id="re-pwErr-cof" class="col-sm-8 control-label" style="color:red"></label>
							</div>
							<label for="re-mail" class="col-sm-3 control-label">E-Mail</label>
							<div class="col-sm-9">
							  <input type="text" id="re-mail" name="re-mail" class="form-control">
							  <label id="re-mailErr" class="col-sm-8 control-label" style="color:red"></label>
							</div>
							<label for="re-name" class="col-sm-3 control-label">성명</label>
							<div class="col-sm-9">
							  <input type="text" id="re-name" name="re-name" class="form-control">
							  <label id="re-nameErr" class="col-sm-8 control-label" style="color:red"></label>
							</div>
							<label for="city" class="col-sm-3 control-label">도시</label>
							<div class="col-sm-9">
							  <select name="re-city" id="re-city" class="form-control input-sm">
								<option value="1">도쿄</option>
								<option value="2">오사카</option>
								<option value="3">교토</option>
								<option value="4">나라</option>
								<option value="5">고베</option>
							  </select>
							  <label id="pwErr" class="col-sm-3 control-label" style="color:red"></label>
							</div>

							<label for="pf-content" class="col-sm-3 control-label">사진사 소개</label>
							<div class="col-sm-9">
							  <textarea name="pf-content" id="pf-content" cols="60" rows="3" class="form-control"></textarea>
							  <label id="pf-contentErr" class="col-sm-7 control-label" style="color:red"></label>
							</div>


							<label for="profile-pt" class="col-sm-6 control-label">프로필 사진</label>
							<div class="col-sm-6">
							  <div class="card-deck" >
								<div class="card">
								  <div class="card-img-top" id='0' class="col-sm-6">
									<img id='prev_0' src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="img-fluid">
								  </div>
								  <div class="card-body">
									  <input type="file" name="0" id="0" class="img-fluid" accept=".jpg, .jpeg, .png" onchange="previewImage(this,'0')" />
								  </div>
								</div>
							  </div>
							  <label id="ptErr-0" class="col-sm-12 control-label" style="color:red"></label>
							  <input type="hidden" name="pt-0" value="0" >
							</div>

							<label for="Portfolio-pt" class="col-sm-6 control-label">포토폴리오 사진</label>

							<div class="col-sm-9">
							  <div class="card-deck" >
								<div class="card">
								  <div class="card-img-top" id='1' class="col-sm-9">
									<img id="prev_1" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="img-fluid">
								  </div>
								  <div class="card-body">
									  <input type="file" name="1" id="1" class="img-fluid" accept=".jpg, .jpeg, .png" onchange="previewImage(this,'1')" />
								  </div>
								</div>
							  </div>
							  <label id="ptErr-1" class="col-sm-12 control-label" style="color:red"></label>
							  <input type="hidden" name="pt-1" value="0" >
							</div>

							<a id="portfolio"></a>

							<label id="pwErr" class="col-sm-3 control-label" style="color:red"></label>
							<div class="col-sm-9">
							  <input type="button" class="btn btn-primary" onclick="photoAdd();" value="ADD" />
							  <input type="button" class="btn btn-primary" onclick="photoSub();" value="SUB" />
							</div>
						  </div>
						</div>
						<div class="modal-footer">
							<input type="submit" class="btn btn-secondary" value = "등록" />
							<input type="hidden" name="portfolio_num" id="portfolio_num" />
						</div>
					  </div>
					</div>
				</form>
			
		</div>
		
		<!-- Bootstrap core JavaScript -->
		<script src="../vendor/jquery/jquery.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	
</body>
</html>