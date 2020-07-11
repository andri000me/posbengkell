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
        "ajax": "<?php echo base_url('view-data-bengkel'); ?>",
        "columns" : [  
            {"data" :"id"},
            {"data" :"nama_pemilik"},
            {"data" :"no_npwp"},
            {"data" :"no_telepon"},
            {"data" :"alamat"},
            {"data" :"foto"},
            {"data" : null,
                 "render":function(data){
                    return '<a style="margin:2px" href="<?php echo base_url('edit-bengkel/'); ?>'+data.id+'" class="btn btn-teal"><i class="ion-ios-create"></i></a> '+
                    		' <button  style="margin:2px" class="btn btn-danger " onclick=deleteBengkel("'+data.id+'");><i class="ion-ios-trash"></i></button> ';
                }
            },
        ]
    } 
);


setTimeout( function () {
    tableData.ajax.reload();
}, 3000);

// $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

});


function deleteBengkel(id){
    swal({
        title: "Peringatan",
        icon: "warning",
        text: "Yakin ingin menghapus data ini?",
        dangerMode: true,
        buttons: {
            cancel: "Batal",
            confirm: "Hapus",
        }
    }).then((ok) => {
        if (ok) {
            $.ajax({
                url : "<?php echo base_url('superadmin-delete-bengkel'); ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    id : id ,
                },
                success: function (r) {
                    swal({
                        title: "Success",
                        icon: r.icon,
                        text: r.msg,
                        dangerMode: false,
                        buttons: {                        
                            confirm: "Ok",
                        }
                    }).then((ok) => {
                        tableData.ajax.reload();
                    });
                }
            });
        }
    });
}


</script>
                                        

                                        
                                        