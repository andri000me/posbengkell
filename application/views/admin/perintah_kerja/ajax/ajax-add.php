<script>
	$('.form_datetime').datetimepicker({
        //language:  'fr',
         useCurrent: false,
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
    	defaultDate: new Date()
    }).datetimepicker("setDate", new Date());

    $(".readonly").keydown(function(e){
        e.preventDefault();
    });

	var tableDataUraianPekerjaan;
	var tableDataTrxSparePart;

	$(document).ready(function(){
    	attach_penerimaan();

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
			            {"data" :"biaya"},
			            {"data" :"status",
							render: function ( data, type, row, meta ) {								
								if (data == 0)
									status = "<span class='badge badge-info'>Proses</span>"
								else 
									status = "<span class='badge badge-teal'>Selesai</span>"
						      
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
			            {"data" :"nama_barang"},
			            {"data" :"qty"},
			            {"data" :"harga_jual"},
			            {"data" :"keterangan"},
			            {"data" :"status",
			            	"render":function(data){
			            		if (data == 0) {
			            			return "<span class='badge badge-info'>Belum Diberikan</span>";
			            		}else if (data == 1) {
									return "<span class='badge badge-teal'>Sudah Diberikan</span>";
			            		}
			            	}
			        	},
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


    function attach_penerimaan(){
    	var id_penerimaan = $("#id_penerimaan").val();    	
    	pilih_penerimaan(id_penerimaan);
    }

    function pilih_penerimaan(id){
		$(".card-task").css("background-color", "#fff");
        $("#pilih_"+id).css("background-color", "lightgray");

		$.ajax({
			url: "<?php echo base_url('view-penerimaan/'); ?>" + id,
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
					$("#id_penerimaan").val(id);
					// $("#pilih_"+id).addClass("selected-penerimaan");
				}else{
					$("#submit-form").addClass('disabled');					
					$("#id_penerimaan").val('');					
					$("#submit-form").prop('disabled', true);

				}
				console.log(r)
				$("#nama_pemilik").html(r.data.nama_pemilik);
				$("#no_polisi").html(r.data.no_polisi);
				
				var keluhan = "";

				for (var i = 0; i < r.data_keluhan.length ; i++) {
					keluhan += `<tr>
                                    <td>`+ (i+1) +`</td>
                                    <td>`+ r.data_keluhan[i].kategori +`</td>
                                    <td>`+r.data_keluhan[i].keterangan+`</td>
                                </tr>`;
				}
				$("#permintaan_keluhan").html(keluhan);
			}
		});
    }

    var ins = $('#form-add-new').on('submit', function(e){
	      e.preventDefault();      

	      if (empty($("#id_gudang").val()) || empty($("#id_teknisi").val()) || empty($('#pekerjaan').val()) || empty($('#pelanggan').val()) || 
	      		empty($('#stnk').val()) || empty($('#dtp_input1').val()) || empty($('#dtp_input2').val())) {    

	        return false;
	      }
	      
	      $.ajaxSetup({
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	        }
	      });
	      $.ajax({
	        url: "<?php echo base_url('save-perintah-kerja'); ?>",
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
	                window.location.replace("<?=base_url('edit-perintah-kerja/')?>" + r.id);
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