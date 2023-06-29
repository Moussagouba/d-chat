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

// Vérifier si l'ID de l'utilisateur est passé en paramètre
if (isset($_GET['user_id']))
{
    $user_id = $_GET['user_id'];

    // Supprimer l'utilisateur de la base de données
    $sql = "DELETE FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if ($result)
    {
        // Rediriger vers la page de gestion des utilisateurs avec un message de succès
        header("Location: manage_users.php?success=1");
        exit;
    }
    else
    {
        // Rediriger vers la page de gestion des utilisateurs avec un message d'erreur
        header("Location: manage_users.php?error=1");
        exit;
    }
}
else
{
    // Rediriger vers la page de gestion des utilisateurs si l'ID de l'utilisateur n'est pas spécifié
    header("Location: manage_users.php");
    exit;
}