<?php 
    require_once("config.php");
    $req = $dbh->prepare("select * from objets where nomObjet=?");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute(array($_GET['objet']));
    $tab=$req->fetchAll();
    echo $tab[$_GET['i']]["bin"];
?>