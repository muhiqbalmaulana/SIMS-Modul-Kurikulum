 <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="content">
          <div class="row">
            <div class="col-md-6">
              <!-- AREA CHART -->
              <?php require 'chain2.php'; ?>
              <?php require 'chain_dua.php'; ?>
            </div>

            <div class="col-md-6">
              <?php require 'chain_tiga.php'; ?>
              <?php require 'chain_empat.php'; ?>
            </div>
          </div>
        </section>
      </div>
    
  <script>
  /*$(function () {
    "use strict";

    // AREA CHART
    /*var bar = new Morris.Bar({
      element: 'revenue-chart',
      resize: true,
      data: [
        {y: 'Statistik Nilai Siswa', a:<?php //include('koneksi.php'); echo $satu; ?> , b:<?php //echo $dua; ?>, c:<?php //echo $tiga; ?>, d:75},
      ],
      barColors: ['#367fa9', '#f56954', '#e08e0b', '#00a65a'],
      xkey: 'y',
      ykeys: ['a', 'b','c','d'],
      labels: ['Nilai Tertinggi', 'Nilai Terendah','Rata-rata','KKM'],
      hideHover: 'auto'
    });*/

    // LINE CHART
    /*var bar = new Morris.Bar({
      element: 'line-chart',
      resize: true,
      data: [<?php //include('koneksi.php');?>
        {y: 'Statistik Nilai Siswa', a:<?php //include('koneksi.php'); echo $empat; ?> , b:<?php //echo $lima; ?>, c:<?php //echo $enam; ?>, d:75},
      ],
      barColors: ['#367fa9', '#f56954', '#e08e0b', '#00a65a'],
      xkey: 'y',
      ykeys: ['a', 'b','c','d'],
      labels: ['Nilai Tertinggi', 'Nilai Terendah','Rata-rata','KKM'],
      hideHover: 'auto'
    });

    //DONUT CHART
    var bar = new Morris.Bar({
      element: 'sales-chart',
      resize: true,
      data: [
        {y: 'Statistik Nilai Siswa', a:<?php //include('koneksi.php'); echo $tujuh; ?> , b:<?php //echo $delapan; ?>, c:<?php //echo $sembilan; ?>, d:75},
      ],
      barColors: ['#367fa9', '#f56954', '#e08e0b', '#00a65a'],
      xkey: 'y',
      ykeys: ['a', 'b','c','d'],
      labels: ['Nilai Tertinggi', 'Nilai Terendah','Rata-rata','KKM'],
      hideHover: 'auto'
    });

    var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: [
            {y: 'Statistik Nilai Siswa', a: 100, b: 90, c:95, d:75},
          ],
          barColors: ['#367fa9', '#f56954', '#e08e0b', '#00a65a'],
          xkey: 'y',
          ykeys: ['a', 'b','c','d'],
          labels: ['Nilai Tertinggi', 'Nilai Terendah','Rata-rata','KKM'],
          hideHover: 'auto'
    });
  }); */
  </script>