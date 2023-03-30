<?php


$conn = mysqli_connect("localhost", "root", "", "kodepos");

$result_prov = mysqli_query($conn, "SELECT * FROM provinsi ORDER BY prov_name ASC");
$provinsi = [];
while ($row = mysqli_fetch_assoc($result_prov)) {
  $provinsi[] = $row;
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
  <title>SPPP MV</title>
  <style src="style.css"></style>
</head>

<body style="background-color: #f9f7f7">
  <!-- Main -->
  <!-- header -->
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
      <div class="container text-light rounded-3 text-start pb-1" style="background-color: #0177b9; font-size: 24; font-weight: bold; height: 5%">Data Tertanggung</div>
      <form action="" method="POST" id="select alamat">

        <div class="row py-4 px-5">
          <div class="col-md-6">
            <label for="nama tertanggung" class="form-label">Nama Tertanggung</label>
            <input type="text" class="form-control rounded-4" id="nama tertanggung" aria-describedby="nama" name="nama tertanggung" />
          </div>
          <div class="col-md-6">
            <label for="KTP" class="form-label">NIK KTP</label>
            <input type="text" class="form-control rounded-4" id="KTP" aria-describedby="ktp" name="KTP" />
          </div>
        </div>
        <div class="row py-4 px-5">
          <div class="col-md-12">
            <label for="alamat tertanggung" class="form-label">Alamat Tertanggung</label>
            <input type="text" name="alamat" class="form-control rounded-4" id="alamat tertanggung" aria-describedby=" alamat" />
          </div>

        </div>
        <div class="row py-4 px-5">
          <div class="col-md-6">
            <label for="provinsi">Provinsi</label>
            <select class="form-select rounded-4" aria-label="Default select example" id="provinsi" name="provinsi" onchange="document.getElementById('select alamat').submit()">
              <option class="text-center">--Provinsi--</option>


              <?php foreach ($provinsi as $prov) : ?>

                <option value="<?= $prov["prov_id"] ?>" <?php if (isset($_POST["provinsi"]) && $_POST["provinsi"] == $prov["prov_id"]) {
                                                          echo "selected";
                                                        } ?>><?= $prov["prov_name"]; ?> </option>
              <?php endforeach ?>
            </select>

          </div>
          <div class="col-md-6">
            <label for="kota">Kota</label>
            <select class="form-select rounded-4" aria-label="Default select example" id="kota" name="kota" onchange="document.getElementById('select alamat').submit()">
              <option class="text-center">--Kota--</option>
              <?php
              $prov_id = $_POST["provinsi"];
              if (isset($_POST["provinsi"]) && !empty($_POST["provinsi"])) {
                $result_kota = mysqli_query($conn, "SELECT * FROM kota WHERE prov_id = $prov_id  ORDER BY city_name ASC");
                $kota = [];
                while ($row = mysqli_fetch_assoc($result_kota)) {
                  $kota[] = $row;
                }
              }
              ?>
              <?php foreach ($kota as $kot) : ?>
                <option value="<?= $kot["city_id"] ?>" <?php if (isset($_POST["kota"]) && $_POST["kota"] == $kot["city_id"]) {
                                                          echo "selected";
                                                        } ?>><?= $kot["city_name"]; ?></option>
              <?php endforeach ?>


            </select>
          </div>
        </div>
        <div class="row py-4 px-5">
          <div class="col-md-6">
            <label for="kecamatan">Kecamatan</label>
            <select class="form-select rounded-4" aria-label="Default select example" id="kecamatan" name="kecamatan" onchange="document.getElementById('select alamat').submit()">
              <option class="text-center">--Kecamatan--</option>
              <?php
              $city_id = $_POST["kota"];
              if (isset($_POST["kota"]) && !empty($_POST["kota"])) {
                $result_kecamatan = mysqli_query($conn, "SELECT * FROM kecamatan WHERE city_id = $city_id  ORDER BY dis_name ASC");
                $kecamatan = [];
                while ($row = mysqli_fetch_assoc($result_kecamatan)) {
                  $kecamatan[] = $row;
                }
              }
              ?>
              <?php foreach ($kecamatan as $kec) : ?>
                <option value="<?= $kec["dis_id"] ?>" <?php if (isset($_POST["kecamatan"]) && $_POST["kecamatan"] == $kec["dis_id"]) {
                                                        echo "selected";
                                                      } ?>><?= $kec["dis_name"]; ?></option>
              <?php endforeach ?>

            </select>
          </div>
          <div class="col-md-4">
            <label for="kelurahan">Kelurahan</label>
            <select class="form-select rounded-4" aria-label="Default select example" id="kelurahan" name="kelurahan" onchange="document.getElementById('select alamat').submit()">
              <option class="text-center">--Kelurahan--</option>
              <?php
              $dis_id = $_POST["kecamatan"];
              if (isset($_POST["kecamatan"]) && !empty($_POST["kecamatan"])) {
                $result_kelurahan = mysqli_query($conn, "SELECT * FROM kelurahan WHERE dis_id = $dis_id  ORDER BY subdis_name ASC");
                $kelurahan = [];
                while ($row = mysqli_fetch_assoc($result_kelurahan)) {
                  $kelurahan[] = $row;
                }
              }
              ?>
              <?php foreach ($kelurahan as $kel) : ?>
                <option value="<?= $kel["subdis_id"] ?>" <?php if (isset($_POST["kelurahan"]) && $_POST["kelurahan"] == $kel["subdis_id"]) {
                                                            echo "selected";
                                                          } ?>><?= $kel["subdis_name"]; ?></option>
              <?php endforeach ?>

            </select>
          </div>
          <div class="col-md-2">
            <?php

            ?>
            <label for="kodepos">Kode Pos</label>
            <?php
            error_reporting(0);
            $subdis_id = $_POST["kelurahan"];
            if (isset($_POST["kelurahan"]) && !empty($_POST["kelurahan"])) {
              $result_kodepos = mysqli_query($conn, "SELECT * FROM `kodepos` WHERE  `subdis_id` = $subdis_id  ");
              $kodepos = [];
              while ($row = mysqli_fetch_assoc($result_kodepos)) {
                $kodepos[] = $row;
              }
            } else {
              $kodepos = [];
            }

            ?>
            <?php foreach ($kodepos as $pos) : ?>
              <input name="kodepos" type="text" class="form-control rounded-4" id="kodepos" value="<?= $pos["postal_code"] ?>" onchange="document.getElementById('select alamat').sumbit()" />
            <?php endforeach ?>
            <?php

            ?>
          </div>

        </div>
        <div class="row py-4 px-5">
          <div class="col-md-4">
            <label for="no telp">No Telp</label>
            <input type="text" class="form-control rounded-4" id="no telp" name="telp" />
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-6">
            <label for="email">Email</label>
            <input type="text" class="form-control rounded-4" id="email" name="email" />
          </div>
        </div>
        <!-- Button -->
        <div class="row py-5 px-4 justify-content-center">
          <a class="col-md-4 btn btn-primary rounded-5">Kembali</a>
          <div class="col-md-2"></div>
          <a href="data kendaraan.php" class="col-md-4 btn rounded-5" style="background-color: #ffa41b" name="submit">lanjutkan</a>
        </div>
      </form>
    </div>
  </div>


  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</body>

</html>