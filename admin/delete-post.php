<?php
    include "config.php";
    $post_id = $_GET['id'];
    $cat_id = $_GET["catid"];
    
    $sql1 = "select * from post";
    $result = mysqli_query($conn,$sql1);
    $row = mysqli_fetch_assoc($result);
    unlink("upload/".$row["post_img"]);            # we use it when we need to delete file from the folder


    $sql = "Delete from post where post_id = {$post_id};";
    $sql .= "update category set post = post-1 where category_id={$cat_id}";

    if(mysqli_multi_query($conn,$sql)){
        header("Location: {$hostname}/admin/post.php");
    }else{
        echo "Query Failed";
    }
?>