var reCheck = true;
var portfolio_num = 1;

$(document).ready(function(){

	$("#re-id").blur(function(){
	  var id = document.getElementById("re-id").value;
	  var RegexId = /^[a-z][a-z0-9_-]{3,11}$/;  
	  if(id == ""){
		document.getElementById("re-idErr").innerHTML = "필요한 정보입니다.";
	  }else if(!RegexId.test($.trim($("#re-id").val()))){
		document.getElementById("re-idErr").innerHTML = "영숫자 4~12줄 이상 입력해주세요.";
		reCheck = false;
	  }else{
		data = new FormData();
		data.append("id", id);
		$.ajax({
			data: data,
			type: "POST",
			url: "../member/memberCheck.php",
			cache: false,
			contentType: false,
			processData: false,
			success: function(data) {
			  if(data==1){
				document.getElementById("re-idErr").innerHTML = "";
				reCheck = true;
			  }else if(data==0){
				document.getElementById("re-idErr").innerHTML = "이 아이디는 사용중입니다.";
				reCheck = false;
			  }
			}
		});
	  }
	});

	$("#re-pw").focus(function(){
	  var id = document.getElementById("re-id").value;
	  if(id == ""){
		document.getElementById("re-idErr").innerHTML = "필요한 정보입니다.";
	  }
	});

	$("#re-pw").blur(function(){
	  var pw = document.getElementById("re-pw").value;
	  var RegexPw = /^[A-Za-z0-9_-]{6,18}$/;
	  if(pw == ""){
		document.getElementById("re-pwErr").innerHTML = "필요한 정보입니다.";
	  }else if(!RegexPw.test($.trim($("#re-pw").val()))){
		document.getElementById("re-pwErr").innerHTML = "영숫자 6~18줄 이상 입력해주세요.";
		reCheck = false;
	  }else{
		document.getElementById("re-pwErr").innerHTML = "";
		reCheck = true;
	  }
	});

	$("#re-pw-cof").focus(function(){
	  var id = document.getElementById("re-id").value;
	  var pw = document.getElementById("re-pw").value;
	  if(id == ""){
		document.getElementById("re-idErr").innerHTML = "필요한 정보입니다.";
	  }
	  if(pw == ""){
		document.getElementById("re-pwErr").innerHTML = "필요한 정보입니다.";
	  }
	});

	$("#re-pw-cof").blur(function(){
	  var pw = document.getElementById("re-pw").value;
	  var pw2 = document.getElementById("re-pw-cof").value;
	  if(pw2 == ""){
		document.getElementById("re-pwErr-cof").innerHTML = "필요한 정보입니다.";
	  }else if(pw2 != pw){
		document.getElementById("re-pwErr-cof").innerHTML = "비밀번호와 비밀번호 확인을 맞게 입력해주세요.";
		reCheck = false;
	  }else {
		document.getElementById("re-pwErr-cof").innerHTML = "";
		reCheck = true;
	  }
	});

	$("#re-mail").focus(function(){
	  var id = document.getElementById("re-id").value;
	  var pw = document.getElementById("re-pw").value;
	  var pw2 = document.getElementById("re-pw-cof").value;
	  if(id == ""){
		document.getElementById("re-idErr").innerHTML = "필요한 정보입니다.";
	  }
	  if(pw == ""){
		document.getElementById("re-pwErr").innerHTML = "필요한 정보입니다.";
	  }
	  if(pw2 == ""){
		document.getElementById("re-pwErr-cof").innerHTML = "필요한 정보입니다.";
	  }
	});

	$("#re-mail").blur(function(){
	  var mail = document.getElementById("re-mail").value;
	  var RegexMail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	  if(mail == ""){
		document.getElementById("re-mailErr").innerHTML = "필요한 정보입니다.";
	  }else if(!RegexMail.test($.trim($("#re-mail").val()))){
		document.getElementById("re-mailErr").innerHTML = "메일을 제대로 입력해주세요.";
		reCheck = false;
	  }else {
		document.getElementById("re-mailErr").innerHTML = "";
		reCheck = true;
	  }  
	});

	$("#re-name").focus(function(){
	  var id = document.getElementById("re-id").value;
	  var pw = document.getElementById("re-pw").value;
	  var pw2 = document.getElementById("re-pw-cof").value;
	  var mail = document.getElementById("re-mail").value;
	  if(id == ""){
		document.getElementById("re-idErr").innerHTML = "필요한 정보입니다.";
	  }
	  if(pw == ""){
		document.getElementById("re-pwErr").innerHTML = "필요한 정보입니다.";
	  }
	  if(pw2 == ""){
		document.getElementById("re-pwErr-cof").innerHTML = "필요한 정보입니다.";
	  }
	  if(mail == ""){
		document.getElementById("re-mailErr").innerHTML = "필요한 정보입니다.";
	  }
	});
	
	$("#re-name").blur(function(){
	  var name = document.getElementById("re-name").value;
	  if(name == ""){
		document.getElementById("re-nameErr").innerHTML = "필요한 정보입니다.";
	  }else {
		document.getElementById("re-nameErr").innerHTML = "";
	  }  
	});

	$("#re-city").focus(function(){
	  var id = document.getElementById("re-id").value;
	  var pw = document.getElementById("re-pw").value;
	  var pw2 = document.getElementById("re-pw-cof").value;
	  var mail = document.getElementById("re-mail").value;
	  var name = document.getElementById("re-name").value;
	  if(id == ""){
		document.getElementById("re-idErr").innerHTML = "필요한 정보입니다.";
	  }
	  if(pw == ""){
		document.getElementById("re-pwErr").innerHTML = "필요한 정보입니다.";
	  }
	  if(pw2 == ""){
		document.getElementById("re-pwErr-cof").innerHTML = "필요한 정보입니다.";
	  }
	  if(mail == ""){
		document.getElementById("re-mailErr").innerHTML = "필요한 정보입니다.";
	  }
	  if(name == ""){
		document.getElementById("re-nameErr").innerHTML = "필요한 정보입니다.";
	  }
	});

	$("#pf-content").focus(function(){
	  var id = document.getElementById("re-id").value;
	  var pw = document.getElementById("re-pw").value;
	  var pw2 = document.getElementById("re-pw-cof").value;
	  var mail = document.getElementById("re-mail").value;
	  var name = document.getElementById("re-name").value;
	  
	  if(id == ""){
		document.getElementById("re-idErr").innerHTML = "필요한 정보입니다.";
	  }
	  if(pw == ""){
		document.getElementById("re-pwErr").innerHTML = "필요한 정보입니다.";
	  }
	  if(pw2 == ""){
		document.getElementById("re-pwErr-cof").innerHTML = "필요한 정보입니다.";
	  }
	  if(mail == ""){
		document.getElementById("re-mailErr").innerHTML = "필요한 정보입니다.";
	  }
	  if(name == ""){
		document.getElementById("re-nameErr").innerHTML = "필요한 정보입니다.";
	  }
	 
	});

	$("#pf-content").blur(function(){
	  var content = document.getElementById("pf-content").value;
	  if(content == ""){
		document.getElementById("pf-contentErr").innerHTML = "필요한 정보입니다.";
	  }else {
		document.getElementById("pf-contentErr").innerHTML = "";
	  }  
	});


  });


  function regCheck(){
	var id = document.getElementById("re-id").value;
	var pw = document.getElementById("re-pw").value;
	var pw2 = document.getElementById("re-pw-cof").value;
	var mail = document.getElementById("re-mail").value;
	var name = document.getElementById("re-name").value;
	var content = document.getElementById("pf-content").value;

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

	for(i=0; i<=portfolio_num ; i++){
	  prevImg = document.forms["insert_form"]["pt-"+i].value;

	  if(prevImg==0){
		document.getElementById("ptErr-"+i).innerHTML = "이미지를 넣어주세요.";
		reCheck = false;
	  }
	}

	document.getElementById("portfolio_num").value = portfolio_num;

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

  function photoSub(){
	if(portfolio_num!=1){
	  $("#div-"+portfolio_num).remove();
			portfolio_num--;
	}
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
	  document.forms["insert_form"]["pt-"+View_area].value = 1;
	  document.getElementById("ptErr-"+View_area).innerHTML = "";
		  
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