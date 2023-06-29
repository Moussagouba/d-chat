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

// Récupérer le nom d'utilisateur de l'administrateur à partir de la session
$admin_username = $_SESSION['email'];
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
    <div class="container mt-4">
        <h1 class="text-center">Admin Panel</h1>
        <hr>

        <p>Bienvenue,
            <?php echo $admin_username; ?> !
        </p>
        <button class="py-5">
            <a class=" btn btn-primary" href="edit_category.php">modifier les categories</a>
        </button>
        <button class="py-5">
            <a class=" btn btn-primary" href="add_category.php">ajouter une categorie</a>
        </button>
        <button class="py-5">
            <a class=" btn btn-primary" href="manage_users.php">gestion des utilisateurs et commentaires</a>
        </button>
        <!-- Le reste du contenu de la page d'administration -->
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