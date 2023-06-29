<?php
$showEroor = "true";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'dbconnect.php';
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['cPassword'];
    $name = $_POST['name'];

    //check weather this gmail exist

    $existSql = "SELECT * FROM `users` WHERE user_email='$user_email' ";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if ($numRows > 0)
    {
        $showEroor = "Email deja utiliser";

    }
    else
    {
        if ($pass == $cpass)
        {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`name`, `user_email`, `user_pass`, `timestamp`) VALUES ( '$name' , '$user_email', '$hash', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            if ($result)
            {
                $showAlert = true;
                header("Location: index.php?signupsuccess=true");
                exit();
            }

        }
        else
        {
            $showEroor = "Mot de passe incorrect ";

        }
    }
    header("Location: index.php?signupsuccess=false&error=$showEroor");

}
?>