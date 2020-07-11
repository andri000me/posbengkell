<script>    
$(function(){
    'use strict';
});

var tableData;

$(document).ready(function(){
    tableData = $('#konten').DataTable({
        "bDestroy": true,
        "responsive": true,
              "language": {
                "searchPlaceholder": 'Search...',
                "sSearch": '',
                "lengthMenu": '_MENU_ items/page',
              },
        "ajax": "<?php echo base_url('view-batasan-akses'); ?>",
        "columns" : [  
            {"data" :"id"},
            {"data" :"role"},
            {"data" :"dashboard"},
            {"data" :"data_bengkel"}, 
            {"data" :"data_pegawai"}, 
            {"data" :"data_penerimaan"}, 
            {"data" :"data_perintah_kerja"}, 
            {"data" :"data_sparepart"}, 
            {"data" :"master_data"}, 
            {"data" :"admin"}, 
            {"data" :"manager"}, 
            {"data" :"kategori_sparepart"}, 
            {"data" :"kondisi_kendaraan"}, 
            {"data" :"info_bengkel"},
            {"data" :"batasan_akses"},
            // {"data" : null,
            //      "render":function(data){
            //         return '<a style="margin:2px" href="<?php echo base_url('edit-penerimaan/'); ?>'+data.id+'" class="btn btn-teal"><i class="ion-ios-create"></i></a> '+
            //         		' <button  style="margin:2px" class="btn btn-danger " onclick=deletePenerimaan("'+data.id+'");><i class="ion-ios-trash"></i></button> ';
            //     }
            // },
        ]
    } 
);


setTimeout( function () {
    tableData.ajax.reload();
}, 3000);

// $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

});

</script>
                                        

                                        
                                        