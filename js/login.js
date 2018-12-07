var randomkey = "";

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
			location.href = 'index.php';
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

  function reset(){ 
	document.getElementById("idErr").innerHTML = "";
	document.getElementById("pwErr").innerHTML = "";
	document.getElementById("keyErr").innerHTML = "";

	document.getElementById("id").value = "";
	document.getElementById("password").value = "";
	document.getElementById("key").value = "";
  }

  function randomKey(){	
		  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

		  for(var i=0 ; i<4 ; i++)
			  randomkey += possible.charAt(Math.floor(Math.random() * possible.length));
		
			document.getElementById("randomkey").innerHTML = randomkey;
	}