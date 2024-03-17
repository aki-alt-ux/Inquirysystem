<?php
/* プログラム名		：dbprpcess.php
 * プログラム説明	：お問合せ管理システム
 * 作成日時			：2024/03/12
 * 作成者			：清水彰
*/
function executeQuery($sql)
{
    $url  = "localhost";
    $user = "root";
    $pass = "root123";
    $db   = "customersdb";

    // MySQLへ接続する
    $link = @mysqli_connect($url, $user, $pass) or die("MySQLへの接続に失敗しました。>>");

    // データベースを選択する
    $sdb = @mysqli_select_db($link, $db) or die("データベースの選択に失敗しました。>>");

    // クエリを送信する
    $result = mysqli_query($link, $sql) or die("クエリの送信に失敗しました。SQL:". $sql);

    // MySQLへの接続を閉じる
    @mysqli_close($link) or die("MySQL切断に失敗しました。>>");

    //戻り値
    return($result);
}
?>