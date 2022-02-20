<?php
    include "config.php";
    if(isset($_FILES["fileToUpload"])){
        $error = array();

        $file_name = $_FILES['fileToUpload']['name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $file_type = $_FILES['fileToUpload']['type'];   
        $file_ext = end(explode('.',$file_name));
        $extensions = array("jpeg","jpg","png");
        if(in_array($file_ext,$extensions) === false){
            $error[] = "This extension file not allowed, Please choose a JPG,PNG,JPEG typ file";
        }
        if($file_size > 2097152){
            $error[] = "File size must be 2MB or lower";
        }
        if(empty($error) == true){
            move_uploaded_file($file_tmp,"upload/".$file_name);
        }
        else{
            print_r($error);
            die();
        }

    }

    session_start();
    $title = mysqli_real_escape_string($conn,$_POST["post_title"]);
    $description = mysqli_real_escape_string($conn,$_POST["postdesc"]);
    $category = mysqli_real_escape_string($conn,$_POST["category"]);
    $date = date("d M, Y");
    $author = $_SESSION["user_id"];

    # when using 2 or more sql statement we should give ; at end of 1
    $sql = "insert into post(title,description,category,post_date,author,post_img) values('{$title}','{$description}',{$category},'{$date}',{$author},'{$file_name}');";

    $sql .= "update category set post = post + 1 where category_id = {$category}";

    if(mysqli_multi_query($conn,$sql)){                  # when we need to run more than 1 sql query
        header("Location: {$hostname}/admin/post.php");
    }else{
        echo "<div class='alert alert-danger'>Query Failed.</div>";
    }
?>