<?php
    include "config.php";
    if($_SESSION["role"] == '0'){
        header("Location: {$hostname}/admin/post.php");
    }
    $userid = $_GET["id"];
    $sql = "delete from user where user_id = '{$userid}'";
    if(mysqli_query($conn,$sql)){
        header("Location: http://localhost/news-site/admin/users.php");
    }else{
        echo "<p style='color:red;margin:10px 0'>Can't Delete</p>";
    }
    mysqli_close($conn);
?>