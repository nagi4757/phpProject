<?php
date_default_timezone_set('Asia/Seoul');
 
require '../PHPMailer/PHPMailerAutoload.php';

include "../common/dbconn.php";

$result_comment = mysqli_query($db_conn, "SELECT * FROM pt_appointment where date(appmt_cst_date) = date(subdate(now(), INTERVAL 1 DAY)) and date(appmt_cst_date) <= date(now()) and appmt_email_cof=0");

//Create a new PHPMailer instance
$mail = new PHPMailer;
$mail->SMTPSecure = 'ssl';
 
//Tell PHPMailer to use SMTP
$mail->isSMTP();
 
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

$mail->CharSet = "euc-kr";

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
 
//Set the hostname of the mail server
$mail->Host = 'smtp.naver.com';
 
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;
 
//Set the encryption system to use - ssl (deprecated) or tls
 
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
 
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "@naver.com";
 
//Password to use for SMTP authentication
$mail->Password = "";
 
//Set who the message is to be sent from
$mail->setFrom('@naver.com', 'Master');
 
//Set the subject line
$mail->Subject = 'MY-TRIPOD evaluation guide';

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';


while($row_comment = mysqli_fetch_assoc($result_comment)) {
	$appmt_no = $row_comment['appmt_no'];
	$appmt_cst_date =  $row_comment['appmt_cst_date'];
	
	mysqli_query($db_conn, "UPDATE pt_appointment SET appmt_email_cof = 1, appmt_cst_date = '$appmt_cst_date' WHERE appmt_no = $appmt_no");

	$appmt_cst_key=$row_comment['appmt_cst_key'];
	$appmt_cst_email=$row_comment['appmt_cst_email'];
	$appmt_cst_name=$row_comment['appmt_cst_email'];
	$appmt_mem_username=$row_comment['appmt_mem_username'];

	//Set who the message is to be sent to
	$mail->addAddress($appmt_cst_email, $appmt_cst_name);
 
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML("<p>안녕하세요. MY-TRIPOD입니다.</p><p>아래링크에서 $appmt_mem_username 사진사 평가 부탁드립니다.</p>
	<p>(<a href='http://localhost/evaluation/evaluation.php?key=$appmt_cst_key'>http://localhost/evaluation/evaluation.php?key=$appmt_cst_key</a>)<p>", dirname(__FILE__));

	$mail->send();
	$mail->ClearAddresses();
}

echo("
	<script>
		location.href = 'all_list.php';
	</script>
");
	

?>