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

function ganti_email() {
  const lb_email = document.getElementById("lb-email");
  const email = document.getElementById("email");
  const btn_email = document.getElementById("btn-email");
  const form_email = document.getElementById("form-email");
  const btn_close_email = document.getElementById("btn-close-email");

  email.addEventListener("click", function () {
    lb_email.classList.toggle("d-none");
    btn_email.classList.toggle("d-none");
  });

  btn_email.addEventListener("click", function () {
    lb_email.classList.toggle("d-none");
    email.classList.toggle("d-none");
    btn_email.classList.toggle("d-none");
    form_email.classList.toggle("d-none");
    btn_close_email.classList.toggle("d-none");
  });

  btn_close_email.addEventListener("click", function () {
    lb_email.classList.toggle("d-none");
    email.classList.toggle("d-none");
    btn_email.classList.toggle("d-none");
    form_email.classList.toggle("d-none");
    btn_close_email.classList.toggle("d-none");
  });
}

function ganti_link() {
  const lb_link = document.getElementById("lb-link");
  const link = document.getElementById("link");
  const btn_link = document.getElementById("btn-link");
  const form_link = document.getElementById("form-link");
  const btn_close_link = document.getElementById("btn-close-link");

  link.addEventListener("click", function () {
    lb_link.classList.toggle("d-none");
    btn_link.classList.toggle("d-none");
  });

  btn_link.addEventListener("click", function () {
    lb_link.classList.toggle("d-none");
    link.classList.toggle("d-none");
    btn_link.classList.toggle("d-none");
    form_link.classList.toggle("d-none");
    btn_close_link.classList.toggle("d-none");
  });

  btn_close_link.addEventListener("click", function () {
    lb_link.classList.toggle("d-none");
    link.classList.toggle("d-none");
    btn_link.classList.toggle("d-none");
    form_link.classList.toggle("d-none");
    btn_close_link.classList.toggle("d-none");
  });
}

function ganti_tentang() {
  const lb_tentang = document.getElementById("lb-tentang");
  const tentang = document.getElementById("tentang");
  const btn_tentang = document.getElementById("btn-tentang");
  const form_tentang = document.getElementById("form-tentang");
  const btn_close_tentang = document.getElementById("btn-close-tentang");

  tentang.addEventListener("click", function () {
    lb_tentang.classList.toggle("d-none");
    btn_tentang.classList.toggle("d-none");
  });

  btn_tentang.addEventListener("click", function () {
    lb_tentang.classList.toggle("d-none");
    tentang.classList.toggle("d-none");
    btn_tentang.classList.toggle("d-none");
    form_tentang.classList.toggle("d-none");
    btn_close_tentang.classList.toggle("d-none");
  });

  btn_close_tentang.addEventListener("click", function () {
    lb_tentang.classList.toggle("d-none");
    tentang.classList.toggle("d-none");
    btn_tentang.classList.toggle("d-none");
    form_tentang.classList.toggle("d-none");
    btn_close_tentang.classList.toggle("d-none");
  });
}

function ganti_password() {
  const f1 = document.getElementById("1");
  const f2 = document.getElementById("2");
  const pw = document.getElementById("ganti-password");
  const btn_pw = document.getElementById("btn-close-password");

  f1.addEventListener("click", function () {
    f2.classList.toggle("d-none");
  });

  f2.addEventListener("click", function () {
    f2.classList.toggle("d-none");
    pw.classList.toggle("d-none");
  });

  btn_pw.addEventListener("click", function () {
    pw.classList.toggle("d-none");
  });
}

ganti_username();
ganti_nama();
ganti_email();
ganti_link();
ganti_tentang();
ganti_password();
