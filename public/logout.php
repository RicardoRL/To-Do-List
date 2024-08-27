<?php

require_once __DIR__ . '/../src/config/init.php';

$authController->logout();

header('Location: login.php');
exit;