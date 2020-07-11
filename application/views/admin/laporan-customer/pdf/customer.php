<!DOCTYPE html>

<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Laporan Pelanggan</title>
        <link rel="stylesheet" href="<?=base_url('assets_new/css/bootstrap.min.css')?>">
        <style>
            tr.text-sm > td{
                font-size:10pt;
            }
        </style>
    </head>
    <body>
        <h4 class='text-center'>Laporan Customer</h4>
        <br class='mb-5' />
        <?php 
            if(!is_null($column) && !is_null($start) && !is_null($end)){
        ?>
        <div class="row mb-3">
            <div class="col-xl-6">
                <div class="table-reponsive">
                    <table class="table-sm">
                        <tr>
                            <td class="text-left">Parameter</td>
                            <td class="text-center">:</td>
                            <td class="text-left"><?=$columnTD?></td>
                        </tr>
                        <tr>
                            <td class="text-left">Rentang Nilai</td>
                            <td class="text-center">:</td>
                            <td class="text-left"><?=$startTD?> s/d <?=$endTD?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-xl-12 table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-left">Nama</th>
                            <th class="text-right">Telepon</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Admin</th>
                            <?php if(!is_null($column)){ ?>
                                <th class="text-left"><?=$columnTD?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listCustomer as $indexData => $customer){ ?>
                            <tr class='text-sm'>
                                <td class="text-center"><?=$indexData+1?></td>
                                <td class="text-left"><?=$customer['nama_pemilik']?></td>
                                <td class="text-right"><?=$customer['telepon_pemilik']?></td>
                                <td class="text-left"><?=$customer['email_pemilik']?></td>
                                <td class="text-left"><?=strtoupper($customer['admin'])?></td>
                                <?php if(!is_null($column)){ ?>
                                    <td class="text-left"><?=$customer[$column]?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>