<?php
require_once "../models/RegUser.php";

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    if (!empty($_POST)) {
        $user = new RegUser($_POST);

        $resultValidate = $user->validation();

        if (empty($resultValidate)) {
            if ($user->saves()) {
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
