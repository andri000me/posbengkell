<script>    
    $('#image-logo').on('submit', function(e){
      e.preventDefault();      
        $.ajax({
            url:'<?php echo base_url('change-logo-bengkel');?>',
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

    var ins = $('#form-add-new').on('submit', function(e){
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
        url: "<?php echo base_url('save-info-bengkel'); ?>",
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