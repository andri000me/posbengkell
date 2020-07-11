<?php
    if($detailSupplier !== false){
        $idSupplier =   '/'.$detailSupplier->id;
    }else{
        $idSupplier =   '';
    }
?>
<script type='text/javascript'>    
    $('#formSupplier').on('submit', function(e){
        e.preventDefault();
        if(empty($('#nama').val()) || empty($('#alamat').val()) || empty($('#telepon').val()) || empty($('#email').val())){
            return false;
        }

        let dataSupplier    =   $(this).serialize();
        
        $.ajax({
            url     :   "<?=site_url('save-supplier')?><?=$idSupplier?>",
            data    :   dataSupplier,
            type    :   'POST',
            success     :   function(responseFromServer){
                let rFS     =   JSON.parse(responseFromServer);

                let swalType    =   'error';
                let swalMessage =   'Gagal Menyimpan Supplier !';
                let swalTitle   =   'Supplier';
                if(rFS.saveSupplier){
                    swalType    =   'success';
                    swalMessage =   'Berhasil Menyimpan Supplier';
                }

                swal({
                    title   :   swalTitle,
                    text    :   swalMessage,
                    icon    :   swalType,
                    buttons :   {
                        confirm :   'OK'
                    }
                }).then(function(){
                    if(rFS.saveSupplier){
                        location.reload();
                    }
                });
            }
        });
    });
    function empty(data){
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
                                        

                                        
                                        