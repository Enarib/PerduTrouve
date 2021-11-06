<?php
    require_once('config.php');
    session_start();
    if(isset($_POST['valider'])){

        $nomObjet = htmlspecialchars($_POST['nomObjet']);
        $description = htmlspecialchars($_POST['description']);
        $image = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $filebin = $_FILES['image']['tmp_name'];
        $categorie = $_POST['categorie'];
        
        if(!empty($nomObjet) && !empty($description) && !empty($categorie) && !empty($image)){
            $maxSize = 300000;
            $extValide = array('.jpg', '.jpeg', '.png');
            if($_FILES['image']['error'] > 0){
                echo 'une erreur est survenue';
            }else{
                if($filesize > $maxSize){
                    echo "La taille du fichier est trop grande";
                }else{
                    $fileext = "." . strtolower(substr(strrchr($image, '.'), 1));
                    if(!in_array($fileext, $extValide)){
                        echo "Le fichier n'est pas une image";
                    }else{
                        $insert = $dbh->prepare('INSERT INTO objets(nomObjet, utilisateur, description, tel, photo, categorie, taille, type, bin) VALUES(:nomObjet, :utilisateur, :description, :tel, :photo, :categorie, :taille, :type, :bin)');
                        $insert->execute(array(
                            'nomObjet' => $nomObjet,
                            'utilisateur' => $_SESSION['username'],
                            'description' => $description,
                            'tel' => $_SESSION['numero'],
                            'photo' => $image,
                            'categorie' => $categorie,
                            'taille' => $filesize,
                            'type' => $filetype,
                            'bin' => file_get_contents($filebin)
                        ));
                    }
                }
            }

            

            /*
            $insert = $dbh->prepare('INSERT INTO objets(nomObjet, utilisateur, description, tel, photo, categorie) VALUES(:nomObjet, :utilisateur, :description, :tel, :photo, :categorie)');
				$insert->execute(array(
					'nomObjet' => $nomObjet,
					'utilisateur' => $_SESSION['username'],
					'description' => $description,
					'tel' => $_SESSION['tel'],
                    'photo' => $image,
                    'categorie' => $categorie,
				));
            */
        }else{
            echo "Veuillez remplir tous les champs";
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
                    <h2>Merci de vouloir publier :)</h2>
                </div>
                <div class="input">
                    <input type="text" name="nomObjet" placeholder="Nom de l'objet"/>
                </div>
                <div class="input">
                    <textarea name="description" id="" cols="100" rows="7" placeholder="Description"></textarea>
                </div>
                <div class="image">
                    <input type="file" name="image">
                    <div class="select" style="width:200px;">
                        <select name="categorie">
                            <option value="0">Selectionnez une categorie</option>
                            <option value="Argent">Argent</option>
                            <option value="Documents">Documents officiels</option>
                            <option value="Baggages">Sacs et Baggages</option>
                            <option value="Electroniques">Electroniques</option>
                            <option value="Bijoux">Bijoux et Montres</option>
                            <option value="Habillements">Habillements</option>
                            <option value="Animaux">Animaux</option>
                            <option value="personnelles">Affaires personnelles</option>
                            <option value="Sports">Accessoires Sports</option>
                            <option value="Divers">Divers</option>
                        </select>
                    </div>
                </div>
                <div class="valide">
                    <button name="valider" class="btn success">Success</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>