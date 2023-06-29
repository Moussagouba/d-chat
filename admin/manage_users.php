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

// Récupérer tous les utilisateurs
$sql_users = "SELECT * FROM users";
$result_users = mysqli_query($conn, $sql_users);

// Récupérer tous les commentaires
$sql_comments = "SELECT * FROM comments";
$result_comments = mysqli_query($conn, $sql_comments);
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

    <title>Gestion des utilisateurs et des commentaires</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container my-4">
        <h2>Gestion des utilisateurs</h2>
        <table class="table table-responsive">
            <thead>
                <tr class="bg-warning">
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row_users = mysqli_fetch_assoc($result_users))
                { ?>
                    <tr>
                        <th scope="row">
                            <?php echo $row_users['user_id']; ?>
                        </th>
                        <td>
                            <?php echo $row_users['name']; ?>
                        </td>
                        <td>
                            <?php echo $row_users['user_email']; ?>
                        </td>
                        <td>
                            <a href="delete_user.php?user_id=<?php echo $row_users['user_id']; ?>"
                                class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h2>Gestion des commentaires</h2>
        <table class="table table-responsive">
            <thead>
                <tr class=" bg-success">
                    <th scope="col">ID</th>
                    <th scope="col">Utilisateur</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row_comments = mysqli_fetch_assoc($result_comments))
                { ?>
                    <tr>
                        <th scope="row">
                            <?php echo $row_comments['comment_id']; ?>
                        </th>
                        <td>
                            <?php echo $row_comments['comment_by']; ?>
                        </td>
                        <td>
                            <?php echo $row_comments['comment_content']; ?>
                        </td>
                        <td>
                            <a href="delete_comment.php?comment_id=<?php echo $row_comments['comment_id']; ?>"
                                class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
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