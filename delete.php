<?php
try {

    $database = new PDO('mysql:host=localhost;dbname=Twitter', 'root', '');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];

            $request = $database->prepare('DELETE FROM tweets WHERE id = id');
            $request->execute();

            header('Location: index.php');
            exit();
        }
    }
} catch (PDOException $e) {
    die('Erreur: ' . $e->getMessage());
}
?>
