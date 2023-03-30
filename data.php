<?php
function getData($url)
{
    $handle = fopen($url, 'r');
    $data = [];
    if ($handle) {
        $header = fgetcsv($handle); // Ambil baris pertama sebagai header
        while (($row = fgetcsv($handle)) !== false) {
            // Konversi baris menjadi array asosiatif dengan menggunakan header sebagai key
            $data[] = array_combine($header, $row);
        }
        fclose($handle);
    } else {
        // Jika gagal membuka file, lakukan penanganan error di sini
        echo "Gagal mengambil data dari URL: " . $url;
    }
    return $data;
}

// Data Provinsi
$data_prov = getData('https://raw.githubusercontent.com/rfahmi/kode-pos-indonesia/master/CSV/province.csv');
// Data Kota
$data_kota = getData('https://raw.githubusercontent.com/rfahmi/kode-pos-indonesia/master/CSV/city.csv');
// Data Kecamatan
$data_kecamatan = getData('https://raw.githubusercontent.com/rfahmi/kode-pos-indonesia/master/CSV/district.csv');
// Data Kelurahan
$data_kelurahan = getData('https://raw.githubusercontent.com/rfahmi/kode-pos-indonesia/master/CSV/subdistrict.csv');
// Data Kode Pos
$data_pos = getData('https://raw.githubusercontent.com/rfahmi/kode-pos-indonesia/master/CSV/postal_code.csv');

// Cetak hasil konversi ke dalam array asosiatif
print_r($data_prov, true);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>List Provinsi</title>
</head>

<body>
    <!-- Main -->
    <div class="container py-4 bg-dark rounded-3 shadow-lg">
        <div class="mb-3 text-light">
            <form action="" method="GET" id="provinsi">
                <label for="SelectProvinsi" class="form-label">Provinsi</label>
                <select id="SelectProvinsi" class="form-select" name="provinsi" onchange="document.getElementById('provinsi').submit()">
                    <option> -- Pilih Provinsi-- </option>
                    <?php foreach ($data_prov as $prov) : ?>
                        <option value="<?= $prov["prov_id"] ?>"><?= $prov["prov_name"]; ?></option>
                    <?php endforeach ?>
                </select>
            </form>
            <form action="" method="GET" id="kota">
                <label for="SelectKota" class="form-label">kota</label>
                <select id="SelectKota" class="form-select" name="kota" onchange="document.getElementById('kota').submit()">
                    <option> -- Pilih Kota --</option>
                    <?php foreach ($data_kota as $kota) : ?>
                        <option value="<?= $kota["city_id"] ?>"><?= $kota["city_name"]; ?></option>
                    <?php endforeach ?>
                </select>
            </form>
            <p><?php var_dump($_GET["kota"]) ?></p>
        </div>
        <!-- Bootstrap JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>


</html>