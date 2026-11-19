<?php 
 
namespace App\Http\Controllers\Admin; 
 
use App\Http\Controllers\Controller; 
use App\Models\Tarif; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash; 
 
class TarifController extends Controller 
{ 
    public function index() 
    { 
        // Gunakan pagination supaya query tetap efisien untuk data besar 
        $tarifs = Tarif::latest()->paginate(10); 
        return view('admin.tarif.index', compact('tarifs')); 
    } 
 
    public function create() 
    { 
        return view('admin.tarif.create'); 
    } 
 
    public function store(Request $request) 
    { 
        $request->validate([ 
            'jenis_kendaraan' => 'required|in:motor,mobil,lainnya',  
            'tarif_per_jam' => 'required|numeric|min:0', 
            
         ]); 
        Tarif::create([ 
            'jenis_kendaraan' => $request->jenis_kendaraan,
           'tarif_per_jam'  => $request->tarif_per_jam,
        ]); 
 
        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil 
ditambahkan.'); 
    } 
 
    public function edit(Tarif $tarif) 
    { 
        return view('admin.tarif.edit', compact('tarif')); 
    }
      public function update(Request $request, Tarif $tarif) 
    { 
         $request->validate([ 
            'jenis_kendaraan' => 'required|in:motor,mobil,lainnya',  
            'tarif_per_jam' => 'required|numeric|min:0', 
            
         ]); 
 
        $data = $request->only('id_tarif','jenis_kendaraan', 'tarif_per_jam'); 
 
        if ($request->filled('password')) { 
            $data['password'] = Hash::make($request->password); 
        } 
 
        $tarif->update($data); 
 
        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil diperbarui.'); 
    } 
 
    public function destroy(Tarif $tarif) 
    { 
        $tarif->delete(); 
        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil dihapus.'); 
    } 
} 