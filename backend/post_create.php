<?php 

session_start();
 if (isset($_SESSION['user_id'])){
  include "../dbconnect.php";

$sql="SELECT * FROM categories";
$stmt=$conn->prepare($sql);
$stmt->execute();
$categories=$stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD']=='POST'){

$title=$_POST['title'];
$category_id=$_POST['category_id'];
$user_id=$_SESSION['user_id'];
$description=$_POST['description'];
$photo_arr=$_FILES['photo'];

//echo "$title and $category_id and $user_id and $description";
//print_r($photo);

if(isset($photo_arr) && $photo_arr['size'] > 0){
  
    $dir='images/';
    $photo=$dir.$photo_arr['name'];
    $tmp_name=$photo_arr['tmp_name'];
    move_uploaded_file($tmp_name,$photo);

}

// $sql="INSERT INTO posts (title,category,user_id,photo,description) VALUES('$title',$category_id,$user_id,'$photo','$description')";
// $stmt=$conn->prepare($sql);
// $stmt->execute();  ------>insert ထည့် <---------
$sql="INSERT INTO posts (title,category_id,user_id,photo,description) VALUES(:title,:category,:user,:photo,:description)";
$stmt=$conn->prepare($sql);
$stmt->bindParam(':title',$title);
$stmt->bindParam(':category',$category_id);
$stmt->bindParam(':user',$user_id);
$stmt->bindParam(':photo',$photo);
$stmt->bindParam(':description',$description);
$stmt->execute();

header("location:post_create.php");
exit;
}else{
    include "layouts/nav_sidebar.php";

}

?>
<div class="container px-3">
    <div class="card my-5">
        <div class="card-header">
            <h5 class="d-inline">Post create</h5>
            <a href="posts.php" class="btn btn-danger float-end">Cancel</a>
        </div>
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                 <div class="mb-3">
                    <label for="photo" class="form-label">Default file input example</label>
                    <input class="form-control" type="file" id="photo" name="photo">
                 </div>
                <div class="mb-3">
                     <label for="category_id" class="form-label">Categories</label>
                    <select class="form-select" name="category_id" id="category_id">
                         <option selected>Select category</option>
                    <?php 
                        foreach ($categories as $category) {
                 
                    ?>
                        <option value="<?= $category['id']?>"><?= $category['name']?></option>
                    <?php 
                     }
                    ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                </div>
                 <button class="btn btn-primary w-100 mt-3 " type="submit">Submit</button>
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