<?php
session_start();

include ("function.php");

$user = check_user_by_email($_POST['email']);
if (!empty ($user)){

    set_flash_message("danger","Этот электронный адрес уже занят");
    redirect_to("page_register.php");
    }
else{
    add_new_user($_POST['email'],$_POST['password']);
    set_flash_message("success","Вы успешно зарегистрировались");
        redirect_to("page_login.php");
}



