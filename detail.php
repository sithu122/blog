<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    include "dbconnect.php";
    include "layouts/navbar.php";

    $id = $_GET['id'];
    // echo $id;

    $sql = "SELECT posts.*, categories.name as c_name, users.name as u_name FROM posts INNER JOIN categories ON categories.id = posts.category_id INNER JOIN users ON users.id = posts.user_id WHERE posts.id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($post);



?>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?= $post['title'] ?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Posted on <?= $post['created_at']?> by <?= $post['u_name'] ?></div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="index.php?cid=<?= $post['category_id'] ?>"><?= $post['c_name'] ?></a>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="backend/<?= $post['photo'] ?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <?= $post['description'] ?>
                        </section>
                    </article>
                </div>
<?php 
    include "layouts/footer.php";
?>