<?php
include '../function.php';

if (isset($_POST['provinsi'])) {
    $selectedProvinsi = $_POST['provinsi'];
    $cityQuery = "SELECT * FROM kota WHERE prov_id = $selectedProvinsi ORDER BY city_name ASC";
    $kota = getCity($cityQuery);
    $selectedCity = 0;
    echo "<option class='text-center'>--Kota--</option>";
    foreach ($kota as $city) {
        echo "<option value='" . $city['city_id'] . "'>" . $city['city_name'] . "</option>";
    }
}
?>
