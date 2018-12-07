<!DOCTYPE html>
<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LOGIN|MY-TRIPOD</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<script type="text/javascript">
		function randomKey(){	
		  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

		  for(var i=0 ; i<4 ; i++)
			  randomkey += possible.charAt(Math.floor(Math.random() * possible.length));
		
			document.getElementById("randomkey").innerHTML = randomkey;
		}

		function loginCheck(){

			var id = document.getElementById("id").value;
			var password = document.getElementById("password").value;
			var key = document.getElementById("key").value;

			document.getElementById("idErr").innerHTML = "";
			document.getElementById("pwErr").innerHTML = "";
			document.getElementById("keyErr").innerHTML = "";

			data = new FormData();
			data.append("id", id);
			data.append("password", password);

			$.ajax({
				data: data,
				type: "POST",
				url: "../login/login.php",
				cache: false,
				contentType: false,
				processData: false,
				success: function(data) {
					if(data==6){
						document.getElementById("idErr").innerHTML = "아이디를 입력해주세요.";
						document.getElementById("pwErr").innerHTML = "비밀번호를 입력해주세요.";
					}else if(data==5){
						document.getElementById("idErr").innerHTML = "아이디를 입력해주세요.";
					}else if(data==4){
						document.getElementById("pwErr").innerHTML = "비밀번호를 입력해주세요.";
					}

					if(key==""){
						document.getElementById("keyErr").innerHTML = "키를 입력해주세요."
					}else if(randomkey != key){
						document.getElementById("keyErr").innerHTML = "키를 제대로 입력해주세요."
					}else if(data==3 && randomkey == key){
						location.href = '../admin/mail_batch.php';
					}else{
						if(data==2){
						document.getElementById("pwErr").innerHTML = "비밀번호가 틀립니다.";
						}else if(data==1){
						document.getElementById("idErr").innerHTML = "존재하지 않은 아이디입니다.";
						}
					}
				}
			});

		}
	</script>

  </head>

  <body onload="randomKey();">

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="../">MY-TRIPOD</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
         <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">login</h5>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="ID">ID</label>
                 <input type="text" class="form-control form-control-lg rounded-0" name="id" id="id" required="">
                 <label id="idErr" style="color:red"></label>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control form-control-lg rounded-0" id="password" name="password" required="" autocomplete="new-password">
                <label id="pwErr" style="color:red"></label>
              </div>
              <div class="form-group">
                KEY : <a id="randomkey"></a>&nbsp;<input class="form-control form-control-lg rounded-0" type="text" id="key" name="key" />
                <label id="keyErr" style="color:red"></label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" onclick="loginCheck();">Login</button>
            </div>
           </div>
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

    <!-- Contact form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="../js/jqBootstrapValidation.js"></script>
    <script src="../js/contact_me.js"></script>

  </body>

</html>
