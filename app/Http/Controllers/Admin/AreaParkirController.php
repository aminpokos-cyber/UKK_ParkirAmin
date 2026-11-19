<?php 
 
namespace App\Http\Controllers\Admin; 
 
use App\Http\Controllers\Controller; 
use App\Models\AreaParkir; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash; 
 
class AreaParkirController extends Controller 
{ 
    public function index() 
    { 
        // Gunakan pagination supaya query tetap efisien untuk data besar 
        $areas = AreaParkir::latest()->paginate(10); 
        return view('admin.area.index', compact('areas')); 
    } 
 
    public function create() 
    { 
        return view('admin.area.create'); 
    } 
 
    public function store(Request $request) 
    { 
        $request->validate([ 
            'nama_area' => 'required|string|max:100', 
            'kapasitas' => 'required|numeric|min:0', 
        ]); 
 
        AreaParkir::create([ 
            'nama_area' => $request->nama_area, 
            'kapasitas' => $request->kapasitas, 
            
        ]); 
 
        return redirect()->route('admin.area.index')->with('success', 'Area berhasil ditambahkan.'); 
    } 
 
    public function edit(AreaParkir $area) 
    { 
        return view('admin.area.edit', compact('area')); 
    }
      public function update(Request $request, AreaParkir $area) 
    { 
        $request->validate([ 
             'nama_area' => 'required|string|max:100', 
            'kapasitas' => 'required|numeric|min:0', 
            
        ]); 
 
        $data = $request->only('nama_area', 'kapasitas', 'terisi'); 
 
        if ($request->filled('password')) { 
            $data['password'] = Hash::make($request->password); 
        } 
 
        $area->update($data); 
 
        return redirect()->route('admin.area.index')->with('success', 'Area berhasil diperbarui.'); 
    } 
    
 
    public function destroy(AreaParkir $area) 
    { 
        $area->delete(); 
        return redirect()->route('admin.area.index')->with('success', 'Area berhasil dihapus.'); 
    } 
} 