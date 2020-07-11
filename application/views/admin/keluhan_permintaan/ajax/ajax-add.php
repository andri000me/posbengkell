<script>
    var ins = $('#form-add-new').on('submit', function(e){
      e.preventDefault();      

      if ( empty($('#id_penerimaan').val()) || empty($('#keterangan').val()) || empty($('#kategori').val())) {        
        return false;
      }
      
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      $.ajax({
        url: "<?php echo base_url('save-keluhan-permintaan'); ?>",
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
                window.location.replace("<?=base_url('data-keluhan-permintaan/')?>" + $('#id_penerimaan').val());
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