function getCity(prov_id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("kota").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "ajax/getCity.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("provinsi=" + prov_id);
}

function getKecamatan(city_id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("kecamatan").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "ajax/getKecamatan.php", true)
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("kota=" + city_id)
}

function getKelurahan(dis_id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("kelurahan").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "ajax/getKelurahan.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("kecamatan=" + dis_id);
}

function getKodePos(subdis_id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('kodepos').value = this.responseText;
        }
    };
    xhttp.open("POST", "ajax/getKodePos.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("kelurahan=" + subdis_id)
}

function getCarModel(merek_id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("model").innerHTML = this.responseText;
      }
    };
    xhttp.open("POST", "ajax/getModel.php", true);
    xhttp.setRequestHeader("Content-Type", "Application/x-www-form-urlencoded");
    xhttp.send("merek=" + merek_id)
  }