<h1 class="h3 mb-2 text-gray-800">Recording</h1>
<p class="mb-4">Call's Recording</p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Recording History</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="recordingDataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Call Date</th>
                        <th>SRC</th>
                        <th>Duration</th>
                        <th>Billsec</th>
                        <th>Disposition</th>
                        <th>Call Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

</div>

<div class="modal fade" id="audioModal" tabindex="-1" role="dialog" aria-labelledby="audioModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Listen the Recording</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <audio id="audioPlayer" controls style="width:100%">
          <source src="" type="audio/mpeg">
          Your Browser Can't Play the Audio.
        </audio>
      </div>
    </div>
  </div>
</div>


<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script> -->
<script>
    const base_url = "<?= base_url(); ?>";
</script>
<script src="<?= base_url('js/result/recording.js'); ?>"></script>