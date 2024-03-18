<?php
/* プログラム名		：list.php
 * プログラム説明	：書籍販売システム
 * 作成日時			：2024/03/5
 * 作成者			：清水彰
*/
    // セッションを開始
    session_start();

	//データベースプロセスファイルを読み込む
	require_once("dbprocess.php");

	//ユーザーアカウントを「login.php」より取得
	$username = $_SESSION["userInfo"];

	//管理者権限の判定
	if ($username['authority'] == 2) {
	    $authority = "管理者";
	}else {
	    $authority = "一般ユーザー";
	}

	//全検索SQL文の設定
	$sql = "SELECT * FROM bookinfo ORDER BY isbn";

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
	<div style="max-width: 950px;margin:0 auto">
		<h1 align="center" style="margin-top: 21px;">書籍販売システムWeb版 Ver.2.0</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
		<table align="center" width="850">
			<tr>
				<td width="80">[<a href="./menu.php">メニュー</a>]</td>
				<td width="80">[<a href="./insert.php">書籍登録</a>]</td>
				<td width="690" align="left" >
					　　　　　　　　　　　　　　　　
					<font size="5">書籍一覧</font></td>
					<p align="right"><font size="2">名前：<?=$username['user'] ?></font></p>
					<p align="right"><font size="2">権限：<?=$authority ?></font></p>
			</tr>
		</table>
		<hr align="center" size="2" color="black" width="950"></hr>

		<table align="center">
			<tr>
				<td>
					<form action="./search.php" method="post">
						ISBN:<input type=text size="20" name="isbn"  value="" />
						TITLE:<input type=text size="20" name="title"  value="" />
						価格:<input type=text size="20" name="price"  value="" />
						<input type="submit" value="検索" />
					</form>
				</td>
				<td>
					<form action="./list.php"><input type="submit" value="全件表示" /></form>
				</td>

			</tr>
		</table>
		<br/>
		<table align="center" border="2">
			<tr >
				<th bgcolor="#6666FF" width="200">ISBN</th>
				<th bgcolor="#6666FF" width="200">TITLE</th>
				<th bgcolor="#6666FF" width="200">価格</th>
				<th bgcolor="#6666FF" width="250">更新/削除/カートに入れる</th>
			</tr>

			<?php
			//検索結果を表示
			if($rows){
				while($row = mysqli_fetch_array($result)) {
					echo  "<tr>\n";
					echo  "<td align=\"center\"><a href='detail.php?isbn=".$row["isbn"]."' target='_self'>".$row["isbn"]."</a></td>\n";
					echo  "<td align=\"center\"><a href='detail.php?isbn=".$row["isbn"]."' target='_self'>".$row["title"]."</td>\n";
					echo  "<td align=\"center\">".$row["price"]."円</td>\n";
					echo  "<td align=\"center\"><a href='update.php?isbn=".$row["isbn"]."' target='_self'>更新</a>　";
					echo  "<a href='delete.php?isbn=".$row["isbn"]."' target='_self'>削除</a>　";
					echo  "<a href='insertInCart.php?isbn=".$row["isbn"]."' target='_self'>カートに入れる</a></td>\n";
					echo  "</tr>\n";

				}
			}else{
				echo  "<tr>\n";
				echo  "<td colspan=\"4\" align=\"center\">書籍データは1件もありません。</td>\n";
				echo  "</tr>\n";
			}

			//結果保持用メモリを開放する
			mysqli_free_result($result);
			?>

		</TABLE>
		<br><br><br><br><br><br><br><br><br><br>
		<hr align="center" size="5" color="blue" width="950"></hr>
		<table align="center" width="950">
			<tr><td>copyright (c) 2020 all rights reserved.</td></tr>
		</table>
	</div>
	</body>
</html>