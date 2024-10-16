<?php
require_once 'assets/php/functions.php';

if (isset($_GET['newfb'])){
    unset($_SESSION['auth_temp']);
    unset($_SESSION['forgot_email']);
    unset($_SESSION['forgot_code']);
}
if(isset($_SESSION['Auth'])){
    $user = getUser($_SESSION['userdata']['id']);
}

if(isset($_SESSION['Auth']) &&  $user['ac_status'] == 1){
    showPage('header', ['page_title' => 'Home']);
    showPage('navbar');
    showPage('wall');
}
elseif(isset($_SESSION['Auth']) && $user['ac_status'] == 0){
    showPage('header', ['page_title' => 'Verify Your Email']);
    showPage('verify_email');
}
elseif(isset($_SESSION['Auth']) && $user['ac_status'] == 2){
    showPage('header', ['page_title' => 'Blocked']);
    showPage('blocked');
}
elseif (isset($_GET['signup'])){
    showPage('header', ['page_title' => 'Pictogram - SignUp']);
    showPage('signup');
    
}
elseif(isset($_GET['login'])){
    showPage('header', ['page_title' => 'Pictogram - Login']);
    showPage('login');
}
elseif(isset($_GET['forgotpassword'])){
    showPage('header', ['page_title' => 'Pictogram - Forgot Password']);
    showPage('forgot_password');
}
else{
    showPage('header', ['page_title' => 'Pictogram - Login']);
    showPage('login');

}
showPage('footer');
unset($_SESSION['error']);
unset($_SESSION['formdata']);

