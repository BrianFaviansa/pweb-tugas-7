<?php
session_start();
require_once "function.php";

if (isset($_POST["aksi"]))
  if ($_POST["aksi"] == "add") {
    $sukses = store($_POST);
    if ($sukses) {
      $_SESSION["alert"] = "Data berhasil ditambahkan";
      header("Location: index.php");
    } else {
      echo $stmt;
    }
  } else if ($_POST["aksi"] == "edit") {
    $sukses = update($_POST);
    if ($sukses) {
      $_SESSION["alert"] = "Data berhasil diperbarui";
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
