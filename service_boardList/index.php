<?php
	// 데이터베이스 연결하기
	include "../common/dbconn.php";
  
	$service = $_GET["service"];

	if($service==1){
		$url = "../image/index_ourservice_travel.jpg";
	}else if($service==2){
		$url = "../image/index_ourservice_photo.jpg";
	}

	$page_size=10;

	$page_list_size = 10;
	$no = $_GET["no"];
	if(!$no || $no < 0) $no=0;

	$sql = "SELECT * FROM pt_board WHERE board_service_number = $service ORDER BY board_no DESC LIMIT $no, $page_size";
	$result = mysqli_query($db_conn, $sql);

	$result_count = mysqli_query($db_conn, "SELECT count(*) FROM pt_board WHERE board_service_number = $service");
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

    <title>Service|MY-TRIPOD</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
    <style type"text/css">
     A:link{text-decoration:none; color:#646464;}
     A:visited{text-decoration:none; color:#646464;}
     A:active{text-decoration:none; color:#646464;}
     A:hover{text-decoration:none; color:#646464;}
    </style>
	
	<script src="../js/login.js" type="text/javascript"></script>
    <script src="../js/registration.js" type="text/javascript"></script>

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="../">MY-TRIPOD</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="../">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../who_we_are">소개말</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../how_it_works">진행방법</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../service">여행/촬영 정보</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../destination">작가님</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../faq">FAQ</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <a href="../service_boardList/?service=<?=$service?>">
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('<?=$url?>')">
            <div class="carousel-caption d-none d-md-block">
              <?php
                if($service==1){
              ?>
                  <h3>여행정보</h3>
                  <p>현지인은 다르다!<br> 현지 작가님들이 전하는 현지에서만 얻을 수 있는 여행관련 정보를 확인해보세요!</p>
              <?php
                }else if($service==2){
              ?>
                  <h3>사진정보</h3>
                  <p>남는 것은 결국 사진! <br>실패하지 않는 각지 현지 스팟과 촬영관련 팁들을 알려드립니다!</p>
              <?php
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </a>
    <!-- Page Content -->
    <div class="container">
		
      <div style="text-align:right;">
        <hr>
      </div>
	  <table class="table table-hover">
	  <?php
	  	while($row = mysqli_fetch_assoc($result)) {
        preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $row["board_content"], $matches);
	  ?>
	  	  <tbody>
		      <tr>
		  	    <th class="d-none" scope="row">1</th>
			      <td>
              <a href="../service_boardView/?board_no=<?=$row["board_no"]?>&service=<?=$service?>">
                <?=$row["board_regdate"]?>
              </a>
            </td>
			      <td>
              <a href="../service_boardView/?board_no=<?=$row["board_no"]?>&service=<?=$service?>">
                <?=$row["board_title"]?>
              </a>
            </td>
			      <td style="text-align:right;">
				      <a href="../service_boardView/?board_no=<?=$row["board_no"]?>&service=<?=$service?>">
                <img src="<?=$matches[1][0]?>" alt="" class="img-thumbnail" height=200px width=200px>
              </a>
			      </td>
		      </tr>
		   </tbody>
	  <?php
		  }
	  ?>
	  </table>

      <!-- Pagination -->
      <ul class="pagination justify-content-center">
			<?php
				if($start_page >= $page_list_size) {
				$prev_list = ($start_page - 2)*$page_size;
			?>
				<li class="page-item">
					<a class="page-link" href="../service_boardList/?service=<?=$service?>&no=<?=$prev_list?>" aria-label="Previous">
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
					<a class="page-link" href="../service_boardList/?service=<?=$service?>&no=<?=$page?>">
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
					<a class="page-link" href="../service_boardList/?service=<?=$service?>&no=<?=$next_list?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
					<span class="sr-only">Next</span>
					</a>
				</li>
			<?php
				}
			?>
			</ul>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; my-tripod 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>