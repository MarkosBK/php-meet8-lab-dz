<?php
$link = mysqli_connect("localhost", "root", "root") or die("Не удалось подключиться к серверу");
$db = mysqli_select_db($link, "ShopDB") or die("Данная БД отсуствует");
$q = mysqli_query($link, "select * from Goods");
echo "В таблице товары содержиться: " . mysqli_num_rows($q) . " товаров<br>";
echo "В таблице товары содержиться: " . mysqli_num_fields($q) . " полей";
echo "<ul>";
while ($row = mysqli_fetch_array($q)) {
    echo "<li>" . $row[0] . ". " . $row['Title'] . ", Цена: " . $row["Price"] . " грн." . "</li>";
}
echo "</ul>";