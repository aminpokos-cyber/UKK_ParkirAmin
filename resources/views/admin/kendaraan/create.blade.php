@extends('layouts.app') 
@section('content') 
<h3>Tambah kendaraan</h3> 
 
<form method="POST" action="{{ route('admin.kendaraan.store') }}"> 
    @csrf 
    <div class="mb-3"> 
        <label>plat Nomor</label> 
        <input type="text" name="plat_nomor" class="form-control" required> 
    </div> 
    <div class="mb-3"> 
        <label>jenis kendaraan</label> 
        <input type="text" name="jenis_kendaraan" class="form-control" required> 
    </div> 
    <div class="mb-3"> 
        <label>Pemilik</label> 
        <input type="text" name="pemilik" class="form-control" required> 
    </div> 
    
    <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary">Batal</a> 
</form> 
@endsection