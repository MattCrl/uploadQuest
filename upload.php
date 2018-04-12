<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <title>Upload quest</title>
</head>

<body>
<div class="container">

<?php
/*if(isset($_FILES['quest']))
{
    $extensions = ['.png', '.gif', '.jpg', '.jpeg',];
    $dossier = 'upload/';
    $fichier = basename($_FILES['file']['name']);
    print_r($fichier);
    if(move_uploaded_file($_FILES['file']['tmp_name'], $dossier . $fichier))
    {
        echo 'Upload effectué avec succès !';
    }
    else
    {
        echo 'Echec de l\'upload !';
    }
}*/

if (!empty($_FILES)) {

    $success = [];
    $errors = [];
    $total = count($_FILES['file']['name']);
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    for ($i=0; $i<$total; $i++) {
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'][$i];
        $fileTmpName = $_FILES['file']['tmp_name'][$i];
        $fileSize = $_FILES['file']['size'][$i];
        $fileError = $_FILES['file']['error'][$i];
        $fileType = $_FILES['file']['type'][$i];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNewName = uniqid('image-', true) . "." . $fileActualExt;
                    $fileDestination = 'uploads/' . $fileNewName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $success[] = 'The file ' . $fileName = $_FILES['file']['name'][$i] . ' has successfully been uploaded <br />';
                } else {
                    $errors[] = 'The file ' . $fileName = $_FILES['file']['name'][$i] . ' is too big <br />';
                }
            } else {
                $errors[] = "There was an error uploading your file";
            }
        } else {
            $errors[] = 'The type of the file ' . $fileName = $_FILES['file']['name'][$i] . ' isn\' correct';
        }
    }
}

if (!empty($errors)) {
    ?>
    <h1>There was a problem uploading your file(s) :</h1>
    <?php
    foreach($errors as $error) {
        echo '<p><span class="error">' . $error . '</span></p>';
    }
    if (!empty($success)) {
        foreach($success as $oneSuccess) {
            echo '<p><span class="success">' . $oneSuccess . '</span></p>';
        }
    }
    ?>
    <a href="index.php" class="btn btn-primary" role="button">Back to galery</a>
<?php
} else {
    ?>
    <h1>Succes !</h1>
    <h2>You will be redirected in 5 seconds</h2>
    <?php
    foreach($success as $oneSuccess) {
        echo '<p><span class="success">' . $oneSuccess . '</span></p>';
    }
    header("refresh:5;url=index.php");
    exit();
}

?>

</div>
</body>
</html>