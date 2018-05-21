<?php 
include "config.php";
include "functions.php";

if(!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['released']) && isset($_FILES['image']['name'])){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $date = $_POST['released'];
    $year = substr($_POST['released'], -4);
    $targetFile = "uploads/" . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    if($imageFileType == "jpg"){
         if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
             $status = $db->addNew($title,$year,$date,$author, $targetFile);
             if($status){    
                 echo getAllBooks($db);
             }
         }
    }
}


