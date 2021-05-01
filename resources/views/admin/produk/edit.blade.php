@extends('admin.layouts.master')

@section('styles')
<link rel="stylesheet" href="{{ asset('public/js/plugins/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('public/js/plugins/bootstrap-taginput/tagsinput.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<style type="text/css">
    .file-upload {
        width: 100%;
        padding: 10px 0px;
        position: absolute;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }

</style>
@endsection

@section('content')
<div class="content">
    <form id="form-produk" onsubmit="return false;">

        <input type="hidden" name="total_variasi" id="total_variasi" value="1">
        <input type="hidden" name="produk_id" id="produk_id" value="{{ $produk->id }}">
        <div class="content-heading pt-0 mb-3">
            Tambah Produk Baru
            <button type="submit" class="btn btn-primary float-right mr-5">
                <i class="si si-paper-plane mr-1"></i>
                Simpan
            </button>
        </div>
        <div class="row">
            <div class="col-lg-12">
                {{-- 1. Informasi Produk --}}
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <div class="block-title">
                            <strong>1. Informasi Produk</strong>
                        </div>
                    </div>

                    <div class="block-content pb-15">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-nama">Nama Produk</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="field-nama" name="nama" placeholder="Masukan Nama Produk" autocomplete="off" value="{{ $produk->nama }}">
                                <div class="invalid-feedback font-size-sm" id="error-nama">Invalid feedback</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-deskripsi">Deskripsi Produk</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="deskripsi" id="field-deskripsi" cols="30" rows="10" placeholder="Masukan Deskripsi Produk"><?= $produk->deskripsi; ?></textarea>
                                <div class="invalid-feedback font-size-sm" id="error-deskripsi">Invalid feedback</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-kategori">Kategori Produk</label>
                            <div class="col-lg-9">
                                <div class="form-control c-pointer" data-toggle="modal" data-target="#categorySelectModal" id="field-kategori">{{ $produk->kategori_select }}</div>
                                <input type="hidden" name="category_id" id="category_id" value="" required>
                                <input type="hidden" name="subcategory_id" id="subcategory_id" value="" required>
                                <input type="hidden" name="subsubcategory_id" id="subsubcategory_id" value="">
                                <input type="hidden" name="kategori" id="kategori_id" value="{{ $produk->kategori_id }}">
                                <div class="text-danger font-size-sm" id="error-kategori"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-kode">Kode Produk</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="field-kode" name="kode" placeholder="Masukan Kode Produk" autocomplete="off" value="{{ $produk->kode }}">
                                <div class="invalid-feedback font-size-sm" id="error-kode">Invalid feedback</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-material">Material</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="field-material" name="material" placeholder="Masukan material Produk" autocomplete="off" value="{{ $produk->material }}">
                                <div class="invalid-feedback font-size-sm" id="error-material">Invalid feedback</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-ukuran">Ukuran</label>
                            <div class="col-lg-9">
                                <input type="number" class="form-control" id="field-ukuran" name="ukuran" placeholder="Masukan Ukuran Produk" autocomplete="off" value="{{ $produk->ukuran }}">
                                <div class="invalid-feedback font-size-sm" id="error-ukuran">Invalid feedback</div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-kadar">Kadar</label>
                            <div class="col-lg-9">
                                <input type="number" class="form-control" id="field-kadar" name="kadar" placeholder="Masukan Kadar(Fineness) Produk" autocomplete="off" value="{{ $produk->kadar }}">
                                <div class="invalid-feedback font-size-sm" id="error-kadar">Invalid feedback</div>
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-jenis_permata">Jenis Permata</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="field-jenis_permata" name="jenis_permata" placeholder="Masukan Jenis Batu Permata Produk" autocomplete="off" value="{{ $produk->jenis_permata }}">
                                <div class="invalid-feedback font-size-sm" id="error-jenis_permata">Invalid feedback</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-berat_permata">Berat Permata</label>
                            <div class="col-lg-9">
                                <input type="number" class="form-control" id="field-berat_permata" name="berat_permata" placeholder="Masukan Berat Permata Produk" autocomplete="off" value="{{ $produk->berat_permata }}">
                                <div class="invalid-feedback font-size-sm" id="error-berat_permata">Invalid feedback</div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- 2. Harga Produk --}}
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <div class="block-title">
                            <strong>2. Harga Produk</strong>
                        </div>
                    </div>
                    <div class="block-content pb-15">
                        <input type="hidden" name="is_variasi" id="is_variasi" value="{{ $produk->has_variasi }}">
                        <input type="hidden" id="var2_status" name="var2_status" value="{{ $produk->var2_status }}"/>
                        @if($produk->has_variasi === 0)
                        <input type="hidden" name="variasi_id" value="{{ $produk->produk_variasi[0]['id'] }}"/>
                        @endif
                        <div class="form-group row non-variasi @if($produk->has_variasi === 1) hide @endif">
                            <label class="col-lg-3 col-form-label" for="field-harga">Harga Produk</label>
                            <div class="col-lg-7">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Rp
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" id="field-harga" name="harga" placeholder="Masukan Harga Produk" autocomplete="off" value="{{ $produk->harga_format }}">
                                </div>
                                <div class="text-danger font-size-sm" id="error-harga"></div>
                            </div>
                        </div>
                        <div class="form-group row non-variasi @if($produk->has_variasi === 1) hide @endif">
                            <label class="col-lg-3 col-form-label" for="field-stok">Stok Produk</label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" id="field-stok" name="stok" placeholder="Masukan Stok Produk" value="{{ $produk->produk_variasi[0]['stok'] }}">
                                <div class="invalid-feedback font-size-sm" id="error-stok">Invalid feedback</div>
                            </div>
                        </div>
                        <div class="form-group row non-variasi">
                            <label class="col-lg-3 col-form-label" for="btn-add-variasi">Variasi Produk</label>
                            <div class="col-lg-7">
                                <button type="button" class="btn btn-outline-primary btn-block @if($produk->has_variasi === 1) hide @endif" id="btn-add-variasi">
                                    <i class="si si-plus mr-1"></i> Aktifkan Variasi Produk
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-block mt-0 @if($produk->has_variasi === 0) hide @endif" id="btn-hapus-variasi">
                                    <i class="si si-trash mr-1"></i> Hapus Variasi Produk
                                </button>
                            </div>
                        </div>
                        @if($produk->has_variasi === 1)
                        <div class="form-group row mb-0 variasi">
                            <label class="col-lg-3 col-form-label" for="field-harga">Variasi 1</label>
                            <div class="col-lg-7">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="field-var1_nama">Nama</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control variasi-1_nama" id="field-var1_nama" name="var1_nama" placeholder="Masukkan Nama Variasi, contoh: Warna, dll." value="{{ $produk->var1_nama }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="field-var1_pilihan">Pilihan</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="field-var1_pilihan" name="var1_pilihan" placeholder="Masukkan Pilihan Variasi, contoh: Hijau, dll." value="{{ implode(",", json_decode($produk->var1_value)) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row variasi">
                            <label class="col-lg-3 col-form-label" for="field-harga">Variasi 2</label>
                            <div class="col-lg-7">
                                <button type="button" class="btn btn-outline-primary btn-block @if($produk->var2_status === 1) hide @endif" id="btn-add-var2">
                                    <i class="si si-plus mr-3"></i> Tambah Variasi 2
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-block mb-3 mt-0 @if($produk->var2_status === 0) hide @endif var2-form" id="btn-hapus-var2">
                                    <i class="si si-trash mr-3"></i> Hapus Variasi 2
                                </button>
                                <div class="form-group row var2-form @if($produk->var2_status === 0) hide @endif">
                                    <label class="col-lg-2 col-form-label" for="field-var2_nama">Nama</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control var2-nama" id="field-var2_nama" name="var2_nama" placeholder="Masukkan Nama Variasi, contoh: Ukuran, dll." value="{{ $produk->var2_nama }}">
                                    </div>
                                </div>
                                <div class="form-group row var2-form @if($produk->var2_status === 0) hide @endif">
                                    <label class="col-lg-2 col-form-label" for="field-var2_pilihan">Pilihan</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="field-var2_pilihan" name="var2_pilihan" placeholder="Masukkan Pilihan Variasi, contoh: Hijau, dll." value="@if(!empty($produk->var2_value)){{ implode(",", json_decode($produk->var2_value)) }}@endif">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row variasi">
                            <div class="col-lg-12">
                                <table class="table table-bordered table-vcenter text-center" id="tbl_variasi">
                                    <thead>
                                        <tr>
                                            <th class="tb-variasi-1_nama" width="18%">{{ $produk->var1_nama }}</th>
                                            <th class="var2-nama @if($produk->var2_status === 0) hide @endif" width="18%">{{ $produk->var2_nama }}</th>
                                            <th width="30%">Harga</th>
                                            <th width="14%">Stok</th>
                                            <th width="20%">Kode Variasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($i= 0; $i < $produk->produk_variasi->count(); $i++)
                                        <tr>
                                            <td>
                                                <input type="hidden" class="form-control variasi_id-{{ get_variant($produk->produk_variasi[$i]['variant'], 1 ) }}" name="variasi[{{$i}}][id]" value="{{ $produk->produk_variasi[$i]['id'] }}">
                                                {{ get_variant($produk->produk_variasi[$i]['variant'], 1) }}
                                                <input type="hidden" class="form-control pil1" name="variasi[{{$i}}][pil1]" value="{{ get_variant($produk->produk_variasi[$i]['variant'], 1 ) }}">
                                            </td>
                                            @if($produk->var2_status === 1)
                                            <td>
                                                {{  get_variant($produk->produk_variasi[$i]['variant'], 2) }}
                                                <input type="hidden" class="form-control" name="variasi[{{$i}}][pil2]" value="{{  get_variant($produk->produk_variasi[$i]['variant'], 2) }}">
                                            </td>
                                            @endif
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            Rp
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-control" name="variasi[{{$i}}][harga]" placeholder="Masukan Harga" value="{{ round($produk->produk_variasi[$i]['harga'],0) }}">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="variasi[{{$i}}][stok]" min="1" value="{{ $produk->produk_variasi[$i]['stok'] }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="variasi[{{$i}}][sku]" value="{{ $produk->produk_variasi[$i]['sku'] }}">
                                            </td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- 1. Informasi Produk --}}
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <div class="block-title">
                            <strong>3. Foto Produk</strong>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="row">
                                    @for($i=0; $i <= 4; $i++)
                                    <div class="col">
                                        <div class="preview_img border">
                                            <img id="previewImg-{{ $i }}" class="img-fluid" src="{{ get_produk_img($foto[$i]['path']) }}"/>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <div class="btn btn-primary btn-block btn-sm {{ $foto[$i]['path'] !== null ? "hide" : '' }}" id="btn-foto-{{ $i }}">
                                                    <input type="file" class="file-upload" data-id="{{ $i }}" accept="image/*">
                                                    <input type="hidden" id="foto-{{$i}}" name="foto[{{ $i }}]" value="{{ $i == 0 && $foto[$i]['path'] !== null ? "ada" : ''  }}">
                                                    <i class="si si-plus mr-1"></i>Pilih Foto {{ $i == 0 ? "Utama" : $i  }}
                                                </div>

                                                <button type="button" class="btn btn-danger btn-block btn-sm mt-0 btn-foto_hapus {{ $foto[$i]['path'] === null ? "hide" : '' }}" data-val="{{ $foto[$i]['id'] }}" id="btn-hapus-{{ $i }}" data-id="{{ $i }}">
                                                    <i class="fa fa-trash mr-1"></i> Hapus Foto {{ $i == 0 ? "Utama" : $i  }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <div class="block-title">
                            <strong>4. Pengiriman</strong>
                        </div>
                    </div>
                    <div class="block-content pb-15">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-berat">Berat</label>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-8">
                                        <input type="number" class="form-control" id="field-berat" name="berat" placeholder="Masukan Berat Produk" value="{{ $produk->berat }}">
                                    </div>
                                    <div class="col-4">
                                        <select class="form-control" name="berat_satuan">
                                            <option @if($produk->berat_satuan == 'Gram (g)') selected="selected" @endif value="Gram (g)">Gram (g)</option>
                                            <option @if($produk->berat_satuan == 'Kilogram (Kg)') selected="selected" @endif value="Kilogram (Kg)">Kilogram (Kg)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-lebar">Ukuran Paket</label>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="field-lebar" name="lebar" placeholder="Lebar" value="{{ $produk->lebar }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            cm
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="field-panjang" name="panjang" placeholder="Panjang" value="{{ $produk->panjang }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            cm
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="field-tinggi" name="tinggi" placeholder="Tinggi" value="{{ $produk->tinggi }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            cm
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>


@include('admin.produk.include.modal_crop')
<div class="modal fade" id="categorySelectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-header block-header-default">
                        <h3 class="block-title modal-title">Pilih Kategori Produk</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content pb-15">
                    <div class="row">
                        <div class="col-4 border-right">
                            <div class="modal-category-box c-scrollbar">
                                <div class="sort-by-box">
                                    <form role="form" class="search-widget" onsubmit="return false;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari Kategori" onkeyup="filterListItems(this, 'categories')">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="si si-magnifier"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-category-list">
                                    <ul id="categories">
                                        @foreach ($kategori as $k)
                                            <li onclick="get_subcategories_by_category(this, {{ $k->id }})">
                                            <span>{{  __($k->nama) }}</span>
                                            @if($k->sub_kategori->count() > 0)
                                            @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 border-right">
                            <div class="modal-category-box c-scrollbar" id="subcategory_list">
                                <div class="sort-by-box">
                                    <form role="form" class="search-widget">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari Kategori" onkeyup="filterListItems(this, 'subcategories')">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="si si-magnifier"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-category-list has-right-arrow">
                                    <ul id="subcategories">

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="modal-category-box c-scrollbar" id="subsubcategory_list">
                                <div class="sort-by-box">
                                    <form role="form" class="search-widget">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari Kategori" onkeyup="filterListItems(this, 'subsubcategories')">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="si si-magnifier"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-category-list">
                                    <ul id="subsubcategories">

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-15">
                        <div class="col-12">
                            <span class="mr-3">Kategori Dipilih:</span>
                            <span>Kategori > Sub Kategori > Sub Kategori</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-alt-success" onclick="closeModal()">
                    <i class="fa fa-check"></i> Simpan Kategori
                </button>
            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
<script src="{{ asset('public/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/select2/js/i18n/id.js') }}"></script>
<script src="{{ asset('public/js/plugins/bootstrap-taginput/tagsinput.js') }}"></script>
<script src="{{ asset('public/js/plugins/summernote/summernote-bs4.min.js') }}"></script>
{{-- <script src="{{ asset('public/js/plugins/jquery-rowspanizer/jquery.rowspanizer.min.js') }}"></script> --}}
<script src="{{ asset('public/js/admin/produk/produk-edit.js') }}"></script>
@endpush
