<?php
$includePath = "../";
include $includePath.('include/include.php');

if($_SESSION['usertype'] != '3'){
    header("Location: projectPage.php");
}
?>

<html>

<head>
    <title>Company - Project</title>
</head>

    <body>
        <div class="pagemargin w3-card w3-round infoview">
        <?php
        $userID = $_SESSION['id'];
        include ('weergaves/devView.php');
        include ('weergaves/projectList.php');
        ?>
        </div>
    </body>

</html>