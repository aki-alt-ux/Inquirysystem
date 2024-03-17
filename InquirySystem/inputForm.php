<?php
/* プログラム名		：inputForm.php
 * プログラム説明	：お問合せ管理システム
 * 作成日時			：2024/03/12
 * 作成者			：清水彰
 */


//エラーメッセージの受信
$errMsg = $_GET['errMsg'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>inputForm.php</title>
		<link rel="stylesheet" href="./CSS/styles.css">
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">お問合せ管理システム</h1>
	<hr align="center" size="5" color="BLUE" width="950"></hr>
		<table align="center" width="850">
			<tr>
				 <td align="center"><font size="5">お問合せフォーム入力</font></td>
			</tr>
		</table>
		<hr align="center" size="2" color="black" width="950"></hr>
		<br><br><br>
		<form action="confirmation.php" method="post">
	 <table align="center">
    　<tr>
        <td>メールアドレス：</td>
        <td><input type="text" name="mail" size="50" placeholder="メールアドレスを入力してください。" value="" /></td>
    　</tr>
    　<tr>
        <td>名前：</td>
        <td><input type="text" name="name" size="50" placeholder="お名前を入力してください。"value="" /></td>
    　</tr>
    　<tr>
        <td>年齢：</td>
        <td><input type="text" name="age" size="50" placeholder="年齢を入力してください。(任意)" value="" /></td>
    　</tr>
    　<tr>
        <td>性別：</td>
        <td>
            <input type="radio" id="male" name="gender" value="男性">
            <label for="male">男性</label>

            <input type="radio" id="female" name="gender" value="女性">
            <label for="female">女性</label>

            <input type="radio" id="other" name="gender" value="未回答">
            <label for="other">未回答</label>
        </td>
    　</tr>
    　<tr>
        <td>住所：</td>
        <td><input type="text" name="address" size="50" placeholder="住所を入力してください。(任意)" value="" /></td>
    　</tr>
    　<tr>
        <td>お問い合わせ種類：</td>
        <td>
            <select name="inquiry_type">
                <option value="料金・お支払いについて">料金・お支払いについて</option>
                <option value="講座、コース、教材について">講座、コース、教材について</option>
                <option value="学習の進め方について">学習の進め方について</option>
                <option value="受講期限について">受講期限について</option>
                <option value="受講終了後のサポートについて">受講終了後のサポートについて</option>
                <option value="その他">その他</option>
            </select>
        </td>
    　</tr>
    　<tr>
        <td>詳細：</td>
        <td><textarea name="inquiry_details" cols="50" rows="5" placeholder="お問い合わせ内容を入力してください。" maxlength="200"></textarea></td>
    　</tr>
    　<tr>
        <td colspan="2" align="center"><input type="submit" value="確認" /></td>
    　</tr>
　　</table>
    	</form>
    	<table align="center">
			<tr><td><?=$errMsg;?></td></tr>
		</table><br><br><br>
		<br><br><br><br><br><br><br><br><br><br>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
		<table align="center" width="950">
			<tr><td>copyright (c) 2024 all rights reserved.</td></tr>
		</table>
	</body>
</html>