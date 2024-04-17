<?php
session_start();
require_once "function.php";

if (isset($_POST["aksi"]))
  if ($_POST["aksi"] == "add") {
    $tanggal = myPost("tanggal");
    $suhu = myPost("suhu");
    $curah_hujan = myPost("curah_hujan");
    $kecepatan_angin = myPost("kecepatan_angin");

    $sukses = store($tanggal, $suhu, $curah_hujan, $kecepatan_angin);
    if ($sukses) {
      $_SESSION["alert"] = "Data berhasil ditambahkan";
      header("Location: index.php");
    } else {
      echo $stmt;
    }
  }


if (isset($_GET["hapus"])) {
  $sukses = destroy($_GET);
  if ($sukses) {
    $_SESSION["alert"] = "Data berhasil dihapus";
    header("Location: index.php");
  } else {
    echo $stmt;
  }
}
