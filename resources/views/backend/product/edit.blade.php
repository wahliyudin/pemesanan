@extends('layouts.backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <form action="{{ route('admin.products.update', Crypt::encrypt($product->id)) }}" method="post"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" value="{{ old('nama', $product->nama) }}"
                                        class="form-control" id="nama" placeholder="Enter nama">
                                    @error('nama')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan"
                                        value="{{ old('keterangan', $product->keterangan) }}" class="form-control"
                                        id="keterangan" placeholder="Keterangan">
                                    @error('keterangan')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="harga">Harga</label>
                                    <input type="text" name="harga"
                                        value="{{ old('harga', 'Rp. ' . numberFormat($product->harga)) }}"
                                        class="form-control" id="harga" placeholder="Harga">
                                    @error('harga')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Kategori</label>
                                    <select name="category_id" class="form-control select2" style="width: 100%;">
                                        <option selected="selected" disabled>-- pilih --</option>
                                        @foreach ($categories as $category)
                                            <option {{ $product->category_id == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">
                                                {{ $category->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="photo">Photo</label>

                                    <div class="custom-file">
                                        <input type="file" name="photo" onchange="previewImage()" class="custom-file-input"
                                            id="photo">
                                        <label class="custom-file-label cursor-pointer" for="photo">Choose file</label>
                                    </div>
                                    @error('photo')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="row flex-column" style="align-items: center;">
                                        <label for="photo" style="align-self: flex-start;">Preview</label>

                                        <img class="photo-preview img-fluid mb-3 col-sm-5 rounded"
                                            src="{{ $product->photo }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .select2-container .select2-selection--single {
            height: 38px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100% !important;
        }

    </style>
@endpush
@push('script')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
            //Initialize Select2 Elements
            $('.select2').select2()
        });

        var harga = document.getElementById('harga');
        harga.addEventListener('keyup', function(e) {
            harga.value = formatRupiah(this.value, 'Rp. ');
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function previewImage() {
            const image = document.querySelector('#photo');
            const imgPreview = document.querySelector('.photo-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush
