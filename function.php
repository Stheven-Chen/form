<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'kodepos';
$db2 = 'mobil';
$db3 = 'data tertanggung';

$conn = mysqli_connect($host, $user, $password, $db);
$conn2 = mysqli_connect($host, $user, $password, $db2);
$conn3 = mysqli_connect($host, $user, $password, $db3);

function add($data)
{
    global $conn3;
    $nama =        htmlspecialchars($data['nama_tertanggung']);
    $ktp =         htmlspecialchars($data['ktp']);
    $alamat =      htmlspecialchars($data['alamat']);
    $provinsi =    htmlspecialchars($data['provinsi']);
    $kota =        htmlspecialchars($data['kota']);
    $kecamatan =   htmlspecialchars($data['kecamatan']);
    $kelurahan =   htmlspecialchars($data['kelurahan']);
    $kodepos =     htmlspecialchars($data['kodepos']);
    $telp =        htmlspecialchars($data['telp']);
    $email =       htmlspecialchars($data['email']);
    $merek =        htmlspecialchars($data['merek']);
    $model =        htmlspecialchars($data['model']);
    $plat =         htmlspecialchars($data['plat']);
    $rangka =      htmlspecialchars($data['rangka']);
    $tahun =        htmlspecialchars($data['tahun']);
    $warna =        htmlspecialchars($data['warna']);
    $mesin =        htmlspecialchars($data['mesin']);
    $penggunaan =   htmlspecialchars($data['penggunaan']);
    $leasing =      htmlspecialchars($data['leasing']);
    $sum_insured = htmlspecialchars($data['sum_insured']);
    $tsi = htmlspecialchars($data['tsi']);
    $jaminan = htmlspecialchars($data['jaminan']);
    $rscc =   htmlspecialchars(in_array('rscc', $data['perluasan']));
    $ts =   htmlspecialchars(in_array('ts', $data['perluasan']));
    $tshfl =   htmlspecialchars(in_array('tshfl', $data['perluasan']));
    $eqvet =   htmlspecialchars(in_array('eqvet', $data['perluasan']));
    $tjh =   htmlspecialchars(in_array('tjh', $data['perluasan']));
    $tjhp =   htmlspecialchars(in_array('tjhp', $data['perluasan']));
    $pad =   htmlspecialchars(in_array('pad', $data['perluasan']));
    $pap =   htmlspecialchars(in_array('pap', $data['perluasan']));

    $query = "INSERT INTO data_tertanggung (nama, ktp, alamat, provinsi, kota, kecamatan, kelurahan, kodepos, telp, email, merek, model, plat, rangka, tahun, warna, mesin, penggunaan, leasing, variasi, rscc, ts, tshfl, eqvet, tjh, tjhp, pad, pap) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn3, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssssssssssssssssssssssssss', $nama, $ktp, $alamat, $provinsi, $kota, $kecamatan, $kelurahan, $kodepos, $telp, $email, $merek, $model, $plat, $rangka, $tahun, $warna, $mesin, $penggunaan, $leasing, $variasi, $rscc, $ts, $tshfl, $eqvet, $tjh, $tjhp, $pad, $pap);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return mysqli_affected_rows($conn3);
}



function getCar($carQuery)
{
    global $conn2;
    $resultCars = mysqli_query($conn2, $carQuery);
    $cars = [];
    while ($row = mysqli_fetch_assoc($resultCars)) {
        $cars[] = $row;
    }
    return $cars;
}

function getCarModel($modelQuery)
{
    global $conn2;
    $resultModel = mysqli_query($conn2, $modelQuery);
    $models = [];
    while ($row = mysqli_fetch_assoc($resultModel)) {
        $models[] = $row;
    }
    return $models;
}

function getProvince($provQuery)
{
    global $conn;
    $resultProvince = mysqli_query($conn, $provQuery);
    $provinsi = [];
    while ($row = mysqli_fetch_assoc($resultProvince)) {
        $provinsi[] = $row;
    }
    return $provinsi;
};

function getCity($cityQuery)
{
    global $conn;
    $resultCity = mysqli_query($conn, $cityQuery);
    $kota = [];
    while ($row = mysqli_fetch_assoc($resultCity)) {
        $kota[] = $row;
    }
    return $kota;
}
function getKecamatan($kecamatanQuery)
{
    global $conn;
    $resultKecamatan = mysqli_query($conn, $kecamatanQuery);
    $kecamatan = [];
    while ($row = mysqli_fetch_assoc($resultKecamatan)) {
        $kecamatan[] = $row;
    }
    return $kecamatan;
}



function getKelurahan($kelurahanQuery)
{
    global $conn;
    $resultKelurahan = mysqli_query($conn, $kelurahanQuery);
    $kelurahan = [];
    while ($row = mysqli_fetch_assoc($resultKelurahan)) {
        $kelurahan[] = $row;
    }
    return $kelurahan;
}

function getKodePos($kodePosQuery)
{
    global $conn;
    $resultKodePos = mysqli_query($conn, $kodePosQuery);
    $kodePos = [];
    while ($row = mysqli_fetch_assoc($resultKodePos)) {
        $kodePos[] = $row;
    }
    return $kodePos;
}
