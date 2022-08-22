<?php
session_start();
session_destroy();
setcookie("logged_in_user_login", "", time() - 3600);
setcookie("logged_in_user_name", "", time() - 3600);
echo json_encode(['result' => true]);