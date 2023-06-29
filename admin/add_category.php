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
$admin_username = $_SESSION['email'];

// Ajouter une catégorie
if (isset($_POST['add_category']))
{
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    // Vérifier si un fichier d'image est téléchargé
    if (isset($_FILES['category_image']))
    {
        $image_name = $_FILES['category_image']['name'];
        $image_tmp_name = $_FILES['category_image']['tmp_name'];
        $image_size = $_FILES['category_image']['size'];
        $image_error = $_FILES['category_image']['error'];

        // Vérifier si l'upload du fichier est réussi
        if ($image_error === 0)
        {
            // Valider le format de l'image (par exemple, uniquement les fichiers JPEG sont autorisés)
            $allowed_extensions = array('jpg', 'jpeg', 'png');
            $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

            if (in_array($image_extension, $allowed_extensions))
            {
                // Déplacer le fichier d'image vers le dossier de destination
                $image_destination = '../image/' . $image_name;
                move_uploaded_file($image_tmp_name, $image_destination);

                // Insérer les données de la catégorie dans la base de données
                $sql = "INSERT INTO category (category_name, category_description, cat_image) 
                        VALUES ('$category_name', '$category_description', '$image_name')";
                $result = mysqli_query($conn, $sql);

                if ($result)
                {
                    // Rediriger vers la page des catégories avec un message de succès
                    header("Location: view_categories.php?success=Catégorie ajoutée avec succès");
                    exit;
                }
                else
                {
                    // Rediriger vers la page des catégories avec un message d'erreur
                    header("Location: view_categories.php?error=Erreur lors de l'ajout de la catégorie");
                    exit;
                }
            }
            else
            {
                // Rediriger vers la page des catégories avec un message d'erreur si le format de l'image n'est pas valide
                header("Location: view_categories.php?error=Seuls les fichiers JPEG et PNG sont autorisés");
                exit;
            }
        }
        else
        {
            // Rediriger vers la page des catégories avec un message d'erreur si l'upload du fichier échoue
            header("Location: view_categories.php?error=Erreur lors du téléchargement de l'image");
            exit;
        }
    }
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

    <title>Admin Panel</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container my-4">
        <p>Bienvenue,
            <?php echo $admin_username; ?> !
        </p>
        <h2>Ajouter une catégorie</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="category_name">Nom de la catégorie</label>
                <input type="text" class="form-control" id="category_name" name="category_name" required>
            </div>
            <div class="form-group">
                <label for="category_description">Description de la catégorie</label>
                <textarea class="form-control" id="category_description" name="category_description" rows="3"
                    required></textarea>
            </div>
            <div class="form-group">
                <label for="category_image">Image de la catégorie</label>
                <input type="file" class="form-control-file" id="category_image" name="category_image" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_category">Ajouter la catégorie</button>
        </form>
        <div>

            <a class="btn mt-4 btn-success" href="admin_panel.php">RETOUR</a>

        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../asset/js/jquery.min.js"></script>
    <script src="../asset/js/popper.js"></script>
    <script src="../asset/js/bootstrap.min.js"></script>
    <script src="../asset/js/main.js"></script>
</body>

</html>