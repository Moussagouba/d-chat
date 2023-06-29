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

// Vérifier si le paramètre de l'ID de la catégorie est passé
if (isset($_GET['category_id']))
{
    $category_id = $_GET['category_id'];

    // Supprimer la catégorie de la base de données
    $sql = "DELETE FROM category WHERE category_id = '$category_id'";
    $result = mysqli_query($conn, $sql);

    if ($result)
    {
        // Rediriger vers la page des catégories avec un message de succès
        header("Location: view_categories.php?success=Catégorie supprimée avec succès");
        exit;
    }
    else
    {
        // Rediriger vers la page des catégories avec un message d'erreur
        header("Location: view_categories.php?error=Erreur lors de la suppression de la catégorie");
        exit;
    }
}
else
{
    // Rediriger vers la page des catégories si l'ID de la catégorie n'est pas spécifié
    header("Location: view_categories.php");
    exit;
}