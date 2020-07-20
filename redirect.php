<?php

session_start();

if ($_GET["disconnect"] == "1") {
    session_unset();
    session_destroy();
    header("location: ./index.php");
}