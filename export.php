<?php 
    require_once("config.php");
    $req = $dbh->prepare("select * from objets where utilisateur=?");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute(array($_GET['nom']));
    $tab=$req->fetchAll();
    echo $tab[$_GET['i']]["bin"];
?>