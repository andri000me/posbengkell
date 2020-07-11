<script>   
$(function(){
        'use strict';
});

var tableData;
    $(document).ready(function(){         
        let queryString     =   new URLSearchParams(location.search);
        let column          =   queryString.get('column');
        let start           =   queryString.get('start');
        let end             =   queryString.get('end');

        column  =   (column === null)? '' : column;
        start   =   (start === null)? '' : start;
        end     =   (end === null)? '' : end;

        tableData = $('#konten').DataTable({
            "processing": true, 
            "serverSide": false,
            "destroy": true,
            "responsive": true,
            "ajax": "<?php echo base_url('view-laporan-profitabilitas'); ?>?column="+column+'&start='+start+'&end='+end,
            "columns" : [  
                {"data" :"id"},
                {"data" :"no_pkb"},
                {"data" :"no_polisi"},
                {"data" :"revenue_service", 
                    render: function ( data, type, row ) {
                        console.log(row);
                        return "Rp " + rupiah(parseInt(data));
                    }
                },      
                {"data" :"revenue_sparepart", 
                    render: function ( data, type, row ) {
                        return "Rp " + rupiah(parseInt(data));
                    }
                },            
                {"data" :"total_revenue", 
                    render: function ( data, type, row ) {
                        return "Rp " + rupiah(parseInt(data));
                    }
                },   
                {"data" :"cost_service", 
                    render: function ( data, type, row ) {
                        return "Rp " + rupiah(parseInt(data));
                    }
                },      
                {"data" :"cost_sparepart", 
                    render: function ( data, type, row ) {
                        return "Rp " + rupiah(parseInt(data));
                    }
                },    
                {"data" :"total_cost", 
                    render: function ( data, type, row ) {
                        return "Rp " + rupiah(parseInt(data));
                    }
                },  
                {"data" :"diskon_service", 
                    render: function ( data, type, row ) {
                        return data + "%";
                    }
                },  
                {"data" :"diskon_sparepart", 
                    render: function ( data, type, row ) {
                        return data + "%";
                    }
                }, 
                {"data" :"profit_service", 
                    render: function ( data, type, row ) {
                        return "Rp " + rupiah(parseInt(data));
                    }
                }, 
                {"data" :"profit_sparepart", 
                    render: function ( data, type, row ) {
                        return "Rp " + rupiah(parseInt(data));
                    }
                },
                {"data" :"total_profit", 
                    render: function ( data, type, row ) {
                        return "Rp " + rupiah(parseInt(data));
                    }
                }, 

            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                // Total over all pages
                total = api
                    .column( 13 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                
                // Total over this page
                pageTotal = api
                    .column( 13, {page: 'current'})
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Update footer
                $( api.column( 13 ).footer() ).html(
                    'Rp'+ rupiah(pageTotal) +' ( Rp'+ rupiah(total) +' total)'
                );
            }
        }        
    );

     function rupiah(angka){

       var reverse = angka.toString().split('').reverse().join(''),
       ribuan = reverse.match(/\d{1,3}/g);
       ribuan = ribuan.join('.').split('').reverse().join('');
       if (angka < 0) {
            return "-"+ribuan;
       }
       return ribuan;
     }


    setTimeout( function () {
        tableData.ajax.reload();
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
                                        

                                        
                                        