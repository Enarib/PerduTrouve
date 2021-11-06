<?php
    require_once('config.php');
    session_start();
    $email = $_SESSION['email'];
    $action = $_GET['action'];
    if(isset($_POST['valider'])){
        $modif = htmlspecialchars($_POST['modifier']);
        if(!empty($modif)){
            $updating = $dbh->prepare("UPDATE utilisateurs SET $action='$modif' WHERE email='$email'");
            $updating->execute();
            if($updating){
                echo 'modification validé';
                if($action === 'pseudo'){
                    $req = $dbh->prepare("select * from objets where utilisateur=?");
                    $req->setFetchMode(PDO::FETCH_ASSOC);
                    $req->execute(array($_SESSION['username']));
                    $tab=$req->fetchAll();
                    $row = $req->rowCount();
                    for($i=0; $i<$row; $i++){
                        $utilisateur = $tab[$i]["utilisateur"];
                        $updating = $dbh->prepare("UPDATE utilisateurs SET $utilisateur='$modif'");
                        $updating->execute();
                    }
                    $_SESSION['username'] = $modif;
                    
                }elseif($action === 'email'){
                    $_SESSION['email'] = $modif;
                }else{
                    $_SESSION['numero'] = $modif;
                }
                
            }else{
                echo 'erreur lors du modification';
            }
        }else{
            echo 'veuillez remplir le champ';
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Publier</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="styleplus.css">
</head>
<body>
    
    <section>
        <div class="header">
            <?php require_once('header.php') ?>
        </div>
        
        <div class="espace">
            <form action="" method="POST" class="container" enctype="multipart/form-data">
                <div class="titre">
                    <h2>Changer votre <?php echo $_GET['action'] ?> ici</h2>
                </div>
                <?php
                    if($action === 'email'){
                        ?>
                        <div class="input">
                            <input type="<?php echo $action ?>" name="modifier" placeholder="<?php echo $action ?>"/>
                        </div>
                        <?php
                    }elseif($action === 'numero'){
                        ?>
                        <div class="input">
                            <input type="text" name="modifier" placeholder="<?php echo $action ?>"/>
                        </div>
                        <?php
                    }else{
                        ?>
                        <div class="input">
                            <input type="text" name="modifier" placeholder="<?php echo $action ?>"/>
                        </div>
                        <?php
                    }
                ?>
                <div class="valide">
                    <button name="valider" class="btn success">Success</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>

<?php
    
?>