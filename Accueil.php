<?php 
session_start();
if(isset($_SESSION['username'])){
}else{
    header('Location:inscription.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="stylea.css">
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <section>
        <?php
        require_once('header.php');
        ?>
        <div class="espace">
            <div class="container">
                <div class="gauche">
                    <h2>
                        Bonjour <span>
                            <?php
                                echo $_SESSION['username'];
                            ?>
                        </span>, <br>Vous 
                        avez perdu ou trouvé un objet ? declarez 
                        le ! et la communauté se met en mouvement pour 
                        vous aider à retrouver votre objet
                    </h2>
                    <div class="flex-button">
                        <div class="trouve">
                            <p><a href="plus.php">J'ai trouvé </a></p>
                        </div>
                        <div class="perdu">
                            <p><a href="search.php">J'ai perdu </a></p>
                        </div>
                    </div>
                </div>
                <div class="droite">
                    <img src="images/questions.svg" alt="">
                </div>
            </div>  
        </div>
        <p class="deconnexion"><a href="deconnexion.php">Deconnexion</a></p>
    </section>
</body>
</html>
