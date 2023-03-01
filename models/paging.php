<?php
class Paging {
	private $recordPerHalaman = 10;
	private $jumlahDisplayHalaman = 10;
	private $SQLSelectData = '';
	private $SQLCountData = '';
	
	// menentukan jumlah record yang ditampilkan di halaman
	public function setRecordPerHalaman($recordPerHalaman) {
		$this->recordPerHalaman = $recordPerHalaman;
	}
	
	//menentukan jumlah halaman yang ditampilkan pada browser
	public function setJumlahDisplayHalaman($jumlahDisplayHalaman) {
		$this->jumlahDisplayHalaman = $jumlahDisplayHalaman;
	}
	
	//Digunakan untuk mengkonfigurasi SQL yang akan digunakan untuk membangkitkan data
	public function setSQLSelectData($SQLSelectData) {
		$this->SQLSelectData = $SQLSelectData;
	}
	
	//Digunakan untuk mengkonfigurasi SQL yang digunakan untuk menghitung data
	public function setSQLCountData($SQLCountData) {
		$this->SQLCountData = $SQLCountData;
	}
	
	//Mendapatkan jumlah record data
	public function getJumlahRecord() {
		if ($this->SQLCountData == '') {
			die ( "Data::Variabel SQL untuk Perhitungan Data belum dikonfigurasi" );
		}
		$recordset = mysql_query ( $this->SQLCountData );
		if ($recordset) {
			$data = mysql_fetch_row ( $recordset );
			return $data [0];
		} else {
			die ( "Data::var SQL Count salah" );
		}
	}
	
	//Mendapatkan data dari halaman yang ditentukan
	public function getData($page) {
		if ($page == 0) {
			$page = 1;
		}
		
		$offset = ($page - 1) * $this->recordPerHalaman;
		$sqlText = $this->SQLSelectData . " LIMIT $offset," . $this->recordPerHalaman;
		$recordset = mysql_query ( $sqlText ) or die ( mysql_error () );
		while ( $record = mysql_fetch_array ( $recordset ) ) {
			$data [] = $record;
		}
		return $data;
	}
	
	//Mendapatkan jumlah halaman yang dibutuhkan
	public function getJumlahHalaman() {
		$jumlahRecord = $this->getJumlahRecord ();
		$jumlahHalaman = ceil ( $jumlahRecord / $this->recordPerHalaman );
		return $jumlahHalaman;
	}
	
	//Mendapatkan range awal halaman yg ditampilkan
	public function getStartPage($page) {
		if ($page % $this->jumlahDisplayHalaman == 0) {
			$x = (floor ( $page / $this->jumlahDisplayHalaman ) - 1) * $this->jumlahDisplayHalaman + 1;
		} else {
			$x = floor ( $page / $this->jumlahDisplayHalaman ) * $this->jumlahDisplayHalaman + 1;
		}
		return $x;
	}
	
	//Mendapatkan range halaman akhir yang ditampilkan
	public function getEndPage($startPage) {
		$i = 1;
		while ( ($i <= $this->jumlahDisplayHalaman) && ($startPage <= $this->getJumlahHalaman ()) ) {
			$startPage ++;
			$i ++;
		}
		$endPage = $startPage - 1;
		return $endPage;
	}
}
?>