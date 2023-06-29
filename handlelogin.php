<?php

$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  include 'dbconnect.php';
  $email = $_POST['loginEmail'];
  $pass = $_POST['loginPass'];

  $sql = "SELECT * FROM `users` WHERE user_email='$email'";
  $result = mysqli_query($conn, $sql);
  $numRows = mysqli_num_rows($result);
  if ($numRows == 1)
  {
    $row = mysqli_fetch_assoc($result);
    $hashedPass = $row['user_pass'];
    if (password_verify($pass, $hashedPass))
    {
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['sno'] = $row['user_id'];
      $_SESSION['useremail'] = $email;
      echo "Logged in: " . $email;
      header("Location: index.php");
      exit;
    }
    else
    {
      $showError = true;
    }
  }
  else
  {
    $showError = true;
  }
}

if ($showError)
{
  echo '
    <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
      <strong>Details not matched!</strong> Please try again.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
  header("Location: index.php");
  exit;
}
?>