<?php

class Validate
{
    public function loginValidation($login, &$errors, $id) {
        if (!isset($login) || strlen($login) == 0) {
            $errors[][$id] = 'Логин не указан';
        }  elseif (!preg_match("/^(([A-Z]+)|([А-ЯЁ]+)|([a-z]+)|([а-яё]+)|(\d+))$/u",$login)) {
            $errors[][$id] = 'Логин должен содержать только цифры, буквы верхнего и нижнего регистра';
        } elseif (strlen($login) < 6) {
            $errors[][$id] = 'Логин должен быть не менее 6 символов';
        } elseif (strlen($login) > 32) {
            $errors[][$id] = 'Логин должен быть не более 32 символа';
        }
    }

    public function passwordValidation($password, &$errors, $id) {
        if (!isset($password) || strlen($password) == 0) {
            $errors[][$id] = 'Пароль не указан';
        } elseif (!preg_match("/(([a-z]+)|([а-яё]+))/u",$password)) {
            $errors[][$id] = 'Пароль должен содержать также буквы нижнего регистра';
        } elseif (!preg_match("/(([A-Z]+)|([А-ЯЁ]+))/u",$password)) {
            $errors[][$id] = 'Пароль должен содержать также буквы верхнего регистра';
        } elseif (!preg_match("/\d+/u",$password)) {
            $errors[][$id] = 'Пароль должен содержать также цифры';
        }  elseif (preg_match("/^(([A-Z]+)|([А-ЯЁ]+)|([a-z]+)|([а-яё]+)|(\d+))$/u",$password)) {
            $errors[][$id] = 'Пароль должен содержать только цифры, буквы верхнего и нижнего регистра';
        } elseif (strlen($password) < 6) {
            $errors[][$id] = 'Пароль должен быть не менее 6 символов';
        } elseif (strlen($password) > 32) {
            $errors[][$id] = 'Пароль должен быть не более 32 символа';
        }
    }

    public function confirmPasswordValidation($password, $confirmPassword, &$errors) {
        if (!isset($confirmPassword) || strlen($confirmPassword) == 0) {
            $errors[]["confirmPassword"] = 'Пароль не указан';
        } elseif ($password !== $confirmPassword) {
            $errors[]["confirmPassword"] = 'Пароли не совпадают';
        }
    }

    public function emailValidation($email, &$errors) {
        if (!isset($email) || strlen($email) == 0) {
            $errors[]["email"] = 'Email не указан';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[]["email"] = 'Неправильный формат email';
        } elseif (strlen($email) < 6) {
            $errors[]["email"] = 'Email должен быть не менее 6 символов';
        } elseif (strlen($email) > 32) {
            $errors[]["email"] = 'Email должен быть не более 32 символа';
        }
    }

    public function nameValidation($name, &$errors) {
        if (!isset($name) || strlen($name) == 0) {
            $errors[]['name'] = 'Имя не указано';
        } elseif (!preg_match("/^(([a-zA-Z' -]{2,30})|([а-яА-ЯЁё -]{2,30}))$/u",$name)) {
            $errors[]["name"] = 'Имя должно состоять только из букв';
        } elseif (strlen($name) < 2) {
            $errors[]["name"] = 'Имя должно быть не менее 2 символа';
        } elseif (strlen($name) > 32) {
            $errors[]["name"] = 'Имя должно быть не более 32 символа';
        }
    }
}