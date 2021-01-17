<?php
include_once("Functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <?php
    if (isset($_POST["addSubmit"])) {
        if (goodAdd()) {
            unset($_POST);
    ?>
    <script>
    window.location = "Goods.php";
    </script>
    <?php
        } else {
            unset($_POST);
        ?>
    <script>
    window.location = "addGood.php";
    </script>
    <?php
        }
        ?>

    <?php
    } else if (isset($_POST["saveSubmit"])) {
        goodEdit();
    ?>
    <script>
    window.location = "Goods.php";
    </script>

    <?php
        unset($_POST);
    } else {
        if ($_GET["editSubmit"])
            $good = getGoodById($_GET["goodEditId"]);
    ?>
    <form action="addGood.php" method="POST" class="mx-auto mt-5 text-center border p-3 shadow" style="width: 300px;">
        <?php
            if ($_GET["editSubmit"]) {
            ?>
        <h4>Изменение товара</h4>
        <input type="hidden" name="id" value=<?php echo $_GET["goodEditId"] ?>>
        <?php

            } else {
            ?>
        <h4>Добавление товара</h4>
        <?php
            }
            ?>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value=<?php echo $good["Title"] ?>>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" value=<?php echo $good["Price"] ?>>
        </div>
        <div class="form-group">
            <label for="manufacturer">Manufacturer</label>
            <?php
                getSelectManufacturers();
                ?>
        </div>
        <?php
            if (isset($_GET["editSubmit"])) {
            ?>
        <input type="submit" class="btn btn-dark container-fluid" value="Сохранить" name="saveSubmit">
        <?php
            } else {
            ?>
        <input type="submit" class="btn btn-dark container-fluid" value="Добавить" name="addSubmit">
        <?php

            }
            ?>

        <a href="Goods.php" class="btn btn-dark container-fluid mt-1">Back</a>
    </form>
    <?php
    }
    ?>

</body>

</html>