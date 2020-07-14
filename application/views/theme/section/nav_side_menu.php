<nav class="hk-nav hk-nav-dark">
<a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close">
    <span class="feather-icon"><i data-feather="x"></i></span></a>
<div class="nicescroll-bar">
    <div class="navbar-nav-wrap">
        <ul class="navbar-nav flex-column">
            <li class="nav-item <?php echo ($page == 'dashboard' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?=base_url('dashboard')?>">
                    <i class="ion ion-md-analytics" style="font-size: 23px"></i>
                    <!-- <i class="fas fa-chart-line"></i> -->

                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <?php if($allow->kasir == 'ya'){ ?>
            <li class="nav-item <?php echo ($page == 'kasir' ? 'active' : ''); ?>">
                <a class="nav-link" href="javascript:void(0)" data-toggle='collapse' data-target='#kasirChildren'>
                    <i class="fa fa-heart"></i>
                    <span class="nav-link-text">Kasir</span>
                </a>  
                <ul id="kasirChildren" class="nav flex-column collapse collapse-level-1">
                    <li class='nav-item'>
                        <a href='<?=base_url('kasir')?>' class='nav-link'>Pembayaran Jasa Service</a>
                    </li>
                    <li class='nav-item'>
                        <a href='<?=base_url('pembayaran-penjualan-selesai')?>' class='nav-link'>Pembayaran Penjualan Sparepart</a>
                    </li>
                </ul>              
            </li>
            <?php }if($allow->task_teknisi == 'ya'){ ?>
            <li class="nav-item <?php echo ($page == 'task_teknisi' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?=base_url('task-teknisi')?>">
                    <i class="fa fa-wrench"></i>
                    <span class="nav-link-text">Tugas Teknisi</span>
                </a>                
            </li>
            <?php }if($allow->gudang == 'ya'){ ?>
                <li class="nav-item <?php echo ($page == 'gudang' ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?=base_url('gudang')?>">
                        <i class="fa fa-briefcase"></i>
                        <span class="nav-link-text">Tugas Gudang</span>
                    </a>                
                </li>
            <?php }if($allow->supplier === 'ya'){ ?>
                <li class="nav-item <?=($page == 'supplier' || $page == 'add-supplier'|| $page == 'edit-supplier')? 'active' : '';?>">
                    <a class="nav-link" href="<?=base_url('supplier')?>">
                        <i class="fa fa-truck"></i>
                        <span class="nav-link-text">Data Supplier</span>
                    </a>                
                </li>
            <?php }if($allow->pembelian === 'ya'){ ?>
                <li class="nav-item <?=($page == 'pembelian')? 'active' : '';?>">
                    <a class="nav-link" href="<?=base_url('pembelian')?>">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="nav-link-text">Pembelian</span>
                    </a>                
                </li>
            <?php }if($allow->penjualan === 'ya'){ ?>
                <li class="nav-item <?=($page == 'penjualan')? 'active' : '';?>">
                    <a class="nav-link" href="<?=base_url('penjualan')?>">
                        <i class="fa fa-dollar"></i>
                        <span class="nav-link-text">Penjualan</span>
                    </a>                
                </li>
            <?php }if($allow->batasan_akses == 'ya'){ ?>
            <li class="nav-item <?php echo ($page == 'batasan_akses' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?=base_url('batasan-akses')?>">
                    <i class="fa fa-users"></i>
                    <span class="nav-link-text">Batasan Akses</span>
                </a>                
            </li>
            <?php }if($allow->data_pegawai == 'ya'){ ?>
            <li class="nav-item <?php echo ($page == 'pegawai' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?=base_url('data-pegawai')?>">
                    <i class="fa fa-users"></i>
                    <span class="nav-link-text">Data Pegawai</span>
                </a>                
            </li>
            <?php }if($allow->data_penerimaan == 'ya'){ ?>
                <li class="nav-item <?php echo ($page == 'penerimaan' || $page == 'add_penerimaan' ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?=base_url('data-penerimaan')?>">
                        <i class="fa fa-bell"></i>
                        <span class="nav-link-text">Data Penerimaan</span>
                    </a>                
                </li>
            <?php }if($allow->data_perintah_kerja == 'ya'){ ?>
            <li class="nav-item <?php echo ($page == 'perintah_kerja' || $page=='add_perintah_kerja' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?=base_url('data-perintah-kerja')?>">
                    <i class="fa fa-briefcase"></i>
                    <span class="nav-link-text">Data Perintah Kerja</span>
                </a>                
            </li>            
            <?php }if($allow->data_sparepart == 'ya'){ ?>
            <li class="nav-item <?php echo ($page == 'sparepart' || $page == 'add_sparepart' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?=base_url('data-sparepart')?>">
                    <i class="fa fa-barcode"></i>
                    <span class="nav-link-text">Data Spare-Part</span>
                </a>                
            </li>
            <?php }if($allow->library_service == 'ya'){ ?>
            <li class="nav-item <?php echo ($page == 'library_service' || $page == 'add_library_service' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?=base_url('data-library-service')?>">
                    <i class="fa fa-barcode"></i>
                    <span class="nav-link-text">Data Library Service</span>
                </a>                
            </li>   
            <?php }if($allow->final_check == 'ya'){ ?>
            <li class="nav-item <?php echo ($page == 'final_checkv2' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?=base_url('final-check')?>">
                    <i class="fa fa-list"></i>
                    <span class="nav-link-text">Final Check</span>
                </a>                
            </li>                        
            <?php }if($allow->laporan == 'ya'){ ?>            
            <li class="nav-item <?php echo ($page == 'laporan_customer' || $page == 'laporan_kendaraan' 
                                            || $page == 'laporan_profitabilitas' || $page == 'laporan_sparepart' || $page == 'laporan_labarugi'
                                            || $page == 'laporan_unit'  ? 'active' : ''); ?>">
                <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#tables_drp">
                    <i class="ion ion-md-paper"  style="font-size: 23px"></i>
                    <span class="nav-link-text">Laporan</span>
                </a>
                <ul id="tables_drp" class="nav flex-column collapse collapse-level-1">
                    <li class="nav-item">
                        <ul class="nav flex-column">
                            <?php if($allow->laporan_customer == 'ya'){ ?>   
                            <li class="nav-item <?php echo ($page == 'laporan_customer' ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?=base_url('laporan-customer')?>">Laporan Pelanggan</a>
                            </li>
                            <?php }if($allow->laporan_kendaraan == 'ya'){ ?>   
                            <li class="nav-item <?php echo ($page == 'laporan_kendaraan' ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?=base_url('laporan-kendaraan')?>">Laporan Kendaraan</a>
                            </li>                                        
                            <?php } if($allow->laporan_profitabilitas == 'ya'){ ?>   
                            <li class="nav-item <?php echo ($page == 'laporan_profitabilitas' ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?=base_url('laporan-profitabilitas')?>">Laporan Profitabilitas</a>
                            </li>                                        
                            <?php } if($allow->laporan_sparepart == 'ya'){ ?>   
                            <li class="nav-item <?php echo ($page == 'laporan_sparepart' ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?=base_url('laporan-sparepart')?>">Laporan Sparepart</a>
                            </li>                                        
                            <?php } if($allow->laporan_labarugi == 'ya'){ ?>   
                            <li class="nav-item <?php echo ($page == 'laporan_labarugi' ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?=base_url('laporan-labarugi')?>">Laporan Laba Rugi</a>
                            </li>                             
                            <?php } if($allow->laporan_unit == 'ya'){ ?>   
                            <li class="nav-item <?php echo ($page == 'laporan_unit' ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?=base_url('laporan-unit')?>">Laporan Unit</a>
                            </li>                                        
                            <?php } ?>                        
                        </ul>
                    </li>
                </ul>
            </li>
            <?php }if($allow->master_data == 'ya'){ ?>            
                <li class="nav-item <?php echo ($page == 'kondisi_kendaraan' || $page == 'kategori_sparepart' || $page == 'info_bengkel') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#tables_drp_master">
                        <i class="fa fa-archive"  style="font-size: 23px"></i>
                        <span class="nav-link-text">Master Data</span>
                    </a>
                    <ul id="tables_drp_master" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <?php if($allow->kategori_sparepart == 'ya'){ ?>   
                                <li class="nav-item <?php echo ($page == 'kategori_sparepart' ? 'active' : ''); ?>">
                                    <a class="nav-link" href="<?=base_url('data-kategori-sparepart')?>">Data Kategori Spare Part</a>
                                </li>
                                <?php }if($allow->kondisi_kendaraan == 'ya'){ ?>   
                                <li class="nav-item <?php echo ($page == 'kondisi_kendaraan' ? 'active' : ''); ?>">
                                    <a class="nav-link" href="<?=base_url('data-kondisi-kendaraan')?>">Data Kondisi Kendaraan</a>
                                </li>                                        
                                <?php }if($allow->info_bengkel == 'ya'){ ?>                               
                                <li class="nav-item <?php echo ($page == 'info_bengkel' ? 'active' : ''); ?>">
                                    <a class="nav-link" href="<?=base_url('info-bengkel')?>">Data Info Bengkel</a>
                                </li>              
                                <?php } ?>                        
                            </ul>
                        </li>
                    </ul>
                </li>
            <?php }?>            
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#laporanGudang">
                    <i class="fa fa-archive"  style="font-size: 23px"></i>
                    <span class="nav-link-text">Laporan Gudang</span>
                </a>
                <ul id="laporanGudang" class="nav flex-column collapse collapse-level-1">
                    <li class="nav-item">
                        <ul class="nav flex-column">
                            <?php if($allow->laporanPenjualan == 'ya'){ ?>   
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url('laporan-penjualan')?>">Laporan Penjualan</a>
                                </li>
                            <?php } ?>                       
                        </ul>
                    </li>
                </ul>
            </li>
            <?php if($allow->data_bengkel == 'ya'){ ?>            
            <li class="nav-item <?php echo ($page == 'data_bengkel' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?=base_url('data-bengkel')?>">
                    <i class="fa fa-archive"></i>
                    <span class="nav-link-text">Data Bengkel</span>
                </a>                
            </li>
            <?php } ?>                        
        </ul>
        <hr class="nav-separator">
        <div class="nav-header">
            <span>Getting Started</span>
            <span>GS</span>
        </div>
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="ion ion-md-bookmarks"></i>
                    <span class="nav-link-text">Documentation</span>
                </a>
            </li>
            <hr class="nav-separator">        
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-link-text">Bengkell.com <?=APP_VERSION?></span>
                </a>
            </li>
        </ul>
    </div>
</div>
</nav>