<script>
    
  var ins = $('#form-add-new').on('submit', function(e){
        e.preventDefault();      
        if ( empty($('#kategori').val()) || empty($('#nama_sparepart').val()) || empty($('#harga_beli').val()) 
          || empty($('#harga_jual').val()) || empty($('#stok').val())) {                  
          return false;
        }
        
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
                  window.location.replace("<?=base_url('data-sparepart')?>");
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

  var rupiah = document.getElementById('harga_beli');
  rupiah.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value, 'Rp. ');
  });

  var rupiah2 = document.getElementById('harga_jual');
  rupiah2.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah2.value = formatRupiah(this.value, 'Rp. ');
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