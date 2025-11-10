<h1 class="h3 mb-2 text-gray-800">TASK</h1>
<p class="mb-4">See and Import Task</p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Upload File</h6>
    </div>
    <div class="card-body">
        <div class="task-upload">
            <a class="btn btn-primary text-white" href="<?= base_url('task/download_template') ?>">
                <i class="fas fa-fw fa-download"></i>
            </a>

            <a style="margin-left: 10px;" href="<?= base_url('task/download_template') ?>">Download Template</a>
            </p>
            <hr>
            <label for="templateFile">Upload Template Here</label>
            <input type="file" id="templateFile" accept=".csv"><br>
            <span class="info-task">Size max: 10MB | Supported type: CSV</span>
        </div>
        <div class="error-upload">

        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Task</h6>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                    </div>
                    <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-6">
                <button class="btn btn-primary" id="search-task"><i class="fas fa-search"></i></button>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Report Code</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Phone 1</th>
                        <th>Phone 2</th>
                        <th>Emergency Contact</th>
                        <th>Emergency Number</th>
                        <th>Bill</th>
                        <th>Desc</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Report Code</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Phone 1</th>
                        <th>Phone 2</th>
                        <th>Emergency Contact</th>
                        <th>Emergency Number</th>
                        <th>Bill</th>
                        <th>Desc</th>
                    </tr>
                </tfoot>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const BASE_URL = "<?= base_url(); ?>";
</script>
<script src="<?= base_url('js/task/upload.js'); ?>"></script>
<script src="<?= base_url('js/task/search.js'); ?>"></script>