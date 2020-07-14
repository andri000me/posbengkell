<script src='<?=base_url("assets_new/sweetalert2/sweetalert2.all.min.js")?>'></script>
<link rel="stylesheet" href="<?=base_url('assets_new/sweetalert2/sweetalert2.min.css')?>" />

<script language='Javascript'>
    function markAsSelesai(){
        let itemChecked     =   $('.item:checked').serialize();

        swal({
            title   :   'Konfirmasi Penyelesaian',
            text    :   'Apakah anda yakin sudah mengecek item pembelian dengan benar ?',
            type    :   'question',
            showCancelButton    :   true,
            showConfirmButton   :   true,
            confirmButtonText   :   'Ya, Lanjutkan',
            cancelButtonText    :   'Batalkan',
            focusCancel :   true,
            focusConfirm    :   false
        }).then((konfirmasi) => {
            if(konfirmasi.value){
                $.ajax({
                    url     :   '<?=site_url('pembelian-cek-item-selesai/')?><?=$idPembelian?>',
                    data    :   itemChecked,
                    type    :   'POST',
                    success     :    function(responseFromServer){
                        let rFS     =   JSON.parse(responseFromServer);
                        let swalTitle   =   'Pengecekan Item Pembelian';
                        let swalMessage =   'Penyelesaian pengecekan item pembelian gagal !';
                        let swalType    =   'error';

                        if(rFS.statusPenyelesaian){
                            swalMessage     =   'Penyelesaian pengecekan item pembelian berhasil';
                            swalType        =   'success';
                        }

                        swal({title : swalTitle, text : swalMessage, type : swalType}).then(() => {
                            if(rFS.statusPenyelesaian){
                                location.href   =   '<?=site_url('pembelian')?>';
                            }
                        });
                    }
                });
            }
        })
    }
    $('#tandaiSemuaAda').on('click', function(e){
        e.preventDefault();
        $('.item').prop('checked', true);
    })
    $('#tandaiSemuaTidakAda').on('click', function(e){
        e.preventDefault();
        $('.item').prop('checked', false);
    })
</script>