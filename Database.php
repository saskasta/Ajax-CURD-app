<?php


class Database {
     //conection on database
    public function __construct() {
	try{	
           $this->pdo = new PDO(TYPE.':dbname='.NAME.';host='.HOST,USER,PASS);
         } catch(PDOException $e){
		   header("Location: index.php?message=no-db-access");
		   die();
	}
    }
    
    //get all content
    public function getAll($year="", $author="",$search=""){
        $where = "";
        if(!empty($year)){
            $where =  " WHERE `year`='$year'";
        }elseif(!empty($author)){
            $where =  " WHERE `author`='$author'";
        }elseif(!empty($search)){
            $where = " WHERE `title` LIKE '%$search%' OR `author` LIKE '%$search%' OR `date` LIKE '%$search%'";
        }
        $arr = array();
        $sql="SELECT `id`,`title`,`year`,`date`,`author`,`image`
              FROM `books`".$where;
        $result=$this->pdo->query($sql);
        if($result->rowCount()>0){
            while ($rs=$result->fetch(PDO::FETCH_ASSOC)){
                $arr[]=$rs;
            }
        }
        return $arr;
    }
    
    //insert new content
    public function addNew($title,$year,$date,$author, $image){
        $sql="INSERT INTO `books` (`title`,`year`,`date`,`author`,`image`)
              VALUES ('$title','$year','$date','$author','$image')";    
        return $this->pdo->exec($sql);
    }
    
    //update content
    public function update($id,$title,$year,$date,$author){
        $sql="UPDATE `books` SET `title`='$title', `year`='$year', `date`='$date',`author`='$author'
        where `id`=$id";
       
        $this->pdo->exec($sql);   
    }
    public function updateImg($id,$image){
        $sql="UPDATE `books` SET `image`='$image'
        where `id`=$id";
        $this->pdo->exec($sql);     
    } 
    //delete content
    public function delete($id){
        $sql="DELETE  FROM `books`
              where `id`=$id";
        $this->pdo->exec($sql);
    }
    //get one row by Id
    public function getById($id){
        $arr = array();
        $sql="SELECT `id`,`title`,`year`,`date`,`author`,`image`
              FROM `books`
              where `id`=$id";
        $result=$this->pdo->query($sql);
        if($result->rowCount()>0){
            $arr=$result->fetch(PDO::FETCH_ASSOC);
        }
        return $arr;   
    }
    
     public function getYears(){
        $arr = array();
        $sql="SELECT DISTINCT year
              FROM `books`";
        $result=$this->pdo->query($sql);
        if($result->rowCount()>0){
            while ($rs=$result->fetch(PDO::FETCH_ASSOC)){
                $arr[]=$rs;
            }
        }
        return $arr;
    }
     public function getAuthors(){
        $arr = array();
        $sql="SELECT DISTINCT author
              FROM `books`";
        $result=$this->pdo->query($sql);
        if($result->rowCount()>0){
            while ($rs=$result->fetch(PDO::FETCH_ASSOC)){
                $arr[]=$rs;
            }
        }
        return $arr;
    }
    
    
}
