<script>	
	function load_unseen_notification(){
		$.ajax({
			url: "<?php echo base_url('load-unseen-notification'); ?>",
			method: 'post',
			data: null,
			dataType: "json",
			contentType: false,
			cache: false,
			processData: false,
			success: function(r){
				var content_notification = "";		
				for (var i = 0; i < r.data_notif.length ; i++) {					
					content_notification +=	`<a href="javascript:void(0);" class="dropdown-item" onclick="read_notif(`+r.data_notif[i].id+`)">
                        <div class="media">                            
                            <div class="media-body">
                                <div>
                                    <div class="notifications-text">
                                    	<span class="text-dark text-capitalize">`+r.data_notif[i].judul+`</span>
                                    	<p>`+r.data_notif[i].deskripsi+`</p>
                                    	</div>                                    
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>`;
				}

				$("#count_notif").html(r.count_notif);	 
				$("#content_notification").html(content_notification);	           
	        }
	    });
	}

	function read_notif(id){
		$.ajax({
			url: "<?php echo base_url('update-status-notification/'); ?>" + id,
			method: 'post',
			data: null,
			dataType: "json",
			contentType: false,
			cache: false,
			processData: false,
			success: function(r){
				if (r.status) {
	                  window.location.replace("<?=base_url('gudang')?>");					
				}
	        }
	    });
	}

    setInterval(function(){
	 load_unseen_notification();
	}, 5000);
</script>