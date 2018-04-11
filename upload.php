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
    $total = count($_FILES['file']['name']);
    echo $total;

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNewName = uniqid('image-', true) . "." . $fileActualExt;
                $fileDestination = 'uploads/' . $fileNewName;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: index.php");
                exit();
            } else {
                echo "Your file is too big";
            }
        } else {
            echo "There was an error uploading your file";
        }
    } else {
        echo "You can't upload that type of file";
    }

}
