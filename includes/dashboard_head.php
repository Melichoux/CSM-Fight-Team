<?php
include_once 'includes/head.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header("Location: login.php");
    exit;
}

if(isset($_GET['delete'])){
$stmt = Database::getInstance()->prepare("DELETE  FROM csm_article WHERE id_article=:id");// : apres le egal correspond a un "prepare"
$stmt->execute([':id'=> (int)$_GET['delete']]); // le (int) => defense en profondeur  pour etre sur que l'id est bien in int meme si le pdo protege deja des injections
}

?>