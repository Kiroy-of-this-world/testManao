<?php
require_once "CRUD.php";

class User extends CRUD
{
    protected function AddToSessionAndCookies($login, $name)
    {
        setcookie("logged_in_user_login", $login);
        setcookie("logged_in_user_name", $name);
        session_start();
        $_SESSION['logged_in_user_login'] = $login;
        $_SESSION['logged_in_user_name'] = $name;
    }

    protected function getName($login)
    {
        $arr = $this->read();
        $name = "";

        foreach ($arr as $item) {
            if ($item["login"] == $login) {
                $name = $item["name"];
                break;
            }
        }

        return $name;
    }

    protected function getHashPassword($login)
    {
        $arr = $this->read();
        $hashPassword = "";

        foreach ($arr as $item) {
            if ($item["login"] == $login) {
                $hashPassword = $item["password"];
                break;
            }
        }

        return $hashPassword;
    }

    protected function getCountOfLogins($login)
    {
        $arr = $this->read();
        $count = 0;

        foreach ($arr as $item) {
            if ($item["login"] == $login) {
                $count++;
                break;
            }
        }

        return $count;
    }

    public function prepareInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}