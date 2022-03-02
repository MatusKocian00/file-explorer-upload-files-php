<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="table.css">
    <title>Zadanie 1</title>
</head>

<body>

    <table class="table table-striped table-bordered" style="width:50%; margin:0 auto" id="filesTable">
        <thead>
            <tr>
                <th scope="col" data-sortable="true">Meno súboru</th>
                <th scope="col" data-sortable="true">Veľkosť</th>
                <th scope="col" data-sortable="true">Dátum</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <?php
            if (isset($_GET["dir"])) {
                $currentpath = $_GET["dir"] . '/';
            } else {
                $currentpath = "/home/xkocian/files";
            }
            $a = array_diff(scandir($currentpath), array('.'));
            foreach ($a as $file) {
                $path = $currentpath . $file;
                if (!strcmp($file, '..')) {
                    if (strcmp($path, "/home/xkocian/files/..")) {
                        $parentPath = realpath($path);
                        echo "<tr>
                    <td><i class='bi bi-arrow-90deg-left'></i>&nbsp;
                        <a href='index.php?dir={$parentPath}'>Parent directory</a>
                    </td>
                    <td></td>
                    <td></td>
                   </tr>";
                    }
                } else if (is_file($path)) {
                    echo "<tr>
                    <td>{$file}</td>
                    <td>" . (filesize($path)) >> 10 . " kB" . "</td>
                    <td>" . date("m.d.Y H:i:s", filemtime($path)) . "</td>
                   </tr>";
                } else {

                    echo "<tr>
                    <td><i class='bi bi-folder'></i>&nbsp;
                        <a href='index.php?dir={$path}'>{$file}</a></td>
                    <td></td>
                    <td></td>
                   </tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <form action="upload.php" method="POST" enctype="multipart/form-data" id="file-upload-form">
        <div id="form">
            <div class="form-group">
                <div class=" mb-3">
                    <label for="file" class="form-label">Select file</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <input type="text" name='name' id='name' placeholder="Zadajte nazov suboru" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" name="submit" id="submit" class="btn btn-primary">SUBMIT</button>
            </div>
        </div>
    </form>

    <script src="app.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
</body>

</html>