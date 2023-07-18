<?php 

    session_start();
    if(isset($_SESSION['user_id'])){

 include "../dbconnect.php";

 if($_SERVER['REQUEST_METHOD']=='POST'){
    $cate_name=$_POST['cate_name'];

    $sql="INSERT INTO categories (name) VALUES (:name)";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':name',$cate_name);
    $stmt->execute();
    header("location:categories.php");
    exit();
 }else{
    include "layouts/nav_sidebar.php";
 }

?>

<div class="container px-3">
    <div class="card my-5">
        <div class="card-header">
            <h5 class="d-inline">Categories Create</h5>
            <a href="posts.php" class="btn btn-danger float-end">Cancel</a>
        </div>
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="cate_name" name="cate_name">
                </div>
                 <button class="btn btn-primary w-100 mt-3 " type="submit">Update</button>
            </form>
        </div>
    </div>
  
</div>


<?php 

include "layouts/footer.php";
    }else{
        header("location:login.php");
    }

?>