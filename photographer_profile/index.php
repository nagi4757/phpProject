<?php
	include "../common/dbconn.php";

	$mem_userid = $_GET["userid"];

	$sql = "SELECT * FROM pt_member where mem_userid = '$mem_userid'";
	$result = mysqli_query($db_conn, $sql);
  
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$mem_id = $row["mem_id"];
  
	$page_size=6;

	$page_list_size = 6;
	$no = $_GET["no"];
	if(!$no || $no < 0) $no=0;
 
	$result_comment = mysqli_query($db_conn, "SELECT * FROM pt_comment where comment_mem_id = '$mem_id' ORDER BY comment_regdate DESC LIMIT $no, $page_size");
	$mem_portfolio_photo = explode(",",$row["mem_portfolio_photo"]);

	$comment_count = mysqli_query($db_conn, "SELECT count(*) FROM pt_comment where comment_mem_id = '$mem_id'");
	$comment_row = mysqli_fetch_array($comment_count, MYSQLI_ASSOC);
	$total_row = $comment_row["count(*)"];

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

    <title>PHOTOGRAPHER|MY-TRIPOD</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">

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
    <!--/Navigation-->

    <!-- Page Content -->
    <div class="container">
	
      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3"><?=$row["mem_username"]?></h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="../">Home</a>
        </li>
		<li class="breadcrumb-item">
          <a href="../destination/">Destination</a>
        </li>
        <li class="breadcrumb-item">
          <a href="../photographers/?destination=<?=$row["mem_photo_city"]?>">Photographers</a>
        </li>
        <li class="breadcrumb-item active"><?=$row["mem_username"]?></li>
      </ol>
      <!-- /Page Heading/Breadcrumbs -->

      <!-- Profile Item Row -->
      <div class="row">

        <div class="col-md-8">
          <img class="img-fluid" src="<?=$row["mem_profile_photo"]?>" alt="">
        </div>

        <div class="col-md-4">
          <h3 class="my-3">Profile Description</h3>
          <p>&nbsp;&nbsp;<?=$row["mem_profile_content"]?></p>
          <h3 class="my-3">Packages</h3>
          <ul>
            <li>時間、価格</li>
            <li>詳細条件など</li>
            <li>時間、価格</li>
            <li>詳細条件など</li>
          </ul>
        </div>
        <!--Star Rating Read Only-->
        <div class="col-md-4">
          <div class="star-rating">
            <div class="star-rating-front" style="width: 100%">
				<?php for($i=0; $i<round($row["mem_star"]); $i++) echo"★"?>
			</div>
            <div class="star-rating-back">★★★★★ <?=$row['mem_star']?></div>
            <a class="btn btn-outline-secondary btn-block" href="../appointment/?userid=<?=$mem_userid?>">APPOINTMENT</a>
          </div>
        </div>
        <div class="col-8"></div>
        
      </div>

      <div class="row"  style="padding:30px;"></div>
      <!-- /.row -->

      <!-- Portfolio Row -->
      <h3 class="my-4">Portfolio</h3>

      <div class="row">
        <?php
          for($i=0;$i<count($mem_portfolio_photo);$i++){
        ?>
            <div class="col-md-3 col-sm-6 mb-4">
              <img class="img-fluid" src="<?=$mem_portfolio_photo[$i]?>" alt="">
            </div>
        <?php
          }
        ?>
        <div class="col-12">
          <a href="#" class="btn btn-outline-secondary btn-block" data-toggle="modal" data-target="#portfolio1">Veiw more..</a>
        </div>
      </div>
      <!-- /.row -->
      <!-- Veiw more Modal -->
      <div class="modal fade" id="portfolio1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Portfolio | Photographer1</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php
                for($i=0;$i<count($mem_portfolio_photo);$i++){
              ?>
                  <img class="img-fluid" src="<?=$mem_portfolio_photo[$i]?>" alt="">
              <?php
                }
              ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /Veiw more Modal-->

      <!-- Comment -->
      <h3 class="my-4">Comment</h3>
        <div class="card card-outline-secondary my-4">
          <div class="card-body">
			<?php while($row_comment = mysqli_fetch_assoc($result_comment)) { ?>
            <p><?=$row_comment["comment_content"]?></p>
            <div class="star-rating">
              <div class="star-rating-front" style="width: 100%">
				<?php for($i=0; $i<$row_comment["comment_star"]; $i++) echo"★"?>
			  </div>
              <div class="star-rating-back">★★★★★ <?=$row_comment["comment_star"]?></div>
            </div>
            <small class="text-muted"><?=$row_comment["comment_regdate"]?></small>
            <hr>
			<?php } ?>
          </div>
		  
		  <ul class="pagination justify-content-center">
        <?php 
          if($start_page >= $page_list_size) { 
            $prev_list = ($start_page - 2)*$page_size;
        ?>
            <li class="page-item">
              <a class="page-link" href="../photographer_profile/?no=<?=$prev_list?>" aria-label="Previous">
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
              
                <a class="page-link" href="../photographer_profile/?no=<?=$page?>">
        <?php
            }else{

        ?>
                <a class="page-link" href="">
        <?php
            }
        ?>
                  <?= $i ?>
       
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
              <a class="page-link" href="../photographer_profile/?no=<?=$next_list?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
        <?php
          }
        ?>

      </ul>
		  
        </div>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; my-tripod 2018</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
