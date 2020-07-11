<div id="modal" class="modal fade">
  <div class="modal-dialog modal-dialog-vertical-center" role="document">
    <div class="modal-content bd-0 tx-14">
      <div class="modal-header pd-y-20 pd-x-25">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Tetapkan Biaya</h6>
        <button type="button" class="close" onclick="btnClose();" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="form-fixing-price">
        <input type="hidden" name="id" id="id">
        <div class="modal-body ">
          <h3 class="tx-gray-800 tx-normal mg-b-5">Penetapan Biaya</h3>          
          <br>          
          <div class="form-group">
            <textarea id="keterangan" class="form-control readonly"></textarea>
          </div>          
          <div class="form-group mg-b-20" >
            <label>Estimasi Biaya</label>
            <input type="text" id="estimasi_biaya" name="estimasi_biaya" class="form-control readonly" placeholder="Estimasi Biaya">
          </div> 
          <div class="form-group mg-b-20" >
            <label>Biaya</label>
            <input type="text" id="biaya" name="biaya" class="form-control" placeholder="Biaya">
          </div> 
          <button type="submit" class="btn btn-success pd-y-12 btn-block">Simpan</button>               
        </div>
      </form>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->

