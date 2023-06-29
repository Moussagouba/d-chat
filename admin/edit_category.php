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

// Vérifier si l'ID de la catégorie est passé en paramètre d'URL
if (!isset($_GET['category_id']))
{
    // Rediriger vers la page d'affichage des catégories si l'ID de la catégorie n'est pas spécifié
    header("Location: view_categories.php");
    exit;
}

// Récupérer l'ID de la catégorie depuis l'URL
$category_id = $_GET['category_id'];

// Récupérer les informations de la catégorie à partir de la base de données
$sql = "SELECT * FROM category WHERE category_id = '$category_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
    $row = mysqli_fetch_assoc($result);
    $category_name = $row['category_name'];
    $category_description = $row['category_description'];
    $category_image = $row['cat_image'];

    // Traitement du formulaire de modification
    if (isset($_POST['update']))
    {
        $new_category_name = $_POST['category_name'];
        $new_category_description = $_POST['category_description'];

        // Vérifier si un fichier d'image a été téléchargé
        if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] === UPLOAD_ERR_OK)
        {
            $image_tmp = $_FILES['category_image']['tmp_name'];
            $image_name = $_FILES['category_image']['name'];

            // Déplacer le fichier téléchargé vers un emplacement souhaité
            $image_path = "../image/" . $image_name;
            move_uploaded_file($image_tmp, $image_path);

            // Mettre à jour la colonne category_image dans la base de données
            $update_sql = "UPDATE category SET cat_image = '$image_name' WHERE category_id = '$category_id'";
            mysqli_query($conn, $update_sql);
        }

        // Mettre à jour les informations de la catégorie dans la base de données
        $update_sql = "UPDATE category SET category_name = '$new_category_name', category_description = '$new_category_description' WHERE category_id = '$category_id'";
        if (mysqli_query($conn, $update_sql))
        {
            // Rediriger vers la page d'affichage des catégories avec un message de succès
            header("Location: view_categories.php?success=Category updated successfully");
            exit;
        }
        else
        {
            // Erreur lors de la mise à jour de la catégorie
            $error = "Une erreur est survenue lors de la mise à jour de la catégorie. Veuillez réessayer.";
        }
    }
}
else
{
    // Rediriger vers la page d'affichage des catégories si la catégorie n'existe pas
    header("Location: view_categories.php");
    exit;
}
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

    <title>Modifier une catégorie - Admin</title>
</head>

<body>
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Content -->
    <div class="container mt-4">
        <h1>Modifier une catégorie</h1>
        <?php if (isset($error))
        { ?>
            <div class="alert alert-danger mt-4">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="category_name">Nom de la catégorie</label>
                <input type="text" class="form-control" id="category_name" name="category_name"
                    value="<?php echo $category_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="category_description">Description de la catégorie</label>
                <textarea class="form-control" id="category_description" name="category_description" rows="3"
                    required><?php echo $category_description; ?></textarea>
            </div>
            <div class="form-group">
                <label for="category_image">Image de la catégorie</label>
                <input type="file" class="form-control-file" id="category_image" name="category_image">
            </div>
            <?php if ($category_image)
            { ?>
                <div class="form-group">
                    <label>Image actuelle</label><br>
                    <img src="../image/<?php echo $category_image; ?>" class="img-thumbnail" width="200"
                        alt="Category Image">
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary" name="update">Mettre à jour la catégorie</button>
        </form>
    </div>
    <div>

        <a class="btn btn-success" href="admin_panel.php">RETOUR</a>

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