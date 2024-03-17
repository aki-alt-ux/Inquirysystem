<?php
/* プログラム名		：formDetail.php
 * プログラム説明	：お問合せ管理システム
 * 作成日時			：2024/03/12
 * 作成者			：清水彰
 */
// セッションを開始
session_start();

//データベースプロセスファイルを読み込む
require_once("dbprocess.php");

// メールの返信機能
if (isset($_POST['message'])) {
    //ユーザーアカウントを「login.php」より取得
    $username = $_SESSION["Administrator"];

    //管理者権限の判定
    if (isset($username)) {
        $adminID = "管理者";
    }else {
        $adminID = "一般ユーザー";
    }

    $sql = "SELECT * FROM administrator WHERE AdminID = {$username['AdminID']}";
    $result = executeQuery($sql);
    $row = mysqli_fetch_assoc($result);
    $emailAdmin = $row['Email'];
    $inquiry_id = $_POST['inquiry_id'];
    $to = $_POST['tomail'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $headers = "From:" . $emailAdmin; // 送信元メールアドレスを設定

    // メール送信が成功した場合に、sendカラムを更新する
    if (mail($to, $subject, $message, $headers)) {
        // sendカラムを1に更新するためのSQL文を作成
        $updateSql = "UPDATE Inquiry SET send = 1, sent_at = NOW() WHERE InquiryID = $inquiry_id";

        // UPDATE文を実行
        if (executeQuery($updateSql)) {
            echo "メールが送信され、データベースが更新されました";
        } else {
            echo "メールは送信されましたが、データベースの更新に失敗しました";
        }
    } else {
        echo "メールの送信に失敗しました";
    }
    //結果保持用メモリを開放する
    mysqli_free_result($result);
} else {
    //ユーザーアカウントを「login.php」より取得
    $username = $_SESSION["Administrator"];





    //管理者権限の判定
    if (isset($username)) {
        $adminID = "管理者";
    }else {
        $adminID = "一般ユーザー";
    }

    $inquiry_id = $_GET["inquiry_id"];

    //全検索SQL文の設定
    $sql = "SELECT * FROM Inquiry WHERE InquiryID = $inquiry_id";

    // executeQuery 関数を使ってSQLを実行
    $result = executeQuery($sql);

    // 結果を取得
    $row = mysqli_fetch_assoc($result);

    $inquiryIDDB = $row['InquiryID'];
    $nameDB = $row['Name'];
    $emailDB = $row['Email'];
    $ageDB = $row['Age'];
    $genderDB = $row['Gender'];
    $addressDB = $row['Address'];
    $inquiry_typeDB = $row['InquiryTopic'];
    $inquiry_detailsDB = $row['InquiryDetails'];

    if($ageDB == -1){
        $ageMsg = "未入力";

    }else{
        $ageMsg = $ageDB;
    }



    //結果保持用メモリを開放する
    mysqli_free_result($result);
}

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
		<style>
        .center {
            margin: auto;
            width: 50%;
        }
        form {
            text-align: center;
        }
    </style>
	</head>
	<body>
	<div style="max-width: 950px;margin:0 auto">
		<h1 align="center" style="margin-top: 21px;">お問合せ管理システム</h1>
		<hr align="center" size="5" color="ORANGE" width="950"></hr>
		<table align="center" width="850">
			<tr>
				 <td align="center"><font size="5">お問合せ内容詳細</font></td>
				<p align="right"><font size="2">名前：<?=$username['Name'] ?></font></p>
				<p align="right"><font size="2">権限：<?=$adminID ?></font></p>
				<form action="login.php" method="POST">
            　　<td><input type="submit" name="logout" value="ログアウト"></td>
				</form>
			</tr>
		</table>
		<hr align="center" size="2" color="black" width="950"></hr>
		<br/>
	<table>
        <tr>
		<?php


            // 受け取ったデータを表示する
            echo "<p>No.：" ,$inquiryIDDB, "</p>";
            echo "<p>メールアドレス： " ,$emailDB, "</p>";
            echo "<p>名前： " ,$nameDB, "</p>";
            echo "<p>年齢： " ,$ageMsg, "</p>";
            echo "<p>性別： " ,$genderDB, "</p>";
            echo "<p>住所： " ,$addressDB, "</p>";
            echo "<p>お問い合わせ種類： " ,$inquiry_typeDB, "</p>";
            echo "<p>詳細： " ,$inquiry_detailsDB, "</p>";





			?>


        <form action="formDetail.php" method="post">
                <label for="subject">件名：</label>
                <input type="text" id="subject" name="subject" required><br><br>

                <label for="message">メッセージ：</label><br>
                <textarea id="message" name="message" cols="30" rows="10" required></textarea><br><br>

                <input type="submit" value="送信">
                <input type="hidden" name="tomail" value="<?= $emailDB; ?>">
                <input type="hidden" name="inquiry_id" value="<?= $inquiry_id; ?>">
            </form>
        </tr>
    </table>
</body>
</html>
<table align="center">
        <tr>
            <td>
                <a href="./formList.php">お問合せ一覧へ戻る</a>
            </td>
        </tr>
    </table>
<br><br><br><br><br><br><br><br><br><br>
<hr align="center" size="5" color="ORANGE" width="950"></hr>
<table align="center" width="950">
    <tr><td>copyright (c) 2024 all rights reserved.</td></tr>
</table>
</div>
</body>
</html>