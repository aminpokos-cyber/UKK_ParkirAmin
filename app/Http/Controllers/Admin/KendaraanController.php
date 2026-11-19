<?php 
 
namespace App\Http\Controllers\Admin; 
 
use App\Http\Controllers\Controller; 
use App\Models\Kendaraan; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash; 
 
class kendaraanController extends Controller 
{ 
    public function index() 
    { 
        // Gunakan pagination supaya query tetap efisien untuk data besar 
        $kendaraans = Kendaraan::latest()->paginate(10); 
        return view('admin.kendaraan.index', compact('kendaraans')); 
    } 
 
    public function create() 
    { 
        return view('admin.kendaraan.create'); 
    } 
 
    public function store(Request $request) 
    { 
       $request->validate([ 
        'plat_nomor' => 'required|string|max:15', 
        'jenis_kendaraan' =>'required|in:motor,mobil,lainnya', 
        'pemilik' => 'required|string', 
    ]); 
 
        Kendaraan::create([ 
               'plat_nomor' => $request->plat_nomor, 
        'jenis_kendaraan' => $request->jenis_kendaraan,  
        'pemilik' => $request->pemilik, 
        'id_user' => auth()->id(), 
    ]); 
        return redirect()->route('admin.kendaraan.index')->with('success', 'kendaraan berhasil 
ditambahkan.'); 
    } 
 
    public function edit(Kendaraan $kendaraan) 
    { 
        return view('admin.kendaraan.edit', compact('kendaraan')); 
    }
      public function update(Request $request, Kendaraan $kendaraan) 
    { 
        $request->validate([ 
             'plat_nomor' => 'required|string|max:15', 
        'jenis_kendaraan' => 'required|in:motor,mobil,lainnya', 
        'pemilik' => 'required|string', 
        ]); 
 
        $data = $request->only('plat_nomor', 'jenis_kendaraan', 'warna', 'pemilik'); 
 
 
        $kendaraan->update($data); 
 
        return redirect()->route('admin.kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui.'); 
    } 
 
    public function destroy(Kendaraan $kendaraan) 
    { 
        $kendaraan->delete(); 
        return redirect()->route('admin.kendaraan.index')->with('success', 'Kendaraan berhasil dihapus.'); 
    } 
} 