<?php
include '../function.php';

if (isset($_POST['kota'])) {
    $selectedCity = $_POST['kota'];
    $kecamatanQuery = "SELECT * FROM kecamatan WHERE city_id = $selectedCity ORDER BY dis_name ASC";
    $kecamatan = getKecamatan($kecamatanQuery);
    $selectedKecamatan = 0;
    echo "<option class='text-center'>--Kecamatan--</option>";
    foreach ($kecamatan as $kec) {
        echo "<option value='" . $kec['dis_id'] . "'>" . $kec['dis_name'] . "</option>";
    }
}
?>
