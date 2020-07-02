<?php
require_once 'Admins.php';
class AdminsController
{

    public static function check($admin)
    {
        $result = AdminsService::check($admin);
        if ($result === true) {
            session_start();
            $_SESSION['username'] = $_POST['uname'];
            $_SESSION['password'] = $_POST['psw'];
            header('Location: home.php');
        } else {

            header('Location: login.php');
        }

    }

}
