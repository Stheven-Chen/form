<?php
include 'function.php';

if (isset($_POST['submit'])) {
    // save the form data to session
    $_SESSION['nama_tertanggung'] = $_POST['nama_tertanggung'];
    $_SESSION['ktp'] = $_POST['KTP'];
    $_SESSION['alamat'] = $_POST['alamat'];
    // prov selected
    $provinsiQuery = "SELECT prov_name FROM provinsi WHERE prov_id = $_POST[provinsi]";
    $result = mysqli_query($conn, $provinsiQuery);
    $provinsi = mysqli_fetch_assoc($result);
    $_SESSION['provinsi'] = $provinsi['prov_name'];
    //city selected 
    $kotaQuery = "SELECT city_name FROM kota WHERE city_id = $_POST[kota]";
    $result = mysqli_query($conn, $kotaQuery);
    $kota = mysqli_fetch_assoc($result);
    $_SESSION['kota'] = $kota['city_name'];
    // district selected
    $kecamatanQuery = "SELECT dis_name FROM kecamatan WHERE dis_id = $_POST[kecamatan]";
    $result = mysqli_query($conn, $kecamatanQuery);
    $kecamatan = mysqli_fetch_assoc($result);
    $_SESSION['kecamatan'] = $kecamatan['dis_name'];
    // subdistrict selected
    $kelurahanQuery = "SELECT subdis_name FROM kelurahan WHERE subdis_id = $_POST[kelurahan]";
    $result = mysqli_query($conn, $kelurahanQuery);
    $kelurahan = mysqli_fetch_assoc($result);
    $_SESSION['kelurahan'] = $kelurahan['subdis_name'];
    // postal code
    $_SESSION['kodepos'] = $_POST['kodepos'];
    $_SESSION['telp'] = $_POST['telp'];
    $_SESSION['email'] = $_POST['email'];

    header("location: data kendaraan.php");
}
// provinsi
$provQuery = 'SELECT * FROM provinsi ORDER BY prov_name ASC';
$provinsi = getProvince($provQuery);
$selectedProvinsi = 0;
if (isset($_POST['provinsi'])) {
    $selectedProvinsi = $_POST['provinsi'];
}

// Kota
$cityQuery = "SELECT * FROM kota WHERE prov_id = $selectedProvinsi ORDER BY city_name ASC";
$kota = getCity($cityQuery);
$selectedCity = 0;
if (isset($_POST['kota'])) {
    $selectedCIty = $_POST['kota'];
}

//kecamatan
$kecamatanQuery = "SELECT * FROM `kecamatan` WHERE `city_id` = $selectedCity ORDER BY dis_name ASC";
$kecamatan = getKecamatan($kecamatanQuery);
$selectedKecamatan = 0;
if (isset($_POST['kecamatan'])) {
    $selectedKecamatan = $_POST['kecamatan'];
}

//kelurahan
$kelurahanQuery = "SELECT * FROM kelurahan WHERE dis_id = $selectedKecamatan ORDER BY subdis_name ASC";
$kelurahan = getKelurahan($kelurahanQuery);
$selectedKelurahan = 0;
if (isset($_POST['kelurahan'])) {
    $selectedKelurahan = $_POST['kelurahan'];
}

//kodePos
$kodePosQuery = "SELECT * FROM kodepos WHERE subdis_id = $selectedKelurahan";
$kodePos = getKodePos($kodePosQuery);


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
    <script src="ajax/ajax.js"></script>
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
            <form action="" method="POST" id="dataTertanggung">

                <div class="row py-4 px-5">
                    <div class="col-md-6">
                        <label for="nama_tertanggung" class="form-label">Nama Tertanggung</label>
                        <input type="text" class="form-control rounded-4" id="nama_tertanggung" aria-describedby="nama" name="nama_tertanggung" />
                    </div>
                    <div class="col-md-6">
                        <label for="KTP" class="form-label">NIK KTP</label>
                        <input type="text" class="form-control rounded-4" id="KTP" aria-describedby="ktp" name="KTP" />
                    </div>
                </div>
                <div class="row py-4 px-5">
                    <div class="col-md-12">
                        <label for="alamat " class="form-label">Alamat Tertanggung</label>
                        <input type="text" name="alamat" class="form-control rounded-4" id="alamat " aria-describedby=" alamat" />
                    </div>

                </div>
                <div class="row py-4 px-5">
                    <div class="col-md-6">
                        <label for="provinsi">Provinsi</label>
                        <select class="form-select rounded-4" aria-label="Default select example" id="provinsi" name="provinsi" onchange="getCity(this.value)">
                            <option class="text-center">--Provinsi--</option>
                            <?php foreach ($provinsi as $prov) : ?>
                                <?php if ($prov['prov_id'] == $selectedProvinsi) : ?>
                                    <option value="<?= $prov['prov_id'] ?>" selected><?= $prov['prov_name']; ?></option>
                                <?php else : ?>
                                    <option value="<?= $prov['prov_id'] ?>"><?= $prov['prov_name']; ?></option>
                                <?php endif; ?>
                            <?php endforeach ?>
                        </select>

                    </div>
                    <div class="col-md-6">
                        <label for="kota">Kota</label>
                        <select class="form-select rounded-4" aria-label="Default select example" id="kota" name="kota" onchange="getKecamatan(this.value)">
                            <option class="text-center">--Kota--</option>
                        </select>
                    </div>
                </div>
                <div class="row py-4 px-5">
                    <div class="col-md-6">
                        <label for="kecamatan">Kecamatan</label>
                        <select class="form-select rounded-4" aria-label="Default select example" id="kecamatan" name="kecamatan" onchange="getKelurahan(this.value)">
                            <option class="text-center">--Kecamatan--</option>


                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="kelurahan">Kelurahan</label>
                        <select class="form-select rounded-4" aria-label="Default select example" id="kelurahan" name="kelurahan" onchange="getKodePos(this.value)">
                            <option class="text-center">--Kelurahan--</option>


                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="kodepos">Kode Pos</label>

                        <input name="kodepos" type="text" class="form-control rounded-4" id="kodepos" value="" />
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
                    <input type="submit" class="col-md-4 btn rounded-5" style="background-color: #ffa41b" name="submit" value="Lanjutkan">
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