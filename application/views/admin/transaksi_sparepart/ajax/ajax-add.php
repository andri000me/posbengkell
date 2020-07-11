<script>
  
  // alert($("#id").val());

    var ins = $('#form-add-new').on('submit', function(e){
      e.preventDefault();      

      if ( empty($("#id_barang").val()) || empty($('#keterangan').val()) || empty($('#qty').val()) ) {     
        return false;
      }
      
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });

      $.ajax({
        url: "<?php echo base_url('save-transaksi-sparepart'); ?>",
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
    url : "<?php echo base_url('auto-complete-sparepart'); ?>",
    data: 'keyword='+$(this).val(),
    beforeSend: function(){
      $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
    },
    success: function(result){
      var jsonResult = JSON.parse(result);
      var displayResult = '<ul>'

      jsonResult.forEach(function(value) {
        displayResult += '<li class="list-autocomplete"  onClick="pilihKodeBarang('+value["id"]+','+value["kode_barang"] +')">'+ value['kode_barang'] + ' - ' + value['nama']+'</li>';
      });

      displayResult += '</ul>';

      $("#suggesstion-box").show();
      $("#suggesstion-box").html(displayResult);
      $("#search-box").css("background","#FFF");
    }
    });
  });

  function pilihKodeBarang(id, kode_barang) {    
    $("#search-box").val(kode_barang);
    $("#suggesstion-box").hide();

    $.ajax({
      url: "<?php echo base_url('get-sparepart/'); ?>" + id,
      method: 'post',
      data: null,
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      success: function(r){
        if (r.status) {
          $("#nama_barang").html(r.data.nama)
          $("#kategori_barang").html(r.data.kategori)
          $("#harga_barang").html( formatRupiah(r.data.harga_jual, 'Rp. '))
          $("#stok_barang").html(r.data.stok)
          $("#id_barang").val(r.data.id)          
        }else{
          swal({
              title: r.msg,
              icon: r.icon
          });               
        }
      }
    });     
  }
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