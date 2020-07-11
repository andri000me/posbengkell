<script type='text/javascript'>    
    $(function(){
            'use strict';
    });

    var tableData;

    $(document).ready(function(){
        tableData = $('#tableSupplier').DataTable({
            bDestroy: true,
            responsive: true,
                "language": {
                    "searchPlaceholder": 'Cari Data Vendor (Supplier)',
                    "lengthMenu": '_MENU_ items/page',
                },
            ajax: "<?php echo base_url('data-supplier'); ?>",
            columns : [  
                {data :"nama"},
                {data :"alamat"},
                {data :"telepon"},
                {data :"email"},  
                {data :"lamanWeb"},             
                {data : null,
                    render : function(data){
                        return  `<a href='<?=site_url('edit-supplier/')?>${data.id}'>
                                    <span class='fa fa-edit mr-1 opsi text-warning cp'></span>
                                </a>
                                <span class='fa fa-trash ml-1 opsi text-danger cp'
                                onClick='hapusSupplier(${data.id}, "${data.nama}")'></span>`;
                    }
                }
            ]
        });

        setTimeout( function () {
            tableData.ajax.reload();
        }, 3000);
    });
    
    function hapusSupplier(idSupplier, namaSupplier){
        // swal({
        //     title   :   'Konfirmasi Hapus Supplier',
        //     text    :   'Apakah anda yakin akan menghapus supplier '+namaSupplier+' ?',
        //     icon    :   'info',
        //     buttons :   {
        //         confirm :   {
        //             text    :   'OK',
        //             value   :   true,
        //             visible :   true,
        //             closeModal  :   false   
        //         },
        //         cancel  :   {
        //             text    :   'Batal',
        //             value   :   false,
        //             visible :   true,
        //             closeModal  :   true
        //         }
        //     }
        // }).then(function(konfirmasi){
            // if(konfirmasi.value){
            let konfirmasi     =   confirm('Apakah anda yakin akan menghapus supplier '+namaSupplier+' ?');
            if(konfirmasi){
                $.ajax({
                    url     :   `<?=site_url('delete-supplier')?>`,
                    data    :   `idSupplier=${idSupplier}`,
                    type    :   'post',
                    success     :   function(responseFromServer){
                        let rFS     =   JSON.parse(responseFromServer);
                        if(rFS.deleteSupplier){
                            tableData.ajax.reload();
                        }
                    }
                })  
            }
        // });
    }
</script>
                                        

                                        
                                        