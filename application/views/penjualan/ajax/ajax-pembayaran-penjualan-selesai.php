<script src='<?=base_url("assets_new/sweetalert2/sweetalert2.all.min.js")?>'></script>
<link rel="stylesheet" href="<?=base_url('assets_new/sweetalert2/sweetalert2.min.css')?>" />

<script language='Javascript'>
    let isBayarOK   =   false;

    let btnSelesai  =   $('#btnSelesai').html();
    let grandTotal  =   Number.parseInt("<?=$grandTotal?>");
    let idPenjualan     =   "<?=$idPenjualan?>";

    let bayarTyped      =   0;
    let diskonTyped     =   0;
    let tagihanBersih   =   grandTotal;

    function bayar(thisContext){
        let el  =   $(thisContext);
        bayarTyped  =   el.val();
        bayarTyped      =   Number.parseInt(bayarTyped);

        if(bayarTyped >= tagihanBersih){
            isBayarOK   =   true;
        }else{
            isBayarOK   =   false;
        }

        toggleSelesai();
    }
    function diskonHandler(thisContext){
        let el  =   $(thisContext);
        diskonTyped     =   el.val();
        diskonTyped     =   Number.parseInt(diskonTyped);

        tagihanBersih   =   grandTotal - diskonTyped;

        bayar('#bayar');
    }
    function toggleSelesai(){
        if(!isBayarOK){
            $('#btnSelesai').empty();
        }else{
            $('#btnSelesai').html(btnSelesai);
        }
    }
    toggleSelesai();

    function selesaiLunas(){
        $.ajax({
            url     :   "<?=site_url('penjualan-lunas')?>/<?=$idPenjualan?>",
            data    :   `idPenjualan=${idPenjualan}&bayar=${bayarTyped}&diskon=${diskonTyped}`,
            type    :   'POST',
            success :   function(responseFromServer){
                let rFS     =   JSON.parse(responseFromServer);

                let swalTitle       =   'Pelunasan Penjualan';
                let swalMessage     =   'Pelunasan penjualan gagal !';
                let swalType        =   'error';
                if(rFS.statusPelunasan){
                    swalMessage     =   'Pelunasan penjualan berhasil';
                    swalType       =   'success';
                }

                swal({
                    title   :   swalTitle,
                    text    :   swalMessage,
                    type    :   swalType
                }).then(() => {
                    if(rFS.statusPelunasan){
                        location.href   =   '<?=site_url("penjualan")?>';
                    }
                });
            }
        })
    }
</script>