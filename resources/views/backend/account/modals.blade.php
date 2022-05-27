<div class="modal fade" id="modal-store">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-account">
                    @csrf
                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" class="form-control" value="{{ old('code') }}" name="code" id="code"
                            placeholder="Code">
                        <span class="text-danger" id="codeError"></span>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" value="{{ old('nama') }}" name="nama" id="nama"
                            placeholder="Nama">
                        <span class="text-danger" id="namaError"></span>
                    </div>
                    <button type="button" onclick="storeAccount()" class="btn btn-primary"
                        id="btn-store-account">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-update">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-update-account">
                    @csrf
                    <input type="hidden" class="d-none" name="account_id" id="account_id" readonly>
                    <div class="form-group">
                        <label for="code_update">Nama</label>
                        <input type="text" class="form-control" name="code_update" id="code_update"
                            placeholder="Code">
                        <span class="text-danger" id="namaError"></span>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama_update" id="nama_update"
                            placeholder="Nama">
                        <span class="text-danger" id="namaError"></span>
                    </div>
                    <button type="button" onclick="updateAccount()" class="btn btn-primary"
                        id="btn-update-account">Update</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
