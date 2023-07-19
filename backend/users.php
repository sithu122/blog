<?php 
 session_start();
 if (isset($_SESSION['user_id'])){
 include "../dbconnect.php";

 if($_SERVER['REQUEST_METHOD']=="POST"){

    $id=$_POST['id'];
//  var_dump($id);
    $sql="DELETE FROM users WHERE id=:id";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    header("location:users.php");

 }else{
    include "layouts/nav_sidebar.php";


 
 $sql="SELECT * FROM users";
 $stmt=$conn->prepare($sql);
 $stmt->execute();
 $users=$stmt->fetchAll();

//  var_dump($users);

?>
                 <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">User table</h1>
                        <div>
                            <a href="user_create.php" class="btn btn-primary float-end">Create User</a>
                        </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                User Table
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Profile</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                         foreach($users as $user){
                                        ?>
                                        <tr>
                                            <!-- <td></td> -->
                                            <td><?= $user['name']?></td>
                                            <td><?= $user['email']?></td>
                                            <td><?= $user['password']?></td>
                                            <td><?= $user['profile']?></td>
                                            <td><a href="user_edit.php?id=<?=$user['id']?>" class="btn btn-warning mx-3">Edit</a>
                                            <a class="btn btn-danger delete" data-id="<?=$user['id']?>">Delete</a></td>
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
} }else{
    header("location:login.php");
}

?>