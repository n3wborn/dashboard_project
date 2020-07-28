<?php require_once 'php/database.php' ?>

<?php 
$location = '';
$name_product = '';
$ref_product = '';
$categories = '';
$purchase_date = '';
$guarantee_date = '';
$price = '';
$advice = '';
$picture = '';
$manual = '';
$error = 'false';

if ( count($_POST) > 0){
    // location
    if (strlen(trim($_POST['location']))!== 0){
        $location = trim($_POST['location']);
    }
    else{
        $error = true;
    }
    // name product
    if (strlen(trim($_POST['name_product']))!== 0){
        $name_product = trim($_POST['name_product']);
    }
    else{
        $error = true;
    }
    // reference product
    if (strlen(trim($_POST['ref_product']))!== 0){
        $ref_product = trim($_POST['ref_product']);
    }
    else{
        $error = true;
    }
    // categories
    if (strlen(trim($_POST['categories']))!== 0){
        $categories = trim($_POST['categories']);
    }
    else{
        $error = true;
    }
    //purchase_date
    if (strlen(trim($_POST['purchase_date']))!== 0){
        $purchase_date = trim($_POST['purchase_date']);
    }
    else{
        $error = true;
    }
    // guarantee date 
    if (strlen(trim($_POST['guarantee_date']))!== 0){
        $guarantee_date = trim($_POST['guarantee_date']);
    }
    else{
        $error = true;
    }
    // price
    if (strlen(trim($_POST['price']))!== 0){
        $price = trim($_POST['price']);
    }
    else{
        $error = true;
    }
    // advice
    if (strlen(trim($_POST['advice']))!== 0){
        $advice = trim($_POST['advice']);
    }
    else{
        $error = true;
    }
    // picture
    if (strlen(trim($_POST['picture']))!== 0){
        $picture = trim($_POST['picture']);
    }
    else{
        $error = true;
    }
    // manual
    if (strlen(trim($_POST['manual']))!== 0){
        $manual = trim($_POST['manual']);
    }
    else{
        $error = true;
    }



}