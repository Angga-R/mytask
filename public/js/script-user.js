const foto = document.getElementById("foto");
const ganti_foto = document.getElementById("ganti-foto");
const info = document.getElementById("info");

function previewImg() {
  const choose_file = document.querySelector("#choose-file");

  // buat ngeganti preview img
  const file = new FileReader();
  file.readAsDataURL(choose_file.files[0]);
  file.onload = function (e) {
    info.classList.toggle("d-none");
    foto.src = e.target.result;
  };
}

foto.addEventListener("click", function () {
  ganti_foto.classList.toggle("d-none");
});

function ganti_nama() {
  const lb_nama = document.getElementById("lb-nama");
  const nama = document.getElementById("nama");
  const btn_nama = document.getElementById("btn-nama");
  const form_nama = document.getElementById("form-nama");
  const btn_close_nama = document.getElementById("btn-close-nama");

  nama.addEventListener("click", function () {
    lb_nama.classList.toggle("d-none");
    btn_nama.classList.toggle("d-none");
  });

  btn_nama.addEventListener("click", function () {
    lb_nama.classList.toggle("d-none");
    nama.classList.toggle("d-none");
    btn_nama.classList.toggle("d-none");
    form_nama.classList.toggle("d-none");
    btn_close_nama.classList.toggle("d-none");
  });

  btn_close_nama.addEventListener("click", function () {
    lb_nama.classList.toggle("d-none");
    nama.classList.toggle("d-none");
    btn_nama.classList.toggle("d-none");
    form_nama.classList.toggle("d-none");
    btn_close_nama.classList.toggle("d-none");
  });
}

function ganti_username() {
  const lb_username = document.getElementById("lb-username");
  const username = document.getElementById("username");
  const btn_username = document.getElementById("btn-username");
  const form_username = document.getElementById("form-username");
  const btn_close_username = document.getElementById("btn-close-username");

  username.addEventListener("click", function () {
    lb_username.classList.toggle("d-none");
    btn_username.classList.toggle("d-none");
  });

  btn_username.addEventListener("click", function () {
    lb_username.classList.toggle("d-none");
    username.classList.toggle("d-none");
    btn_username.classList.toggle("d-none");
    form_username.classList.toggle("d-none");
    btn_close_username.classList.toggle("d-none");
  });

  btn_close_username.addEventListener("click", function () {
    lb_username.classList.toggle("d-none");
    username.classList.toggle("d-none");
    btn_username.classList.toggle("d-none");
    form_username.classList.toggle("d-none");
    btn_close_username.classList.toggle("d-none");
  });
}

function ganti_gender() {
  const lb_gender = document.getElementById("lb-gender");
  const gender = document.getElementById("gender");
  const btn_gender = document.getElementById("btn-gender");
  const form_gender = document.getElementById("form-gender");
  const btn_close_gender = document.getElementById("btn-close-gender");

  gender.addEventListener("click", function () {
    lb_gender.classList.toggle("d-none");
    btn_gender.classList.toggle("d-none");
  });

  btn_gender.addEventListener("click", function () {
    lb_gender.classList.toggle("d-none");
    gender.classList.toggle("d-none");
    btn_gender.classList.toggle("d-none");
    form_gender.classList.toggle("d-none");
    btn_close_gender.classList.toggle("d-none");
  });

  btn_close_gender.addEventListener("click", function () {
    lb_gender.classList.toggle("d-none");
    gender.classList.toggle("d-none");
    btn_gender.classList.toggle("d-none");
    form_gender.classList.toggle("d-none");
    btn_close_gender.classList.toggle("d-none");
  });
}

function ganti_pertanyaan() {
  const lb_pertanyaan = document.getElementById("lb-pertanyaan");
  const pertanyaan = document.getElementById("pertanyaan");
  const btn_pertanyaan = document.getElementById("btn-pertanyaan");
  const form_pertanyaan = document.getElementById("form-pertanyaan");
  const btn_close_pertanyaan = document.getElementById("btn-close-pertanyaan");

  pertanyaan.addEventListener("click", function () {
    lb_pertanyaan.classList.toggle("d-none");
    btn_pertanyaan.classList.toggle("d-none");
  });

  btn_pertanyaan.addEventListener("click", function () {
    lb_pertanyaan.classList.toggle("d-none");
    pertanyaan.classList.toggle("d-none");
    btn_pertanyaan.classList.toggle("d-none");
    form_pertanyaan.classList.toggle("d-none");
    btn_close_pertanyaan.classList.toggle("d-none");
  });

  btn_close_pertanyaan.addEventListener("click", function () {
    lb_pertanyaan.classList.toggle("d-none");
    pertanyaan.classList.toggle("d-none");
    btn_pertanyaan.classList.toggle("d-none");
    form_pertanyaan.classList.toggle("d-none");
    btn_close_pertanyaan.classList.toggle("d-none");
  });
}

function ganti_jawaban() {
  const lb_jawaban = document.getElementById("lb-jawaban");
  const jawaban = document.getElementById("jawaban");
  const btn_jawaban = document.getElementById("btn-jawaban");
  const form_jawaban = document.getElementById("form-jawaban");
  const btn_close_jawaban = document.getElementById("btn-close-jawaban");

  jawaban.addEventListener("click", function () {
    lb_jawaban.classList.toggle("d-none");
    btn_jawaban.classList.toggle("d-none");
  });

  btn_jawaban.addEventListener("click", function () {
    lb_jawaban.classList.toggle("d-none");
    jawaban.classList.toggle("d-none");
    btn_jawaban.classList.toggle("d-none");
    form_jawaban.classList.toggle("d-none");
    btn_close_jawaban.classList.toggle("d-none");
  });

  btn_close_jawaban.addEventListener("click", function () {
    lb_jawaban.classList.toggle("d-none");
    jawaban.classList.toggle("d-none");
    btn_jawaban.classList.toggle("d-none");
    form_jawaban.classList.toggle("d-none");
    btn_close_jawaban.classList.toggle("d-none");
  });
}

function ganti_password() {
  const lb_password = document.getElementById("lb-password");
  const password = document.getElementById("password");
  const btn_password = document.getElementById("btn-password");
  const form_password = document.getElementById("form-password");
  const btn_close_password = document.getElementById("btn-close-password");

  password.addEventListener("click", function () {
    lb_password.classList.toggle("d-none");
    btn_password.classList.toggle("d-none");
  });

  btn_password.addEventListener("click", function () {
    lb_password.classList.toggle("d-none");
    password.classList.toggle("d-none");
    btn_password.classList.toggle("d-none");
    form_password.classList.toggle("d-none");
    btn_close_password.classList.toggle("d-none");
  });

  btn_close_password.addEventListener("click", function () {
    lb_password.classList.toggle("d-none");
    password.classList.toggle("d-none");
    btn_password.classList.toggle("d-none");
    form_password.classList.toggle("d-none");
    btn_close_password.classList.toggle("d-none");
  });
}

ganti_nama();
ganti_username();
ganti_gender();
ganti_pertanyaan();
ganti_jawaban();
ganti_password();
