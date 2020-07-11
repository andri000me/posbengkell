<div class="container-fluid px-xxl-65 px-xl-20">
	<div class="hk-pg-header row">
		<div class='col-xl-6'>
			<h4 class="hk-pg-title">
				<span class="pg-title-icon">
					<span class="feather-icon">
						<i data-feather="database"></i>
					</span>
				</span>
				<span id="title-konten"><?=$subtitle_small?></span>
			</h4>
		</div>
		<div class='col-xl-6 text-right'>
			<button class="btn btn-info" id="toggleFilter">
				<span class="fa fa-filter"></span>
			</button>
		</div>
	</div>
	<hr />
	<div class='row' id='filter'>
		<div class="col-xl-12">
			<form id="formFilter">
				<div class="row">
					<div class="col-xl-6">
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
									<option value="tgl_input" inputType='date' 
										<?=($column !== null && $column === 'tgl_input')? 'selected':''?>>Tanggal Input</option>
									<option value="tgl_transaksi" inputType='date' 
										<?=($column !== null && $column === 'tgl_transaksi')? 'selected':''?>>Tanggal Transaksi</option>
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
	      <section class="hk-sec-wrapper" id="container-kendaraan">
	          <div class="row">
	              <div class="col-sm">
	                  <div class="table-wrap">
	                      <table id="konten" class="table table-hover w-100 display pb-30">
	                          <thead>                                      
	                              <tr>
	                                  <th scope="col">Tanggal Transaksi</th>
	                                  <th scope="col">Kode Barang</th>
	                                  <th scope="col">Nama Barang</th>
	                                  <th scope="col">Tanggal Input</th>
	                                  <th scope="col">Sisa Stok</th>
	                                  <th scope="col">Barang Terjual</th>
	                                  <th scope="col">Nilai Barang Terjual</th>	                                  
	                              </tr>
	                          </thead>
	                          <tbody></tbody>
				              <tfoot>
				                <tr>
				                  <th colspan="3" style="text-align:left">Total:</th>				                  
				                  <th colspan="4"  scope="col" id='total-amount' style="text-align:right"></th>
				                </tr>
				              </tfoot>
	                      </table>
						  <hr />
						  <?php 
								  $hrefExcel	=	site_url('sparepart-excel');
								  $hrefPDF 		=	site_url('sparepart-pdf');
						 		if(!is_null($column) && !is_null($start) && !is_null($end)){
									$hrefExcel 	=	site_url('sparepart-excel').'?column='.$column.'&start='.$start.'&end='.$end;
									$hrefPDF 	=	site_url('sparepart-pdf').'?column='.$column.'&start='.$start.'&end='.$end;
								} 
						  ?>
						  <a target='_blank' href="<?=$hrefExcel?>">
							<button class="btn btn-success mr-2" id="exportExcel">
								Export ke Excel
							</button>
						  </a>
						  <a target='_blank' href='<?=$hrefPDF?>'>
							<button class="btn btn-warning" id="exportPDF">
								Export ke PDF
							</button>
						  </a>
	                  </div>
	              </div>
	          </div>
	      </section>
	  </div>
	</div>
</div>