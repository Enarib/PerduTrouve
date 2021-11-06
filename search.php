


<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="searc.css">
		<link rel="stylesheet" href="header.css">
<title> Recherche</title>
<body>
 <section>
        <?php
        require_once('header.php');
        ?>
        <div class="content">
            <div class="informations">
            <form method="post" action="">
                <h2>Recherchez l'objet perdu....</h2></br>
                <input type="text" name="search" class="search" placeholder="Recherchez ici!">
                <input type="submit" name="submit" class="submit" value="Search">        
            </form>
            </div>
        </div>
   


   <div class="space">
    <div class="container">
    <?php
        require_once('config.php');
        if(isset($_POST['submit'])){
            $search = htmlspecialchars($_POST['search']);
            if(!empty($search)){
                $req = $dbh->prepare("select * from objets where nomObjet=?");
                $req->setFetchMode(PDO::FETCH_ASSOC);
                $req->execute(array($search));
                $tab=$req->fetchAll();
                $row = $req->rowCount();
                if($row === 0){
                    ?>
                <br>
                <p>L'élément n'existe pas</p>
                <?php
                }
                for($i=0; $i<$row; $i++){
                    ?>
                    <div class="poste">
                        <div class="inposte"></div>
                        <div class="profile">
                            <div class="imageProfile">
        
                            </div>
                            <div class="nameprofile">
        
                            </div>
                        </div>
                        <div class="image">
                            <img src="exportr.php?i=<?php echo $i ?>&objet=<?php echo $search ?>">
                        </div>
                        <div class="description">
                            <p>Description :<?php echo $tab[$i]["description"]; ?> </p><br>
                            <p>Contactez au : <span><?php echo $tab[$i]["tel"]; ?></span></p>
                        </div>
                    </div>
                    <?php
                }
            }else{
                ?>
                <br>
                <p>Veuillez saisir le nom de l'objet à rechercher</p>
                <?php
            }
        }
        
   ?>
    </div>
   </div>
   
   

<?php ?>
</section>
   </body>
	</head>
</html>