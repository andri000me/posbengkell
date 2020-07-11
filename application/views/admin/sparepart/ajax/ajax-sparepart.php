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
                "searchPlaceholder": 'Search...'
              },
        "ajax": "<?php echo base_url('view-sparepart'); ?>",
        "columns" : [  
            {"data" :"id"},
            {"data" :"kode_barang"},
            {"data" :"kategori"},
            {"data" :"nama"},
            {"data" :"harga_beli"},            
            {"data" :"harga_jual"},            
            {"data" :"stok"},            
            {"data" : null,
                 "render":function(data){
                    return '<a style="margin:2px" href="<?php echo base_url('edit-sparepart/'); ?>'+data.id+'" class="btn btn-teal"><i class="ion-ios-create"></i></a> '+
                    		' <button  style="margin:2px" class="btn btn-danger " onclick=deleteSparePart("'+data.id+'");><i class="ion-ios-trash"></i></button> ';
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

var ins = $('#form-add-new').on('submit', function(e){
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      $.ajax({
        url: "<?php echo base_url('save-sparepart'); ?>",
        method: 'post',
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function(r){
            console.log(r)
          if(r.icon == 'success'){
              swal({
                  title: "Success",
                  icon: r.icon,
                  text: r.msg,
                  dangerMode: false,
                  buttons: {                        
                      confirm: "Ok",
                  }
              }).then((ok) => {
                btnClose();
                tableData.ajax.reload();
              });
            }else{
              swal({
                  title: r.msg,
                  icon: r.icon
              });
            }
        }
      });  
});

function deleteSparePart(id){
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
                url : "<?php echo base_url('delete-sparepart'); ?>",
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
                                        

                                        
                                        