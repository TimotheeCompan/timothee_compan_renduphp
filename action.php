<?php

try{

    $database = new PDO ('mysql:host=localhost;dbname=Twitter','root','');
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        if(isset($_POST['message']) && !empty($_POST['message'])){
            $message = $_POST['message'];
            $userId =null;
            
            if(isset($_POST['user']) && !empty($_POST['user'])){
                $user = $_POST['user'];
                $_REQUEST= $database -> prepare(
                    'SELECT id FROM users WHERE pseudo = :pseudo'
                );
                $_REQUEST-> execute ([
                    'pseudo' => $user
                ]);
                $userId = $request-> fetchColumn ();
            }

            if($userId){
                $request = $database ->prepare(
                    'INSERT INTO tweets (message) VALUES (:message, :author_id)'
                );
                $request ->execute([
                    'message' => $message,
                    'author_id' => $userId,
                ]);
            }else{
                $request = $database->prepare(
                    'INSERT INTO tweets(message) VALUES (:message)'
                );
                $request->execute([
                    'message' => $message
                ]);
            }
            header('Location: index.php');
            exit();
        }
    }
}catch(PDOexception $e){
    die('Erreur: '. $e -> getMessage());

}

?>