<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Laporan Profitabilitas</title>
        <link rel="stylesheet" href="<?=base_url('assets_new/css/bootstrap.min.css')?>">
        <style>
            tr.text-sm > td{
                font-size:10pt;
            }
        </style>
    </head>
    <body>
        <h4 class='text-center'>Laporan Profitabilitas</h4>
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
                            <th scope="col">Id</th>
                            <th scope="col">No. PKB</th>
                            <th scope="col">No. Polisi</th>
                            <th scope="col">Revenue Service</th>
                            <th scope="col">Revenue Sparepart</th>
                            <th scope="col">Total Revenue</th>
                            <th scope="col">Cost Service</th>
                            <th scope="col">Cost Sparepart</th>
                            <th scope="col">Total Cost</th>
                            <th scope="col">Discount Service</th>
                            <th scope="col">Discount Sparepart</th>
                            <th scope="col">Profit Service</th>
                            <th scope="col">Profit Sparepart</th>
                            <th scope="col">Total Profit</th>	                                  
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dataLengkap as $row){ ?>    
                            <tr class='tr-parent text-sm'>
                                <td><?=$row['id']?></td>
                                <td><?=$row['no_pkb']?></td>
                                <td><?=$row['no_polisi']?></td>
                                <td>Rp. <?=number_format($row['revenue_service'])?></td>
                                <td>Rp. <?=number_format($row['revenue_sparepart'])?></td>   
                                <td>Rp. <?=number_format($row['total_revenue'])?></td>      
                                <td>Rp. <?=number_format($row['cost_service'])?></td>      
                                <td>Rp. <?=number_format($row['cost_sparepart'])?></td>    
                                <td>Rp. <?=number_format($row['total_cost'])?></td>       
                                <td><?=$row['diskon_service']?>%</td>    
                                <td><?=$row['diskon_sparepart']?>%</td>
                                <td>Rp. <?=number_format($row['profit_service'])?></td>
                                <td>Rp. <?=number_format($row['profit_sparepart'])?></td>
                                <td>Rp. <?=number_format($row['total_profit'])?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>