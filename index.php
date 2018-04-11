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
    <h1>Welcome to your galery</h1>

    <h2>Upload your file :</h2>
    <form method="POST" action="upload.php" enctype="multipart/form-data">
        <div class="form-group">
        <input type="file" name="file" multiple="multiple">
        </div>
        <div class="form-group">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
    </form>


    <h2>All uploaded images :</h2>

    <?php
        $dir = "uploads";
        $files = scandir($dir);
        $filesFilter = array_diff($files, array('.', '..'));
        foreach ($filesFilter as $file => $value) {
            ?>
            <div class="col-xs-6 col-md-3">
                <div class="thumbnail">
                    <img src="uploads/<?= $value ?>" alt="">

                <div class="caption">
                    <h3><strong><?= $value ?></strong></h3>
                    <form action="deleteImage.php" method="POST">
                        <input type="hidden" name="name" value="<?= $value ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                </div>
            </div>

            <?php
        }

    ?>

</div>
</body>
</html>
