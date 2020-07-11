<?php	
$uri = $this->uri->segment(1);
if ($uri == 'dashboard') {	
	$this->load->view('admin/'.$uri.'/ajax/ajax-'.$uri);
}elseif ($uri == 'laporan-kendaraan') {
	$this->load->view('admin/'.$uri.'/ajax/ajax-'.$uri);	
}elseif ($uri == 'laporan-customer') {
	$this->load->view('admin/'.$uri.'/ajax/ajax-'.$uri);	
}elseif ($uri == 'laporan-profitabilitas') {
	$this->load->view('admin/'.$uri.'/ajax/ajax-'.$uri);	
}elseif ($uri == 'laporan-sparepart') {
	$this->load->view('admin/'.$uri.'/ajax/ajax-'.$uri);	
}elseif ($uri == 'laporan-labarugi') {
	$this->load->view('admin/'.$uri.'/ajax/ajax-'.$uri);	
}elseif ($uri == 'laporan-unit') {
	$this->load->view('admin/'.$uri.'/ajax/ajax-'.$uri);	
}elseif ($uri == 'data-library-service') {
	$this->load->view('admin/'.$uri.'/ajax/ajax-'.$uri);	
}elseif ($uri == 'add-library-service' || $uri == 'edit-library-service') {
	$this->load->view('admin/data-library-service/ajax/ajax-add-library-service');	
}elseif ($uri == 'task-teknisi') {
	$this->load->view($uri.'/ajax/ajax-'.$uri);	
}


// var_dump($uri);die();
if($page == 'pegawai'){
    $this->load->view('admin/pegawai/ajax/ajax-pegawai');    
}elseif ($page == 'kondisi_kendaraan') {	
	$this->load->view('admin/kondisi_kendaraan/ajax/ajax-kondisi-kendaraan');
}elseif ($page == 'penerimaan') {	
	$this->load->view('admin/penerimaan/ajax/ajax-penerimaan');
}elseif ($page == 'add_penerimaan') {	
	$this->load->view('admin/penerimaan/ajax/ajax-add');
}elseif ($page == 'keluhan_permintaan') {	
	$this->load->view('admin/keluhan_permintaan/ajax/ajax-keluhan-permintaan');
}elseif ($page == 'add_keluhan_permintaan') {	
	$this->load->view('admin/keluhan_permintaan/ajax/ajax-add');
}elseif ($page == 'perintah_kerja') {	
	$this->load->view('admin/perintah_kerja/ajax/ajax-perintah-kerja');
}elseif ($page == 'add_perintah_kerja') {	
	$this->load->view('admin/perintah_kerja/ajax/ajax-add');
}elseif ($page == 'add_uraian_pekerjaan') {	
	$this->load->view('admin/uraian_pekerjaan/ajax/ajax-add');
}elseif ($page == 'info_bengkel') {	
	$this->load->view('admin/info_bengkel/ajax/ajax-info-bengkel');
}elseif ($page == 'kategori_sparepart') {	
	$this->load->view('admin/kategori_sparepart/ajax/ajax-kategori-sparepart');
}elseif ($page == 'sparepart') {	
	$this->load->view('admin/sparepart/ajax/ajax-sparepart');
}elseif ($page == 'add_sparepart') {	
	$this->load->view('admin/sparepart/ajax/ajax-add');
}elseif ($page == 'add_transaksi_sparepart') {	
	$this->load->view('admin/transaksi_sparepart/ajax/ajax-add');
}elseif ($page == 'final_check') {	
	$this->load->view('admin/final_check/ajax/ajax-final-check');
}elseif ($page == 'final_checkv2') {	
	$this->load->view('admin/final_check/ajax/ajax-final-checkv2');
}elseif ($page == 'batasan_akses') {	
	$this->load->view('superadmin/batasan_akses/ajax/ajax-batasan-akses');
}elseif ($page == 'data_bengkel') {	
	$this->load->view('superadmin/data_bengkel/ajax/ajax-data-bengkel');
}elseif ($page == 'add_bengkel') {	
	$this->load->view('superadmin/data_bengkel/ajax/ajax-add');
}elseif ($page == 'kasir') {	
	$this->load->view('kasir/ajax/ajax-kasir');
}elseif ($page == 'gudang') {	
	$this->load->view('gudang/ajax/ajax-gudang');
}elseif ($page == 'supplier') {	
	$this->load->view('supplier/ajax/ajax-supplier');
}elseif ($page == 'add-supplier' || $page === 'edit-supplier') {	
	$this->load->view('supplier/ajax/ajax-add-supplier');
}elseif ($page == 'pembelian') {	
	$this->load->view('pembelian/ajax/ajax-pembelian');
}elseif($page == 'lanjutkan-pembelian-pending' || $page == 'pembelian-baru'){
	$data 	=	[
		'grandTotal'	=>	$grandTotal,
		'idPembelian'	=>	$idPembelian
	];
	$this->load->view('pembelian/ajax/ajax-pilih-produk', $data);
}elseif($page === 'penjualan'){
	$this->load->vieW('penjualan/ajax/ajax-penjualan');
}elseif($page == 'lanjutkan-penjualan-pending' || $page == 'penjualan-baru'){
	$data 	=	[
		'grandTotal'	=>	$grandTotal,
		'idPenjualan'	=>	$idPenjualan
	];
	$this->load->view('penjualan/ajax/ajax-pilih-produk', $data);
}

$this->load->view('notif/ajax/ajax-notif');
?>