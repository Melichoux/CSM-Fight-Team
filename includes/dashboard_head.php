<?php
include_once 'includes/head.php';

if(!isset($_SESSION['user_role'])){
    header("Location: login.php");
    exit;
}

$supress_message= "";

if(isset($_GET['delete'])){
$stmt = Database::getInstance()->prepare("DELETE  FROM csm_article WHERE id_article=:id");// : apres le egal correspond a un "prepare"
$stmt->execute([':id'=>$_GET['delete']]);
}

?>