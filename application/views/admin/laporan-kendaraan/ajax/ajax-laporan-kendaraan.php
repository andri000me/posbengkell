<script>   
$(function(){
        'use strict';
});

var tableDataKendaraan;
$(document).ready(function(){
    
    let queryString     =   new URLSearchParams(location.search);
    let column          =   queryString.get('column');
    let start           =   queryString.get('start');
    let end             =   queryString.get('end');

    column  =   (column === null)? '' : column;
    start   =   (start === null)? '' : start;
    end     =   (end === null)? '' : end;

    tableDataKendaraan = $('#konten-kendaraan').DataTable({
                                "bDestroy": true,
                                "responsive": true,
                                      "language": {
                                        "searchPlaceholder": 'Search...',
                                        "sSearch": '',
                                        "lengthMenu": '_MENU_ items/page',
                                      },
                                "ajax": "<?=base_url('view-kendaraan-bengkel')?>?column="+column+"&start="+start+'&end='+end,
                                "columns" : [  
                                    {"data" :"id"},
                                    {"data" :"nama_pemilik"},
                                    {"data" :"no_polisi"},
                                    {"data" :"no_rangka"},            
                                    {"data" :"no_mesin"},            
                                    {"data" :"tipe_warna"},            
                                    {"data" :"tahun_produksi"},            
                                    {"data" : null,
                                         "render":function(data){
                                            return `<button  style="margin:2px" class="btn btn-info" onclick=openHistory("`+ data.no_polisi.split(' ').join('') +`");><i class="ion-ios-timer"></i> Riwayat</button>`;
                                        }
                                    }
                                ]
                            } 
                        );


    setTimeout( function () {
        tableDataKendaraan.ajax.reload();
    }, 3000);

    // $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
});

function openHistory(id){
    $.ajax({
        url: "<?=base_url('view-laporan-trx-kendaraan'); ?>",        
        type: "POST",
        dataType: "JSON",
        data: {
            "no_polisi" : id
        },
        success: function(r){       
            var riwayat = "";
            for (var i = 0; i < r.data.length ; i++) {
                riwayat += `<tr>
                                <td>`+ r.data[i].jenis_service +`</td>
                                <td>`+ r.data[i].nama_sparepart+`</td>                                
                                <td> Rp.`+ rupiah(r.data[i].total_revenue)+`</td>                                
                                <td>`+ r.data[i].service_advisor+`</td>                                
                                <td>`+ r.data[i].teknisi+`</td>                                
                                <td>`+ r.data[i].tanggal_service+`</td>                                
                            </tr>`;
            }
            $("#konten-riwayat").html(riwayat);
        }
      });  
    
    $('#modal').modal({backdrop: 'static', keyboard: false},'show');                    
}

function rupiah(angka){
    var reverse = angka.toString().split('').reverse().join(''),
    ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    if (angka < 0) {
        return "-"+ribuan;
    }
    return ribuan;
}

function btnClose(){
    $('#modal').modal('hide');      
}

    let toggleFilterState   =   false; 
    //false = hide, true = show

    function toggleFilter(){
        if(toggleFilterState){
            $('#filter').slideDown();
            $('#filterHR').show();
        }else{
            $('#filter').slideUp();
            $('#filterHR').hide();
        }
    }

    toggleFilter();
    
    $('#toggleFilter').on('click', function(e){
        e.preventDefault();
        toggleFilterState   =   !toggleFilterState;
        toggleFilter();
    })

    let dataTypeSelected    =   '';
    $('#column').on('change', function(){
        let selectedOption      =   $(this).find('option:selected');
        dataTypeSelected    =   selectedOption.attr('inputType');

        columnChanged();
    });
    function columnChanged(){
        let dataType    =   dataTypeSelected.toLowerCase();
        if(dataType.length >= 1){
            $('#start, #end').attr('disabled', false);
            $('#start, #end').attr('type', dataType);
        }else{
            $('#start, #end').attr('disabled', true);
        }
    }

    columnChanged();
    
</script>
                                        

                                        
                                        