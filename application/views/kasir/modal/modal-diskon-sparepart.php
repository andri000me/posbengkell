<div id="modal-diskon-sparepart" class="modal fade">
  <div class="modal-dialog modal-dialog-vertical-center" role="document">
    <div class="modal-content bd-0 tx-14">
      <div class="modal-header pd-y-20 pd-x-25">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Diskon Sparepart</h6>
        <button type="button" class="close" onclick="btnClose();" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="fixing-diskon-sparepart">
        <div class="modal-body ">
          <h3 class="tx-gray-800 tx-normal mg-b-5">Diskon</h3>
          <p>Tetapkan Diskon Sparepart Disini</p>
          <br>
          <div class="form-group">
            <input min="1" max="100" type="number" id="diskon-sparepart" name="diskon-sparepart" class="form-control" required placeholder="Besar Diskon">
          </div>          
          <hr>
          <button type="submit" class="btn btn-success pd-y-12 btn-block">Simpan</button>               
        </div>
      </form>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->

