<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['logout'] = 'auth/logout';
$route['reset-password'] = 'auth/resetPassword';

// dashboard
$route['dashboard'] = "Dashboard";

// pegawai
$route['data-pegawai'] 		= "admin/Pegawai";
$route['view-pegawai'] 		= "admin/Pegawai/ViewPegawai";
$route['delete-pegawai'] 	= "admin/Pegawai/DeletePegawai";
$route['get-pegawai'] 		= "admin/Pegawai/getPegawai";
$route['save-pegawai'] 		= "admin/Pegawai/SavePegawai";

// penerimaan
$route['data-penerimaan'] 				= "admin/Penerimaan";
$route['view-penerimaan'] 				= "admin/Penerimaan/ViewPenerimaan";
$route['save-penerimaan'] 				= "admin/Penerimaan/SavePenerimaan";
$route['delete-penerimaan'] 			= "admin/Penerimaan/DeletePenerimaan";
$route['view-penerimaan/(:any)'] 		= "admin/Penerimaan/ViewPenerimaan/$1";
$route['view-detail-penerimaan/(:any)'] = "admin/Penerimaan/ViewDetailPenerimaan/$1";
$route['save-detail-penerimaan'] 		= "admin/Penerimaan/SaveDetailPenerimaan";
$route['delete-detail-penerimaan'] 		= "admin/Penerimaan/DeleteDetailPenerimaan";
$route['set-detail-penerimaan'] 		= "admin/Penerimaan/SetDetailPenerimaan";
$route['add-penerimaan'] 				= "admin/Penerimaan/AddPenerimaan";
$route['edit-penerimaan/(:any)'] 		= "admin/Penerimaan/AddPenerimaan/$1";

// data kondisi kendaraan
$route['data-kondisi-kendaraan'] 	= "admin/KondisiKendaraan";
$route['view-kondisi-kendaraan'] 	= "admin/KondisiKendaraan/ViewKondisiKendaraan";
$route['save-kondisi-kendaraan'] 	= "admin/KondisiKendaraan/SaveKondisiKendaraan";
$route['delete-kondisi-kendaraan'] 	= "admin/KondisiKendaraan/DeleteKondisiKendaraan";

//Perintah Kerja
$route['data-perintah-kerja'] 			= "admin/PerintahKerja";
$route['view-perintah-kerja'] 			= "admin/PerintahKerja/ViewPerintahKerja";
$route['view-perintah-kerja/(:any)']	= "admin/PerintahKerja/ViewPerintahKerja/$1";
$route['add-perintah-kerja'] 			= "admin/PerintahKerja/AddPerintahKerja";
$route['edit-perintah-kerja/(:any)'] 	= "admin/PerintahKerja/AddPerintahKerja/$1";
$route['save-perintah-kerja'] 			= "admin/PerintahKerja/SavePerintahKerja";
$route['delete-perintah-kerja'] 		= "admin/PerintahKerja/DeletePerintahKerja";

//Final Check
$route['final-check'] 			= "admin/FinalCheck/index";
$route['final-check/(:any)'] 	= "admin/FinalCheck/index/$1";
$route['save-final-check'] 		= "admin/FinalCheck/SaveFinalCheck";
$route['save-fixing-price'] 	= "admin/FinalCheck/SaveFixingPrice";

//Keluhan & Permintaan
$route['data-keluhan-permintaan/(:any)'] 		= "admin/KeluhanPermintaan/index/$1";
$route['view-keluhan-permintaan/(:any)'] 		= "admin/KeluhanPermintaan/ViewKeluhanPermintaan/$1";
$route['add-keluhan-permintaan/(:any)'] 		= "admin/KeluhanPermintaan/AddKeluhanPermintaan/$1";
$route['edit-keluhan-permintaan/(:any)/(:any)'] = "admin/KeluhanPermintaan/AddKeluhanPermintaan/$1/$2";
$route['save-keluhan-permintaan'] 				= "admin/KeluhanPermintaan/SaveKeluhanPermintaan";
$route['delete-keluhan-permintaan'] 			= "admin/KeluhanPermintaan/DeleteKeluhanPermintaan";

//Uraian Pekerjaan
$route['auto-complete-pekerjaan'] 				= "admin/UraianPekerjaan/AutoCompleteLibraryService";
$route['get-service/(:any)'] 					= "admin/UraianPekerjaan/GetLibraryService/$1";
$route['view-uraian-pekerjaan/(:any)'] 			= "admin/UraianPekerjaan/ViewUraianPekerjaan/$1";
$route['add-uraian-pekerjaan/(:any)'] 			= "admin/UraianPekerjaan/AddUraianPekerjaan/$1";
$route['edit-uraian-pekerjaan/(:any)/(:any)'] 	= "admin/UraianPekerjaan/AddUraianPekerjaan/$1/$2";
$route['save-uraian-pekerjaan'] 				= "admin/UraianPekerjaan/SaveUraianPekerjaan";
$route['delete-uraian-pekerjaan'] 				= "admin/UraianPekerjaan/DeleteUraianPekerjaan";
$route['get-uraian-pekerjaan'] 					= "admin/UraianPekerjaan/GetUraianPekerjaan";

//Info Bengkel
$route['info-bengkel'] 			= "admin/InfoBengkel";
$route['save-info-bengkel'] 	= "admin/InfoBengkel/SaveInfoBengkel";
$route['change-logo-bengkel'] 	= "admin/InfoBengkel/ChangeLogoBengkel";

//Kategori SparePart
$route['data-kategori-sparepart'] 	= "admin/KategoriSparePart";
$route['view-kategori-sparepart'] 	= "admin/KategoriSparePart/ViewKategoriSparePart";
$route['save-kategori-sparepart'] 	= "admin/KategoriSparePart/SaveKategoriSparePart";
$route['delete-kategori-sparepart'] = "admin/KategoriSparePart/DeleteKategoriSparePart";

$route['data-library-service'] 		    = "admin/LibraryService";
$route['view-library-service'] 		    = "admin/LibraryService/View";
$route['delete-library-service'] 	    = "admin/LibraryService/Delete";
$route['add-library-service'] 	        = "admin/LibraryService/Add";
$route['edit-library-service/(:any)'] 	= "admin/LibraryService/Add/$1";
$route['save-library-service'] 	= "admin/LibraryService/Save";

//SparePart
$route['data-sparepart'] 		= "admin/SparePart";
$route['view-sparepart'] 		= "admin/SparePart/ViewSparePart";
$route['save-sparepart'] 		= "admin/SparePart/SaveSparePart";
$route['delete-sparepart'] 		= "admin/SparePart/DeleteSparePart";
$route['add-sparepart'] 		= "admin/SparePart/AddSparePart";
$route['edit-sparepart/(:any)'] = "admin/SparePart/AddSparePart/$1";

//Trx SparePart
$route['auto-complete-sparepart'] 					= "admin/TransaksiSparePart/AutoCompleteSparePart";
$route['get-sparepart/(:any)'] 						= "admin/TransaksiSparePart/GetSparePart/$1";
$route['view-transaksi-sparepart/(:any)'] 			= "admin/TransaksiSparePart/ViewTransaksiSparePart/$1";
$route['add-transaksi-sparepart/(:any)'] 			= "admin/TransaksiSparePart/AddTransaksiSparePart/$1";
$route['edit-transaksi-sparepart/(:any)/(:any)'] 	= "admin/TransaksiSparePart/AddTransaksiSparePart/$1/$2";
$route['save-transaksi-sparepart'] 					= "admin/TransaksiSparePart/SaveTransaksiSparePart";
$route['delete-transaksi-sparepart'] 				= "admin/TransaksiSparePart/DeleteTransaksiSparePart";

//Document
$route['dokumen-serah-terima/(:any)'] 	= "admin/Dokumen/SerahTerima/$1";
$route['dokumen-perintah-kerja/(:any)'] = "admin/Dokumen/PerintahKerja/$1";
$route['dokumen-hasil-diagnosa/(:any)'] = "admin/Dokumen/HasilDiagnosa/$1";
$route['dokumen-invoice/(:any)'] 		= "admin/Dokumen/Invoice/$1";
$route['dokumen-kwitansi/(:any)'] 		= "admin/Dokumen/Kwitansi/$1";


// Batasan Akses
$route['batasan-akses'] 		= "superadmin/BatasanAkses";
$route['view-batasan-akses'] 	= "superadmin/BatasanAkses/ViewBatasanAkses";



$route['task-teknisi'] 	            = "KaTeknisi";
$route['view-task-teknisi/(:any)'] 	= "KaTeknisi/View/$1";
$route['done-task/(:any)'] 	            = "KaTeknisi/DoneTask/$1";


// Data Bengkel
$route['data-bengkel'] 						= "superadmin/DataBengkel";
$route['view-data-bengkel'] 				= "superadmin/DataBengkel/ViewDataBengkel";
$route['view-admin-manager/(:any)'] 		= "superadmin/DataBengkel/ViewAdminManager/$1";
$route['add-bengkel'] 						= "superadmin/DataBengkel/AddBengkel";
$route['edit-bengkel/(:any)'] 				= "superadmin/DataBengkel/AddBengkel/$1";
$route['superadmin-save-info-bengkel'] 		= "superadmin/DataBengkel/SaveInfoBengkel";
$route['superadmin-change-logo-bengkel'] 	= "superadmin/DataBengkel/ChangeLogoBengkel";
$route['superadmin-delete-bengkel'] 		= "superadmin/DataBengkel/DeleteBengkel";
$route['get-admin-manager'] 				= "superadmin/DataBengkel/GetAdminManager";
$route['save-admin-manager'] 				= "superadmin/DataBengkel/SaveAdminManager";
$route['delete-admin-manager'] 				= "superadmin/DataBengkel/DeleteAdminManager";

$route['kasir'] 				= "Kasir";
$route['bayar-kasir'] 			= "Kasir/Bayar";
$route['tagihan-kasir/(:any)'] 	= "Kasir/Tagihan/$1";

$route['tugas-gudang'] 					= "Gudang";
$route['view-tugas-gudang/(:any)'] 		= "Gudang/viewTugasGudang/$1";
$route['give-item/(:any)'] 				= "Gudang/giveIt/$1";


$route['load-unseen-notification'] 		= "MyNotification";
$route['update-status-notification/(:any)'] 		= "MyNotification/updateNotif/$1";

$route['view-pelanggan-bengkel']		= "admin/LaporanCustomer/view";
$route['view-kendaraan-bengkel']		= "admin/LaporanKendaraan/view";
$route['view-laporan-profitabilitas']	= "admin/LaporanProfitabilitas/view";
$route['view-laporan-sparepart']		= "admin/LaporanSparepart/view";
$route['view-laporan-labarugi']			= "admin/LaporanLabaRugi/view";
$route['view-laporan-unit']				= "admin/LaporanUnit/view";

$route['laporan-customer']		        = "admin/LaporanCustomer";
$route['laporan-kendaraan']		        = "admin/LaporanKendaraan";
$route['kendaraan-excel']		        = "admin/LaporanKendaraan/export/excel";
$route['kendaraan-pdf']		            = "admin/LaporanKendaraan/export/pdf";
$route['laporan-profitabilitas']        = "admin/LaporanProfitabilitas";
$route['profitabilitas-excel']          =   'admin/LaporanProfitabilitas/export/excel';
$route['profitabilitas-pdf']            =   'admin/LaporanProfitabilitas/export/pdf';
$route['laporan-sparepart']		        = "admin/LaporanSparepart";
$route['sparepart-pdf']		            = "admin/LaporanSparepart/export/pdf";
$route['sparepart-excel']		        = "admin/LaporanSparepart/export/excel";
$route['laporan-labarugi']		        = "admin/LaporanLabaRugi";
$route['labarugi-excel']		        = "admin/LaporanLabaRugi/export/excel";
$route['labarugi-pdf']		            = "admin/LaporanLabaRugi/export/pdf";
$route['laporan-unit']			        = "admin/LaporanUnit";
$route['unit-pdf']			            = "admin/LaporanUnit/export/pdf";
$route['unit-excel']			        = "admin/LaporanUnit/export/excel";
$route['customer-excel']                =   'admin/LaporanCustomer/customerExport/excel';
$route['customer-pdf']                  =   'admin/LaporanCustomer/customerExport/pdf';

$route['view-laporan-trx-kendaraan']		= "admin/LaporanKendaraan/viewHistoryTransaction";

/* Supplier */
$route['autocomplete-supplier']  =   'supplier/autocompleteSupplier';
$route['data-supplier']         =   'supplier/listDataSupplier';
$route['add-supplier']          =   'supplier/addSupplier';
$route['edit-supplier/(:any)']  =   'supplier/addSupplier/$1';
$route['save-supplier']         =   'supplier/saveSupplier';
$route['save-supplier/(:any)']  =   'supplier/saveSupplier/$1';
$route['delete-supplier']       =   'supplier/deleteSupplier';

/* Pembelian */
$route['pembelian']                             =   'pembelian';
$route['data-pembelian']                        =   'pembelian/dataPembelian';
$route['detail-pembelian/(:any)']               =   'pembelian/detailPembelian/$1';
$route['detail-pembelian-pdf/(:any)']           =   'pembelian/exportDetailPembelian/pdf/$1';
$route['create-pembelian-baru']                 =   'pembelian/createPembelianBaru';
$route['pembelian-pending']                     =   'pembelian/pembelianPending';
$route['lanjutkan-pembelian-pending/(:any)']    =   'pembelian/lanjutkanPembelianPending/$1';
$route['tambah-item-pembelian']                 =   'pembelian/tambahItemPembelian';
$route['hapus-item-pembelian']                  =   'pembelian/hapusItemPembelian';
$route['batalkan-pembelian']                    =   'pembelian/batalkanPembelian';
$route['selesaikan-pembelian']                  =   'pembelian/selesaikanPembelian';
$route['pembelian-baru']                        =   'pembelian/lanjutkanPembelianPending';
$route['pembelian-cek-item/(:any)']             =   'pembelian/cekItem/$1';
$route['pembelian-cek-item-selesai/(:any)']     =   'pembelian/pengecekanSelesai/$1';
$route['cetak-surat-jalan-pembelian/(:any)']    =   'pembelian/cetakSuratJalan/$1';

/* Penjualan */
$route['penjualan']                             =   'penjualan';
$route['data-penjualan']                        =   'penjualan/dataPenjualan';
$route['detail-penjualan/(:any)']               =   'penjualan/detailPenjualan/$1';
$route['penjualan-pending']                     =   'penjualan/penjualanPending';
$route['create-penjualan-baru']                 =   'penjualan/createPenjualanBaru';
$route['lanjutkan-penjualan-pending/(:any)']    =   'penjualan/lanjutkanPenjualanPending/$1';
$route['tambah-item-penjualan']                 =   'penjualan/tambahItemPenjualan'; #perlu dites
$route['hapus-item-penjualan']                  =   'penjualan/hapusItemPenjualan'; #perlu dites
$route['batalkan-penjualan']                    =   'penjualan/batalkanPenjualan'; #perlu dites
$route['selesaikan-penjualan']                  =   'penjualan/selesaikanPenjualan'; #perlu dites
$route['penjualan-baru']                        =   'penjualan/lanjutkanPenjualanPending';
$route['laporan-penjualan']                     =   'penjualan/laporanPenjualan';
$route['cek-item-penjualan']                    =   'penjualan/cekItemPenjualan';
$route['cek-item-penjualan/(:any)']             =   'penjualan/cekItemPenjualan/$1';
$route['penjualan-cek-item-selesai/(:any)']     =   'penjualan/pengecekanSelesai/$1';
$route['cetak-surat-jalan-penjualan/(:any)']    =   'penjualan/cetakSuratJalan/$1';
$route['detail-penjualan-pdf/(:any)']           =   'penjualan/exportDetailPenjualan/pdf/$1';
$route['pembayaran-penjualan-selesai']          =   'penjualan/pembayaran';
$route['pembayaran-penjualan-selesai/(:any)']   =   'penjualan/pembayaran/$1';
$route['penjualan-lunas/(:any)']                =   'penjualan/lunas/$1';
