<?php
session_start();

require './Klasifikasi.php';
require './Tipe.php';
require './DataTrain.php';

if (isset($_POST['cek'])) {
    $kalimat = $_POST['kalimat'];
    $resultType = train($kalimat);
    $_SESSION['hasil'] = $kalimat . " => merupakan kalimat " . $resultType;

    header("Location: index.php");
}


function train($kalimat)
{
    $klasifikasi = new Klasifikasi();
    $dataTrain = data_train();

    foreach ($dataTrain as $item) {
        $klasifikasi->learn($item[0], $item[1]);
    }

    return $klasifikasi->guess($kalimat);
}
