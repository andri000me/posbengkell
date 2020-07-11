<div id="modal" class="modal fade">
  <div class="modal-dialog modal-dialog-vertical-center" role="document">
    <div class="modal-content bd-0 tx-14">
      <div class="modal-header pd-y-20 pd-x-25">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Tambah Pegawai</h6>
        <button type="button" class="close" onclick="btnClose();" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="form-add-new">
        <input type="hidden" name="id" id="id">
        <div class="modal-body ">
          <h3 class="tx-gray-800 tx-normal mg-b-5">Pegawai</h3>
          <p>Akun Pegawai bisa anda tambahkan disini.</p>
          <br>
          <div class="form-group">
            <input type="text" id="username" name="username" class="form-control" required placeholder="Username">
          </div>
          <div class="form-group mg-b-20">
            <input type="password" id="password" name="password" class="form-control pd-y-12" required placeholder="Password">
          </div>
          <hr>
          <div class="form-group">            
              <div class="form-group">
                  <select id="role_user" name="role_user" 
                      class="form-control select2" 
                      data-placeholder="Choose one" 
                      data-parsley-class-handler="#slWrapper" 
                      data-parsley-errors-container="#slErrorContainer" 
                      required>
                      <option label="Choose one"></option>
                      <?php 
                        $roleuser = $this->session->userdata('roleuser');    
                        if ($roleuser == "SUPER_ADMIN") { ?>
                          <option value="Admin" label="Admin"></option>
                      <?php  } ?>
                      <option value="Kasir" label="Kasir"></option>
                      <option value="Teknisi" label="Teknisi"></option>
                      <option value="Gudang" label="Gudang"></option>
                      <option value="Ka_Teknisi" label="Kepala Teknisi"></option>
                      
                  </select>
                  <span style="color: darkred; font-size: 10px">*pilih dahulu Bidang Pekerjaan</span>
              </div>          
          </div>          
          <div class="form-group mg-b-20">
            <input type="number" id="nip" name="nip" class="form-control pd-y-12" required placeholder="NIP">          
          </div>

          <div class="form-group mg-b-20">
            <input type="text" id="nama" name="nama" class="form-control pd-y-12" required placeholder="Nama Lengkap">          
          </div>
          
          <button type="submit" class="btn btn-success pd-y-12 btn-block">Simpan</button>               
        </div>
      </form>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->

