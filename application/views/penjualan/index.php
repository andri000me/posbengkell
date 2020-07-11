<style type='text/css'>
    .opsi{
        font-size:12.5pt;
    }
</style>
<div class="container-fluid px-xxl-65 px-xl-20">
    <div class="hk-pg-header">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <h4 class="hk-pg-title">
                        <span class="pg-title-icon">
                            <span class="feather-icon">
                                <i data-feather="external-link"></i>
                            </span>
                        </span>
                        <?=$subtitle_small?>
                    </h4>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right pr-0">
                    <a href='<?=site_url("create-penjualan-baru")?>'>
                        <button class="btn btn-success">
                            <span class="fa fa-shopping-cart mr-2"></span>
                            Penjualan Baru
                        </button>
                    </a>
                    <button class="btn btn-info ml-1" title='Tampilkan Filter' id='toggleFilter'>
                        <span class="fa fa-filter"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>    
	<hr />
	<div class='row' id='filter'>
		<div class="col-xl-12">
			<form id="formFilter">
				<div class="row">
					<div class="col-xl-4">
						<div class="form-group">
							<label for="rentangData">Rentang Data</label>
							<div class="input-group" id='rentangData'>
								<?php
									$column 	=	$this->input->get('column');
									$start 		=	$this->input->get('start');
									$end 		=	$this->input->get('end');
								?>	
								<select name="column" id="column" class="form-control">
									<option value="pilihan_entitas" inputType=''>Pilihan Entitas</option>
									<option value="diskon" inputType='number' 
										<?=($column !== null && $column === 'diskon')? 'selected':''?>>Diskon Belanja</option>
									<option value="tunai" inputType='number' 
										<?=($column !== null && $column === 'tunai')? 'selected':''?>>Tunai yang dibayar</option>
									<option value="totalBelanja" inputType='number' 
										<?=($column !== null && $column === 'totalBelanja')? 'selected':''?>>Total Belanja</option>
									<option value="waktu" inputType='date' 
										<?=($column !== null && $column === 'waktu')? 'selected':''?>>Waktu Belanja</option>
								</select>
								<input type="date" class="form-control" placeholder='Nilai Awal' id='start' name='start' 
									value='<?=($start !== null)? $start : ''?>' />
								<input type="date" class="form-control" placeholder='Nilai Akhir' id='end' name='end'
									value='<?=($end !== null)? $end : ''?>' />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-12">
						<button class="btn btn-success" type='submit'>Terapkan Filter</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<hr id='filterHR' />
    <div class="row">
        <div class="col-xl-12">            
            <div class="row">                
                <div class="col-md-12">
                    <div class="card card-sm ml-1 mr-1">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover display pb-30" id='tabelPenjualan'>
                                    <thead>
                                        <tr>
                                            <th>ID Bengkel</th>
                                            <th>Nomor Transaksi</th>
                                            <th>Total Penjualan</th>
                                            <th>Diskon</th>
                                            <th>Status Penjualan</th>
                                            <th>Waktu</th>
                                            <th>Opsi</th>
                                        </tr> 
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>                 
                </div>            
            </div>
        </div>
    </div>
</div>