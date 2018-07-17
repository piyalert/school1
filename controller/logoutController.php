<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/16/2018
 * Time: 3:45 PM
 */
session_start();
session_destroy();
header("Location: /school/index.php");
exit();