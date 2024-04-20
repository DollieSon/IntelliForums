<?php include ("includes/connect.php");
include ("includes/helpers.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="css/globalStyle.css">

<body>
    <?php include ("includes/header.php"); ?>
    <div id="MainBody">
        <?php include ("includes/subHeader.php"); ?>
        <?php createForumHeader("My First Post", "John Doe", "2020-01-01", 5, "2020-01-02", "Jane Doe"); ?>
    </div>
    <?php include ("includes/footerBoth.php"); ?>
</body>

</html>