@extends('layouts.app') 
@section('content') 
<h3>Data kendaraan</h3> 
<a href="{{ route('admin.kendaraan.create') }}" class="btn btn-primary mb-3">+ Tambah Kendaraan</a> 
 
<table class="table table-bordered table-striped"> 
    <thead> 
        <tr> 
            <th>#</th> 
            <th>Nomor Plat</th> 
            <th>Jenis kendaraan</th> 
            <th>Pemilik</th> 
            <th>Aksi</th> 
        </tr> 
    </thead> 
    <tbody> 
        @foreach($kendaraans as $i => $kendaraan) 
        <tr> 
            <td>{{ $kendaraans->firstItem() + $i }}</td> 
  <td>{{ $kendaraan->plat_nomor }}</td> 
            <td>{{ $kendaraan->jenis_kendaraan }}</td> 
            <td>{{ $kendaraan->pemilik }}</td> 
      <td>
                <a href="{{ route('admin.kendaraan.edit', $kendaraan->id_kendaraan) }}" class="btn btn-sm btn
warning">Edit</a> 
                <form action="{{ route('admin.kendaraan.destroy', $kendaraan->id_kendaraan) }}" method="POST" 
class="d-inline" 
                      onsubmit="return confirm('Yakin hapus kendaraan ini?')"> 
                    @csrf @method('DELETE') 
                    <button class="btn btn-sm btn-danger">Hapus</button> 
                </form> 
            </td> 
        </tr> 
        @endforeach 
    </tbody> 
</table> 
 
{{ $kendaraans->links() }} 
@endsection