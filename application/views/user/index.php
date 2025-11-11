<h1 class="h3 mb-2 text-gray-800">User</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User Data</h6>
    </div>
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <button type="button"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                data-toggle="modal"
                data-target="#addDataModal">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add Data
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Number</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Number</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?= $u->real_name ?></td>
                            <td><?= $u->role_name ?></td>
                            <td><?= $u->number ?></td>
                            <td><?= $u->is_active ? 'Yes' : 'No' ?></td>
                            <td>
                                <button
                                    class="btn btn-info btn-sm editBtn"
                                    data-id="<?= $u->id ?>">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <a href="<?= base_url('user/delete/' . $u->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

</div>

<!-- Form Add-->
<div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="addDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDataModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('user/create') ?>" method="post">
                    <div class="form-group">
                        <label>Real Name</label>
                        <input type="text" name="real_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Number</label>
                        <input type="text" name="number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role_id" required>
                            <option value="">Pilih Role...</option>
                            <?php foreach ($roles as $r): ?>
                                <option value="<?= $r->id ?>"><?= $r->role_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_admin" value="1" id="addIsAdmin">
                        <label class="form-check-label" for="addIsAdmin">Is Admin?</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Form Edit -->
<div class="modal fade" id="editDataModal" tabindex="-1" role="dialog" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('user/update') ?>" method="post">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="form-group">
                        <label>Real Name</label>
                        <input type="text" name="real_name" id="edit_real_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" id="edit_username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password (kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" id="edit_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Number</label>
                        <input type="text" name="number" id="edit_number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role_id" id="edit_role_id" required>
                            <option value="">Pilih Role...</option>
                            <?php foreach ($roles as $r): ?>
                                <option value="<?= $r->id ?>"><?= $r->role_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_admin" value="1" id="edit_is_admin">
                        <label class="form-check-label" for="edit_is_admin">Is Admin?</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.editBtn').on('click', function() {
            var id = $(this).data('id');
            console.log(id)

            $.ajax({
                url: '<?= base_url('user/edit/') ?>' + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#edit_id').val(data.id);
                    $('#edit_real_name').val(data.real_name);
                    $('#edit_username').val(data.username);
                    $('#edit_number').val(data.number);
                    $('#edit_role_id').val(data.role_id);
                    $('#edit_is_admin').prop('checked', data.is_admin == 1);

                    $('#editDataModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data user!');
                }
            });
        });
    });
</script>