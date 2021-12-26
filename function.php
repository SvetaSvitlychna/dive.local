<?php
function check_user_by_email($email){

    $pdo = new PDO ("mysql:host=localhost;dbname=dive", "root", "");
    $sql = "SELECT * FROM users WHERE email =:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email'=>$email]);
    $result =$statement->fetch(PDO::FETCH_ASSOC);

    return $result;

}
function add_new_user($email, $password){
    $pdo = new PDO ("mysql:host=localhost;dbname=dive", "root", "");
    $sql = "INSERT INTO `users`(`email`, `password`,`role`) VALUES (:email, :password, :role)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email'=>$email, 'password'=>password_hash($password, PASSWORD_DEFAULT), 'role' =>'customer']);

    return $pdo->lastInsertId();;

}

function set_flash_message($name, $message){
    $_SESSION[$name]=$message;
};
function display_flash_message($name){
    if(isset($_SESSION[$name])){
        echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";

        unset ($_SESSION[$name]);}

}
function redirect_to($path){
    header("LOCATION: /".$path);
    exit;
}

function login($email, $password){
    $user = check_user_by_email($email);

    if (empty($user)){
    set_flash_message("danger","Зарегистрируйтесь или введите данные");
    redirect_to("page_login.php");}

    if(!password_verify($_POST['password'], $user['password'])){
        set_flash_message("danger", "Неверный логин или пароль");
        redirect_to("page_login.php");
    }

    $_SESSION['user'] = $user;

}

function is_not_logged_in($data){

    if(isset ($data) and $_SESSION['user'] ===false ){
                  redirect_to("page_login.php");

    }else{
        if ($_SESSION["user"]["role"] == "admin"){
           echo  "<a class=\"btn btn-success\" href=\"create_user.\">Добавить</a>";

        }
    }
}
function navigate_buttons($data){
    if(isset ($data) and $_SESSION['user'] ===false ){
        redirect_to("page_login.php");

    }else{
        if ($_SESSION["user"]["role"] == "admin"){

            echo " <i class=\"fal fas fa-cog fa-fw d-inline-block ml-1 fs-md\"></i>
                 <i class=\"fal fa-angle-down d-inline-block ml-1 fs-md\"></i>";
        }
    }


}
