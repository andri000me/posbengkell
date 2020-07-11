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
			<button class="btn btn-info" id="toggleFilter" title='Tampilkan Filter'>
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
									<option value="tgl_penerimaan" inputType='date' 
										<?=($column !== null && $column === 'tgl_penerimaan')? 'selected':''?>>Tanggal Penerimaan</option>
									<option value="tgl_transaksi" inputType='date'
										<?=($column !== null && $column === 'tgl_transaksi')? 'selected':''?>>Tanggal Transaksi</option>
									<option value="tahun_produksi" inputType='number'
										<?=($column !== null && $column === 'tahun_produksi')? 'selected':''?>>Tahun Produksi</option>
									<option value="kilometer" inputType='number'
										<?=($column !== null && $column === 'kilometer')? 'selected':''?>>Kilometer</option>
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
	      <section class="hk-sec-wrapper" id="container-pelanggan">
	          <div class="row">
	              <div class="col-sm">
	                  <div class="table-wrap">
	                      <table id="konten-pelanggan" class="table table-hover w-100 display pb-30">
	                          <thead>                                      
	                              <tr>
	                                  <th>Id</th>
	                                  <th>Nama</th>
	                                  <th>Email</th>
	                                  <th>Alamat</th>
	                                  <th>Telepon</th>
	                              </tr>
	                          </thead>
	                      </table>
						  <hr />
						  <?php 
								  $hrefExcel	=	site_url('customer-excel');
								  $hrefPDF 		=	site_url('customer-pdf');
						 		if(!is_null($column) && !is_null($start) && !is_null($end)){
									$hrefExcel 	=	site_url('customer-excel').'?column='.$column.'&start='.$start.'&end='.$end;
									$hrefPDF 	=	site_url('customer-pdf').'?column='.$column.'&start='.$start.'&end='.$end;
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