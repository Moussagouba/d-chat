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
  <?php include 'dbconnect.php'; ?>
  <?php include 'header.php'; ?>

  <?php
  $id = $_GET['catid'];
  $sql = "SELECT * FROM `category` WHERE category_id=$id";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result))
  {
    $catname = $row['category_name'];
    $catdesc = $row['category_description'];
  }
  ?>

  <div class="container my-2">
    <div class="jumbotron">
      <h1 class="display-4">BIENVENUE SUR
        <?php echo $catname; ?> FORUMS
      </h1>
      <p class="lead">
        <?php echo $catdesc; ?>
      </p>
      <hr class="my-4">
      <p>Ceci est un forum pair-à-pair pour partager des connaissances les uns avec les autres. Pas de spam / publicité.
        Ne pas publier de contenu en violation du droit d'auteur. Ne pas publier de messages, liens ou images
        "offensants".
        Ne pas publier de questions en double. Rester respectueux envers les autres membres en tout temps.</p>
      <a class="btn btn-primary btn-lg" href="#" role="button">Lire plus</a>
    </div>
  </div>

  <!-- Début du formulaire de discussion -->

  <?php
  $showalert = false;
  $method = $_SERVER['REQUEST_METHOD'];
  if ($method == 'POST')
  {
    // Insertion de la discussion dans la base de données
  
    $th_title = $_POST['title'];
    $th_desc = $_POST['desc'];

    // Protection contre les attaques XSS
    $th_title = str_replace("<", "&lt;", $th_title);
    $th_title = str_replace(">", "&gt;", $th_title);

    $th_desc = str_replace("<", "&lt;", $th_desc);
    $th_desc = str_replace(">", "&gt;", $th_desc);

    $sno = $_POST['sno'];
    $sql = "INSERT INTO `thread` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    $showalert = true;
    if ($showalert)
    {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Succès !</strong> Votre problème a été posté, veuillez patienter, la communauté va y répondre.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    }
  }
  ?>

  <div class="container">
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
      <h1 class="font-italic py-2">Démarrer une discussion</h1>
      <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
        <div class="form-group">
          <label for="title">Quel est le problème que vous rencontrez ?</label>
          <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
          <small id="emailHelp" class="form-text text-muted">Veuillez donner un titre court à votre problème.</small>
        </div>
        <div class="form-group">
          <label for="desc">Décrivez votre problème</label>
          <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
        </div>
        <input type="hidden" name="sno" value="<?php echo $_SESSION["sno"]; ?>"><br>
        <button type="submit" class="btn btn-primary">Soumettre</button>
      </form>
    <?php else: ?>
      <h1 class="font-italic py-2">Commencer une discussion</h1>
      <div class="alert alert-warning" role="alert">
        Veuillez vous connecter d'abord.
      </div>
    <?php endif; ?>
  </div>

  <div class="container">
    <h1 class="font-italic py-2">Questions différentes</h1>
    <?php
    $id = $_GET['catid'];
    $noresult = true;
    $sql = "SELECT * FROM `thread` WHERE thread_cat_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result))
    {
      $noresult = false;
      $id = $row['thread_id'];
      $title = $row['thread_title'];
      $desc = $row['thread_desc'];
      $comment_time = $row['timestamp'];
      $thread_user_id = $row['thread_user_id'];
      $sql2 = "SELECT `name` FROM `users` WHERE user_id='$thread_user_id'";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);

      echo '
              <div class="media my-2 border">
                <img src="image/user.jpg" width="80px" class="mr-3" alt="...">
                <div class="media-body">
                  <p class="font-weight-normal my-0">Question posée par - ' . $row2['name'] . ' le ' . $comment_time . '</p>
                  <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' . $id . '">' . $title . '</a></h5>
                  ' . $desc . '
                </div>
              </div>';
    }
    if ($noresult)
    {
      echo '
              <div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-4">Aucune question trouvée dans cette catégorie</h1>
                  <p class="lead">Vous serez la première personne à poser une question ici.</p>
                </div>
              </div>';
    }
    ?>
  </div>

  <?php include 'footer.php'; ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>