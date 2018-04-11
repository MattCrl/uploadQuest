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
                    $success = 'The file ' . $fileName = $_FILES['file']['name'][$i] . ' has successfully been uploaded';
                } else {
                    $errors = 'The file ' . $fileName = $_FILES['file']['name'][$i] . ' is too big';
                }
            } else {
                $errors = "There was an error uploading your file";
            }
        } else {
            $errors = 'The type of the file ' . $fileName = $_FILES['file']['name'][$i] . ' isn\' correct';
        }
    }
}

if (!empty($errors)) {
    echo $errors . '<br />';
    if (!empty($success)) {
        echo $success . '<br />';
    }
    ?>
    <a href="index.php">Back to galery</a>
<?php
} else {
    header("Location: index.php");
    exit();
}

?>
