<?php
// Inclure le fichier de configuration de la base de données
include 'dbconnect.php';

// Vérifier si l'administrateur est connecté
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true)
{
    // Rediriger vers la page de connexion si l'administrateur n'est pas connecté
    header("Location: admin_login.php");
    exit;
}

// Récupérer les catégories depuis la base de données
$sql = "SELECT * FROM category";
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">

    <title>Categories - Admin</title>
</head>

<body>
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Content -->
    <div class="container mt-4">
        <h1>Catégories</h1>
        <?php if (isset($_GET['success']))
        { ?>
            <div class="alert alert-success mt-4">
                <?php echo $_GET['success']; ?>
            </div>
        <?php } ?>
        <table class="table mt-4">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'dbconnect.php';

                $sql = "SELECT * FROM category";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $category_id = $row['category_id'];
                        $category_name = $row['category_name'];
                        $category_description = $row['category_description'];
                        $category_image = $row['cat_image'];
                        ?>
                        <tr>
                            <td>
                                <?php echo $category_id; ?>
                            </td>
                            <td>
                                <?php echo $category_name; ?>
                            </td>
                            <td>
                                <?php echo $category_description; ?>
                            </td>
                            <td><img src="../image/<?php echo $category_image; ?>" alt="Category Image" class="img-thumbnail"
                                    width="100"></td>
                            <td>
                                <a href="edit_category.php?category_id=<?php echo $category_id; ?>"
                                    class="btn btn-primary">Modifier</a>
                                <a href="delete_category.php?category_id=<?php echo $category_id; ?>"
                                    class="btn btn-danger">Supprimer</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    echo "<tr><td colspan='5'>Aucune catégorie trouvée.</td></tr>";
                }
                ?>

            </tbody>
        </table>
        <div>

            <a class="btn btn-success" href="admin_panel.php">RETOUR</a>

        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../asset/js/jquery.min.js"></script>
    <script src="../asset/js/popper.js"></script>
    <script src="../asset/js/bootstrap.min.js"></script>
</body>

</html>