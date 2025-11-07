<h1 class="h3 mb-2 text-gray-800">Call Screen</h1>

<div class="row">
    <div class="col-5 mx-auto">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Call Screen</h6>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($report)) : ?>

                            <?php if (!empty($report->phone_1)) : ?>
                                <div class="call-section">
                                    <b><label class="mb-0">Phone 1</label></b>
                                    <button type="button" class="btn btn-success w-100 mb-3" data-phone="<?= $report->phone_1; ?>">
                                        Call 
                                    </button>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($report->phone_2)) : ?>
                                <div class="call-section">
                                    <b><label class="mb-0">Phone 2</label></b>
                                    <button type="button" class="btn btn-warning w-100 mb-3" data-phone="<?= $report->phone_2; ?>">
                                        Call 
                                    </button>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($report->emergency_phone)) : ?>
                                <div class="call-section">
                                    <b><label class="mb-0">Emergency Call</label></b>
                                    <button type="button" class="btn btn-danger w-100 mb-3" data-phone="<?= $report->emergency_phone; ?>">
                                        Call 
                                    </button>
                                </div>
                            <?php endif; ?>

                        <?php else: ?>
                            <p class="text-center text-muted">Tidak ada data untuk ditampilkan.</p>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"> Submit Result</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputState">Result</label>
                            <select id="inputState" class="form-control">
                                <option selected disabled>Choose...</option>
                                <option value="0">All</option>
                                <option value="1">Paid</option>
                                <option value="2">PTP</option>
                                <option value="3">MSG</option>
                                <option value="4">Noan</option>
                                <option value="5">BPH</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Notes</label>
                            <textarea class="form-control" id="resultNotes" rows="3"></textarea>
                        </div>
                        <button class="btn btn-primary" data-id="<?= $report->id ?>">Submit Result</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="col-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Data User</h6>
            </div>
            <div class="card-body">
                <div class="user-info">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <tbody>
                            <?php if (!empty($report)) : ?>
                                <tr>
                                    <td>Report Code</td>
                                    <td><?= $report->report_code; ?></td>
                                </tr>
                                <tr>
                                    <td>Customer Name</td>
                                    <td><?= $report->customer_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><?= $report->address; ?></td>
                                </tr>
                                <tr>
                                    <td>Bill</td>
                                    <td><?= $report->bill; ?></td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td><?= $report->desc; ?></td>
                                </tr>
                                <tr>
                                    <td>Emergency Contact</td>
                                    <!-- <td><?= $report->emergency_contact; ?></td> -->
                                </tr>
                                <tr>
                                    <td>Relation</td>
                                    <!-- <td><?= $report->relation; ?></td> -->
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2" class="text-center">Tidak ada data ditemukan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const BASE_URL = "<?= base_url(); ?>";
</script>
<script src="<?= base_url('js/call/result.js'); ?>"></script>