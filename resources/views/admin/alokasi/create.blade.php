@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Buat Alokasi Berdasarkan Iuran {{ $iurans->nama }}</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <form method="post" action="{{ route('admin-create-alokasi-store', ['id' => $iurans->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="table_section padding_infor_info">

                    {{-- <div class="mb-3">
                        <label class="form-label">Iuran</label>
                        <div class="input-group">
                            <select class="form-control w-100 @error('alokasi_iuran') is-invalid @enderror" id="inputGroupSelect04" aria-label="Example select with button addon" name="alokasi_iuran">
                            <option disabled selected>Choose...</option>
                                @foreach ($iurans as $iuran)
                                    <option value="{{ $iuran->id }}" {{ old('alokasi_iuran') == $iuran->id ? 'selected' : '' }}>{{ $iuran->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('alokasi_iuran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control @error('alokasi_name') is-invalid @enderror" name="alokasi_name" value="{{old('alokasi_name')}}" spellcheck="disabled" required>
                        @error('alokasi_name')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea type="text" class="form-control @error('alokasi_deskripsi') is-invalid @enderror" name="alokasi_deskripsi" rows="4" spellcheck="disabled" required>{{old('alokasi_deskripsi')}}</textarea>
                        @error('alokasi_deskripsi')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto</label>
                        <input class="form-control" type="file" id="alokasi_foto" required accept="image/*" name="alokasi_foto" value="{{ old('alokasi_foto') }}">
                        @if ($errors->has('alokasi_foto'))
                            <div class="invalid-feedback">{{ $errors->first('alokasi_foto') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah (Rp.)</label>
                        <div class="input-group">
                          <span class="input-group-text">Rp.</span>
                          <input type="number" class="form-control @error('alokasi_jumlah') is-invalid @enderror" name="alokasi_jumlah" value="{{ old('alokasi_jumlah') }}" spellcheck="disabled" required>
                        </div>
                        @error('alokasi_jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button style="width:100%;" type="submit" class="model_bt btn btn-primary mt-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection