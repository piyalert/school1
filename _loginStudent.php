<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 14/9/2561
 * Time: 20:47
 */
$LOGIN_STATUS = isset($_SESSION['status'])?$_SESSION['status']:'';
if($LOGIN_STATUS != 'student'){
    header("Location: /school/index.php");
    exit();
}


