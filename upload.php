<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    $name = $_POST['name'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 500000) {
                $fileNameNew = $name . '.' . $fileActExt;
                $fileDestination = '/home/xkocian/files/' . $fileNameNew;
                $i = 1;
                while (file_exists($fileDestination)) {
                    $fileNameNew = $name . "($i)" . '.' . $fileActExt;
                    $fileDestination = '/home/xkocian/files/' . $fileNameNew;
                    $i++;
                }

                move_uploaded_file($fileTmpName, $fileDestination);
            } else {
                echo 'Your file is too big!';
            }
        } else {
            echo 'There was an error with uploading your file!';
        }
    } else {
        echo 'Your type of file is not allowed !';
    }

    header("Location: https://site95.webte.fei.stuba.sk/zadanie1/index.php?dir=/home/xkocian/files");
}
