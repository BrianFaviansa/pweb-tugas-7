<?php  
require_once "function.php";

if(isset($_GET['edit'])) {
  $id = $_GET["edit"];
  $result = fetchOne($id);
  $tanggal = $result['tanggal'];
  $suhu = $result['suhu'];
  $curah_hujan = $result['curah_hujan'];
  $kecepatan_angin = $result['kecepatan_angin'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cuaca Jember</title>
  <!-- flowbite css -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>
  <h2 class="text-4xl font-bold dark:text-white text-center mt-6">Tambah Riwayat Suhu, Curah Hujan, dan Kecepatan Angin</h2>
  <div class="container mt-4 mx-auto flex justify-center items-center">

    <div class="mt-6 flex justify-center items-center shadow-lg py-3 px-4 rounded-lg max-w-md">
      <form action="handle.php" method="post">
        <input type="hidden" value="<?= $id ?>" name="id">
        <div class="my-3">
          <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
          <input type="date" name="tanggal" id="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= $tanggal; ?>" required>
        </div>
        <div class="my-3">
          <label for="suhu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Suhu (°C)</label>
          <input type="number" name="suhu" id="suhu" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Suhu" value="<?= $suhu; ?>" required />
        </div>
        <div class="my-3">
          <label for="curah_hujan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Curah Hujan (mm)</label>
          <input type="number" name="curah_hujan" id="curah_hujan" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Curah Hujan" value="<?= $curah_hujan; ?>" required />
        </div>
        <div class="my-3">
          <label for="kecepatan_angin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecepatan Angin (km/jam)</label>
          <input type="number" name="kecepatan_angin" id="kecepatan_angin" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Kecepatan Angin" value="<?= $kecepatan_angin; ?>" required />
        </div>
        <a href="index.php" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</a>
        <?php if (isset($_GET["edit"])) : ?>
          <button type="submit" name="aksi" value="edit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Simpan Perubahan</button>
        <?php else : ?>
          <button type="submit" name="aksi" value="add" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambahkan</button>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <!-- flowbite js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
</body>

</html>