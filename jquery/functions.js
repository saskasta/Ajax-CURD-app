$(function(){
    $("#released").datepicker();
    $("#e_released").datepicker();
    
    $("#addNewBook").on('submit', function(e){
        console.log('done');
        e.preventDefault();
        $.ajax({
            url: "ajax.php", 
            type: "POST",             
            data: new FormData(this), 
            contentType: false,       
            cache: false,             
            processData:false,        
            success: function(data)   
            {
                console.log(data);
                emptyFilds();
                $(".list-of-books").html(data);
                $('#newBook').modal('toggle'); 
            }
        });
    });
    
    $("#select_year").on("change", function(){
        var year = $(this).val();
        $.ajax({
            url: "ajax-select.php", 
            type: "POST",
            data: {year:year},
            success: function(data)   
            {
                $(".list-of-books").html(data);
            }
        });
    });
    
    $("#select_author").on("change", function(){
        var author = $(this).val();
        $.ajax({
            url: "ajax-select.php", 
            type: "POST",
            data: {author:author},
            success: function(data)   
            {
                 $(".list-of-books").html(data);
            }
        });
    });
    
    $(".list-of-books").on("click",'.edit_book',function(){
        var bookId = $(this).prev().val();
        $.ajax({
            url: "ajax-edit.php", 
            type: "POST",
               dataType: 'json',
            data: {command:'get_book',book_id: bookId},
            success: function(data)   
            {
                $("#book_id").val(data.id);
                $("#e_title").val(data.title);
                $("#e_author").val(data.author);
                $("#e_released").val(data.date);
          
               
                $('#editBook').modal('toggle');
            }
        });
    });
     $(".list-of-books").on("click",'.delete_book',function(){
        var bookId = $(this).prev().prev().val();
        console.log(bookId);
         $.ajax({
            url: "ajax-edit.php", 
            type: "POST",
            data: {command:'delete_book',book_id: bookId},
            success: function(data)   
            {
                console.log(data);
                $(".list-of-books").html(data);
            }
        });
    });
    
    $("#updateBook").on('submit', function(e){
        console.log('done');
        e.preventDefault();
        $.ajax({
            url: "ajax-update.php", 
            type: "POST",             
            data: new FormData(this), 
            contentType: false,       
            cache: false,             
            processData:false,        
            success: function(data)   
            {
                console.log(data);
                emptyEditFilds();
                $(".list-of-books").html(data);
                $('#editBook').modal('toggle'); 
            }
        });
    });
    $("#search").keyup(function(){
        var search = $(this).val();
        console.log(search);
        $.ajax({
            url: "ajax-select.php", 
            type: "POST",
            data: {search:search},
            success: function(data)   
            {
                 console.log(data);
                 $(".list-of-books").html(data);
            }
        });
    });
});



function emptyFilds(){
    $("#title").val("");
    $("#author").val("");
    $("#released").val("");
    $("#image").val("");
}
function emptyEditFilds(){
    $("#book_id").val("");
    $("#e_title").val("");
    $("#e_author").val("");
    $("#e_released").val("");
    $("#e_image").val("");
}

