<?php
include "config.php";
include "functions.php";




if(!empty($_POST['book_id']) && !empty($_POST['e_title']) && !empty($_POST['e_author']) && !empty($_POST['e_released'])){
    $bookId = $_POST['book_id'];
    $title = $_POST['e_title'];
    $author = $_POST['e_author'];
    $date = $_POST['e_released'];
    $year = substr($_POST['e_released'], -4);
    $db->update($bookId,$title,$year,$date,$author);
    if(isset($_FILES['e_image']['name'])){
        $targetFile = "uploads/" . basename($_FILES["e_image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        if($imageFileType == "jpg"){      
         if (move_uploaded_file($_FILES["e_image"]["tmp_name"], $targetFile)) {
             $db->updateImg($bookId,$targetFile);
             
         }
         }
    }
    echo getAllBooks($db);
}