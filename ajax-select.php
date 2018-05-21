<?php

include "config.php";
include "functions.php";


if(isset($_POST['year'])){
    $year = $_POST['year'];
    if($year == "Year"){
        echo getAllBooks($db);
    }else{
        echo getAllBooks($db,$year);
    }
    
}else if(isset($_POST['author'])){
    $author = $_POST['author'];
    if($author == "Author"){
        echo getAllBooks($db);
    }else{
        echo getAllBooks($db,'',$author);
    }
}else if(isset($_POST['search'])){
     $search = $_POST['search'];
      echo getAllBooks($db,'','', $search);
}
