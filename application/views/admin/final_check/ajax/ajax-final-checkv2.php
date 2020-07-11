<script>
	var id_perintah_kerja;
	function pilih_perintah_kerja(id){
    $(".card-task").css("background-color", "#fff");
    $("#pilih_"+id).css("background-color", "lightgray");

		id_perintah_kerja = id;
		$.ajax({
			url: "<?php echo base_url('view-perintah-kerja/'); ?>" + id,
			method: 'post',
			data: null,
			dataType: "json",
			contentType: false,
			cache: false,
			processData: false,
			success: function(r){
				if (r.ready) {
					$("#submit-form").prop('disabled', false);
					$("#submit-form").removeClass('disabled');
					$("#id_perintah_kerja").val(id);
					$("#id_penerimaan").val(r.data.id_penerimaan);
					
					// $("#pilih_"+id).addClass("selected-penerimaan");
				}else{
					$("#submit-form").addClass('disabled');					
					$("#id_perintah_kerja").val('');					
					$("#id_penerimaan").val('');					
					$("#submit-form").prop('disabled', true);

				}
				console.log(r.data)
				$("#nama_pemilik").html(r.data.nama_pemilik);
				$("#no_polisi").html(r.data.no_polisi);
				
				var uraian_pekerjaan = "";

				for (var i = 0; i < r.uraian_pekerjaan.length ; i++) {
					uraian_pekerjaan += `<tr>
                                    <td>`+ r.uraian_pekerjaan[i].keterangan +`</td>
                                    <td>`+ r.uraian_pekerjaan[i].biaya+`</td>
                                    <td>`+ (r.uraian_pekerjaan[i].status == 0 ? "<span class='badge badge-info'>Proses</span>" 
                                      : "<span class='badge badge-teal'>Selesai</span>") +`</td>
                                    <td> <button  style="margin:2px" class="btn btn-primary" disabled title="Tetapkan Biaya" onclick="fixingPrice(`+r.uraian_pekerjaan[i].id+`)">
                                    <i class="fa fa-check"></i></button>  </td>
                                </tr>`;
				}
				$("#uraian_pekerjaan").html(uraian_pekerjaan);

				var transaksi_sparepart = "";

				for (var i = 0; i < r.transaksi_sparepart.length ; i++) {
					transaksi_sparepart += `<tr>
                                    <td>`+ r.transaksi_sparepart[i].nama_barang +`</td>
                                    <td>`+ r.transaksi_sparepart[i].qty +`</td>
                                    <td>`+ r.transaksi_sparepart[i].keterangan+`</td>
                                    <td>`+ r.transaksi_sparepart[i].harga_jual+`</td>
                                    <td>`+ (r.transaksi_sparepart[i].status  == 0 ? "<span class='badge badge-info'>Belum Diberikan</span>" : "<span class='badge badge-teal'>Sudah Diberikan</span>") +`</td>                                    
                                </tr>`;
				}
				$("#transaksi_sparepart").html(transaksi_sparepart);
			}
		});
    }

    var ins = $('#form-add-new').on('submit', function(e){
      e.preventDefault();      

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      $.ajax({
        url: "<?php echo base_url('save-final-check'); ?>",
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
                window.location.replace("<?= base_url('final-check')?>");    
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

    var update = $('#form-fixing-price').on('submit', function(e){
      e.preventDefault();      

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      $.ajax({
        url: "<?php echo base_url('save-fixing-price'); ?>",
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
              	pilih_perintah_kerja(id_perintah_kerja);
              	btnClose();
                // window.location.reload();    
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

    function fixingPrice(id){    
    $.ajax({
        url : "<?php echo base_url('get-uraian-pekerjaan'); ?>",
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
                $('#keterangan').html(res.keterangan);
                $('#estimasi_biaya').val(formatRupiah(res.estimasi_biaya, "Rp. "));                
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

  
  function btnClose(){
      $('#modal').modal('hide');
      $('#form-add-new').trigger("reset");
      $('#id').val('');
  }



  var rupiah = document.getElementById('biaya');
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