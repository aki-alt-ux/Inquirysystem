<?php
/* プログラム名		：login.php
 * プログラム説明	：お問合せ管理システム
 * 作成日時			：2024/03/11
 * 作成者			：清水彰
 */

    // セッションを開始
    session_start();

    //データベースプロセスファイルを読み込む
    require_once("dbprocess.php");

    //ログインボタンを押してアクセスされた場合の処理
    if (isset($_POST['user'])) {

        $user = $_POST['user'];
        $password = $_POST['password'];


        //フォームに入力されたuserがすでに登録されていないかチェック
        $sql = "SELECT * FROM Administrator WHERE AdminID = '{$user}' and password = '{$password}'";
        $result = executeQuery($sql);

        //結果データの判断
        if (mysqli_num_rows($result) == 0) {
                //データが存在しなかった場合エラー処理
                header("Location: ./login.php?errMsg=入力されたユーザー名とパスワードが間違っています。&path=login");

        }else {
                // データが存在する場合の処理
                $userInfo = mysqli_fetch_assoc($result);
                $_SESSION["Administrator"] = $userInfo;

                // クッキーにユーザー情報を登録
                setcookie("user", $user, (time() + 30 * 86400), '/');

                // メニュー画面に遷移
                header("location: ./formList.php");
                exit(); // リダイレクト後にスクリプトの実行を終了する
        }
    }

    // 初回アクセスの処理
    $user = "";
    if (!isset($_COOKIE['user'])) {
        // クッキー情報に前回ログイン成功した際の「ユーザー」があれば取得する。
        $user = $_COOKIE['user'];
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
		<h1 align="center" style="margin-top: 21px;">お問合せ管理システム</h1>
	<hr align="center" size="5" color="ORANGE" width="950"></hr>
		<table align="center" width="850">
			<tr>
				 <td align="center"><font size="5">ログイン画面</font></td>
			</tr>
		</table>
		<hr align="center" size="2" color="black" width="950"></hr>
		<br><br><br>
		<form action="login.php" method="POST">
		<table align="center" border="2">
			<tr>
				<th bgcolor="#FFCC99" width="150">ID</th>
				<th><input type="text" name="user" value=""></th>
			</tr>
			<tr>
				<th bgcolor="#FFCC99" width="150">パスワード</th>
				<th><input type="password" name="password" value=""></th>
			</tr>
			</table><br><br><br>
		<table align="center">
        <tr>
            <td>
                <input type="submit" name="login" value="ログイン">
            </td>
        </tr>
        </form>
        <form action="registration.php" method="POST">
        <tr>
            <td>
                <input type="submit" name="new_user" value="新規管理者登録">
            </td>
        </tr>
    </table>
	</form>
	<table align="center" >
		<tr>
		  <th>
			<?php
            //メッセージの表示
    		if (isset($_GET['errMsg'])) {
            echo $_GET['errMsg'];
            }elseif (isset($_GET['Msg'])) {
                echo $_GET['Msg'];
            }
            ?>
         </th>
        </tr>
	</TABLE>
		<br><br><br><br><br><br><br><br><br><br>
		<hr align="center" size="5" color="ORANGE" width="950"></hr>
		<table align="center" width="950">
			<tr><td>copyright (c) 2024 all rights reserved.</td></tr>
		</table>
	</body>
</html>