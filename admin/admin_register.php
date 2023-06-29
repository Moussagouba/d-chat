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
$success = "";

// Traitement du formulaire d'inscription
if (isset($_POST['register']))
{
    $email = $_POST['username'];
    $password = $_POST['password'];

    // Vérifier si l'administrateur existe déjà dans la base de données
    $sql = "SELECT * FROM `admin` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0)
    {
        // L'administrateur existe déjà
        $error = "Un administrateur avec ce nom d'utilisateur existe déjà.";
    }
    else
    {
        // Hasher le mot de passe avant de l'enregistrer dans la base de données
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insérer les informations de l'administrateur dans la base de données
        $sql = "INSERT INTO `admin` (email, password, timestamp) VALUES ('$email', '$hashedPassword',  NOW())";
        if (mysqli_query($conn, $sql))
        {
            // L'inscription a réussi
            $success = "Inscription réussie. Vous pouvez maintenant vous connecter en tant qu'administrateur.";
        }
        else
        {
            // Erreur lors de l'inscription
            $error = "Une erreur est survenue lors de l'inscription. Veuillez réessayer.";
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

    <title>Admin Registration</title>
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Admin Registration</h1>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success">
                        <?php echo $success; ?>
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
                    <button type="submit" class="btn btn-primary" name="register">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../asset/js/jquery.min.js"></script>
    <script src="../asset/js/popper.js"></script>
    <script src="../asset/js/bootstrap.min.js"></script>
    <script src="../asset/js/main.js"></script>
</body>

</html>