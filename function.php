<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "tugas-7";

$conn = mysqli_connect($server, $username, $password, $dbname);

if (empty($conn->error) == false) {
  echo "kesalahan koneksi ke database, " . $conn->connect_error;
  die();
}

$rows = [];

function myPost($key)
{
  if (isset($_POST[$key])) {
    return $_POST[$key];
  }
  return '';
}

function fetchAll()
{
  global $conn, $rows;

  $query = $conn->query("SELECT * FROM tracking_cuaca order by tanggal desc");


  if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
      $rows[] = [
        'id' => $row['id'],
        'tanggal' => $row['tanggal'],
        'suhu' => $row['suhu'],
        'curah_hujan' => $row['curah_hujan'],
        'kecepatan_angin' => $row['kecepatan_angin'],
      ];
    }
  }
  return $rows;
}


function fetchOne($id)
{
  global $conn;

  $stmt = $conn->prepare("SELECT * FROM tracking_cuaca WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $result = [
      'id' => $row['id'],
      'tanggal' => $row['tanggal'],
      'suhu' => $row['suhu'],
      'curah_hujan' => $row['curah_hujan'],
      'kecepatan_angin' => $row['kecepatan_angin'],
    ];
    return $result;
  } else {
    return null;
  }
}


function store($tanggal, $suhu, $curah_hujan, $kecepatan_angin)
{
  global $conn;
  $stmt = $conn->prepare('INSERT INTO tracking_cuaca (tanggal,suhu,curah_hujan,kecepatan_angin) VALUES(?,?,?,?)');
  $stmt->bind_param("ssss", $tanggal, $suhu, $curah_hujan, $kecepatan_angin);
  $stmt->execute();

  $stmt->close();
  $conn->close();
  return true;
}


function destroy($data)
{
  global $conn;
  $id = $data['hapus'];
  $stmt = $conn->prepare('DELETE FROM tracking_cuaca WHERE id = ?');
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $stmt->close();
  $conn->close();
  header("Location: index.php");
  return true;
}
