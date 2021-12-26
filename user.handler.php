<?php
session_start();

include ("function.php");


set_flash_message("success", "Профиль успешно обновлен");


is_not_logged_in($_SESSION['user']);
navigate_buttons($_SESSION['user']);
get_users_list();
//var_dump($_SESSION);die;


