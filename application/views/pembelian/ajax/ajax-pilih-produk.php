<script src='<?=base_url('assets_new/js/jquery-ui-1.12.1/jquery-ui.min.js')?>'></script>
<link rel="stylesheet" href="<?=base_url('assets_new/js/jquery-ui-1.12.1/jquery-ui.min.css')?>" />

<script language='Javascript'>
    let vendorTerpilih  =   0;
    let namaVendorTerpilih  =   '';
    let btnSelesai  =   $('#btnSelesai').html();
    let tunai   =   0;
    let tagihan     =   Number.parseInt(<?=$grandTotal?>);
    let idPembelian     =   Number.parseInt(<?=$idPembelian?>);

    $('#cariProduk').autocomplete({
        source  :   '<?=site_url("auto-complete-sparepart?select=nama,kode_barang,harga_beli,id")?>',
        select  :   function(event, value){
            let item    =   value.item;
            let idProduk    =   item.id;
            
            tambahItem(idPembelian, idProduk);
        }
    }).autocomplete( "instance" )._renderItem = function(ul, item){
        let divHTML =   `<div class='py-2 px-3'>
            <h6 class='mt-0 mb-1 text-muted'>${item.nama}</h6>
            <p class='text-success' style='font-size:9pt'>Rp. ${numeral(item.harga_beli).format('0,0')}</p>
        </div>`;

        return $( "<li>" )
            .append(divHTML)
            .appendTo(ul);
    };
    $('#supplier').autocomplete({
        source  :   '<?=site_url("autocomplete-supplier?select=nama,id,lamanWeb")?>',
        select  :   function(event, value){
            let item    =   value.item;
            let idSupplierSelected  =   item.id;
            let namaSupplier    =   item.nama;  
            vendorTerpilih  =   Number.parseInt(idSupplierSelected);
            
            namaVendorTerpilih =    namaSupplier;

            toggleSelesai();    
            toggleShowSupplier();
        }
    }).autocomplete( "instance" )._renderItem = function(ul, item){
        let divHTML =   `<div class='py-2 px-3'>
            <h6 class='mt-0 mb-1 text-muted'>${item.nama}</h6>
            <p class='text-info' style='font-size:9pt'>${item.lamanWeb}</p>
        </div>`;

        return $( "<li>" )
            .append(divHTML)
            .appendTo(ul);
    };

    function toggleSelesai(){
        if(vendorTerpilih === 0 || tunai < tagihan){
            $('#btnSelesai').empty();
        }else{
            $('#btnSelesai').html(btnSelesai);
        }
    }

    function tunaiChanged(thisContext){
        let el  =   $(thisContext);
        if(el.val().length >= 1){
            tunai   =   Number.parseInt(el.val());
        }else{
            tunai   =   0;
        }

        toggleSelesai();
    }

    function tambahItem(idPembelian, idProduk, jumlahTambah = 1){
        let dataPOST    =   {idPembelian, idProduk, jumlahTambah};

        $.ajax({
            url     :   '<?=site_url('tambah-item-pembelian')?>',
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
            let dataPOST    =   {idPembelian, idProduk};

            $.ajax({
                url     :   '<?=site_url('hapus-item-pembelian')?>',
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

    function toggleShowSupplier(){
        if(vendorTerpilih === 0 || namaVendorTerpilih.length <= 0){
            $('#showNamaVendor').html('');
        }else{
            $('#showNamaVendor').html(`<span class='badge badge-info'>${namaVendorTerpilih}</span>`);
        }
    }
    
    function batal(){
        let konfirmasiBatal =   confirm('Apakah anda yakin akan membatalkan transaksi ini ?');
        if(konfirmasiBatal){
            let dataPOST    =   {idPembelian};
            $.ajax({
                url     :   '<?=site_url('batalkan-pembelian')?>',
                data    :   dataPOST,
                type    :   'POST',
                success     :   function(responseFromServer){
                    let rFS     =   JSON.parse(responseFromServer);
                    if(rFS.statusBatalkanPembelian){
                        location.href   =   '<?=site_url("pembelian")?>';
                    }else{
                        swal({
                            title   :   'Pembatalan Pembelian',
                            text    :   'Gagal Membatalkan Pembelian',
                            icon    :   'error'
                        });
                    }
                }
            });
        }
    }

    function selesai(){
        let dataPOST    =   {idPembelian, idVendor : vendorTerpilih, tunai};
        $.ajax({
            url     :   '<?=site_url('selesaikan-pembelian')?>',
            data    :   dataPOST,
            type    :   'POST',
            success     :   function(responseFromServer){
                let rFS     =   JSON.parse(responseFromServer);
                if(rFS.statusSelesaikanPembelian){
                    location.href   =   '<?=site_url("pembelian")?>';
                }else{
                    swal({
                        title   :   'Penyelesaian Pembelian',
                        text    :   'Gagal Menyelesaikan Pembelian',
                        icon    :   'error'
                    });
                }
            }
        });
    }

    toggleSelesai();
    toggleShowSupplier();
</script>