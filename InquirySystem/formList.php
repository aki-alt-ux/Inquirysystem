<?php
/* プログラム名		：formList.php
 * プログラム説明	：お問合せ管理システム
 * 作成日時			：2024/03/11
 * 作成者			：清水彰
*/
    // セッションを開始
    session_start();

	//データベースプロセスファイルを読み込む
	require_once("dbprocess.php");

	//ユーザーアカウントを「login.php」より取得
	$username = $_SESSION["Administrator"];

	//管理者権限の判定
	if (isset($username)) {
	    $adminID = "管理者";
	}else {
	    $adminID = "一般ユーザー";
	}

	//全検索SQL文の設定
	$sql = "SELECT * FROM Inquiry ORDER BY InquiryID";

	//dbprocessファイルから「executeQuery」関数を利用してSQLを発行する
	$result = executeQuery($sql);

	//結果セットの行数を取得する
	$rows = mysqli_num_rows($result);

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
	</head>
	<body>
	<div style="max-width: 950px; margin: 0 auto;">
    <h1 align="center" style="margin-top: 21px;">お問合せ管理システム</h1>
    <hr align="center" size="5" color="ORANGE" width="950">
    <table align="center" width="850">
        <tr>
            <td colspan="2" align="center"><font size="5">お問合せ内容一覧</font></td>
        </tr>
        <tr>
            <td width="50%" align="left"><font size="2">名前：<?=$username['Name'] ?></font></td>
        </tr>
        <tr>
            <td width="50%" align="left"><font size="2">権限：<?=$adminID ?></font></td>
        </tr>
        <tr>
            <td colspan="2">
                <form action="login.php" method="POST">
                    <p align="right"><input type="submit" name="logout" value="ログアウト"></p>
                </form>
            </td>
        </tr>
    </table>
		<hr align="center" size="2" color="black" width="950"></hr>


		<br/>
		<table align="center" border="2">
			<tr >
				<th bgcolor="#FFCC99" width="200">No.</th>
				<th bgcolor="#FFCC99" width="200">名前</th>
				<th bgcolor="#FFCC99" width="200">お問合せ日時</th>
				<th bgcolor="#FFCC99" width="200">種類</th>
				<th bgcolor="#FFCC99" width="200">お問合せ内容</th>
				<th bgcolor="#FFCC99" width="200">未返信/返信済</th>
			</tr>

			<?php
			//検索結果を表示
			if($rows){
				while($row = mysqli_fetch_array($result)) {
					echo  "<tr>\n";
					echo  "<td align=\"center\">".$row["InquiryID"]."</td>\n";
					echo  "<td align=\"center\">".$row["Name"]."</td>\n";
					echo  "<td align=\"center\">".$row["sent_at"]."</td>\n";
					echo  "<td align=\"center\">".$row["InquiryTopic"]."</td>\n";
					echo "<td align=\"center\">" . mb_substr($row["InquiryDetails"], 0, 18, "UTF-8") . "</td>\n";
					echo  "<td align=\"center\">";
					if($row["send"] == 0){
						echo "<a href=\"formDetail.php?inquiry_id=".$row["InquiryID"]."\">未返信</a>";
					} else {
					    echo "<a href=\"formDetail.php?inquiry_id=".$row["InquiryID"]."\">返信済</a>";
					}
					echo "</td>\n";
					echo  "</tr>\n";

				}
			}else{
				echo  "<tr>\n";
				echo  "<td colspan=\"4\" align=\"center\">データは1件もありません。</td>\n";
				echo  "</tr>\n";
			}

			//結果保持用メモリを開放する
			mysqli_free_result($result);
			?>

		</TABLE>
		<br><br><br><br><br><br><br><br><br><br>
		<hr align="center" size="5" color="ORANGE" width="950"></hr>
		<table align="center" width="950">
			<tr><td>copyright (c) 2024 all rights reserved.</td></tr>
		</table>
	</div>
	</body>
</html>