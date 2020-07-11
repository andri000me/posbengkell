<script>
    var id_global;
    function pilih_tugas(id){
        id_global = id;
        $(".card-task").css("background-color", "#fff");
        $("#pilih_"+id).css("background-color", "lightgray");
        $("#id_quota_activation").val(id)

		$.ajax({
			url: "<?php echo base_url('view-task-teknisi/'); ?>" + id,
			method: 'post',
			data: null,
			dataType: "json",
			contentType: false,
			cache: false,
			processData: false,
			success: function(r){
				var task_teknisi = "";

				for (var i = 0; i < r.data_uraian_pekerjaan.length ; i++) {
					var display_status = r.data_uraian_pekerjaan[i].status == 1 ? "<span class='badge badge-teal'>Selesai</span>" : "<span class='badge badge-info'>Proses</span>";
					task_teknisi += `<tr>
                                    <td>`+ r.data_uraian_pekerjaan[i].keterangan+`</td>
                                    <td>`+ display_status +`</td>
                                    <td> <button `+(r.data_uraian_pekerjaan[i].status == 1 ? 'disabled' : '')+` onclick="doneTask(`+r.data_uraian_pekerjaan[i].id+`)" class="btn btn-orange">Selesai</button></td>
                                </tr>`;
				}
				$("#task_teknisi").html(task_teknisi);
			}
		});
    }

    

    function doneTask(id){    	
    	$.ajax({
			url: "<?php echo base_url('done-task/'); ?>" + id,
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
	                //   window.location.replace("<?=base_url('task-teknisi')?>");
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