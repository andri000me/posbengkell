<div id="modal" class="modal fade">
  <div class="modal-dialog modal-dialog-vertical-center" role="document">
    <div class="modal-content bd-0 tx-14">
      <div class="modal-header pd-y-20 pd-x-25">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Tambah Admin/Manager</h6>
        <button type="button" class="close" onclick="btnClose();" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="form-add-new-modal">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="id_bengkel" id="idbengkel" value="<?= ($data_bengkel != null ? $data_bengkel->id : "" ) ?>">        
        <div class="modal-body ">
          <h3 class="tx-gray-800 tx-normal mg-b-5">Admin/Manager</h3>
          <p>Akun Admin/Manager bisa anda tambahkan disini.</p>
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
                      <option value="ADMIN" label="Admin"></option>
                      <option value="MANAGER" label="Manager"></option>
                      
                  </select>
                  <span style="color: darkred; font-size: 10px">*pilih dahulu Bidang peran diatas</span>
              </div>          
          </div>                    
          <button type="submit" class="btn btn-success pd-y-12 btn-block">Simpan</button>               
        </div>
      </form>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->


<div id="modalResetPassword" class="modal fade">
  <div class="modal-dialog modal-dialog-vertical-center" role="document">
    <div class="modal-content bd-0 tx-14">    
      <div class="modal-body pd-0">
        <div class="row no-gutters">
          <div class="col-lg-12 bg-white">
            <div class="pd-y-30 pd-xl-x-30">
            
              <button type="button" class="close" onclick="btnCloseResetPass();">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="pd-x-30 pd-y-10">
                <h5 class="tx-gray-800 tx-normal mg-b-5">Reset Password</h5>
                <hr>
                <div class="alert alert-danger" style='display:none;' id="msg-alert">
                  <span></span>
                </div>
                <form  method="post" id="form_reset_pass">
                <input type="hidden" name="id_reset" id="id_reset">
                <div class="form-group mg-b-20">
                  <input type="password" id="new_pass" name="new_pass" class="form-control" placeholder="Password Baru" required onblur="checkResetPass();">
            </div>
            
            <div class="form-group mg-b-20">
                  <input type="password" id="confirm_pass" name="confirm_pass" class="form-control" placeholder="Konfirmasi Password" required onblur="checkResetPass();">
                </div>
                <button class="btn btn-success pd-y-12 btn-block" type="submit">Simpan </button>               
                        </form>
                        <p class="mg-b-5 text-white">It is a long established fact that a reader will be distracted by </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>