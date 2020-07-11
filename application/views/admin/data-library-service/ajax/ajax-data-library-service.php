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
                "lengthMenu": '_MENU_ items/page',
              },
        "ajax": "<?php echo base_url('view-library-service'); ?>",
        "columns" : [  
            {"data" :"id"},
            {"data" :"kode_service"},
            {"data" :"service"},
            {"data" :"keterangan"},
            {"data" :"biaya",
                "render" : function(data){
                    return "Rp " + rupiah(parseInt(data));
                }
            },            
            {"data" : null,
                "render" : function(data){
                    if (data.tipe_keuntungan == 0) {
                        return data.nilai_keuntungan +"%";
                    }else{
                        return "Rp " + rupiah(parseInt(data.nilai_keuntungan));
                    }
                }
            },                       
            {"data" : null,
                "render" : function(data){
                    return '<a style="margin:2px" href="<?php echo base_url('edit-library-service/'); ?>'+data.id+'" class="btn btn-teal"><i class="ion-ios-create"></i></a> '+
                    		' <button  style="margin:2px" class="btn btn-danger " onclick=deleteLibraryService("'+data.id+'");><i class="ion-ios-trash"></i></button> ';
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

function rupiah(angka){
    var reverse = angka.toString().split('').reverse().join(''),
    ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    if (angka < 0) {
        return "-"+ribuan;
    }
    return ribuan;
}

function deleteLibraryService(id){
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
                url : "<?php echo base_url('delete-library-service'); ?>",
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
                                        

                                        
                                        