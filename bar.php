
<?
 include('koneksi.php'); 
 if (isset($error)) {
  echo '<b>Error</b>: <br />'.implode('<br />', $error);
} else {
  /*
  
  */

  $data = $_POST['pelajaran'];

  $tampilmaxi=mysql_query("SELECT MAX(UAS) FROM nilai_akhir WHERE kode_pelajaran='$data';");
    $empat=mysql_result($tampilmaxi,0);

    $tampilmini=mysql_query("SELECT MIN(UAS) FROM nilai_akhir WHERE kode_pelajaran='$data';");
    $lima=mysql_result($tampilmini,0);

    $tampilavgi=mysql_query("SELECT AVG(UAS) FROM nilai_akhir WHERE kode_pelajaran='$data';");
    $enam=mysql_result($tampilavgi,0);

  }
  ?>

  <script>
  $(function () {
    "use strict";

    // AREA CHART
    var bar = new Morris.Bar({
      element: 'revenue-chart',
      resize: true,
      data: [
        {y: 'Statistik Nilai Siswa', a:<?php echo $empat; ?> , b:<?php echo $lima; ?>, c:<?php echo $enam; ?>, d:75},
      ],
      barColors: ['#367fa9', '#f56954', '#e08e0b', '#00a65a'],
      xkey: 'y',
      ykeys: ['a', 'b','c','d'],
      labels: ['Nilai Tertinggi', 'Nilai Terendah','Rata-rata','KKM'],
      hideHover: 'auto'
    });
  });
  </script>