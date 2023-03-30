<?php
include "../function.php";

if (isset($_POST['kelurahan'])) {
    $selectedKelurahan = $_POST['kelurahan'];
    $kodePosQuery = "SELECT * FROM kodepos WHERE subdis_id = '$selectedKelurahan'";
    $kodePos = getKodePos($kodePosQuery);
    foreach ($kodePos as $pos) {
        echo $pos['postal_code'];
    }
}
?>