<?php
    $this->db->where('id', $idPenjualan);
    $detailPenjualan    =   $this->db->get('view_penjualan');

    if($detailPenjualan->num_rows() >= 1){
        $detailPenjualan    =   $detailPenjualan->row();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Surat Jalan Penjualan <?=$detailPenjualan->nomorTransaksi?></title>
        <link rel="stylesheet" href="<?=base_url('assets_new/css/bootstrap.min.css')?>">
        <style>
            tr.text-sm > td, tr.tr-parent > td{
                font-size:10pt;
                padding:2px 0;
            }
        </style>
    </head>
    <body>
        <h4 class='text-center'>Surat Jalan Penjualan</h4>
        <br />
        <div class="row">
            <div class="col-xl-12 table-responsive">
                <table class='table table-sm'>
                    <tr class='tr-parent'>
                        <td class='border-top-0'>ID Bengkel</td>
                        <td class='border-top-0'>:</td>
                        <td class='border-top-0'>
                            <span class='badge badge-info'>
                                <?=$detailPenjualan->idBengkel?>
                            </span>
                        </td>
                    </tr>
                    <tr class='tr-parent'>
                        <td class='border-top-0'>Nomor Transaksi</td>
                        <td class='border-top-0'>:</td>
                        <td class='border-top-0'><?=$detailPenjualan->nomorTransaksi?></td>
                    </tr>
                    <tr class='tr-parent'>
                        <td class='border-top-0'>Total Belanja</td>
                        <td class='border-top-0'>:</td>
                        <td class='border-top-0'>
                            Rp. <?=number_format($detailPenjualan->totalBelanja)?>
                            <?php if($detailPenjualan->diskon >= 1){ ?>
                                <p class='text-warning'>Diskon Rp. <?=number_format($detailPenjualan->diskon)?></p>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr class='tr-parent'>
                        <td class='border-top-0'>Tunai</td>
                        <td class='border-top-0'>:</td>
                        <td class='border-top-0'>Rp. <?=number_format($detailPenjualan->tunai)?></td>
                    </tr>
                    <tr class='tr-parent'>
                        <td class='border-top-0'>Waktu</td>
                        <td class='border-top-0'>:</td>
                        <td class='border-top-0'><?=date('D, d M y H:i:s', strtotime($detailPenjualan->waktu))?></td>
                    </tr>
                </table>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-xl-12 table-responsive">
                <table class='table table-sm'>
                    <thead>
                        <tr>
                            <th class='border-top-0 text-center'>No.</th>
                            <th class='border-top-0 text-left'>Produk</th>
                            <th class='border-top-0 text-right'>Harga</th>
                            <th class='border-top-0 text-right'>Diskon</th>
                            <th class='border-top-0 text-right'>Quantity</th>
                            <th class='border-top-0 text-right'>Total Harga</th>
                            <th class='border-top-0 text-left'>Ketersediaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $this->db->where('idPenjualan', $idPenjualan);
                            $itemPenjualan  =   $this->db->get('view_penjualan_item');

                            if($itemPenjualan->num_rows() >= 1){
                                foreach($itemPenjualan->result_array() as $indexData =>  $item){
                                    ?>
                                        <tr>
                                            <td class='text-center'><?=$indexData+1?></td>
                                            <td class='text-left'><?=$item['namaProduk']?></td>
                                            <td class='text-right'>Rp. <?=number_format($item['harga'])?></td>
                                            <td class='text-right'>Rp. <?=number_format($item['diskon'])?></td>
                                            <td class='text-right'><?=number_format($item['quantity'])?> item</td>
                                            <td class='text-right'>Rp. <?=number_format($item['totalHarga'])?></td>
                                            <td class='text-left'>
                                                <span class='badge badge-<?=($item['produkAda'] == 1)? 'success' : 'danger'?>'>
                                                    <?=($item['produkAda'] == 1)? 'Tersedia' : 'Tidak Tersedia'?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<?php } ?>