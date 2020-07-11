<script>
  
  // alert($("#id").val());

    var ins = $('#form-add-new').on('submit', function(e){
      e.preventDefault();      
      // if ( empty($('#keterangan').val()) || empty($('#estimasi_biaya').val()) ) {     
      //   return false;
      // }
      
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });

      $.ajax({
        url: "<?php echo base_url('save-uraian-pekerjaan'); ?>",
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
                window.location.replace("<?=base_url('edit-perintah-kerja/')?>" + $("#id_perintah_kerja").val());
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

  $("#search-box").keyup(function(){
    $.ajax({
    type: "POST",
    url : "<?php echo base_url('auto-complete-pekerjaan'); ?>",
    data: 'keyword='+$(this).val(),
    beforeSend: function(){
      $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
    },
    success: function(result){
      var jsonResult = JSON.parse(result);
      var displayResult = '<ul>'

      jsonResult.forEach(function(value) {
        displayResult += `<li class='list-autocomplete'  onClick='pilihService(`+value["id"]+`,"`+value["kode_service"]+`")'>`+value['kode_service'] + `, ` + value['service']+`</li>`;
      });

      displayResult += '</ul>';

      $("#suggesstion-box").show();
      $("#suggesstion-box").html(displayResult);
      $("#search-box").css("background","#FFF");
    }
    });
  });

  function pilihService(id, kode_service) {    
    $("#search-box").val(kode_service);
    $("#suggesstion-box").hide();

    $.ajax({
      url: "<?php echo base_url('get-service/'); ?>" + id,
      method: 'post',
      data: null,
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      success: function(r){
        if (r.status) {
          $("#jenis_service").html(r.data.service)          
          $("#harga").html( formatRupiah(r.data.biaya, 'Rp. '))
          $("#keterangan").html(r.data.keterangan)
          $("#id_service").val(r.data.id)          
        }else{
          swal({
              title: r.msg,
              icon: r.icon
          });               
        }
      }
    });     
  }


  var rupiah = document.getElementById('estimasi_biaya');
  rupiah.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value, 'Rp. ');
  });
 
    /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split       = number_string.split(','),
    sisa        = split[0].length % 3,
    rupiah        = split[0].substr(0, sisa),
    ribuan        = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
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