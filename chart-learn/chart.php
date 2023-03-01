<script type="text/javascript">
$(function () {
    var bar = new Morris.Bar({
          element: 'tampil',
          resize: true,
          data: [
            {y: 'Statistik Nilai Siswa', a: 100, b: 0, c:95, d:75},
          ],
          barColors: ['#367fa9', '#f56954', '#e08e0b', '#00a65a'],
          xkey: 'y',
          ykeys: ['a', 'b','c','d'],
          labels: ['Nilai Tertinggi', 'Nilai Terendah','Rata-rata','KKM'],
          hideHover: 'auto'
    });
    
});
</script>