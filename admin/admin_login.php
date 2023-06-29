<?php
// Inclure le fichier de configuration de la base de données
include 'dbconnect.php';

// Vérifier si l'administrateur est déjà connecté
session_start();
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true)
{
    // Rediriger vers la page d'administration si l'administrateur est déjà connecté
    header("Location: admin_panel.php");
    exit;
}

// Déclarer les variables pour stocker les messages d'erreur/succès
$error = "";

// Traitement du formulaire de connexion
if (isset($_POST['login']))
{
    $email = $_POST['username'];
    $password = $_POST['password'];

    // Échapper les données pour éviter les injections SQL
    $username = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Vérifier les informations d'identification de l'administrateur
    $sql = "SELECT * FROM `admin` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['password']))
    {
        // Les informations d'identification sont valides, connecter l'administrateur
        session_start();
        $_SESSION['admin'] = true;
        $_SESSION['email'] = $row['email'];
        // Rediriger vers la page d'administration
        header("Location: admin_panel.php");
        exit;
    }
    else
    {
        // Les informations d'identification sont invalides
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
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

    <title>Admin Login</title>
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Admin Login</h1>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Connexion</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../asset/js/jquery.min.js"></script>
    <script src="../asset/js/popper.js"></script>
    <script src="../asset/js/bootstrap.min.js"></script>
    <script