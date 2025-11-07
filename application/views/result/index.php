<h1 class="h3 mb-2 text-gray-800">Result</h1>
<p class="mb-4">Final Result Reporting</p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
    </div>
    <div class="card-body">
        <form action="">
            <div class="report-filters">
                <div class="row">
                    <div class="col-6">
                        <div class="input-group">
                            <span class="input-group-text">Date Range</span>
                            <input type="date" class="form-control">
                            <input type="date" class="form-control">
                        </div>
                    </div>

                    <div class="input-group mb-3 col-3">
                        <label class="input-group-text" for="inputGroupSelect01">Result</label>
                        <select class="custom-select" id="resultSelect">
                            <option selected disabled>Choose...</option>
                            <option value="0">All</option>
                            <option value="1">Paid</option>
                            <option value="2">PTP</option>
                            <option value="3">MSG</option>
                            <option value="4">Noan</option>
                            <option value="5">BPH</option>
                        </select>
                    </div>

                    <div class="input-group mb-3 col-3">
                        <label class="input-group-text" for="inputGroupSelect01">Status</label>
                        <select class="custom-select" id="statusSelect">
                            <option selected disabled>Choose...</option>
                            <option value="1">Final</option>
                            <option value="2">Waiting / On Progress</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary" id="result-filters">Apply Filter</button>
            </div>
        </form>
        <div class="error-upload">

        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Report Result</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="resultdataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Report Code</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Phone 1</th>
                        <th>Phone 2</th>
                        <th>Emergency Number</th>
                        <th>Result</th>
                        <th>Bill</th>
                        <th>Desc</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->


<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>
<script>
    const base_url = "<?= base_url(); ?>";
</script>
<script src="<?= base_url('js/result/index.js'); ?>"></script>