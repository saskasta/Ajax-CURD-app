<?php
include "config.php";
include "functions.php";

if($_POST['command'] == "get_book"){
    $bookId = $_POST['book_id'];
    $book = $db->getById($bookId);
    echo json_encode($book);

}else if($_POST['command'] == "delete_book"){
    $bookId = $_POST['book_id'];
    $db->delete($bookId);
    echo getAllBooks($db);
}
