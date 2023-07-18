<?php 

session_start();

if(isset($_SESSION['user_id'])){

 include "../dbconnect.php";

 if($_SERVER["REQUEST_METHOD"]=="POST"){

    $id=$_POST['id'];
    //var_dump($id);

 $sql="DELETE FROM posts WHERE id=:id";
 $stmt=$conn->prepare($sql);
 $stmt->bindParam(':id',$id);
 $stmt->execute();

 header('location:posts.php');

 }else{
  include "layouts/nav_sidebar.php";

 
 $sql="SELECT posts.*,categories.name as c_name,users.name as u_name FROM posts INNER JOIN categories ON posts.category_id=categories.id INNER JOIN users ON posts.user_id=users.id";
 $stmt=$conn->prepare($sql);
 $stmt->execute();
 $posts=$stmt->fetchAll();
?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Posts</h1>
                        <div>
                            <a href="post_create.php" class="btn btn-primary float-end">Create Post</a>
                        </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Posts</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Post Table
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <!-- <th>#</th> -->
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Created By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                         foreach($posts as $post){
                                        ?>
                                        <tr>
                                            <td><?= $post['title']?></td>
                                            <td><?= $post['c_name']?></td>
                                            <td><?= $post['u_name']?></td>
                                            <td>
                                                <a href="post_edit.php?id=<?=$post['id']?>" class="btn btn-warning mx-3 w-25">Edit</a>
                                                <a class="btn btn-danger w-25 delete"  data-id="<?=$post['id']?>">Delete</a >
                                            </td>
                                        </tr>
                                    <?php 
                                         }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            <div class="modal fade" id="del_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="text-danger">Delete?.....</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                 <div class="modal-body">
                    <h6>Are you sure to Delete?</h6>
                </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="" method="post">
                     <button type="submit" class="btn btn-danger">Delete</button>
                     <input type="hidden" name="id" id="del_id">
                </form>
            </div>
        </div>
     </div>
</div>
<?php 
 include "layouts/footer.php";
                 }
                }else{
                    header("location:login.php");
                                        }
?>



