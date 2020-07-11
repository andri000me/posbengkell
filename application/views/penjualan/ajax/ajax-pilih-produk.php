<script src='<?=base_url('assets_new/js/jquery-ui-1.12.1/jquery-ui.min.js')?>'></script>
<link rel="stylesheet" href="<?=base_url('assets_new/js/jquery-ui-1.12.1/jquery-ui.min.css')?>" />

<script language='Javascript'>
    let btnSelesai      =   $('#btnSelesai').html();
    let tagihan         =   Number.parseInt(<?=$grandTotal?>);
    let idPenjualan     =   Number.parseInt(<?=$idPenjualan?>);
    
    let diskonTyped         =   0;
    let tunaiBayar          =   0;
    let tagihanMutable      =   tagihan;

    $('#cariProduk').autocomplete({
        source  :   '<?=site_url("auto-complete-sparepart?select=nama,kode_barang,harga_jual,id")?>',
        select  :   function(event, value){
            let item    =   value.item;
            let idProduk    =   item.id;
            
            tambahItem(idPenjualan, idProduk);
        }
    }).autocomplete( "instance" )._renderItem = function(ul, item){
        let divHTML =   `<div class='py-2 px-3'>
            <h6 class='mt-0 mb-1 text-muted'>${item.nama}</h6>
            <p class='text-success' style='font-size:9pt'>Rp. ${numeral(item.harga_jual).format('0,0')}</p>
        </div>`;

        return $( "<li>" )
            .append(divHTML)
            .appendTo(ul);
    };

    function tambahItem(idPenjualan, idProduk, jumlahTambah = 1){
        let dataPOST    =   {idPenjualan, idProduk, jumlahTambah};

        $.ajax({
            url     :   '<?=site_url('tambah-item-penjualan')?>',
            data    :   dataPOST,
            type    :   'POST',
            success     :   function(responseFromServer){
                let rFS     =   JSON.parse(responseFromServer);
                if(rFS.statusTambahItem){
                    location.reload();
                }else{
                    swal({
                        title   :   'Tambah Produk',
                        text    :   'Gagal Menambah Produk',
                        icon    :   'error'
                    });
                }
            }
        })
    }

    function hapusItem(thisContext, idProduk){
        let konfirmasi  =   confirm('Apakah anda yakin akan membatalkan item belanja ini ?');
        if(konfirmasi){
            let dataPOST    =   {idPenjualan, idProduk};

            $.ajax({
                url     :   '<?=site_url('hapus-item-penjualan')?>',
                data    :   dataPOST,
                type    :   'POST',
                success     :   function(responseFromServer){
                    let rFS     =   JSON.parse(responseFromServer);
                    if(rFS.statusHapusItem){
                        location.reload();
                    }else{
                        swal({
                            title   :   'Hapus Item Belanja',
                            text    :   'Gagal Menghapus Item Belanja',
                            icon    :   'error'
                        });
                    }
                }
            });
        }
    }
    
    function batal(){
        let konfirmasiBatal =   confirm('Apakah anda yakin akan membatalkan transaksi penjualan ini ?');
        if(konfirmasiBatal){
            let dataPOST    =   {idPenjualan};
            $.ajax({
                url     :   '<?=site_url('batalkan-penjualan')?>',
                data    :   dataPOST,
                type    :   'POST',
                success     :   function(responseFromServer){
                    let rFS     =   JSON.parse(responseFromServer);
                    if(rFS.statusBatalkanPenjualan){
                        location.href   =   '<?=site_url("penjualan")?>';
                    }else{
                        swal({
                            title   :   'Pembatalan Penjualan',
                            text    :   'Gagal Membatalkan Penjualan',
                            icon    :   'error'
                        });
                    }
                }
            });
        }
    }

    function selesai(){
        let dataPOST    =   {idPenjualan, tunai : tunaiBayar, diskon : diskonTyped};
        $.ajax({
            url     :   '<?=site_url('selesaikan-penjualan')?>',
            data    :   dataPOST,
            type    :   'POST',
            success     :   function(responseFromServer){
                let rFS     =   JSON.parse(responseFromServer);
                if(rFS.statusSelesaikanPenjualan){
                    location.href   =   '<?=site_url("penjualan")?>';
                }else{
                    swal({
                        title   :   'Penyelesaian Penjualan',
                        text    :   'Gagal Menyelesaikan Penjualan',
                        icon    :   'error'
                    });
                }
            }
        });
    }

    function diskonHandler(thisContext){
        let el  =   $(thisContext);
        diskonTyped     =   Number.parseInt(el.val());

        if(diskonTyped > tagihan){
            $('#diskonNotification').html('<span class="text-danger">Diskon Tidak Boleh Lebih Besar dari Tagihan</span>');
        }else{
            $('#diskonNotification').empty();
        }

        tagihanMutable    =   tagihan - diskonTyped;

        toggleShowSelesai();
    }

    function tunaiHandler(thisContext){
        let el  =   $(thisContext);
        tunaiBayar  =   Number.parseInt(el.val());
        toggleShowSelesai();
    }

    function toggleShowSelesai() {
        let isTunaiOK   =   tunaiBayar >= tagihanMutable;
        if(isTunaiOK){
            $('#btnSelesai').html(btnSelesai);
        }else{
            $('#btnSelesai').empty();
        }
    }

    toggleShowSelesai();
</script>