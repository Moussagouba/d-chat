<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum éducatif</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        /* Vos styles personnalisés ici */
    </style>
</head>

<body>
    <?php include 'starter.html'; ?>
    <?php
    include 'dbconnect.php';
    include 'header.php';
    ?>

    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `thread` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result))
    {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];

        $thread_user_id = $row['thread_user_id'];
        // Requête pour obtenir le nom de l'auteur du message
        $sql2 = "SELECT user_email FROM `users` WHERE user_id='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];
    }
    ?>

    <div class="container my-2">
        <div class="jumbotron">
            <h1 class="display-4">
                <?php echo $title; ?>
            </h1>
            <p class="lead">
                <?php echo $desc; ?>
            </p>
            <hr class="my-4">
            <p>Ceci est un forum pair-à-pair pour partager des connaissances les uns avec les autres. Pas de spam /
                publicité.
                Ne pas publier de contenu en violation du droit d'auteur. Ne pas publier de messages, liens ou images
                "offensants".
                Ne pas publier de questions en double. Rester respectueux envers les autres membres en tout temps.</p>
            <p class="p-1">Posté par - <strong class="p-1">
                    <?php echo $posted_by ?>
                </strong></p>
        </div>
    </div>

    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
    {
        echo '
    <div class="container" style="min-height:200px;">
        <h1 class="font-italic">Poster un Commentaire</h1>
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
            <div class="form-group">
                <label for="comment">ENTREZ VOTRE COMMENTAIRE</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">COMMENTER</button>
        </form>
    </div>';
    }
    else
    {
        echo ' <div class="container">
    <h1 class="font-italic py-2">Postez un Commentaire</h1>
    <div class="alert alert-warning" role="alert">
        Veuillez vous connecter pour pouvoir poster un commentaire.
    </div>
    </div>';
    }
    ?>

    <div class="container my-2">
        <h1 class="font-italic">Discussion</h1>
        <?php
        $noresult = true;
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            $noresult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $thread_user_id = $row['comment_by'];
            $sql2 = "SELECT `name` FROM `users` WHERE user_id='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '
        <div class="media my-2 border border-3">
            <img src="image/user.jpg" width="80px" class="mr-3" alt="...">
            <div class="media-body">
                <p class="font-weight-bold my-0">' . $row2['name'] . ' le ' . $comment_time . '</p>
                ' . $content . '
            </div>
        </div>';
        }
        if ($noresult)
        {
            echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Aucun résultat pour cette question</h1>
                    <p class="lead">Vous serez le premier à répondre à cette question.</p>
                </div>
            </div>';
        }
        ?>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>