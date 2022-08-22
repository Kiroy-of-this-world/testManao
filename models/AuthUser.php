<?php
require_once "User.php";
require_once "Validate.php";

class AuthUser extends User
{
    private $login = "";
    private $password = "";
    private $name = "";

    public function __construct($userData)
    {
        $this->login = $this->prepareInput($userData['login-auth']);
        $this->password = $this->prepareInput($userData['password-auth']);
        $this->name = $this->getName($this->prepareInput($userData['login-auth']));
    }

    public function validation()
    {
        $errors = [];

        $validate = new Validate();
        $this->isLoginAlreadyExists($this->login, $errors);
        $validate->loginValidation($this->login, $errors, "login-auth");
        $this->confirmPassword($this->password, $this->getHashPassword($this->login), $errors);
        $validate->passwordValidation($this->password, $errors, "password-auth");

        return $errors;
    }

    public function authorization()
    {
        $this->AddToSessionAndCookies($this->login, $this->name);
        return true;
    }

    private function isLoginAlreadyExists($login, &$errors)
    {
        $count = $this->getCountOfLogins($login);
        if ($count == 0) {
            $errors[]["login-auth"] = 'Логина не существует';
        }
    }

    private function confirmPassword($password, $hashPassword, &$errors)
    {
        $salt = substr($hashPassword, 32);
        $password = md5($password . $salt) . $salt;
        if ($password !== $hashPassword) {
            $errors[]["password-auth"] = 'Пароль не верный';
        }
    }
}