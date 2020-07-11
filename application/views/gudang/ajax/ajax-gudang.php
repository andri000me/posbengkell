<script>
	var id_global;
    function pilih_tugas(id){
		id_global = id;
		$.ajax({
			url: "<?php echo base_url('view-tugas-gudang/'); ?>" + id,
			method: 'post',
			data: null,
			dataType: "json",
			contentType: false,
			cache: false,
			processData: false,
			success: function(r){
				var trx_sparepart = "";

				for (var i = 0; i < r.data_trx_sparepart.length ; i++) {
					var display_status = r.data_trx_sparepart[i].status == 1 ? "<span class='badge badge-teal'>Sudah diberikan</span>" : "<span class='badge badge-info'>Belum diberikan</span>";
					trx_sparepart += `<tr>
                                    <td>`+ r.data_trx_sparepart[i].kode_barang +`</td>
                                    <td>`+ r.data_trx_sparepart[i].nama_barang +`</td>
                                    <td>`+ r.data_trx_sparepart[i].qty+`</td>
                                    <td>`+ r.data_trx_sparepart[i].harga_jual+`</td>
                                    <td>`+ r.data_trx_sparepart[i].keterangan+`</td>
                                    <td>`+ display_status +`</td>
                                    <td> <button `+(r.data_trx_sparepart[i].status == 1 ? 'disabled' : '')+` onclick="giveIt(`+r.data_trx_sparepart[i].id+`)" class="btn btn-orange">Berikan</button></td>
                                </tr>`;
				}
				$("#trx_sparepart").html(trx_sparepart);
			}
		});
    }

    

    function giveIt(id_trx){    	
    	$.ajax({
			url: "<?php echo base_url('give-item/'); ?>" + id_trx,
			method: 'post',
			data: null,
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
						pilih_tugas(id_global)
	                });
	            }else{
	                swal({
	                    title: r.msg,
	                    icon: r.icon
	                });
	            }
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