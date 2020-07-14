<script language='Javascript'>
    let tabelPenjualan;

    $(document).ready(function(){
        let queryString     =   new URLSearchParams(location.search);
        let column          =   queryString.get('column');
        let start           =   queryString.get('start');
        let end             =   queryString.get('end');

        column  =   (column === null)? '' : column;
        start   =   (start === null)? '' : start;
        end     =   (end === null)? '' : end;

        tabelPenjualan  =   $('#tabelPenjualan').DataTable({
            bDestroy: true,
            responsive: true,
                "language": {
                    "searchPlaceholder": 'Cari Data Penjualan',
                    "lengthMenu": '_MENU_ items/page',
                },
            ajax: "<?php echo base_url('data-penjualan'); ?>?column="+column+'&start='+start+'&end='+end,
            columns : [  
                {data : null, render : function(data){
                    return  `${data.idBengkel}`;
                }},  
                {data : null, render : function(data){
                    return  `${data.nomorTransaksi}`;
                }}, 
                {data : null, render : function(data){
                    return `Rp. ${numeral(data.totalBelanja).format('0,0')}`;
                }},
                {data : null, render : function(data){
                    return `Rp. ${numeral(data.diskon).format('0,0')}`;
                }}, 
                {data : 'statusPenjualan'},
                {data : null, render : function(data){
                    return  `${new Date(data.waktu).toDateString()}`;
                }},             
                {data : null,   
                    render : function(data){
                        return  `<a href='<?=site_url('detail-penjualan/')?>${data.id}'>
                                    <span class='fa fa-list opsi text-info cp'></span>
                                </a>
                                <a class='ml-2' href='<?=site_url('penjualan-export/pdf/')?>${data.id}' title='Export ke PDF'>
                                    <span class='fa fa-file-pdf-o text-warning cp opsi'></span>
                                </a>`;
                    }
                }
            ]
        });
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