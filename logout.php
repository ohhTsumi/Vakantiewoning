<?php

session_start();
if(isset($_SESSION['sessionid']) && $_SESSION['sessionid'] == session_id()) {
    unset($_SESSION['sessionid']);
    session_destroy();
}
header("Location: index.php");

