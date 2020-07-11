<script>   
$(function(){
        'use strict';
});

var tableDataPelanggan;
var tableDataKendaraan;
$(document).ready(function(){
    tableDataPelanggan = $('#konten-pelanggan').DataTable({
                                "bDestroy": true,
                                "responsive": true,
                                      "language": {
                                        "searchPlaceholder": 'Search...',
                                        "sSearch": '',
                                        "lengthMenu": '_MENU_ items/page',
                                      },
                                "ajax": "<?php echo base_url('view-pelanggan-bengkel'); ?>",
                                "columns" : [  
                                    {"data" :"id"},
                                    {"data" :"nama_pemilik"},
                                    {"data" :"email_pemilik"},            
                                    {"data" :"alamat_pemilik"},            
                                    {"data" :"telepon_pemilik"},            
                                ]
                            } 
                        );

    tableDataKendaraan = $('#konten-kendaraan').DataTable({
                                "bDestroy": true,
                                "responsive": true,
                                      "language": {
                                        "searchPlaceholder": 'Search...',
                                        "sSearch": '',
                                        "lengthMenu": '_MENU_ items/page',
                                      },
                                "ajax": "<?php echo base_url('view-kendaraan-bengkel'); ?>",
                                "columns" : [  
                                    {"data" :"id"},
                                    {"data" :"no_polisi"},
                                    {"data" :"no_rangka"},            
                                    {"data" :"no_mesin"},            
                                    {"data" :"tipe_warna"},            
                                    {"data" :"tahun_produksi"},            
                                ]
                            } 
                        );


    setTimeout( function () {
        tableDataPelanggan.ajax.reload();
    }, 3000);

    // $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
});

</script>
                                        

                                        
                                        