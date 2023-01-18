<?php 

    session_start();

    session_unset();
    session_destroy();

    header("Refresh:1;url=index.php");
    //header("Location:index.php");

?>