<script>   
$(function(){
        'use strict';
});

var tableDataPelanggan;
$(document).ready(function(){
    let queryString     =   new URLSearchParams(location.search);
    let column          =   queryString.get('column');
    let start           =   queryString.get('start');
    let end             =   queryString.get('end');

    column  =   (column === null)? '' : column;
    start   =   (start === null)? '' : start;
    end     =   (end === null)? '' : end;

    tableDataPelanggan = $('#konten-pelanggan').DataTable({
                                "bDestroy": true,
                                "responsive": true, 
                                      "language": {
                                        "searchPlaceholder": 'Search...',
                                        "sSearch": '',
                                        "lengthMenu": '_MENU_ items/page',
                                      },
                                "ajax": "<?php echo base_url('view-pelanggan-bengkel'); ?>?column="+column+"&start="+start+'&end='+end,
                                "columns" : [  
                                    {"data" :"id"},
                                    {"data" :"nama_pemilik"},
                                    {"data" :"email_pemilik"},            
                                    {"data" :"alamat_pemilik"},            
                                    {"data" :"telepon_pemilik"},            
                                ]
                            } 
                        );


    setTimeout( function () {
        tableDataPelanggan.ajax.reload();
    }, 3000);

    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
});

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
                                        

                                        
                                        