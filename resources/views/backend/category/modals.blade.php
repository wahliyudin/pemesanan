<div class="modal fade" id="modal-store">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-category">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" value="{{ old('nama') }}" name="nama" id="nama"
                            placeholder="Nama">
                        <span class="text-danger" id="namaError"></span>
                    </div>
                    <button type="button" onclick="storeCategory()" class="btn btn-primary"
                        id="btn-store-category">Simpan</button>
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
                <h4 class="modal-title">Edit Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-update-category">
                    @csrf
                    <input type="hidden" class="d-none" name="category_id" id="category_id" readonly>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama_update" id="nama_update"
                            placeholder="Nama">
                        <span class="text-danger" id="namaError"></span>
                    </div>
                    <button type="button" onclick="updateCategory()" class="btn btn-primary"
                        id="btn-update-category">Update</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
