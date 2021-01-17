<?php
$link = mysqli_connect("localhost", "root", "root", "ShopDB") or die("Не удалось подключиться к серверу");
$goods = mysqli_query($link, "select * from Goods");
$manufacturers = mysqli_query($link, "select * from Manufacturers");
function getGoods()
{
    global $link;
    global $goods;
    while ($row = mysqli_fetch_array($goods)) {
        echo "<tr>";
        echo "<td>" . $row["Id"] . "</td>";
        echo "<td>" . $row["Title"] . "</td>";
        echo "<td>" . $row["Price"] . "</td>";

        $id = $row['ManufacturerId'];
        $manufacturer = mysqli_query($link, "select Login from Manufacturers where Id=$id");
        $res = mysqli_fetch_array($manufacturer)[0];
        echo "<td>" . $res . "</td>";
        echo "<td class='d-flex'>";
        echo "<form action='addGood.php' method='GET'><input type='hidden' name='goodEditId' value='" . $row['Id'] . "'>";
        echo "<input name='editSubmit' type='submit' class='btn btn-dark' value='Изменить'></form>";
        echo "<form method='POST'><input type='hidden' name='goodId' value='" . $row['Id'] . "'>";
        echo "<input name='deleteSubmit' type='submit' class='btn btn-dark ml-1' value='Удалить'></form>";
        echo "</td>";
        echo "</tr>";
    }
}

function getGoodsCount()
{
    global $goods;
    echo "<tr>";
    echo "<td colspan='4' class='font-weight-bold'>Количество товаров: " . mysqli_num_rows($goods) . "</td>";
    echo "<td><a href='addGood.php' class='btn btn-dark container-fluid'>Добавить товар</a></td>";
    echo "</tr>";
}

function getSelectManufacturers()
{
    global $manufacturers;

    echo "<select class='form-control' name='manufacturer'>";
    while ($row = mysqli_fetch_array($manufacturers)) {
        if ($row["Id"] == getGoodById($_GET["goodEditId"])['ManufacturerId']) {
            echo "<option value='" . $row["Id"] . "' selected>";
        } else {
            echo "<option value='" . $row["Id"] . "'>";
        }
        echo $row["Login"];
        echo "</option>";
    }
    echo "</select>";
}

function getGoodById($id)
{
    global $link;
    $good = mysqli_query($link, "select * from Goods where Id=$id");
    $res = mysqli_fetch_assoc($good);
    return $res;
}

function goodAdd()
{
    global $link;
    if ($_POST["title"] != "" && $_POST["price"] > 0) {
        $add = mysqli_query($link, "insert into Goods (Id,Title,Price,ManufacturerId) values (DEFAULT,'" . $_POST["title"] . "', " . $_POST["price"] . ", " . $_POST["manufacturer"] . ")");
        if ($add) return true;
        else return false;
    }
}

function goodDelete()
{
    global $link;
    $delete = mysqli_query($link, "DELETE FROM `goods` WHERE Id=" . $_POST["goodId"]);
    unset($_POST["deleteSubmit"]);
    if ($delete) return true;
    else return false;
}

function goodEdit()
{
    global $link;
    $edit = mysqli_query($link, "UPDATE Goods SET Title=" . "'" . $_POST["title"] . "'" . ", Price=" . $_POST["price"] . ", ManufacturerId=" . $_POST["manufacturer"] . " WHERE Id=" . $_POST["id"]);

    if ($edit) return true;
    else return false;
}