<?php


function getAllBooks($db,$year="", $author="",$search=""){
    $text = "<h3>List of books</h3>";
    
    $books = $db->getAll($year,$author,$search);
    
    for($i=0; $i < count($books); $i++){

         $text .= "<div class='col-md-6'>";
         $text .= "<div class='article'>";
         $text .= "<div class='row'>";
         $text .= "<div class='col-md-5 img-wrapp'>"; 
          $text .= "<img src='".$books[$i]['image']."'/>";
         $text .= "</div>";
         $text .= "<div class='col-md-7'>";
         $text .= "<ul>";
         $text .= "<li>Title: ".$books[$i]['title']."</li>";
         $text .= "<li>Author: ".$books[$i]['author']."</li>";
         $text .= "<li>Released: ".$books[$i]['date']."</li>";
         $text .= "<li><input type='hidden' value='".$books[$i]['id']."'/><button class='edit_book'>Edit</button> <button class='delete_book'>Delete</button></li>";
         $text .= "</ul>";
         $text .= "</div>";
         $text .= "</div>";
         $text .= "</div>";
         $text .= "</div>";
    }
    return $text;
}

