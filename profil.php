<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylep.css">
    <link rel="stylesheet" href="header.css">
    <title>Document</title>
</head>
<body>
    <?php
    require_once('header.php');
    ?>

    <div class="espace">
        <div class="content">
            <div class="informations">
                <div class="imgprofil">
                    <img src="images/emma.jpg" alt=""/>
                </div>
                <div class="myinfos">
                    <div class="edit">
                        <p><?php echo $_SESSION['username'] ?></p>
                    </div>
                    <div class="edit">
                        <p><?php echo $_SESSION['email'] ?></p>
                    </div>
                    <div class="edit">
                        <p><?php echo $_SESSION['numero'] ?></p> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space">
    <div class="container">
        <?php ?>
        <?php 
            require_once("config.php");
            $req = $dbh->prepare("select * from objets where utilisateur=?");
            $req->setFetchMode(PDO::FETCH_ASSOC);
            $req->execute(array($_SESSION['username']));
            $tab=$req->fetchAll();
            $row = $req->rowCount();
            for($i=0; $i<=$row-1; $i++){
                ?>
                    <div class="poste">
                        <div class="inposte">
                        <div class="profile">
                            <div class="imageProfile">
                                <img src="images/emma.jpg" alt="">
                            </div>
                            <div class="nameProfile">
                                <p><?php echo $_SESSION['username'] ?></p>
                            </div>
                        </div>
                            <div class="image">
                                <img src="export.php?nom=<?php echo $_SESSION['username'] ?>&i=<?php echo $i ?>">  
                            </div>
                            <div class="description">
                                <p>Description :<?php echo $tab[$i]["description"]; ?> </p><br>
                                <p>Contactez au : <span><?php echo $_SESSION["numero"]; ?></span></p>
                                <p>Nom : <span><?php echo $tab[$i]["nomObjet"]; ?></span></p>
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>
        
    </div>
    </div>
    
</body>
</html>