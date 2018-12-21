<?php
$includePath = "../";
include $includePath.('include/include.php');
?>

<html>

<head>
    <title>Company - Project</title>
</head>

    <body>
        <div class="w3-card w3-round infoview">
        <?php
        include ('weergaves/projectView.php');
        include ('weergaves/devList.php');
        ?>
    </body>

</html>