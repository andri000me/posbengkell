<script type="text/javascript">      
  $(document).ready(function(){
      $(".yearpicker").yearpicker({
        year: 2020,
        startYear: 2010,
        endYear: 2050
      });
  });

  $(".readonly").keydown(function(e){
      e.preventDefault();
  });

  var tableData;

  $(document).ready(function(){
      var id    = $("#id").val();
      if (empty(id)) {
        id = 0;
      }
      tableData = $('#konten').DataTable({
          "bDestroy": true,
          // "responsive": true,
                "language": {
                  "searchPlaceholder": 'Search...',
                  "sSearch": '',
                  "lengthMenu": '_MENU_ items/page',
                },
          "ajax": "<?php echo base_url('view-detail-penerimaan/')?>" + id,
          "columns" : [  
              {"data" :"id"},
              {"data" :"keterangan"},      
              {"data" : null,
                   "render":function(data){
                      return '<div class="custom-control custom-radio radio-teal"><input '+ (data.status == 1 ? 'checked' : '' )+' onclick="switch_condition('+"'"+data.keterangan+"'"+','+"'baik'"+', '+data.id+')" type="radio" id="baik_'+data.id+'" name="kondisi_'+data.id+'" class="custom-control-input"><label class="custom-control-label" for="baik_'+data.id+'"></label></div>';
                  }
              },
              {"data" : null,
                   "render":function(data){
                      return '<div class="custom-control custom-radio radio-danger"><input '+ (data.status == 2 ? 'checked' : '' )+' onclick="switch_condition('+"'"+data.keterangan+"'"+','+"'rusak'"+', '+data.id+')" type="radio" id="rusak_'+data.id+'" name="kondisi_'+data.id+'" class="custom-control-input"><label class="custom-control-label" for="rusak_'+data.id+'"></label></div>';
                  }
              },
              {"data" : null,
                   "render":function(data){
                      return '<div class="custom-control custom-radio radio-secondary"><input '+ (data.status == 3 ? 'checked' : '' )+' onclick="switch_condition('+"'"+data.keterangan+"'"+','+"'kosong'"+', '+data.id+')" type="radio" id="kosong_'+data.id+'" name="kondisi_'+data.id+'" class="custom-control-input"><label class="custom-control-label" for="kosong_'+data.id+'"></label></div>';
                  }
              },
              {"data" : null,
                   "render":function(data){
                      return ' <button  style="margin:2px" class="btn btn-danger " onclick=deleteDetailPenerimaan("'+data.id+'");><i class="ion-ios-trash"></i></button> ';
                  }
              },
          ]
      });
  });

  function switch_condition(text, val, id) {
    var status = 0;
    if(val == "baik"){
      loaderBgLoad = "#22AF47";
      class_selected = 'jq-toast-success';
      status = 1;
    }else if (val == "rusak") {
      class_selected = 'jq-toast-danger';
      loaderBgLoad = "#af2922";
      status = 2;
    }else{
      loaderBgLoad = "#aba9a9";      
      class_selected = 'jq-toast-secondary';
      val = "tidak ada";
      status = 3;
    }

    $.ajax({
        url : "<?php echo base_url('set-detail-penerimaan'); ?>",
        type: "POST",
        dataType: "JSON",
        data: {
            id : id ,
            status : status,
        },
        success: function (r) {
          if (r.status) {
            $.toast({
              heading: text+'!',
              text: '<h3>'+ val.toUpperCase() +'</h3></p>',
              position: 'top-right',
              loaderBg: loaderBgLoad,
              class: class_selected,
              hideAfter: 3500, 
              stack: 6,
              showHideTransition: 'fade'
            });
          }else{
            swal({
                title: "Gagal",
                icon: "error",
                text: "Terjadi Kesalahan, Silahkan Coba Kembali",
                dangerMode: false,
                buttons: {                        
                    confirm: "Ok",
                }
            }).then((ok) => {
                tableData.ajax.reload();
            });
          } 
        }
    });
  }

  function deleteDetailPenerimaan(id){
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
                url : "<?php echo base_url('delete-detail-penerimaan'); ?>",
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
                        tableData.ajax.reload();
                    });
                }
            });
        }
    });
}


  setTimeout( function () {
      tableData.ajax.reload();
  }, 3000);


  
  var ins = $('#form-add-new').on('submit', function(e){
      e.preventDefault();      

      if ( empty($('#no_polisi').val()) || empty($('#nama_pemilik').val()) || empty($('#no_telepon').val()) || empty($('#no_pkb').val()) ||
        empty($('#alamat').val()) ||  empty($('#tahun_produksi').val()) || empty($('#no_rangka').val()) | 
        empty($('#no_mesin').val()) || empty($('#tipe_warna').val())) {        
        return false;
      }
      
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      $.ajax({
        url: "<?php echo base_url('save-penerimaan'); ?>",
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
                window.location.replace("<?=base_url('edit-penerimaan/')?>" + r.id);
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

	var ins2 = $('#form-add-new-kondisi-kendaraan').on('submit', function(e){
      e.preventDefault();            
      
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      $.ajax({
        url: "<?php echo base_url('save-detail-penerimaan'); ?>",
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
                location.reload();
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