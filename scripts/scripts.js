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



function formatNomorPlat(input) {
  let nomorPlat = input.value.toUpperCase().replace(/[^A-Z0-9]/g, "");

  let blok1 = "";
  let blok2 = "";
  let blok3 = "";

  const matchBlok1 = nomorPlat.match(/[A-Z]{1,2}/);
  if (matchBlok1) {
    blok1 = matchBlok1[0];
    nomorPlat = nomorPlat.slice(blok1.length);
  }

  const matchBlok2 = nomorPlat.match(/\d{1,4}/);
  if (matchBlok2) {
    blok2 = matchBlok2[0];
    nomorPlat = nomorPlat.slice(blok2.length);
  }

  const matchBlok3 = nomorPlat.match(/[A-Z]{1,3}/);
  if (matchBlok3) {
    blok3 = matchBlok3[0];
  }

  input.value = `${blok1} ${blok2} ${blok3}`;

  return `${blok1}${blok2}${blok3}`;
}

function validasiNomorPlat(input) {
  let nomorPlat = formatNomorPlat(input);
  let pattern = /^[A-Z]{1,2}\s\d{1,4}\s[A-Z]{1,3}$/;

  if (pattern.test(nomorPlat)) {
    input.setCustomValidity("");
  } else {
    input.setCustomValidity("Nomor plat tidak valid");
  }
}

let inputNomorPlat = document.getElementById("plat");
inputNomorPlat.addEventListener("input", function() {
  validasiNomorPlat(this);
});

function disableTable() {
  var radioButtonYa = document.getElementsByName("variasi")[0];

  var formInputs = document.getElementById("table").getElementsByTagName("input");

  for (var i = 0; i < formInputs.length; i++) {
    if (radioButtonYa.checked) {
      formInputs[i].disabled = true;
    } else {
      formInputs[i].disabled = false;
    }
  }
}