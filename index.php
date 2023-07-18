<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



    include "layouts/navbar.php";
    include "dbconnect.php";

    

    if(isset($_GET['cid'])){
        $cid = $_GET['cid'];
        $sql = "SELECT posts.*,categories.name as c_name, users.name as u_name FROM posts INNER JOIN categories ON categories.id = posts.category_id INNER JOIN users ON users.id=posts.user_id WHERE posts.category_id = :cid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cid',$cid);
        $stmt->execute();
        $posts = $stmt->fetchAll();
    }else {
        $sql = "SELECT posts.*,categories.name as c_name, users.name as u_name FROM posts INNER JOIN categories ON categories.id = posts.category_id INNER JOIN users ON users.id=posts.user_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $posts = $stmt->fetchAll();
    }
    

    // var_dump($posts);


?>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Hein Blog!</h1>
                    <p class="lead mb-0">Sharing is caring. Knowledge is power, Action is super power.</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                
                    <div class="col-lg-8">
                        <!-- Featured blog post-->
                        <?php 
                            foreach($posts as $post){

                                $timestamp = strtotime($post['created_at']);
                        ?>
                        <div class="card mb-4">
                            <a href="#!"><img class="card-img-top" src="backend/<?= $post['photo'] ?>" alt="..." /></a>
                            <div class="card-body">
                                <div class="small text-muted"><?= date('M d, Y', $timestamp) ?> by <?= $post['u_name'] ?></div>
                                <a class="badge bg-secondary text-decoration-none link-light" href="index.php?cid=<?= $post['category_id'] ?>"><?= $post['c_name'] ?></a>
                                <h2 class="card-title"><?php echo $post['title'] ?></h2>
                                <p class="card-text"><?= $post['description'] ?></p>
                                <a class="btn btn-primary" href="detail.php?id=<?= $post['id']?>">Read more →</a>
                            </div>
                        </div>
                        <?php 
                            }
                        ?>
                        
                    </div>
                
                
                
<?php 
    include "layouts/footer.php";
?>