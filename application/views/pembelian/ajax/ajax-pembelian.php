<script language='Javascript'>
    let tabelPembelian;

    $(document).ready(function(){       
        let queryString     =   new URLSearchParams(location.search);
        let column          =   queryString.get('column');
        let start           =   queryString.get('start');
        let end             =   queryString.get('end');

        column  =   (column === null)? '' : column;
        start   =   (start === null)? '' : start;
        end     =   (end === null)? '' : end;

        tabelPembelian  =   $('#tabelPembelian').DataTable({
            bDestroy: true,
            responsive: true,
                "language": {
                    "searchPlaceholder": 'Cari Data Pembelian',
                    "lengthMenu": '_MENU_ items/page',
                },
            ajax: "<?php echo base_url('data-pembelian'); ?>?column="+column+'&start='+start+'&end='+end,
            columns : [  
                {data : null, render : function(data){
                    return  `<h6 class='mt-0 mb-1'>${data.namaVendor}</h6>
                            <p>Nomor Transaksi <span class='ml-2 badge badge-success'>${data.nomorTransaksi}</span></p>`;
                }},
                {data : null, render : function(data){
                    return  `${new Date(data.waktu).toDateString()}`;
                }},
                {data :"statusBelanja"},  
                {data : null, render : function(data){
                    return `Rp. ${numeral(data.totalBelanja).format('0,0')}`;
                }},
                {data : null, render : function(data){
                    return `Rp. ${numeral(data.tunai).format('0,0')}`;
                }},              
                {data : null,   
                    render : function(data){
                        return  `<a href='<?=site_url('detail-pembelian/')?>${data.id}' title='Detail Pembelian'>
                                    <span class='fa fa-list opsi text-info cp'></span>
                                </a>
                                <a href='<?=site_url('pembelian-export/excel/')?>${data.id}' title='Export ke Excel'>
                                    <span class='fa fa-file-excel-o text-success cp opsi ml-2 mr-2'></span>
                                </a>
                                <a href='<?=site_url('pembelian-export/pdf/')?>${data.id}' title='Export ke PDF'>
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