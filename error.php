<?php
/* プログラム名		：error.php
 * プログラム説明	：お問合せ管理システム
 * 作成日時			：2024/03/12
 * 作成者			：清水彰
 */

      //各ファイルからエラーメッセージの受信
      $errMsg = $_GET['errMsg'];

      //各ファイルからのpathを受信
      $path = $_GET['path'];

      if (isset($_GET['path']) && $_GET['path'] === 'list') {
          // pathパラメータが存在し、かつpathがlistである場合の処理
          $link = "<a href='./registration.php'>新規管理者登録</a>";
      } else {
          $link = "<a href='./login.php'>ログイン画面へ戻る</a>";
      }






?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>insert.php</title>
	</head>
<body>
    <div style="max-width: 950px;margin:0 auto">
        <h1 align="center" style="margin-top: 21px;">お問合せ管理システム</h1>
        <hr align="center" size="5" color="ORANGE" width="950"></hr>
        <table align="center" width="850">
            <tr>
                <td colspan="2" align="center"><font size="5">エラー</font></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <form action="login.php" method="POST">
                        <p align="right"><input type="submit" name="logout" value="ログアウト"></p>
                    </form>
                </td>
            </tr>
        </table>
		<hr align="center" size="2" color="black" width="950"></hr>
		<br><br><br>

		<table align="center">
			<tr><td><?=$errMsg;?></td></tr>
		</table><br><br><br>

		<form action="login.php" method="POST">
		<table align="center">
        	<tr>
            	<td>
               	 <?=$link?>
            	</td>
        	</tr>
    	</table>
    	</form>
		<br><br><br><br><br><br><br><br><br><br>
		<hr align="center" size="5" color="ORANGE" width="950"></hr>
		<table align="center" width="950">
			<tr><td>copyright (c) 2024 all rights reserved.</td></tr>
		</table>
	</div>
	</body>
</html>
