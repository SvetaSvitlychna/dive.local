<?php
session_start();

include ("function.php");

login ($_POST['email'], $_POST['password']);


redirect_to("users.php");

