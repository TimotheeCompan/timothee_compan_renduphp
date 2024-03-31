<?php

try{
    $database = new PDO ('mysql:host=localhost;dbname=Twitter','root','');
    $request = $database -> prepare(
        'SELECT tweets.message, users.pseudo FROM tweets
        LEFT JOIN users ON users.id = tweets.author_id
        ORDER BY tweets.id DESC'
    );
    $request -> execute();
    $tweets = $request -> fetchAll(PDO::FETCH_ASSOC);
    require_once 'index.html.php';
}catch(PDOexception $e){
    die('Erreur: '. $e -> getMessage());

}





