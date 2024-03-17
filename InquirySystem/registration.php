<?php
/* プログラム名		：registration.php
 * プログラム説明	：お問合せ管理システム
 * 作成日時			：2024/03/12
 * 作成者			：清水彰
 */

      //データベースプロセスファイルを読み込む
    require_once("dbprocess.php");



    //作成ボタンを押してアクセスされた場合の処理
    if (isset($_POST['id'])) {

        //新規管理者登録情報
        $id = $_POST['id'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $mail = $_POST['mail'];

        // テキストボックス入力値のチェック
        if(empty($id))  {
            // 未入力がある場合はエラーページへリダイレクト
            header("Location: ./error.php?errMsg=IDが未入力の為、登録処理は行えませんでした。&path=list");
            exit();
        }
        if(empty($name))  {
            // 未入力がある場合はエラーページへリダイレクト
            header("Location: ./error.php?errMsg=名前が未入力の為、登録処理は行えませんでした。&path=list");
            exit();
        }
        if(empty($password))  {
            // 未入力がある場合はエラーページへリダイレクト
            header("Location: ./error.php?errMsg=パスワードが未入力の為、登録処理は行えませんでした。&path=list");
            exit();
        }
        if(empty($mail))  {
            // 未入力がある場合はエラーページへリダイレクト
            header("Location: ./error.php?errMsg=メールアドレスが未入力の為、登録処理は行えませんでした。&path=list");
            exit();
        }

        //フォームに入力されたuserがすでに登録されていないかチェック
        $sql = "SELECT * FROM Administrator WHERE AdminID = '{$id}'";
        $result = executeQuery($sql);

        //結果データの判断
        if (mysqli_num_rows($result) == 0) {

                //データが存在しなかった場合、DBに登録
                $sql_insert = "INSERT INTO Administrator (AdminID, Name, Password, Email)
                                VALUES ('{$id}', '{$name}', '{$password}', '{$mail}')";
                executeQuery($sql_insert);
                //登録後、ログイン画面に遷移
                header("Location: ./login.php?Msg=登録が完了しました。ログインしてください。&path=login");

        }else {
                // データが存在する場合の処理
                header("Location: ./registration.php?errMsg=IDが重複しています。別のIDで登録してください。&path=login");
        }
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
				 <td align="center"><font size="5">新規管理者登録</font></td>
			</tr>
		</table>
		<hr align="center" size="2" color="black" width="950"></hr>
		<br><br><br>
		<form action="registration.php" method="POST">
		<table align="center" border="2">
			<tr>
				<th bgcolor="#FFCC99" width="200">新規ID入力</th>
				<th><input type="text" name="id" value=""></th>
			</tr>
			<tr>
				<th bgcolor="#FFCC99" width="200">新規名前入力</th>
				<th><input type="text" name="name" value=""></th>
			</tr>
			<tr>
				<th bgcolor="#FFCC99" width="200">新規パスワード入力</th>
				<th><input type="password" name="password" value=""></th>
			</tr>
			<tr>
				<th bgcolor="#FFCC99" width="200">新規メールアドレス入力</th>
				<th><input type="text" name="mail" value=""></th>
			</tr>
			</table><br><br><br>
		<table align="center">
        <tr>
            <td>
                <input type="submit" name="login" value="作成">
            </td>
        </tr>
    </table>
	</form>
	<table align="center" >
		<tr>
		  <th>
			<?php
            //エラーメッセージの表示
    		if (isset($_GET['errMsg'])) {
            echo $_GET['errMsg'];
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
	</div>
	</body>
</html>