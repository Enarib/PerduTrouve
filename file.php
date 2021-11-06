<?php 
    if(isset($_POST['valider'])){
        $maxSize = $_FILES['image']['size'];
        echo $maxSize;
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Files</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" value="valider" name="valider">
    </form>
</body>
</html>