<?php
	// 데이터베이스 연결하기
	include "../common/dbconn.php";

	session_start();
	$userno = $_SESSION['userno'];
	$userid = $_SESSION['userid'];
	$username = $_SESSION['username'];
	$is_admin = $_SESSION['is_admin'];
	
	if($is_admin != 'Y'){
		echo("
			<script>
				location.href = './login.php';
			</script>
		");
	}

	$page_size=10;

	$page_list_size = 10;
	$no = $_GET["no"];
	if(!$no || $no < 0) $no=0;

	$sql = "SELECT * FROM pt_board ORDER BY board_no DESC LIMIT $no, $page_size";
	$result = mysqli_query($db_conn, $sql);

	$result_count = mysqli_query($db_conn, "SELECT count(*) FROM pt_board");
	$result_row = mysqli_fetch_array($result_count, MYSQLI_ASSOC);
	$total_row = $result_row["count(*)"];

	if($total_row <= 0) $total_row = 0;
	$total_page = ceil($total_row / $page_size);

	$current_page = ceil(($no+1)/$page_size);

	$start_page = floor(($current_page - 1) / $page_list_size) * $page_list_size + 1;
  	$end_page = $start_page + $page_list_size - 1;

  	if($total_page <$end_page) $end_page = $total_page;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Board List|MY-TRIPOD</title>

	<!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
	<link href="../css/modern-business.css" rel="stylesheet">
	
</head>
<body>
	<!-- Navigation -->
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    	<div class="container">
        	<a class="navbar-brand" href="./board_list.php">MY-TRIPOD</a>
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
          <h2 class="my-4">게시판</h2>
          <div class="list-group">
            <a href="/admin/all_list.php" class="list-group-item">일람</a>
            <a href="#" class="list-group-item active">게시판</a>
			<a href="/admin/member_insert.php" class="list-group-item">사진사 등록</a>
          </div>

        </div>
		<!-- /.col-lg-2 -->
		
		<div class="col-lg-10">
			<h3 class="my-4">리스트</h3>
			<div class="card card-outline-secondary my-4">
				<table class="table table-striped custab">
					<thead>
                  		<tr>
                      		<th>NO</th>
							<th>SERVICE</th>
                      		<th>제목</th>
                      		<th class="text-center">action</th>
                  		</tr>
					</thead>
					<?php
						while($row = mysqli_fetch_assoc($result)) {
							if($row["board_service_number"] == 1){
								$service = "TRAVLE";
							}else if($row["board_service_number"] ==2){
								$service = "PHOTO";
							}
					?>
						<tr>
							<td>&nbsp;<?=$row["board_no"]?></td>
							<td><?=$service?></td>
							<td><?=$row["board_title"]?></td>
							<td class="text-center">
								<a class='btn btn-info btn-xs' href="board_modify_form.php?board_no=<?=$row["board_no"]?>"><span class="glyphicon glyphicon-edit"></span>수정</a>
								<a class='btn btn-danger btn-xs' href="board_delete.php?board_no=<?=$row["board_no"]?>&no=<?=$no?>"><span class="glyphicon glyphicon-edit"></span>삭제</a>
							</td>
						</tr>
					<?php
						}
					?>
				</table>
				
			</div>

			<ul class="pagination justify-content-center">
			<?php
				if($start_page >= $page_list_size) {
				$prev_list = ($start_page - 2)*$page_size;
			?>
				<li class="page-item">
					<a class="page-link" href="board_list.php?no=<?=$prev_list?>" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
					<span class="sr-only">Previous</span>
					</a>
				</li>
			<?php
				}
			?>
			<?php
				for($i=$start_page;$i <= $end_page;$i++) {
				$page= ($i-1) * $page_size;
			?>
				<li class="page-item">
			<?php
				if($no!=$page){ 
			?>
					<a class="page-link" href="board_list.php?no=<?=$page?>">
			<?php
				}else{
			?>
					<a class="page-link" href="">
			<?php
				}
			?>
						<?=$i?>
					</a>
				</li>
			<?php
				}
			?>

			<?php
				if($total_page >$end_page){
				$next_list = $end_page * $page_size;
			?>
				<li class="page-item">
					<a class="page-link" href="board_list?no=<?=$next_list?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
					<span class="sr-only">Next</span>
					</a>
				</li>
			<?php
				}
			?>
			</ul>
			<ul class="pagination justify-content-center">
				<a class='btn btn-primary btn-xs' href="/admin/board_write.php"><span class="glyphicon glyphicon-edit"></span>글쓰기</a>
			</ul>
		</div>
		
		<!-- Bootstrap core JavaScript -->
		<script src="../vendor/jquery/jquery.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	
</body>
</html>