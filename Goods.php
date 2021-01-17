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
    if (isset($_POST["deleteSubmit"])) {
        goodDelete();
    ?>
    <script>
    window.location = document.URL;
    </script>
    <?php
    } else {
    ?>
    <table class="container mx-auto table border shadow mt-5">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Price</th>
                <th>Manufacturer</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php getGoods(); ?>
        </tbody>

        <tfoot style="border-top: 2px solid gray;">
            <?php getGoodsCount(); ?>
        </tfoot>
    </table>
    <?php
    }
    ?>
</body>

</html>