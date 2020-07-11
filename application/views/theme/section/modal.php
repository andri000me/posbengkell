<?php	
	if($page == 'pegawai'){
	    $this->load->view('admin/pegawai/modal/modal-pegawai');
	}elseif ($page == 'kondisi_kendaraan') {	
		$this->load->view('admin/kondisi_kendaraan/modal/modal-kondisi-kendaraan');
	}elseif ($page == 'add_penerimaan') {	
		$this->load->view('admin/penerimaan/modal/modal-kondisi-kendaraan');
	}elseif ($page == 'kategori_sparepart') {	
		$this->load->view('admin/kategori_sparepart/modal/modal-kategori-sparepart');
	}elseif ($page == 'add_bengkel') {	
		$this->load->view('superadmin/data_bengkel/modal/modal-admin-manager');
	}elseif ($page == 'final_check' || $page == 'final_checkv2') {
		$this->load->view('admin/final_check/modal/modal-tetapkan-biaya');		
	}elseif ($page == 'kasir') {
		$this->load->view('kasir/modal/modal-diskon-sparepart');		
		$this->load->view('kasir/modal/modal-diskon-pekerjaan');		
	}elseif ($page == 'laporan_kendaraan') {
		$this->load->view('admin/laporan-kendaraan/modal/modal-laporan-kendaraan');		
	}
	
	