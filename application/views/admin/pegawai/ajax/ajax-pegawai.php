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
        "ajax": "<?php echo base_url('view-pegawai'); ?>",
        "columns" : [

            {"data" :"id"},
            {"data" :"username"},
            {"data" :"nama"},
            {"data" :"nip"},
            {"data" :"role_user"},                
            {"data" : null,
                "render":function(data){
                    
                },

                 "render":function(data){
                    return '<button class="btn btn-teal " onclick=editPegawai("'+data.id+'");><i class="ion-ios-create"></i></button> ' + 
                    '<button class="btn btn-orange" disabled onclick=ubahKataSandi("'+data.id+'");><i class="ion-ios-key"></i></button> ' + 
                    '<button class="btn btn-danger " onclick=deletePegawai("'+data.id+'");><i class="ion-ios-trash"></i></button> ';
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
        url: "<?php echo base_url('save-pegawai'); ?>",
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

function deletePegawai(id){
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
                url : "<?php echo base_url('delete-pegawai'); ?>",
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

function btnClose(){
        $('#modal').modal('hide');
        $('#form-add-new').trigger("reset");
        $('#id').val('');
}

function editPegawai(id){
    $.ajax({
        url : "<?php echo base_url('get-pegawai'); ?>",
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
                $('#modal').modal({backdrop: 'static', keyboard: false},'show');
                $.ajax({
                    type  : 'ajax',
                    url   : '<?php echo base_url();?>admin/Uptd/dataProvinsi',
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        console.log(data)
                        var html = '';
                        var i;

                        for(i=0; i<data['data_provinsi'].length; i++){
                            if(data['data_provinsi'][i].id == res.id_provinsi){
                                html += '<option value='+data['data_provinsi'][i].id+' selected>'+data['data_provinsi'][i].provinsi+'</option>';
                            }else{
                                html += '<option value='+data['data_provinsi'][i].id+'>'+data['data_provinsi'][i].provinsi+'</option>';
                            }
                        }
                        $('#id_provinsi').html(html);
                    }

                });
                $('#id').val(res.id);
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