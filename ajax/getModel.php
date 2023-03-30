<?php
include '../function.php';


if (isset($_POST['merek'])){
    $selectedCar = $_POST['merek'];
    $modelQuery = "SELECT * FROM model_mobil WHERE merek_id = $selectedCar ORDER BY model ASC";
    $models = getCarModel($modelQuery);
    $selectedModel = 0;
    echo "<option class='text-center'>--Model--</option>";
    foreach ($models as $model) {
        echo "<option value='" . $model['id'] . "'>" . $model['model'] . "</option>";
    }
}
?>