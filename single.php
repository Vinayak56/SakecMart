<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                    <?php
                            include "config.php";
                            $id = $_GET["id"];
                            $sql = "select * from post left join category on post.category = category.category_id left join user 
                            on post.author = user.user_id where post_id = {$id}";
                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result)>0){
                            $row = mysqli_fetch_assoc($result)
                    ?>
                        <div class="post-content single-post">
                            <h3><?php echo $row["title"] ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href="category.php?cid=<?php echo $row["category_id"]; ?>"><?php echo $row["category_name"] ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aid=<?php echo $row["author"] ?>'><?php echo $row["first_name"]; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row["post_date"]; ?>
                                </span>
                            </div>
                            
                            <img class="single-feature-image" src="admin/upload/<?php echo $row["post_img"] ?>" alt=""/>
                            <p class="description">
                                <?php echo $row["description"]; ?>
                            </p>
                        </div>
                    </div>
                    <?php
                        }
                        else{
                            echo "No Record Found";
                        }
                    ?>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
