<?php
include "function.php";

if (isset($_POST['submit'])){




    if (add($_SESSION) > 0) {
        echo "
        <script>
        alert('Data Tersimpan');
        document.location.href = 'SP3MV.php'
        </script>
        ";
      } else {
        echo "
        <script>
        alert('Data Failed');
        document.location.href = 'SP3MV.php'
        </script>
        ";
      }
      // // exit to prevent the rest of the script from running unnecessarily
      exit;
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <style src="style/style.css"></style>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <title>Pertanggungan</title>
</head>

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
        <div class="container text-light rounded-3 text-start pb-1" style="background-color: #0177b9; font-size: 24; font-weight: bold; height: 5%">Coverage</div>
        <div class="row py-4 px-5">
            <div class="col-md-6">
                <label class="form-label" for="sum_insured">Harga Pertanggungan</label>
                <input class="form-control rounded-4 " type="text" name="sum_insured" id="sum_insured" oninput="formatCurrency(this)">
            </div>
            <div class="col-md-6">
                <label for="tsi" class="form-label">Total Nilai Pertanggungan</label>
                <input type="text" class="form-control rounded-4" id="tsi" name="tsi" value="">
            </div>
        </div>
        <div class=" row py-4 px-5">
            <div class="col-md-2">
                Jenis Pertanggungan:
            </div>
            <div class="col-md-2">
                <input class="form-check-input" type="radio" name="jaminan" id="compre" value="compre" />
                <label class="form-check-label" for="compre"> &nbsp; <i>Comprehensive</i> </label>
            </div>
            <div class="col-md-4"><input class="form-check-input" type="radio" name="jaminan" id="tlo" value="tlo" />
                <label class="form-check-label" for="tlo"> &nbsp; <i>Total Loss Only</i> </label>
            </div>
        </div>
        <div class="row py-4 px-5">
            <div class="col-md-2">
                Perluasan:
            </div>
            <div class="col-xs col-sm">
                <div class="form-check form-check-inline d-flex">
                    <input class="form-check-input" type="checkbox" name="perluasan[]" id="rscc" value="rscc">
                    <label class="form-check-label" for="rscc"> &nbsp; Huru-hara (RSCC)</label>
                </div>
                <div class="form-check form-check-inline d-flex">
                    <input class="form-check-input" type="checkbox" name="perluasan[]" id="ts" value="ts">
                    <label class="form-check-label" for="ts"><i> &nbsp; Terrorism and Sabotage</i></label>
                </div>
                <div class="form-check form-check-inline d-flex">
                    <input class="form-check-input" type="checkbox" name="perluasan[]" id="tshfl" value="">
                    <label class="form-check-label" for="tshfl" "> &nbsp; Angin Topan, Badai,
                            Hujan Es, Banjir, dan Tanah Longsor</label>
                    </div>
                    <div class=" form-check form-check-inline d-flex">
                        <input class="form-check-input" type="checkbox" name="perluasan[]" id="eqvet" value="eqvet">
                        <label class="form-check-label" for="eqvet"> &nbsp; Tsunami, Gempa Bumi,
                            dan Letusan Gunung Berapi</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="perluasan[]" id="tjh" value="tjh">
                    <label class="form-check-label" for="tjh"> Tanggung Jawab Hukum
                        terhadap pihak ketiga limit s.d.</label>

                    <!-- <select class="form-select rounded-4 " style="display: none;" name="tjh" id="tjh_select">
                            <option value="25">25Jt</option>
                            <option value="50">50Jt</option>
                            <option value="100">100Jt</option>
                        </select> -->
                </div>
                <div class="form-check form-check-inline d-flex">
                    <input class="form-check-input" type="checkbox" name="perluasan[]" id="tjhpa" value="tjhpa">
                    <label class="form-check-label" for="tjhpa">&nbsp; Tanggung Jawab Hukum
                        terhadap Penumpang limit s.d.</label>
                </div>
                <div class="form-check form-check-inline d-flex">
                    <input class="form-check-input" type="checkbox" name="perluasan[]" id="pad" value="pad">
                    <label class="form-check-label" for="pad">&nbsp; Kecelakaan Diri Supir
                        limit s.d.</label>
                </div>
                <div class="form-check form-check-inline d-flex">
                    <input class="form-check-input" type="checkbox" name="perluasan[]" id="pap" value="pap">
                    <label class="form-check-label" for="pap">&nbsp; Kecelakaan Diri Penumpang
                        limit s.d.</label>
                </div>

            </div>



        </div>
        <!-- button -->
        <div class="row py-5 px-4 justify-content-center">
            <a href="data kendaraan.php" class="col-md-4 btn btn-primary rounded-5">Kembali</a>
            <div class="col-md-2"></div>
            <input type="submit" class="col-md-4 btn rounded-5" style="background-color: #ffa41b" name="submit">
        </div>
    </div>

</div>
<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<script>
    function formatCurrency(input) {
        // Menghilangkan semua karakter selain digit
        var value = input.value.replace(/[^0-9]/g, "");

        // Mengkonversi string ke number
        var number = parseInt(value);

        // Memeriksa apakah nilai input adalah NaN
        if (isNaN(number)) {
            // Mengembalikan nilai kosong jika nilai input adalah NaN
            input.value = "";
        } else {
            // Memformat angka ke dalam format currency
            var formattedValue = "Rp " + number.toLocaleString("id-ID");

            // Mengatur nilai input field dengan format currency
            input.value = formattedValue;
        }
    }

    function muncul() {
        let tjh = document.getElementById('tjh')
        if (tjh.checked) {
            document.getElementById('tjh_select').style.display = 'flex';

        } else {
            document.getElementById('tjh_select').style.display = 'none';

        }


    }
    tjh.addEventListener('change', () => {
        this.muncul();
    })

    
</script>
</body>

</html>