<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <title>dchat</title>



</head>

<body>
    <?php
    include 'dbconnect.php';
    include 'header.php';
    ?>
    <div class="container-fluid tt">
        <img src="image/banner.jpg" class="cover w-100 h-100 img-responsive" alt="">
    </div>

    <div class="container my-1">
        <h2 class="text-center">DCHAT - Différentes Catégories</h2>
        <div class="row">
            <?php
            include 'dbconnect.php';
            $sql = "SELECT * FROM `category`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result))
            {
                $id = $row['category_id'];
                $cat = $row['category_name'];
                $desc = $row['category_description'];
                $image_name = $row['cat_image'];
                echo '<div class="col-md-4 my-2">
              <div class="card h-100">
                  <img src="image/' . $image_name . '" class="card-img-top cat-img" alt="...">
                  <div class="card-body">
                      <h5 class="card-title"><a href="threadlist.php?catid=' . $id . '">' . $cat . '</a></h5>
                      <p class="card-text text-justify">' . substr($desc, 0, 100) . '...</p>
                      <a href="threadlist.php?catid=' . $id . '" class="btn btn-warning">Voir plus</a>
                  </div>
              </div>
          </div>';
            }
            ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="asset/js/main.js"></script>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/popper.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
    <script src="asset/js/main.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script> -->
</body>

</html>