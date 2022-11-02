@extends('admin.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Ubah Data Mobil</h5>

		<form method="post" action="{{ route('admin.update', $data->Id_mobil) }}">
			@csrf
            <div class="mb-3">
                <label for="Id_mobil" class="form-label">ID Mobil</label>
                <input type="text" class="form-control" id="Id_mobil" name="Id_mobil" value="{{ $data->Id_mobil }}">
            </div>
			<div class="mb-3">
                <label for="kapasitas_penumpang" class="form-label">Kapasitas Penumpang</label>
                <input type="text" class="form-control" id="kapasitas_penumpang" name="kapasitas_penumpang" value="{{ $data->kapasitas_penumpang }}">
            </div>
            <div class="mb-3">
                <label for="id_pembeli" class="form-label">ID Pelanggan</label>
                <input type="text" class="form-control" id="id_pembeli" name="id_pembeli" value="{{ $data->id_pembeli }}">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop