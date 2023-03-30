<?php
include '../function.php';

if (isset($_POST['kecamatan'])) {
    $selectedKecamatan = $_POST['kecamatan'];
    $kelurahanQuery = "SELECT * FROM kelurahan WHERE dis_id = $selectedKecamatan ORDER BY subdis_name ASC";
    $kelurahan = getKelurahan($kelurahanQuery);
    $selectedKelurahan = 0;
    echo "<option class='text-center'>--Kelurahan--</option>";
    foreach ($kelurahan as $kel) {
        echo "<option value='" . $kel['subdis_id'] . "'>" . $kel['subdis_name'] . "</option>";
    }
}
?>
