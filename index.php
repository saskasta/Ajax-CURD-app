<?php
include "config.php";
include "functions.php";

$authors = $db->getAuthors();
$years = $db->getYears();

?>
<!DOCTYPE html>

<html>
    <head>
        <title>AJAX CRUD Book App</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link type="text/css" href="bootstrap-3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <link type="text/css" href="css/styles.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>AJAX CRUD Book App</h1>
                </div>
            </div>
              <div class="row">
                  <div class="col-md-8">
                      <select class="selectpicker" id="select_year">
                          <option>Year</option>
                          <?php foreach($years as $year): ?>
                          <option><?php echo $year['year']; ?></option>
                          <?php endforeach ?>
                      </select>
                      <select class="selectpicker" id="select_author">
                          <option>Author</option>
                          <?php foreach($authors as $author): ?>
                          <option><?php echo $author['author']; ?></option>
                          <?php endforeach ?>
                      </select>
                  </div>
                  <div class="col-md-4">
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newBook"> <i class="glyphicon glyphicon-plus"></i> New</button>
                  </div>
              </div>
            <div class="row search-input">
                <div class="col-md-4 col-md-offset-8">
                    <input type="text" id="search" placeholder="search"/>
                </div>
            </div>
              <div class="row">
                  <div class="col-md-12 list-of-books"/>
                  <hr>
                  <div class="row">
                  <?php echo getAllBooks($db); ?>
                  </div>
                  </div>   
              </div>
            
        </div>
         <script src="jquery/jquery-1.11.3.min.js"></script>
         <script src="bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
         <script src="jquery-ui/jquery-ui.min.js"></script>
         <script src="jquery/functions.js"></script>
    </body>
</html>


 <div id="newBook" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Add New Book</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
              <form id="addNewBook" action="" method="post" enctype="multipart/form-data">
              <div class="row">
               <div class="form-group">
                <label for="title" class="col-md-4 control-label">Title</label>
                 <div class="col-md-6">
                     <input id="title" type="text" class="form-control" name="title" required autofocus>
                 </div>
               </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <hr>  
                  </div>
              </div>
               <div class="row">
              <div class="form-group">
                    <label for="author" class="col-md-4 control-label">Author</label>
                    <div class="col-md-6">
                         <input id="author" type="text" class="form-control" name="author" required autofocus>
                    </div>
              </div> 
                </div>
              <div class="row">
                  <div class="col-md-12">
                      <hr>  
                  </div>
              </div>
                <div class="row">
               <div class="form-group">
                    <label for="released" class="col-md-4 control-label">Released</label>
                    <div class="col-md-6">
                         <input id="released" type="text" class="form-control" name="released" required autofocus>
                    </div>
              </div>   
                 </div>
              <div class="row">
                  <div class="col-md-12">
                      <hr>  
                  </div>
              </div>
                 <div class="row">
              <div class="form-group">
                   <label for="image" class="col-md-4 control-label">Image</label>
                      <div class="col-md-6">
                   <input type="file" name="image" id="image" required/>
                      </div>
              </div>
                 <div class="row">
                  <div class="col-md-12">
                      <hr>  
                  </div>
              </div>
                    <button type="submit" class="btn btn-info" id="save_new_book">
            <i class="glyphicon glyphicon-floppy-disk" ></i> Save
        </button>
                 </div>
             </form>     
          </div>
      </div>
      <div class="modal-footer">
     
        
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-arrow-left"></i>Back</button>
        
      </div>
    </div>

  </div>
</div>

<div id="editBook" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Edit Book</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
              <form id="updateBook" action="" method="post" enctype="multipart/form-data">
               <input type="hidden" name="book_id" id="book_id"/>
              <div class="row">
               <div class="form-group">
                <label for="e_title" class="col-md-4 control-label">Title</label>
                 <div class="col-md-6">
                     <input id="e_title" type="text" class="form-control" name="e_title" required autofocus>
                 </div>
               </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <hr>  
                  </div>
              </div>
               <div class="row">
              <div class="form-group">
                    <label for="e_author" class="col-md-4 control-label">Author</label>
                    <div class="col-md-6">
                         <input id="e_author" type="text" class="form-control" name="e_author" required autofocus>
                    </div>
              </div> 
                </div>
              <div class="row">
                  <div class="col-md-12">
                      <hr>  
                  </div>
              </div>
                <div class="row">
               <div class="form-group">
                    <label for="e_released" class="col-md-4 control-label">Released</label>
                    <div class="col-md-6">
                         <input id="e_released" type="text" class="form-control" name="e_released" required autofocus>
                    </div>
              </div>   
                 </div>
              <div class="row">
                  <div class="col-md-12">
                      <hr>  
                  </div>
              </div>
                 <div class="row">
              <div class="form-group">
                   <label for="e_image" class="col-md-4 control-label">Image</label>
                      <div class="col-md-6">
                      <input type="file" name="e_image" id="e_image" />
                      </div>
              </div>
                 <div class="row">
                  <div class="col-md-12">
                      <hr>  
                  </div>
              </div>
                    <button type="submit" class="btn btn-info" id="save_update_book">
            <i class="glyphicon glyphicon-floppy-disk" ></i> Save
        </button>
                 </div>
             </form>     
          </div>
      </div>
      <div class="modal-footer">
     
        
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-arrow-left"></i>Back</button>
        
      </div>
    </div>

  </div>
</div>