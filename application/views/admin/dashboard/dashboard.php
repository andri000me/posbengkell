<div class="container-fluid px-xxl-65 px-xl-20">
  <div class="hk-pg-header">
      <h4 class="hk-pg-title">
        <span class="pg-title-icon">
          <span class="feather-icon">
            <i data-feather="database"></i>
          </span>
        </span><?=$subtitle_small?>
      </h4>
  </div>
  <div class="row">
  		<div class="col-md-3">
			<section class="hk-sec-wrapper">
			  	<div class="card-body">
					<span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Jumlah Pelanggan</span>
					<div class="d-flex align-items-end justify-content-between">
						<div>
							<span class="d-block">
								<span class="display-5 font-weight-400 text-dark"><?=$jumlah_customer?></span>
								<small>pelanggan</small>
							</span>
							<a href="<?=base_url('laporan-customer')?>" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</div>
			</section>
	    </div>
      	<div class="col-md-3">
         	<section class="hk-sec-wrapper">
	            <div class="card-body">
					<span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Jumlah Kendaraan</span>
					<div class="d-flex align-items-end justify-content-between">
						<div>
							<span class="d-block">
								<span class="display-5 font-weight-400 text-dark"><?=$jumlah_kendaraan?></span>
								<small>kendaraan</small>
							</span>
							<a href="<?=base_url('laporan-kendaraan')?>" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</div>                                
          	</section>
      	</div>

      	<div class="col-md-3">
         	<section class="hk-sec-wrapper">
	            <div class="card-body">
					<span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Jumlah Sedang dikerjakan</span>
					<div class="d-flex align-items-end justify-content-between">
						<div>
							<span class="d-block">
								<span class="display-5 font-weight-400 text-dark"><?=$jumlah_order_service?></span>
								<small>kendaraan</small>
							</span>
						</div>
					</div>
				</div>                                
          	</section>
      	</div>

      	<div class="col-md-3">
         	<section class="hk-sec-wrapper">
	            <div class="card-body">
					<span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Jumlah Booking</span>
					<div class="d-flex align-items-end justify-content-between">
						<div>
							<span class="d-block">
								<span class="display-5 font-weight-400 text-dark"><?=$jumlah_order_booking?></span>
								<small>kendaraan</small>
							</span>
						</div>
					</div>
				</div>                                
          	</section>
      	</div>      

      	<div class="col-md-3">
         	<section class="hk-sec-wrapper">
	            <div class="card-body">
					<span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Jumlah Pegawai</span>
					<div class="d-flex align-items-end justify-content-between">
						<div>
							<span class="d-block">
								<span class="display-5 font-weight-400 text-dark"><?=$jumlah_pegawai?></span>
								<small>Pegawai</small>
							</span>
							<a href="<?=base_url('data-pegawai')?>" class="btn btn-primary">Lihat</a>							
						</div>
					</div>
				</div>                                
          	</section>
      	</div>      
  </div>
</div>