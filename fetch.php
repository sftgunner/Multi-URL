<?php
include "customfunctionlibrary.php";
$uid1 = ltrim($_SERVER['REQUEST_URI'], '/');
//Strange bug with ltrim where it removes extra ts from the beginning of the string
//$uid = ltrim($uid1, "Multi-URL/");
$uid = str_replace("Multi-URL/","",$uid1);

$dbserver = getenv('MYSQL_SERVER_MULTIURL');
$dbusername = getenv('MYSQL_USER_MULTIURL');
$dbpassword = getenv('MYSQL_PASSWORD_MULTIURL');
$dbname = getenv('MYSQL_DB_MULTIURL');
$dbport = getenv('MYSQL_PORT_MULTIURL');
$dbaccess = true;

$results = get_arr_from_db('title,urls',$uid,'shortlink','multiurl');

if ($results == 'No results'){
    header("Location: https://multiurl.sftg.io/404.html#".$uid);
    die();
}
else{

    $title = $results[0][0];
    $links = json_decode($results[0][1],true);
    
    include 'render.php';
}
?>
