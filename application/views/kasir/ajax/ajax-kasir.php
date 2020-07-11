<script>
	 $(".readonly").keydown(function(e){
        e.preventDefault();
    });

	var tableDataUraianPekerjaan;
	var tableDataTrxSparePart;

	$(document).ready(function(){
    	// attach_penerimaan();

    	if (!empty($("#id").val())) {
			tableDataUraianPekerjaan = $('#konten_uraian_pekerjaan').DataTable({
			        "bDestroy": true,
			        "responsive": true,
			              "language": {
			                "searchPlaceholder": 'Search...',
			                "sSearch": '',
			                "lengthMenu": '_MENU_ items/page',
			              },
			        "ajax": "<?php echo base_url('view-uraian-pekerjaan/'); ?>" + $("#id").val(),
			        "columns" : [  
			            {"data" :"id"},
			            {"data" :"keterangan"},
			            // {"data" :"estimasi_biaya"},
			            {"data" :"biaya"},
			            {"data" :"status",
							render: function ( data, type, row, meta ) {								
								if (data == 0)
									status = 'Proses' 
								else 
									status = 'Selesai'
						      
						      	return  status;
						    }
			        	},
    						// render: 'Rp.' + $.fn.dataTable.render.number( '.', ',', 0 )
			       //  	},     
			            {"data" : null,
			                 "render":function(data){
			                    return '<a style="margin:2px" href="<?php echo base_url('edit-uraian-pekerjaan/'); ?>'+ $("#id").val() +'/'+data.id+'" class="btn btn-teal"><i class="ion-ios-create"></i></a> '+
			                    		' <button  style="margin:2px" class="btn btn-danger " onclick=deleteUraianPekerjaan("'+data.id+'");><i class="ion-ios-trash"></i></button> ';
			                }
			            },
			        ]});

			tableDataTrxSparePart = $('#konten_transaksi_sparepart').DataTable({
			        "bDestroy": true,
			        "responsive": true,
			              "language": {
			                "searchPlaceholder": 'Search...',
			                "sSearch": '',
			                "lengthMenu": '_MENU_ items/page',
			              },
			        "ajax": "<?php echo base_url('view-transaksi-sparepart/'); ?>" + $("#id").val(),
			        "columns" : [                                                     
			            {"data" :"id"},
			            {"data" :"id_spare_part"},
			            {"data" :"qty"},
			            {"data" :"keterangan"},
    						// render: 'Rp.' + $.fn.dataTable.render.number( '.', ',', 0 )
			       //  	},     
			            {"data" : null,
			                 "render":function(data){
			                    return '<a style="margin:2px" href="<?php echo base_url('edit-transaksi-sparepart/'); ?>'+ $("#id").val() +'/'+data.id+'" class="btn btn-teal"><i class="ion-ios-create"></i></a> '+
			                    		'<button  style="margin:2px" class="btn btn-danger" onclick=deleteTransaksiSparePart("'+data.id+'");><i class="ion-ios-trash"></i></button> ';
			                }
			            },
			        ]});
		}	    		
	});	

	function deleteTransaksiSparePart(id){		
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
	                url : "<?php echo base_url('delete-transaksi-sparepart'); ?>",
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
	                        tableDataTrxSparePart.ajax.reload();
	                    });
	                }
	            });
	        }
	    });
	}

	function btnClose(){
        $('#modal-diskon-sparepart').modal('hide');
        $('#form-add-diskon').trigger("reset");        
	}

	function deleteUraianPekerjaan(id){
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
	                url : "<?php echo base_url('delete-uraian-pekerjaan'); ?>",
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
	                        tableDataUraianPekerjaan.ajax.reload();
	                    });
	                }
	            });
	        }
	    });
	}

    // function attach_penerimaan(){
    // 	var id_penerimaan = $("#id_penerimaan").val();    	
    // 	pilih_penerimaan(id_penerimaan);
    // }

    var total_tagihan 			= 0;
    var total_tagihan_sparepart = 0;
    var total_tagihan_pekerjaan = 0;
	var total_bayar 			= 0; 

	var tagihan_pekerjaan_final = 0;
	var tagihan_sparepart_final = 0;  

    function pilih_penerimaan(id){
    	$("#btn-diskon-sparepart").html("0% Diskon");
    	$("#btn-diskon-pekerjaan").html("0% Diskon");
		$.ajax({
			url: "<?php echo base_url('tagihan-kasir/'); ?>" + id,
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

					// $("#pilih_"+id).addClass("selected-penerimaan");
				}else{
					$("#submit-form").addClass('disabled');	
					$("#submit-form").prop('disabled', true);
				}

				$("#nama_pemilik").html(r.data.nama_pemilik);
				$("#no_polisi").html(r.data.no_polisi);
				
				var keluhan = "";

				for (var i = 0; i < r.data_keluhan.length ; i++) {
					keluhan += `<tr>
                                    <td>`+ (i+1) +`</td>
                                    <td>`+ r.data_keluhan[i].kategori +`</td>
                                    <td>`+ r.data_keluhan[i].keterangan +`</td>
                                </tr>`;
				}
				$("#permintaan_keluhan").html(keluhan);

				var trx_sparepart = "";
				total_harga_jual = 0;
				for (var i = 0; i < r.data_trx_sparepart.length ; i++) {
					total_harga_jual += parseInt(r.data_trx_sparepart[i].harga_jual * r.data_trx_sparepart[i].qty);					
					trx_sparepart 	+= `<tr>
		                                    <td>`+ (i+1) +`</td>
		                                    <td>`+r.data_trx_sparepart[i].keterangan+`</td>
		                                    <td>`+r.data_trx_sparepart[i].qty +`</td>
		                                    <td style="text-align:right">`+"Rp."+ parseInt(total_harga_jual).toLocaleString() +`</td>
	                                	</tr>`;
				}
				trx_sparepart += `<tr style="background:lightgray">
                                        <td colspan="3">Total</td>
                                        <td style="text-align:right" id="display_total_tagihan_sparepart">`+ "Rp." + parseInt(total_harga_jual).toLocaleString()+`</td>
                                    </tr>`;
				$("#trx_sparepart").html(trx_sparepart);

				var uraian_pekerjaan = "";

				var total_uraian_pekerjaan = 0;
				for (var i = 0; i < r.data_uraian_pekerjaan.length ; i++) {
					total_uraian_pekerjaan += parseInt(r.data_uraian_pekerjaan[i].biaya);
					uraian_pekerjaan 	+= `<tr>
		                                    <td>`+ (i+1) +`</td>
		                                    <td colspan="2">`+r.data_uraian_pekerjaan[i].keterangan+`</td>
		                                    <td style="text-align:right">`+"Rp."+ parseInt(r.data_uraian_pekerjaan[i].biaya).toLocaleString() +`</td>
	                                	</tr>`;
				}
				uraian_pekerjaan += `<tr style="background:lightgray">
                                        <td colspan="3">Total</td>
                                        <td style="text-align:right" id="display_total_tagihan_pekerjaan">`+ "Rp." + parseInt(total_uraian_pekerjaan).toLocaleString()+`</td>
                                    </tr>`;
				
				$("#uraian_pekerjaan").html(uraian_pekerjaan);						
				total_tagihan 			= r.total;
				total_tagihan_sparepart = r.total_tagihan_sparepart; 
				total_tagihan_pekerjaan = r.total_tagihan_pekerjaan;

				tagihan_pekerjaan_final = total_tagihan_pekerjaan;
				tagihan_sparepart_final = total_tagihan_sparepart; 
				total_bayar 			= total_tagihan + (total_tagihan * 0.10);
				$("#total").val("Rp. " + parseInt(total_bayar).toLocaleString());		
				
				$("#id_penerimaan").val(id);	
				$("#id_perintah_kerja").val(r.perintah_kerja.id);

				$("#kembalian").val("");		
				$("#bayar").val("");		
				$("#total").val("Rp. " + parseInt(total_bayar).toLocaleString());		
				$("#submit-form-bayar").addClass('disabled');											
				$("#submit-form-bayar").prop('disabled', true);		
			}
		});
    }

    $('#fixing-diskon-pekerjaan').on('submit', function(e){
	    e.preventDefault();      
	    var diskon = $("#diskon-jasa").val();
	    $("#diskon_service_value").val(diskon);
	    
	    $("#btn-diskon-pekerjaan").html(diskon + "% Diskon");
        $('#modal-diskon-pekerjaan').modal('hide');

        disc = 100 - diskon; 
		tagihan_pekerjaan_final = disc * total_tagihan_pekerjaan / 100;
		if (diskon > 0) {
			$("#display_total_tagihan_pekerjaan").html(
				"<s>" + "Rp." + parseInt(total_tagihan_pekerjaan).toLocaleString() +"</s>" + 
				" <b>" + "Rp." + parseInt(tagihan_pekerjaan_final).toLocaleString() + "</b>")	
		}
		_total = tagihan_pekerjaan_final + tagihan_sparepart_final
		total_bayar =   _total + (_total * 0.10); //0.10 adalah ppn 10%
		$("#kembalian").val("");		
		$("#bayar").val("");		
		$("#total").val("Rp. " + parseInt(total_bayar).toLocaleString());		
		$("#submit-form-bayar").addClass('disabled');											
		$("#submit-form-bayar").prop('disabled', true);		

    });

    $('#fixing-diskon-sparepart').on('submit', function(e){
	    e.preventDefault();      
	    var diskon = $("#diskon-sparepart").val();
	    $("#diskon_sparepart_value").val(diskon);
	    $("#btn-diskon-sparepart").html(diskon + "% Diskon");
        $('#modal-diskon-sparepart').modal('hide');

        disc = 100 - diskon; 
		tagihan_sparepart_final = disc * total_tagihan_sparepart / 100;
		if (diskon > 0) {
			$("#display_total_tagihan_sparepart").html(
				"<s>" + "Rp." + parseInt(total_tagihan_sparepart).toLocaleString() +"</s>" + 
				" <b>" + "Rp." + parseInt(tagihan_sparepart_final).toLocaleString() + "</b>")	
		}		

		_total = tagihan_pekerjaan_final + tagihan_sparepart_final
		total_bayar =   _total + (_total * 0.10); //0.10 adalah ppn 10%
		$("#kembalian").val("");		
		$("#bayar").val("");		
		$("#total").val("Rp. " + parseInt(total_bayar).toLocaleString());		
		$("#submit-form-bayar").addClass('disabled');											
		$("#submit-form-bayar").prop('disabled', true);		
    });

    var ins = $('#form-add-new').on('submit', function(e){
	      e.preventDefault();      
	      
	      $.ajaxSetup({
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	        }
	      });
	      $.ajax({
	        url: "<?php echo base_url('bayar-kasir'); ?>",
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
	                window.location.replace("<?=base_url('kasir')?>");
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
	
	var diskon = document.getElementById('diskon');
	diskon.addEventListener('keyup', function(e){
		disc = 100 - diskon.value; 
		total_bayar = disc * (total_tagihan + (total_tagihan * 0.10)) / 100; //0.10 adalah ppn 10%
		$("#kembalian").val("");		
		$("#bayar").val("");		
		$("#total").val("Rp. " + parseInt(total_bayar).toLocaleString());		
		$("#submit-form-bayar").addClass('disabled');											
		$("#submit-form-bayar").prop('disabled', true);			
	});


	var rupiah = document.getElementById('bayar');
	rupiah.addEventListener('keyup', function(e){
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		rupiah.value = formatRupiah(this.value, 'Rp. ');
		
		var bayar = convertToAngka(rupiah.value);
		var kembalian = bayar - total_bayar;		
		$("#kembalian").val("Rp. " +  parseInt(kembalian).toLocaleString() );
		if (kembalian >= 0){			
			$("#submit-form-bayar").prop('disabled', false);
			$("#submit-form-bayar").removeClass('disabled');			
		}else{			
			$("#submit-form-bayar").addClass('disabled');											
			$("#submit-form-bayar").prop('disabled', true);			
		}
	});	

	/* Fungsi formatRupiah */
	function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split			= number_string.split(','),
		sisa        	= split[0].length % 3,
		rupiah        	= split[0].substr(0, sisa),
		ribuan        	= split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if(ribuan){
		  separator = sisa ? '.' : '';
		  rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}

	function convertToAngka(rupiah)
	{
		return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
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