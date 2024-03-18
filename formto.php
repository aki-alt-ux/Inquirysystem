<?php
/* プログラム名		：formto.php
 * プログラム説明	：お問合せ管理システム
 * 作成日時			：2024/03/12
 * 作成者			：清水彰
 */

//データベースプロセスファイルを読み込む
require_once("dbprocess.php");

$mail = $_POST['mail'];
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$inquiry_type = $_POST['inquiry_type'];
$inquiry_details = $_POST['inquiry_details'];

if ($age == "") {
    $age = -1;
}
// 現在の日時を取得
$current_datetime = date("Y-m-d H:i:s");

// InquiryIDが重複しない場合はフォーム情報をDBへ挿入
$sql_insert = "INSERT INTO Inquiry (Email, Name, Age, Gender, Address, InquiryTopic, InquiryDetails, sent_at)
                VALUES ('{$mail}', '{$name}', '{$age}', '{$gender}', '{$address}', '{$inquiry_type}', '{$inquiry_details}','$current_datetime')";
executeQuery($sql_insert);


// フォーム送信直下の情報だけを取得
$sql = $sql = "SELECT * FROM Inquiry ORDER BY InquiryID DESC LIMIT 1";
$result = executeQuery($sql);
$row = mysqli_fetch_assoc($result);
$nameDB = $row['Name'];
$emailDB = $row['Email'];
$age = $row['Age'];
$genderDB = $row['Gender'];
$addressDB = $row['Address'];
$inquiry_typeDB = $row['InquiryTopic'];
$inquiry_detailsDB = $row['InquiryDetails'];

 if($age == -1){
     $ageMsg = "年齢：未入力\n";

 }else{
     $ageMsg = "年齢：" . $age . "\n";
 }

// 自動メール返信を行う
mb_language("japanese");
mb_internal_encoding("UTF-8");
$to = $emailDB;
$sbj = "お問い合わせありがとうございます。";
$body = $nameDB . "様\n\n";
$body .= "神田英会話スクールへのお問い合わせ、ありがとうございました。\n\n";
$body .= "以下の内容でお問い合わせを受け付けましたので、ご連絡致します。\n\n";
$body .= "メールアドレス：" . $emailDB . "\n";
$body .= "名前：" . $nameDB . "\n";
$body .= $ageMsg;
$body .= "性別：" . $genderDB . "\n";
$body .= "住所：" . $addressDB . "\n";
$body .= "お問い合わせ種類：" . $inquiry_typeDB . "\n";
$body .= "詳細：" . $inquiry_detailsDB . "\n\n";

$body .= "後程返信メールをお送りいたします。\n\n";
$body .= "神田英会話スクール\n";

$hdr = "Content-Type: text/plain;charset=ISO-2022-JP";

//メール送信
$result = mb_send_mail($to, $sbj, $body, $hdr);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>insert.php</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">お問合せ管理システム</h1>
	<hr align="center" size="5" color="BLUE" width="950"></hr>
		<table align="center">
			<tr><td><font size="5">お問合せフォーム完了</font></td></tr>
		</table><br/>
		<table align="center">
			<tr>
				<td>
				　　<a href="./inputForm.php">お問合せフォームへ戻る</a>
				</td>
			</tr>
		</table>
   		<br><br><br><br><br><br><br><br><br><br>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
		<table align="center" width="950">
			<tr><td>copyright (c) 2024 all rights reserved.</td></tr>
		</table>
	</body>
</html>