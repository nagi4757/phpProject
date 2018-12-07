<?php
	// 데이터베이스 연결하기
	include "../common/dbconn.php";

	session_start();
	$userno = $_SESSION['userno'];
	$userid = $_SESSION['userid'];
	$username = $_SESSION['username'];
	$is_admin = $_SESSION['is_admin'];
	
	$userid = $_GET['userid'];
	
	if($is_admin != 'Y'){
		echo("
			<script>
				location.href = './login.php';
			</script>
		");
	}
	
	$result_member = mysqli_query($db_conn, "SELECT * FROM pt_member where mem_userid = '$userid'");
	$member_row = mysqli_fetch_array($result_member, MYSQLI_ASSOC);
	$portfolio = explode(",",$member_row["mem_portfolio_photo"]);
	
	
?>

<!DOCTYPE html>
<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modify|MY-TRIPOD</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<script type="text/javascript">
		  var portfolio_num = <?=count($portfolio)?>;
		  var reCheck = true;

		  function photoSub(){
			  if(portfolio_num!=1){
				$("#div-"+portfolio_num).remove();
					portfolio_num--;
			  }
		  }

		  function modCheck(){
			var id = document.getElementById("re-id").value;
			var pw = document.getElementById("re-pw").value;
			var pw2 = document.getElementById("re-pw-cof").value;
			var mail = document.getElementById("re-mail").value;
			var name = document.getElementById("re-name").value;
			var content = document.getElementById("pf-content").value;  
			var RegexPw = /^[A-Za-z0-9_-]{6,18}$/;
			var RegexMail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
			
			document.getElementById("portfolio_num").value = portfolio_num;
			
			if(id == ""){
			  document.getElementById("re-idErr").innerHTML = "필요한 정보입니다.";
			  reCheck = false
			}
			if(pw == ""){
			  document.getElementById("re-pwErr").innerHTML = "필요한 정보입니다.";
			  reCheck = false
			}
			if(pw2 == ""){
			  document.getElementById("re-pwErr-cof").innerHTML = "필요한 정보입니다.";
			  reCheck = false
			}
			if(mail == ""){
			  document.getElementById("re-mailErr").innerHTML = "필요한 정보입니다.";
			  reCheck = false
			}
			if(name == ""){
			  document.getElementById("re-nameErr").innerHTML = "필요한 정보입니다.";
			  reCheck = false
			}
			if(content == ""){
			  document.getElementById("pf-contentErr").innerHTML = "필요한 정보입니다.";
			  reCheck = false
			}
			if(!RegexPw.test($.trim($("#re-pw").val()))){
				document.getElementById("re-pwErr").innerHTML = "영숫자 6~18줄 이상 입력해주세요.";
			}
			if(pw2 != pw){
				document.getElementById("re-pwErr-cof").innerHTML = "비밀번호와 비밀번호 확인을 맞게 입력해주세요.";
			}
			if(!RegexMail.test($.trim($("#re-mail").val()))){
				document.getElementById("re-mailErr").innerHTML = "메일을 제대로 입력해주세요.";
			}
			
			for(i=0; i<=portfolio_num ; i++){
				prevImg = document.forms["insert_form"]["pt-"+i].value;

				if(prevImg==0){
					document.getElementById("ptErr-"+i).innerHTML = "이미지를 넣어주세요.";
					reCheck = false;
				}
			}
			
			return reCheck;
		  }

		  function photoAdd(){
			portfolio_num++;
			portfolio_num = portfolio_num;

			$("#portfolio").append(
			  "<div class='col-sm-9' id='div-"+portfolio_num+"'>"+
				"<div class='card-deck'>"+
				  "<div class='card'>"+
					"<div class='card-img-top' id='"+portfolio_num+"' class='col-sm-9'>"+
					  "<img id='prev_"+portfolio_num+"' src='https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' class='img-fluid'>"+
					"</div>"+
					"<div class='card-body'>"+
					  "<input type='file' name='"+portfolio_num+"' id='"+portfolio_num+"' class='img-fluid' accept='.jpg, .jpeg, .png' onchange='previewImage(this,"+portfolio_num+")'"+
					"</div>"+
				  "</div>"+
				"</div>"+
				"<label id='ptErr-"+portfolio_num+"' class='col-sm-12 control-label' style='color:red'></label>"+
				"<input type='hidden' name='pt-"+portfolio_num+"' value='0' >"+
			  "</div>"
			);
		  }

		  function previewImage(targetObj, View_area) {
			  var preview = document.getElementById(View_area); //div id
			  var ua = window.navigator.userAgent;
		
			//ie일때(IE8 이하에서만 작동)
			if (ua.indexOf("MSIE") > -1) {
			  targetObj.select();
			  try {
			  var src = document.selection.createRange().text; // get file full path(IE9, IE10에서 사용 불가)
			  var ie_preview_error = document.getElementById("ie_preview_error_" + View_area);
			  
			  if (ie_preview_error) {
				preview.removeChild(ie_preview_error); //error가 있으면 delete
			  }

			  var img = document.getElementById(View_area); //이미지가 뿌려질 곳

			  //이미지 로딩, sizingMethod는 div에 맞춰서 사이즈를 자동조절 하는 역할
			  img.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+src+"', sizingMethod='scale')";
			  
			  } catch (e) {
			  if (!document.getElementById("ie_preview_error_" + View_area)) {
				var info = document.createElement("<p>");
				info.id = "ie_preview_error_" + View_area;
				info.innerHTML = e.name;
				preview.insertBefore(info, null);
			  }
			  }	
			} else { //ie가 아닐때(크롬, 사파리, FF)
			  var files = targetObj.files;
			  document.forms["member_modify"]["pt-"+View_area].value = 2;
				
			  for (var i = 0; i < files.length; i++) {
			  var file = files[i];
			  var imageType = /image.*/; //이미지 파일일경우만.. 뿌려준다.
				
			  if (!file.type.match(imageType)) continue;
			
			  var prevImg = document.getElementById("prev_" + View_area); //이전에 미리보기가 있다면 삭제
				
			  if (prevImg) {
				preview.removeChild(prevImg);
			  }

			  var img = document.createElement("img"); 
				
			  img.id = "prev_" + View_area;
			  img.classList.add("img-fluid");
			  img.file = file;
			  img.style.width = 'auto'; 
			  img.style.height = 'auto';
			  preview.appendChild(img);
			
			  if (window.FileReader) { // FireFox, Chrome, Opera 확인.
				var reader = new FileReader();
				  
				reader.onloadend = (function(aImg) {
				return function(e) {
				  aImg.src = e.target.result;
				};
				})(img);
				reader.readAsDataURL(file);
			  } else { // safari is not supported FileReader
				//alert('not supported FileReader');
				if (!document.getElementById("sfr_preview_error_" + View_area)) {
				  var info = document.createElement("p");
				  info.id = "sfr_preview_error_" + View_area;
				  info.innerHTML = "not supported FileReader";
				  preview.insertBefore(info, null);
				}
			  }
			}
		  }
	  }

    
    </script>

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="./member_modify.php?userid=<?=$userid?>">MY-TRIPOD</a>
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
          <?php 
            if($is_admin == 'Y'){
          ?>
              <h2 class="my-4">일람</h2>
          <?php
            }else if($is_admin == 'N'){
          ?>
              <h2 class="my-4">MYPAGE</h2>
          <?php
            }
          ?>
          <div class="list-group">
            <?php 
              if($is_admin == 'Y'){
            ?>
                <a href="/admin/all_list.php" class="list-group-item active">일람</a>
                <a href="/admin/board_list.php" class="list-group-item">게시판</a>
				<a href="/admin/member_insert.php" class="list-group-item">사진사 등록</a>
            <?php
              }else if($is_admin == 'N'){
            ?>
                <a href="#" class="list-group-item active">MYPAGE</a>
                <a href="#" class="list-group-item">탈퇴</a>
            <?php
              }
            ?>
            
          </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-10">
			<form enctype="multipart/form-data" name="member_modify" method="post" action="../member/modify.php" onsubmit="return modCheck()">
              <h3 class="my-4">정보 수정</h3>
              <div class="card card-outline-secondary my-4">
              <div class="modal-body">
                  <div class="form-group">
                    <label for="ID" class="col-sm-3 control-label">ID</label>
                    <div class="col-sm-9">
                      <input type="text" id="re-id" name="re-id" class="form-control" placeholder="<?=$member_row["mem_userid"]?>" disabled>
                      <label id="re-idErr" class="col-sm-9 control-label" style="color:red"></label>
					  <input type="hidden" name="re-id" value="<?=$member_row["mem_userid"]?>" >
                    </div>
                    <label for="Password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                      <input type="password" id="re-pw" name="re-pw" value="<?=$member_row["mem_password"]?>" class="form-control">
                      <label id="re-pwErr" class="col-sm-9 control-label" style="color:red"></label>
                    </div>
                    <label for="password-cof" class="col-sm-6 control-label">Password확인</label>
                    <div class="col-sm-9">
                      <input type="password" id="re-pw-cof" value="<?=$member_row["mem_password"]?>" class="form-control">
                      <label id="re-pwErr-cof" class="col-sm-8 control-label" style="color:red"></label>
                    </div>
                    <label for="re-mail" class="col-sm-3 control-label">E-Mail</label>
                    <div class="col-sm-9">
                      <input type="text" id="re-mail" name="re-mail" value="<?=$member_row["mem_email"]?>" class="form-control">
                      <label id="re-mailErr" class="col-sm-8 control-label" style="color:red"></label>
                    </div>
                    <label for="re-name" class="col-sm-3 control-label">성명</label>
                    <div class="col-sm-9">
                      <input type="text" id="re-name" name="re-name" value="<?=$member_row["mem_username"]?>" class="form-control">
                      <label id="re-nameErr" class="col-sm-8 control-label" style="color:red"></label>
                    </div>
                    <label for="city" class="col-sm-3 control-label">도시</label>
                    <div class="col-sm-9">
                      <select name="re-city" id="re-city" value="2" class="form-control input-sm">
                        <option value="1" <?php if($member_row["mem_photo_city"]==1) echo("selected");?>>도쿄</option>
                        <option value="2" <?php if($member_row["mem_photo_city"]==2) echo("selected");?>>오사카</option>
                        <option value="3" <?php if($member_row["mem_photo_city"]==3) echo("selected");?>>교토</option>
                        <option value="4" <?php if($member_row["mem_photo_city"]==4) echo("selected");?>>나라</option>
                        <option value="5" <?php if($member_row["mem_photo_city"]==5) echo("selected");?>>고베</option>
                      </select>
                      <label id="pwErr" class="col-sm-3 control-label" style="color:red"></label>
                    </div>

                    <label for="pf-content" class="col-sm-3 control-label">사진사 소개</label>
                    <div class="col-sm-9">
                      <textarea name="pf-content" id="pf-content" cols="60" rows="3" class="form-control"><?=$member_row["mem_profile_content"]?></textarea>
                      <label id="pf-contentErr" class="col-sm-7 control-label" style="color:red"></label>
                    </div>


                    <label for="profile-pt" class="col-sm-6 control-label">프로필 사진</label>
                    <div class="col-sm-6">
                      <div class="card-deck" >
                        <div class="card">
                          <div class="card-img-top" id='0' class="col-sm-6">
                            <img id='prev_0' src="<?=$member_row["mem_profile_photo"]?>" class="img-fluid">
                          </div>
                          <div class="card-body">
							<label class="btn btn-primary btn-file">
                              사진 변경<input type="file" name="0" id="0" class="img-fluid" accept=".jpg, .jpeg, .png" size="1MB" onchange="previewImage(this,'0')" style="display: none;" />
							</label>
                          </div>
                        </div>
                      </div>
                      <label id="ptErr-0" class="col-sm-12 control-label" style="color:red"></label>
                      <input type="hidden" name="pt-0" value="1" >
					  <input type="hidden" name="fileName0" value="<?=$member_row["mem_profile_photo"]?>" >
                    </div>

                    <label for="Portfolio-pt" class="col-sm-6 control-label">포토폴리오 사진</label>

                    <?php
                      for($i=1;$i<=count($portfolio);$i++){
                    ?>
                    <div class="col-sm-9" id="div-<?=$i?>">
                      <div class="card-deck" >
                        <div class="card">
                          <div class="card-img-top" id='<?=$i?>' class="col-sm-9">
                            <img id="prev_<?=$i?>" src="<?=$portfolio[$i-1]?>" class="img-fluid">
                          </div>
                          <div class="card-body">
                              <label class="btn btn-primary btn-file">
								사진 변경<input type="file" name="<?=$i?>" id="<?=$i?>" class="img-fluid" accept=".jpg, .jpeg, .png" onchange="previewImage(this,'<?=$i?>')" style="display: none;" />
							  </label>
                          </div>
                        </div>
                      </div>
                      <label id="ptErr-<?=$i?>" class="col-sm-12 control-label" style="color:red"></label>
                      <input type="hidden" name="pt-<?=$i?>" value="1" >
                      <input type="hidden" name="fileName<?=$i?>" value="<?=$portfolio[$i-1]?>" >
                    </div>
					
                    <?php
                      }
                    ?>

                    <a id="portfolio"></a>

                    <label id="pwErr" class="col-sm-3 control-label" style="color:red"></label>
                    <div class="col-sm-9">
                      <input type="button" class="btn btn-primary" onclick="photoAdd();" value="ADD" />
                      <input type="button" class="btn btn-primary" onclick="photoSub();" value="SUB" />
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-secondary" value = "수정" />
                    <input type="hidden" name="portfolio_num" id="portfolio_num" />
                </div>
              </div>
			</form>
			
			
        </div>
        <!-- /.col-lg-9 -->

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
