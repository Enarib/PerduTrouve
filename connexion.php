<?php
session_start();
require_once('config.php');

if(isset($_POST['annuler'])){
    header('Location:index.php');
}

if(isset($_POST['valider'])){
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['password']);
    if(!empty($email) && !empty($pass)){
        $check = $dbh->prepare('SELECT * from utilisateurs WHERE email=?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();
        if($row == 1){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $password = hash('sha256', $pass);
                if($data['password'] === $password){
                    $_SESSION['username'] = $data['pseudo'];
                    $_SESSION['numero'] = $data['numero'];
                    $_SESSION['email'] = $data['email'];
				    header('Location:Accueil.php');
                }else{
                    echo 'mot de passe incorrecte';
                }
            }else{
                echo 'email non valide';
            }
        }else{
            echo 'Indentifiants incorrectes';
        }
    }else{
        echo 'Veuillez remplir tous les champs';
    }
}
?>

<!Doctype html>
<html lang="fr">
 <head>
 <meta charset="utf-8"/>
 <link rel="stylesheet" href="styleconnexion.css" />
 <title>ma page de connexion</title>
 </head>
 <body>
 <section>
 <div class="content">
   <div class="form">
         <form method="POST" action="">
          <h1>CONNEXION</h1>
              </br>
              <div class="input">
             <input type="email" name="email" placeholder="EMAIL OU IDENTIFIANT"/>
             </div>
             <br/><br/>
             <div class="input">
             <input type="password" name="password" placeholder="MOT DE PASSE"/>
             </div>
             <br/></br>
             <aside>
              <a href="inscription.php">s'inscrire</a>
              </aside>
             <br/><br/>
             <input type="submit" name="valider" class="value" value="se connecter"/>
             <input type="submit" name="annuler" value="Annuler" class="value"/>
         </form>
     </div>
     <div class="circle"></div>
     <div class="droit">
     <img src="connexion.svg"/>
     </div>
 </div>
 </section>
 </body>
 </html>