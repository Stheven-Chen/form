<?php
include "../form/function.php";
if (isset($_POST['submit'])) {
  //   // save the form data to session


  $merekQuery = "SELECT merek FROM merek_mobil WHERE id = $_POST[merek]";
  $result = mysqli_query($conn2, $merekQuery);
  $merek = mysqli_fetch_assoc($result);
  $_SESSION['merek'] = $merek['merek'];
  //selected model
  $modelQuery = "SELECT model FROM model_mobil WHERE id = $_POST[model]";
  $result = mysqli_query($conn2, $modelQuery);
  $model = mysqli_fetch_assoc($result);
  $_SESSION['model'] = $model['model'];
  $_SESSION['plat'] = $_POST['plat'];
  $_SESSION['rangka'] = $_POST['rangka'];
  $_SESSION['tahun'] = $_POST['tahun'];
  $_SESSION['warna'] = $_POST['warna'];
  $_SESSION['mesin'] = $_POST['mesin'];
  $_SESSION['penggunaan'] = $_POST['penggunaan'];
  $_SESSION['leasing'] = $_POST['leasing'];
  $_SESSION['variasi'] = $_POST['variasi'];

  // $_SESSION['nama'] = $_POST['nama'];
  // $_SESSION['tipe'] = $_POST['tipe'];
  // $_SESSION['harga'] = $_POST['harga'];

  // call the add function to insert the data to database
  header("location: premium.php");
}

$carQuery = 'SELECT * FROM merek_mobil ORDER BY merek ASC';
$cars = getCar($carQuery);
$selectedCar = 0;
if (isset($_POST['merek'])) {
  $selectedCar = $_POST['merek'];
}

$modelQuery = "SELECT * FROM model_mobil WHERE merek_id = $selectedCar ORDER BY model ASC";
$models = getCarModel($modelQuery);
$selectedModel = 0;
if (isset($_POST['model'])) {
  $selectedModel = $_POST['model'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <style>
    label {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 18;
      font-weight: 500;
      padding-left: 10px;
    }

    .btn {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 28;
      color: #e6e6e6;
    }
  </style>
  <title>Data Kendaraan</title>
  <script src="ajax/ajax.js"></script>
</head>

<body>
  <!-- Main -->
  <header class="container-fluid" style="background-color: #0177b9; height: 67px">
    <div class="row justify-content-between">
      <div class="col-md-6">
        <img src="img/logoputih.png" class="img-fluid" alt="" style="height: 50px; margin-top: 7px" />
      </div>
      <!-- <div class="col-6">
              <img src="img/logoOJK.png" class="img-fluid" alt="" style="height: 60px; margin-top: 4px" />
            </div> -->
    </div>
  </header>
  <div class="container">
    <!-- Main Box -->
    <div class="container px-0 rounded-3 shadow-lg" style="background-color: #d9d9d9; margin-top: 38px; height: 80%">
      <div class="container text-light rounded-3 text-start pb-1" style="background-color: #0177b9; font-size: 24; font-weight: bold; height: 5%">Data Kendaraan</div>
      <form action="" method="POST" id="data kendaraan">
        <div class="row py-4 px-5">
          <div class="col-md-4">
            <label for="merek">Merek Kendaraan</label>
            <select name="merek" id="merek" class="form-select rounded-4 text-center" onchange="getCarModel(this.value)">
              <option value="merek">--Merek--</option>
              <?php foreach ($cars as $car) : ?>
                <?php if ($car['id'] == $selectedCar) : ?>
                  <option value="<?= $car['id'] ?>" selected><?= $car['merek']; ?></option>
                <?php else : ?>
                  <option value="<?= $car['id'] ?>"><?= $car['merek']; ?></option>
                <?php endif; ?>
              <?php endforeach ?>

            </select>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-4">
            <label for="model">Model Kendaraan</label>
            <select name="model" id="model" class="form-select rounded-4 text-center">
              <option value="model">--Model--</option>

            </select>
          </div>
        </div>
        <div class="row py-2 px-5">
          <div class="col-md-2">
            <label for="plat">No Polisi</label>
            <input type="text" class="form-control rounded-4" name="plat" id="" required>
          </div>
          <div class="col-md-2">
            <label for="tahun">Usia Kendaraan</label>
            <input type="text" name="tahun" class="form-control rounded-4" required/>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-4">
            <label for="rangka">No Rangka</label>
            <input type="text" name="rangka" class="form-control rounded-4" required/>
          </div>
        </div>
        <div class="row py-2 px-5">
          <div class="col-md-4">
            <label for="warna">Warna Kendaraan</label>
            <input name="warna" id="warna" class="form-control rounded-4 text-center" required/>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-4">
            <label for="mesin">No Mesin</label>
            <input name="mesin" id="mesin" class="form-control rounded-4 text-center" required/>
          </div>
        </div>
        <div class="row py-2 px-5">
          <div class="col-md-4">
            <label for="penggunaan">Penggunaan</label>
            <select name="penggunaan" id="penggunaan" class="form-select rounded-4 text-center">
              <option value="">--Penggunaan--</option>
              <option value="Pribadi">Pribadi</option>
              <option value="Komersial">Komersial</option>
              <option value="Dinas">Dinas</option>
            </select>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-4">
            <label for="leasing">Leasing?</label>
            <select name="leasing" id="leasing" class="form-select rounded-4 text-center">
              <option value="Ya">Ya</option>
              <option value="Tidak">Tidak</option>
            </select>
          </div>
        </div>
        <div class="row py-4 px-5">
          <label class="col-md-1" for="">Spare Part:</label>
          <div class="form-check py-2 px-5 col-md-1">
            <input class="form-check-input" type="radio" name="variasi" id="variasi" value="Standar" checked onchange="disableTable()" />
            <label class="form-check-label" for="variasi"> Standar </label>
          </div>
          <div class="form-check py-2 px-5 col-md-1">
            <input class="form-check-input" type="radio" name="variasi" id="variasi" value="Tidak" onchange="disableTable()" />
            <label class="form-check-label" for="variasi"> Tidak </label>
          </div>
          <div class="col-md-3"></div>
        </div>
        <div class="row py-4 px-5">
          <div class="col-md-12 table">
            <table class="table table-hover table-sm" id="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col" class="text-center">Nama Perlengkapan</th>
                  <th scope="col" class="text-center">Tipe</th>
                  <th scope="col" class="text-center">Harga</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td><input disabled type="text" name="nama" class="form-control rounded-4" /></td>
                  <td><input disabled type="text" name="tipe" class="form-control rounded-4" /></td>
                  <td><input disabled type="text" name="harga" class="form-control rounded-4  hargaSparepart" oninput="formatCurrency(this)" /></td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td><input disabled type="text" name="nama" class="form-control rounded-4" /></td>
                  <td><input disabled type="text" name="tipe" class="form-control rounded-4" /></td>
                  <td><input disabled type="text" name="harga" class="form-control rounded-4  hargaSparepart" oninput="formatCurrency(this)" /></td>
                </tr>
                <tr>
                  <th scope="row">3</th>

                  <td><input disabled type="text" name="nama" class="form-control rounded-4" /></td>
                  <td><input disabled type="text" name="tipe" class="form-control rounded-4" /></td>
                  <td><input disabled type="text" name="harga" class="form-control rounded-4  hargaSparepart" oninput="formatCurrency(this)" /></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="row py-5 px-4 justify-content-center">
      <a href="SP3MV.php " class="col-md-4 btn btn-primary rounded-5">Kembali</a>
      <div class="col-md-2">&nbsp;</div>
      <input class="col-md-4 btn rounded-5" style="background-color: #ffa41b" type="submit" name="submit" value="Lanjutkan">
    </div>
    </form>
  </div>

  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
  <script src="scripts/scripts.js"></script>


</body>

</html>