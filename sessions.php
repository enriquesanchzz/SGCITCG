<?php

session_start();

if(!isset($_SESSION['subcategoria']) or isset($_SESSION['subcategoria'])){
    $sub = strip_tags($_POST['subcategoria']);
    $_SESSION['subcategoria'] = $sub; 
    $subcategoria = $_SESSION['subcategoria'];
    }

    header('Location:MostrarDoc.php');
    exit;

?>