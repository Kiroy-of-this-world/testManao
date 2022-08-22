<?php
require_once "../models/AuthUser.php";

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    if (!empty($_POST)) {
        $user = new AuthUser($_POST);

        $resultValidate = $user->validation();

        if (empty($resultValidate)) {
            if ($user->authorization()) {
                echo json_encode(['result' => true]);
                exit();
            }
            else echo json_encode(['result' => false]);

            exit();
        }

        echo json_encode([
            'result' => false,
            'errors' => $resultValidate
        ]);
        exit();
    }
}