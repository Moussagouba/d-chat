<?php

echo '
<nav class="navbar navbar-expand-lg navbar-dark text-light bg-dark">
<img src="image/svg/logo-no-background.svg" class="navbar-brand logooo">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto mx-auto ">
      <li class="nav-item active">
        <a class="nav-link cool-link" href="index.php">Accueil <span class="sr-only"></span></a>
      </li>
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categorie
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

$sql = "SELECT `category_id`, `category_name` FROM `category` Limit 5";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result))
{
  echo '  <a class="dropdown-item cool-link" href="threadlist.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a>';

}
echo ' </div>
      </li>
      <li class="nav-item">
      
      <a class="nav-link cool-link" href="about.php">A propos</a>
    </li>
      <li class="nav-item">
        <a class="nav-link cool-link" href="contact.php"  >Contact</a>
      </li>
    </ul>
  </div>
    
  </div>
  </div>
</nav>

';
?>

<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{

  echo '
            <div class="alert alert-success " role="alert"><div class="btn-group opas">
       <p class="text-dark">  Bienvenue <b>' . $_SESSION['useremail'] . '</b>
        <a href="logout.php" class="btn btn-success my-2 my-sm-0" type="submit">se deconnecter</a></p>
        </div>
        </div>';


}
else
{
  echo '
    <div class="alert alert-success " role="alert"><div class="btn-group">
  Creer un compte sur ce site   <button class="btn btn-success ml-2 " data-toggle="modal" data-target="#signupModal">S\'enregistrer</button>
  <button class="btn btn-warning ml-2 " data-toggle="modal" data-target="#loginModal" >Se connecter</button> 
  </div>
</div>';


}



include 'loginModal.php';
include 'signupModal.php';

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true")
{
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success !</strong> vous pouvez vous connecter maintenant.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>