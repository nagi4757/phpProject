<?php
	include "../common/dbconn.php";
	
	$destination = $_GET["destination"];

	$page_size=6;

	$page_list_size = 6;
	$no = $_GET["no"];
	if(!$no || $no < 0) $no=0;

	$sql = "SELECT * FROM pt_member WHERE mem_photo_city = $destination AND mem_is_admin = 'N' ORDER BY mem_id DESC LIMIT $no, $page_size";
	$result = mysqli_query($db_conn, $sql);

	$result_count = mysqli_query($db_conn, "SELECT count(*) FROM pt_member WHERE mem_photo_city = $destination AND mem_is_admin = 'N'");
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
<html lang="en">

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

  <body">

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

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Photographer
		<?php
			if($destination==1){
				echo "<small>Tokyo</small>";
			}else if($destination==2){
				echo "<small>Osaka</small>";
			}else if($destination==3){
				echo "<small>kyoto</small>";
			}else if($destination==4){
				echo "<small>Nara</small>";
			}
		?>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="../">Home</a>
        </li>
		<li class="breadcrumb-item">
          <a href="../destination/">Destination</a>
        </li>
        <li class="breadcrumb-item active">Photographers</li>
      </ol>

      <div class="row">
	  	<?php
			while($row = mysqli_fetch_assoc($result)) {
		?>
				<div class="col-lg-4 col-sm-6 portfolio-item">
					<div class="card h-100">
						<a href="../photographer_profile/?userid=<?=$row["mem_userid"]?>"><img class="card-img-top" src="<?=$row["mem_profile_photo"]?>" alt=""></a>
						<div class="card-body">
							<h4 class="card-title">
								<a href="../photographer_profile/?userid=<?=$row["mem_userid"]?>"><?=$row["mem_username"]?></a>
							</h4>
							<p class="card-text"><?=$row["mem_profile_content"]?></p>
							<div class="star-rating">
								<div class="star-rating-front" style="width: 50%">
									<?php for($i=0; $i<round($row["mem_star"]); $i++) echo"★"?>
								</div>
            					<div class="star-rating-back">★★★★★ <?=$row['mem_star']?></div>
							</div>
						</div>
					</div>
				</div>
		<?php
			}
		?>
      </div>

      <!-- Pagination -->
      <ul class="pagination justify-content-center">
        <?php 
          if($start_page >= $page_list_size) { 
            $prev_list = ($start_page - 2)*$page_size;
        ?>
            <li class="page-item">
              <a class="page-link" href="../photographers/?destination=<?=$destination?>&no=<?=$prev_list?>" aria-label="Previous">
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
              
                <a class="page-link" href="../photographers/?destination=<?=$destination?>&no=<?=$page?>">
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
              <a class="page-link" href="../photographers/?destination=<?=$destination?>&no=<?=$next_list?>" aria-label="Next">
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