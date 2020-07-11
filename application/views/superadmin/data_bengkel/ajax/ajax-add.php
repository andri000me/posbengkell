<script>    

  $(document).ready(function(){
    if (!empty($("#id_bengkel").val())) {
        tableData = $('#konten').DataTable({
        "bDestroy": true,
        "responsive": true,
              "language": {
                "searchPlaceholder": 'Search...',
                "sSearch": '',
                "lengthMenu": '_MENU_ items/page',
              },
        "ajax": "<?php echo base_url('view-admin-manager/'); ?>"+ $("#id_bengkel").val(),
        "columns" : [
            {"data" :"id"},
            {"data" :"username"},
            // {"data" :"nama"},
            {"data" :"role_user"},                
            {"data" : null,
                 "render":function(data){
                    return '<button class="btn btn-teal " onclick=editAdminManager("'+data.id+'");><i class="ion-ios-create"></i></button> ' +
                    '<button class="btn btn-orange" onclick=ubahKataSandi("'+data.id+'");><i class="ion-ios-key"></i></button> ' + 
                    '<button class="btn btn-danger " onclick=deleteAdminManager("'+data.id+'");><i class="ion-ios-trash"></i></button> ';
                }
            },
          ]
        } 
      );
      setTimeout( function () {
          tableData.ajax.reload();
      }, 3000);
    }    
  });

  $('#image-logo').on('submit', function(e){
    e.preventDefault();      
      $.ajax({
          url:'<?php echo base_url('superadmin-change-logo-bengkel');?>',
          type: "post",
          data: new FormData(this),
          processData:false,
          contentType:false,
          cache:false,
          success: function(r){
            r = JSON.parse(r);
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
                  location.reload();
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

  $('#form-add-new').on('submit', function(e){
      e.preventDefault();      
      if ( empty($('#nama_pemilik').val()) || empty($('#no_npwp').val()) || 
          empty($('#no_telepon').val()) || empty($('#alamat').val())) {        
        return false;
      }
      
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      $.ajax({
        url: "<?php echo base_url('superadmin-save-info-bengkel'); ?>",
        method: 'post',
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function(r){       

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
                location.reload();
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
    
  $('#form-add-new-modal').on('submit', function(e){
    e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      $.ajax({
        url: "<?php echo base_url('save-admin-manager'); ?>",
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


  function btnClose(){
    $('#modal').modal('hide');
    $('#form-add-new').trigger("reset");
    $('#id').val('');
  }

  function editAdminManager(id){
    $.ajax({
        url : "<?php echo base_url('get-admin-manager'); ?>",
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
                $('#id').val(res.id);
                $('#nama').val(res.nama);
                $('#username').val(res.username);
                $('#role_user').val(res.role_user);
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

  function ubahKataSandi(key){
            $("#id_reset").val(key);
            $("#modalResetPassword").modal({backdrop: 'static', keyboard: false},'show');
    }

    function btnCloseResetPass(){
            $('#modalResetPassword').modal('hide');
            $('#form_reset_pass').trigger("reset");
            $('#id_reset').val('');
    }

    function checkResetPass(){
        var newPass = $('#new_pass').val(); 
        var confirmPass = $('#confirm_pass').val(); 
        if(newPass == confirmPass && newPass != "" && confirmPass != ""){
            $('#btnSave').attr('type','submit');
            $('#btnSave').attr('class','btn btn-primary');
                $('#msg-alert').attr('style','display:block;');
                $('#msg-alert').attr('class','alert alert-success');
                $('#msg-alert span').html('Password sesuai');
        }else{
            $('#msg-alert').attr('style','display:block;');
            $('#msg-alert').attr('class','alert alert-danger');
            if(newPass != confirmPass){
              $('#msg-alert span').html('Password tidak sama');
            }
            $('#btnSave').attr('type','button');
            $('#btnSave').attr('class','btn disbled');
        }
    }

    var resetPassword = $('#form_reset_pass').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?= base_url('reset-password'); ?>',
            method: 'post',
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(r){
                $('#form_reset_pass').trigger("reset");
                $('#modalResetPassword').modal('hide');
                swal({
                    title: r.msg,
                    icon: r.icon
                });
            }
        }); 
    });


  function deleteAdminManager(id){
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
                url : "<?php echo base_url('delete-admin-manager'); ?>",
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

  function empty(data)
  {
    if(typeof(data) == 'number' || typeof(data) == 'boolean'){ 
      return false; 
    }
    if(typeof(data) == 'undefined' || data === null){
      return true; 
    }
    if(typeof(data.length) != 'undefined'){
      return data.length == 0;
    }

    var count = 0;
    for(var i in data){
      if(data.hasOwnProperty(i)){
        count ++;
      }
    }
    return count == 0;
  }
</script>