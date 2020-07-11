<style>
  .modal-body{
    overflow-x: auto;
  }
  /* width */
  ::-webkit-scrollbar {
    width: 10px;
  }

  /* Track */
  ::-webkit-scrollbar-track {
    background: #f1f1f1; 
  }
   
  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #888; 
  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #555; 
  }
  th{
    font-weight: bold;
  }
</style>

<div id="modal" class="modal fade">
  <div class="modal-dialog modal-dialog-vertical-center modal-lg" role="document">
    <div class="modal-content bd-0 tx-14">
      <div class="modal-header pd-y-20 pd-x-25">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Riwayat Transaksi Kendaraan</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <div class="table-wrap">
            <table class="table table-hover w-100 display pb-30">
                <thead>                                      
                    <tr>
                        <th>Jenis Service</th>
                        <th>Nama Sparepart</th>
                        <th>Revenue Service</th>
                        <th>Service Advisor</th>
                        <th>Teknisi</th>
                        <th>Tanggal Service</th>
                    </tr>
                </thead>
                <tbody id="konten-riwayat"></tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>