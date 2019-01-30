<div  class="w3-right">

    <?php

    if(!isset($_SESSION['username'])){
        session_destroy();
        header("Location: ../index.php");
    }

    if(isset($_POST['logout'])){
        session_destroy();

        header("Location: ../index.php");
    }
    ?>

        <form method="post" name="logout">
            Welkom, <?php echo $_SESSION['username']; ?>
            <input class="w3-button companyblue hoverButton" type="submit" name="logout" value="Uitloggen">
        </form>
</div>
