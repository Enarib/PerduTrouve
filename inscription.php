<?php
require_once("config.php");
session_start();
if(isset($_POST['annuler'])){
    header('Location:index.php');
}
if(isset($_POST['submit'])){
	if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['tel']) && !empty($_POST['pass']) && !empty($_POST['passR'])){
		$username = htmlspecialchars($_POST['username']);
		$email = htmlspecialchars($_POST['email']);
		$tel = htmlspecialchars($_POST['tel']);
		$pass = htmlspecialchars($_POST['pass']);
		$passR = htmlspecialchars( $_POST['passR']);

		if($pass === $passR){
			$pass = hash('sha256', $pass);

			$check = $dbh->prepare('SELECT email FROM utilisateurs WHERE email=?');
			$check->execute(array($email));
			$row = $check->rowCount();
			if($row == 0){
				$insert = $dbh->prepare('INSERT INTO utilisateurs(pseudo, email, password, numero) VALUES(:pseudo, :email, :password, :numero)');
				$insert->execute(array(
					'pseudo' => $username,
					'email' => $email,
					'password' => $pass,
					'numero' => $tel,
				));
				$_SESSION['username'] = $username;
				$_SESSION['telephone'] = $tel;
				header('Location:Accueil.php');
			}else{
				echo 'adresse email ou numéro telephone existe deja';
			}
		}else{
			echo'mots de passes differents';
		}
		
	}else{
		echo'Veuillez remplir tous les champs';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="inscriptio.css"/>
	<title> Titre</title>
</head>
<body>
	<h2 style="font-size:80px; color:#2271FF">Inscription...</h2>
	<section>
		<h3> <img src="images/emma.jpg" class="img" alt="emma" /></h3>
		<form method="POST">
			<Label for="id2"><strong>Entrez votre nom d'utilisateur</strong></label>
			<input type="text" id="prénom" name="username"/><br>
			
			<label for="id"><strong>Entrez votre addresse email</strong></label>
			<input type="email" id="addrese email" name="email"/><br>
			
			<label for="id"><strong>Entrez votre numéro de téléphone</strong></label>
			<input type="text" id="numéro de téléphone" name="tel"/><br>
			
			<label for="pass"><strong>Entrez votre mot de passe</strong></label>
			<input type="password" id="mot de passe" name="pass"/><br>
			
			<label for="pass"><strong>Confirmez votre mot de passe</strong></label>
			<input type="password" id="mot de passe" name="passR"/><br>
			<a href="connexion.php">se connecter</a>
			<p>
				<input type='submit' name='submit' value="S'inscrire" />
				<input type="submit" name="annuler" value="Annuler" class="value"/>
			</p>
		</form>

		<div class="content">
			<div class="gauche">
			</div>
			<div class="circle"></div>
			<div class="droite">
				<img src="images/inscription.svg" alt="">
			</div>
		</div>
	</section>
</body>
</html>