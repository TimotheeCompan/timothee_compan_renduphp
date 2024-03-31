<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mini Twitter</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <img src="img/x.webp" alt="">
    <div class="container">
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Explorer</a></li>
                <li><a href="#">Notifications</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="#">Profil</a></li>
            </ul>
        </nav>
        <section class="feed">
            <?php if(!empty($user)): ?>
                <h3>Je suis <?= $user ?></h3>
            <?php endif; ?>
            <form id="tweetForm" action="action.php" method="POST">
                <?php if(!empty($user)): ?>
                    <input type="hidden" name="user" value="<?= $user ?>">
                <?php endif; ?>
                <textarea placeholder="Quoi de neuf ?" name="message"></textarea>
                <button type="submit">Tweeter</button>
            </form>
            <ul>
            <!-- Créer une boucle avec des li pour chaque skills, si acquis j'affiche une classe success sinon danger.

            La valeur de mon LI doit etre le nom de la compétence. -->
            </ul>
            <div class="tweets">
                <?php foreach($tweets as $tweet){ ?>
                    <div class="tweet">
                        <h1>
                            <?php echo $tweet['pseudo'] ?>
                        </h1>
                        <p>
                            <?= $tweet['message'] ?>
                        </p>
                        
                        <?php if (isset($_GET['user'])) { ?>
                            <?php
                                $user = $_GET['user'];
                                $request = $database->prepare('SELECT pseudo FROM users WHERE pseudo = :pseudo');
                                $request->execute(array('pseudo' => $user));
                                $pseudo = $request->fetchColumn();
                            ?>
                            <?php if ($pseudo == $user) { ?>
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="id" value="<?= $tweet['id'] ?>">
                                    <button type="submit" name="delete-button">Supprimer le tweet</button>
                                </form>
                            <?php } else { ?>
                                <button type="submit" name="delete-button" class="button" style="visibility: hidden;">Supprimer le tweet</button>
                            <?php } ?>
                        <?php } else { ?>
                            <button type="submit" name="delete-button" class="button" style="visibility: hidden">Supprimer le tweet</button>
                        <?php } ?>
                        <!-- j'ai seulement réussi à faire en sorte que quand mon pseudo est égale a user je peux supprimer les tweets. Par contre le pseudo est toujours égal à ce que l'on met dans users.-->
                    </div>
                <?php } ?>
            </div>
        </section>
    </div>
    
</body>
</html>

