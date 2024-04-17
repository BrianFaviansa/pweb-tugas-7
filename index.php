<?php
session_start();
require_once "function.php";

fetchAll();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cuaca Jember</title>
  <!-- flowbite css -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

  <!-- highchart js -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
</head>

<body>
  <div class="container mt-8 mx-auto">
    <h1 class="text-5xl font-medium dark:text-white text-center">Pendataan Suhu, Curah Hujan, dan Kecepatan Angin di Jember</h1>
    <a href="form.php" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-10">Tambah Data</a>
    <?php if (isset($_SESSION["alert"])) : ?>
      <div id="alert-3" class="flex mt-4 items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
      <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
      </svg>
      <span class="sr-only">Info</span>
      <div class="ms-3 text-sm font-medium">
       <?= $_SESSION["alert"]; ?>
      </div>
      <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
      </button>
    </div>
    <?php
      session_destroy();
      endif;
    ?>

    <div class="mt-6">
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">
                No
              </th>
              <th scope="col" class="px-6 py-3">
                Tanggal
              </th>
              <th scope="col" class="px-6 py-3">
                Suhu (°C)
              </th>
              <th scope="col" class="px-6 py-3">
                Curah Hujan (mm)
              </th>
              <th scope="col" class="px-6 py-3">
                Kecepatan Angin (km/jam)
              </th>
              <th scope="col" class="px-6 py-3">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            <?php $counter = 0; ?>
            <?php foreach ($rows as $row) : ?>
              <?php $counter++; ?>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  <?= $counter ?>
                </th>
                <td class="px-6 py-4">
                  <?= $row["tanggal"] ?>
                </td>
                <td class="px-6 py-4">
                  <?= $row["suhu"] ?>
                </td>
                <td class="px-6 py-4">
                  <?= $row["curah_hujan"] ?>
                </td>
                <td class="px-6 py-4">
                  <?= $row["kecepatan_angin"] ?>
                </td>
                <td class="px-6 py-4">
                  <a href="form.php?edit=<?= $row["id"] ?>" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Edit</a>
                  <a href="handle.php?hapus=<?= $row["id"] ?>" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" onclick="return confirm('Apakah anda yakin ingin menghapus data tersebut?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="mt-6" id="chartContainer"></div>

    <script>
      // Prepare data for chart
      var data = [];
      <?php 
      // Sort $rows by tanggal in ascending order
      usort($rows, function($a, $b) {
        return strtotime($a['tanggal']) - strtotime($b['tanggal']);
      });
      foreach ($rows as $row) : ?>
      data.push({
        tanggal: "<?= $row["tanggal"] ?>",
        suhu: <?= $row["suhu"] ?>,
        curah_hujan: <?= $row["curah_hujan"] ?>,
        kecepatan_angin: <?= $row["kecepatan_angin"] ?>
      });
      <?php endforeach; ?>

      // Create chart
      Highcharts.chart('chartContainer', {
      chart : {
        type: 'line'
      },
      title: {
        text: 'Tren Data Cuaca Jember'
      },
      xAxis: {
        categories: data.map(item => item.tanggal)
      },
      yAxis: {
        title: {
        text: 'Value'
        }
      },
      series: [{
        name: 'Suhu (°C)',
        data: data.map(item => item.suhu)
      }, {
        name: 'Curah Hujan (mm)',
        data: data.map(item => item.curah_hujan)
      }, {
        name: 'Kecepatan Angin (km/jam)',
        data: data.map(item => item.kecepatan_angin)
      }]
      });
    </script>

  </div>

  <!-- flowbite js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>