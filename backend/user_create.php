<?php 
session_start();

if(isset($_SESSION['user_id'])){

  include "../dbconnect.php";

  if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $profile=$_POST['profile'];

    // echo "$name and $email and $password and $profile";
    $sql="INSERT INTO users (name,email,password,profile) VALUES (:name,:email,:password,:profile)";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':password',$password);
    $stmt->bindParam(':profile',$profile);
    $stmt->execute();

    header('location:user_create.php');
    exit();
  }else{
    include "layouts/nav_sidebar.php";

  }

?>

<div class="container px-3">
    <div class="card my-5">
        <div class="card-header">
            <h5 class="d-inline">User Create</h5>
            <a href="posts.php" class="btn btn-danger float-end">Cancel</a>
        </div>
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                 <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" type="email" id="email" name="email">
                 </div>
                <div class="mb-3">
                     <label for="password" class="form-label">Password</label>
                     <input class="form-control" type="password" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Profile</label>
                    <textarea class="form-control" id="description" rows="3" name="profile"></textarea>
                </div>
                 <button class="btn btn-primary w-100 mt-3 " type="submit">Submit</button>
            </form>
        </div>
    </div>
  
</div>


<?php 
include "layouts/footer.php";
}else{
    header("location:login.php");}

?>