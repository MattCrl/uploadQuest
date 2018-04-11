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
                } else {
                    $errors = "Your file is too big";
                }
            } else {
                $errors = "There was an error uploading your file";
            }
        } else {
            $errors = "You can't upload that type of file";
        }
    }
}

if (!empty($errors)) {
    echo $errors . '<br />';
    ?>
    <a href="index.php">Back to galery</a>
<?php
} else {
    header("Location: index.php");
    exit();
}

?>
