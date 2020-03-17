<?php
require './Tipe.php';
require './DataTrain.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar Naive Bayes - Klasifikasi kalimat positif dan negatif</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <h1 class="display-5">Klasifikasi kalimat positif dan negatif</h1>
            <p class="lead">Menggunakan algoritma naive bayes</p>
            <hr class="my-2">
            <div class="col-md-12 col-xs-12" style="margin-top:30px">
                <h4>Analisa kalimat</h4>
                <form class="form-inline" action="prosesKlasifikasi.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="kalimat" class="form-control" placeholder="teman saya baik">
                    </div>
                    <button type="submit" name="cek" class="btn btn-primary">Cek</button>
                </form>

                <?php
                if (isset($_SESSION['hasil'])) :
                ?>
                    <div class="alert alert-info" role="alert">
                        <strong><?= $_SESSION['hasil'] ?></strong>
                    </div>
                <?php
                    unset($_SESSION['hasil']);
                endif
                ?>
            </div>
            <div class="col-md-12 col-sm-12" style="margin-top: 20px">
                <h4>Data Training</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTraining">
                        <thead class="thead-inverse">
                            <tr>
                                <th>No</th>
                                <th>Contoh Kalimat</th>
                                <th>Klasifikasi Kalimat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dataTraining = data_train();
                            $no = 1;
                            foreach ($dataTraining as $item) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $item[0] ?></td>
                                    <td><?= $item[1] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#dataTraining').DataTable();
    </script>
</body>

</html>