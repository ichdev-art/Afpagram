


<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location:  ../../index.php');
    exit();
}

include_once '../View/view-deconnexion.php' ?>