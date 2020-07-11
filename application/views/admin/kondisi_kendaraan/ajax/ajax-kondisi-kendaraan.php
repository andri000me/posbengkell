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
            "ajax": "<?php echo base_url('view-kondisi-kendaraan'); ?>",
            "columns" : [
                {"data" :"id"},
                {"data" :"keterangan"},
                {"data" : null,
                    "render":function(data){
                        return '<button class="btn btn-danger " onclick=deleteKondisiKendaraan("'+data.id+'");><i class="ion-ios-trash"></i></i></button> ';
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

    // var konfirmasi  = confirm("Benerkah anda ingin simpan Komoditi ini?");
    // if (konfirmasi){
    // }

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      $.ajax({
        url: "<?php echo base_url('save-kondisi-kendaraan'); ?>",
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
                tableData.ajax.reload();
                $("#input-kondisi-kendaraan").val("");
                btnClose();
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

function deleteKondisiKendaraan(id){    
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
                url : "<?php echo base_url('delete-kondisi-kendaraan'); ?>",
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
        // else {
        //     swal({
        //         title: "Data Batal Dihapus",
        //         icon: "info"
        //     });
        // }
    });
}

function btnClose(){
        $('#modal').modal('hide');
        $('#form-add-new-komoditi').trigger("reset");
        $('#id').val('');
}


function editPetugas(id){
    $.ajax({
                        url : "<?php echo base_url('get-petugas'); ?>",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            id : id ,
                        },
                success : function(res){
                    if(res.icon != null && res.icon != ''){
                        swal({
                            title: res.msg,
                            icon: res.icon
                        });
                    }else{
                        $('#modal-petugas').modal({backdrop: 'static', keyboard: false},'show');
                        $.ajax({
                            type  : 'ajax',
                            url   : '<?php echo base_url();?>admin/Uppt/selectUpptInduk',
                            async : false,
                            dataType : 'json',
                            success : function(data){
                                var html = '';
                                var i;
                                for(i=0; i<data.length; i++){
                                    if(data[i].id == res.id_uppt_induk){
                                        html += '<option value='+data[i].uppt_induk+' selected>'+data[i].uppt_induk+'</option>';
                                    }else{
                                        html += '<option value='+data[i].uppt_induk+'>'+data[i].uppt_induk+'</option>';
                                    }
                                }
                                $('#id_uppt_induk').html(html);
                            }

                        });
                        $('#id').val(res.id_user);
                        $('#nama').val(res.nama);
                        $('#username').val(res.username);
                        $('#role_user').val(res.role_user);
                        $('#nip').val(res.nip);
                        $('#pangkat').val(res.pangkat);
                        $('#jabatan_lama').val(res.jabatan_lama);
                        $('#jabatan_baru').val(res.jabatan_baru);
                        $('#password').attr('style','display:none;');
                        $('#password').removeAttr('required','required');
                    }
                },
                error : function(){
                    swal({
                        title : "Terjadi kesalahan dalam mengambil data",
                        icon : "error"
                    });
                }
            });
}
</script>