<?php
require_once "User.php";
require_once "Validate.php";

class RegUser extends User
{
    private $login = "";
    private $password = "";
    private $confirmPassword = "";
    private $email = "";
    private $name = "";

    public function __construct($userData)
    {
        $this->login = $this->prepareInput($userData['login']);
        $this->password = $this->prepareInput($userData['password']);
        $this->confirmPassword = $this->prepareInput($userData['confirmPassword']);
        $this->email = $this->prepareInput($userData['email']);
        $this->name = $this->prepareInput($userData['name']);
    }

    public function validation()
    {
        $errors = [];

        $validate = new Validate();
        $validate->loginValidation($this->login, $errors, "login");
        $this->isLoginAlreadyExists($this->login, $errors);
        $validate->passwordValidation($this->password, $errors, "password");
        $validate->confirmPasswordValidation($this->password, $this->confirmPassword, $errors);
        $validate->emailValidation($this->email, $errors);
        $validate->nameValidation($this->name, $errors);

        return $errors;
    }

    private function isLoginAlreadyExists($login, &$errors)
    {
        $count = $this->getCountOfLogins($login);
        if ($count != 0) {
            $errors[]["login"] = 'Логин уже используется';
        }
    }

    public function saves()
    {
        $user = ['login' => $this->login, 'password' => $this->hashPassword($this->password), 'email' => $this->email, 'name' => $this->name];
        if ($this->create($user)) {
            $this->AddToSessionAndCookies($this->login, $this->name);
            return true;
        }
    }

    private function hashPassword($password)
    {
        $salt = bin2hex(random_bytes(16));
        $password = md5($password . $salt) . $salt;
        return $password;
    }
}