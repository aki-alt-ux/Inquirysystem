<?php
/* プログラム名		：confirmation.php
 * プログラム説明	：お問合せシステム
 * 作成日時			：2024/03/12
 * 作成者			：清水彰
 */




//データベースプロセスファイルを読み込む
require_once("dbprocess.php");



if (isset($_POST['name'])) {
        //SQL文の用意
    $mail = $_POST['mail'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $inquiry_type = $_POST['inquiry_type'];
    $inquiry_details = $_POST['inquiry_details'];

        // テキストボックス入力値のチェック
        if(empty($mail))  {
            // 未入力がある場合はフォーム入力画面ページへリダイレクト
            header("Location: ./inputForm.php?errMsg=メールアドレスが未入力の為、フォームの送信は行えませんでした。&path=form");
            exit();
        }
        if(empty($name))  {
            // 未入力がある場合はフォーム入力画面へリダイレクト
            header("Location: ./inputForm.php?errMsg=お名前が未入力の為、フォームの送信は行えませんでした。&path=form");
            exit();
        }if ($age !== "" && (!is_numeric($age) || $age < 0 || $age > 200)) {
            // 年齢が条件を満たしていない場合、フォーム入力画面にリダイレクト
            header("Location: ./inputForm.php?errMsg=年齢を入力する場合は、0から200の間の数字で入力してください。&path=form");
            exit();
        }
  }



?>
<form action="formto.php" method="POST">
<input type="hidden" name="mail" value="<?php $mail; ?>">
<input type="hidden" name="name" value="<?php $name; ?>">
<input type="hidden" name="age" value="<?php $age; ?>">
<input type="hidden" name="gender" value="<?php $gender; ?>">
<input type="hidden" name="address" value="<?php $address; ?>">
<input type="hidden" name="inquiry_type" value="<?php $inquiry_type; ?>">
<input type="hidden" name="inquiry_details" value="<?php $inquiry_details; ?>">
</form>

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
		<table align="center" width="850">
			<tr>
				 <td align="center"><font size="5">お問合せフォーム確認</font></td>
			</tr>
		</table>
		<hr align="center" size="2" color="black" width="950"></hr>
		<br><br><br>

    <table align="center">
        <tr>
            <td>メールアドレス：</td>
            <td><?php echo $_POST['mail']; ?></td>
        </tr>
        <tr>
            <td>名前：</td>
            <td><?php echo $_POST['name']; ?></td>
        </tr>
        <tr>
            <td>年齢：</td>
            <td><?php echo $_POST['age']; ?></td>
        </tr>
        <tr>
            <td>性別：</td>
            <td><?php echo $_POST['gender']; ?></td>
        </tr>
        <tr>
            <td>住所：</td>
            <td><?php echo $_POST['address']; ?></td>
        </tr>
        <tr>
            <td>お問い合わせ種類：</td>
            <td><?php echo $_POST['inquiry_type']; ?></td>
        </tr>
        <tr>
            <td>詳細：</td>
            <td><?php echo $_POST['inquiry_details']; ?></td>
        </tr>
    </table>

    <form action="formto.php" method="post">
        <input type="hidden" name="mail" value="<?php echo $_POST['mail']; ?>">
        <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
        <input type="hidden" name="age" value="<?php echo $_POST['age']; ?>">
        <input type="hidden" name="gender" value="<?php echo $_POST['gender']; ?>">
        <input type="hidden" name="address" value="<?php echo $_POST['address']; ?>">
        <input type="hidden" name="inquiry_type" value="<?php echo $_POST['inquiry_type']; ?>">
        <input type="hidden" name="inquiry_details" value="<?php echo $_POST['inquiry_details']; ?>">
		<br><br>
	 <table align="center">
        <tr>
            <td>
        		<input type="submit" value="送信">
        	</td>
        	</form>
        	<form action="inputForm.php" method="post">
        	<td>
        		<input type="submit" value="戻る">
        	</td>
        </tr>
    </table>
    </form>
	<br><br><br><br><br><br><br><br><br><br>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
		<table align="center" width="950">
			<tr><td>copyright (c) 2024 all rights reserved.</td></tr>
		</table>
	</body>
</html>