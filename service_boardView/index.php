<?php
	// 데이터베이스 연결하기
	include "../common/dbconn.php";
  
	$service = $_GET["service"];
	$board_no = $_GET['board_no'];

	if($service==1){
		$url = "../image/index_ourservice_travel.jpg";
	}else if($service==2){
		$url = "../image/index_ourservice_photo.jpg";
	}
	
	$sql = "SELECT * FROM pt_board WHERE board_no = $board_no";
	$result = mysqli_query($db_conn, $sql);

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
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

    <style type"text/css">
     A:link{text-decoration:none; color:#646464;}
     A:visited{text-decoration:none; color:#646464;}
     A:active{text-decoration:none; color:#646464;}
     A:hover{text-decoration:none; color:#646464;}
    </style>

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


    <a href="/service_boardView/?board_no=<?=$board_no?>&service=<?=$service?>">
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
      <hr>
      <h3><?=$row["board_title"]?></h3>
      <a href="#"><small>category</small></a>
      <small><?=$row["board_regdate"]?></small>
      <hr>
      <div class="text-center">
        <div style="text-align:right;">
          <hr>
        </div>
        <?=$row["board_content"]?>
      </div>
      
     
      <hr>
      <div style="text-align:right; padding-top:10px;">
        
      </div>
  
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
