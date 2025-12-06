<?php
namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use Illuminate\Support\Facades\Mail;
use App\Mail\ItemResolvedMail;
use Carbon\Carbon;

class ItemController extends Controller
{
    public function index(Request $request) {
        $query = Item::latest();
        if($request->search) $query->where('title', 'like', "%$request->search%");
        if($request->status) $query->where('status', $request->status);
        return view('home', ['items' => $query->get()]);
    }

    public function create() { return view('post.create'); }

    public function store(Request $request) {
        $req = $request->validate([
            'status'=>'required', 'title'=>'required', 'description'=>'required',
            'location'=>'required', 'titipkan_ke'=>'required', 'time'=>'required',
            'image'=>'required|image|max:10240', 'whatsapp'=>'nullable', 'instagram'=>'nullable'
        ]);

        // Upload Image
        $imgName = time().'_item.'.$request->image->extension();
        $request->image->move(public_path('uploads'), $imgName);

        // Clean WA
        $wa = $req['whatsapp'] ? preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $req['whatsapp'])) : null;

        Item::create(array_merge($req, [
            'user_name' => Auth::user()->name,
            'image_path' => $imgName,
            'whatsapp' => $wa
        ]));
        
        return redirect('/home');
    }

    public function show($id) {
        return view('show', ['item' => Item::findOrFail($id)]);
    }
    // --- PROSES DONE (SELESAI) ---
    public function markAsDone($id)
    {
        $item = Item::findOrFail($id);
        $currentUser = Auth::user();
        
        // Cari Data Pelapor (Reporter)
        // Karena di tabel Item kita cuma simpan nama, kita cari ID-nya di tabel User
        $reporterUser = \App\Models\User::where('name', $item->user_name)->first();
        
        $reporterName = $reporterUser ? $reporterUser->name . ' (' . $reporterUser->nim . ')' : $item->user_name;
        $reporterId   = $reporterUser ? $reporterUser->id : null; // Simpan ID

        // Data Penemu (Resolver - Orang yang login saat ini)
        $resolverName = $currentUser->name . ' (' . $currentUser->nim . ')';
        $resolverId   = $currentUser->id; // Simpan ID

        $note = "";

        // Logika Skenario
        if ($item->status == 'kehilangan') {
            if ($currentUser->name != $item->user_name) {
                return back()->with('error', 'Hanya pemilik yang bisa menyelesaikan ini!');
            }
            $note = "Barang telah kembali ke pemilik asli.";
        } else {
            $note = "Barang diklaim/diambil oleh $resolverName.";
        }

        // Pindahkan ke History (DENGAN ID USER)
        History::create([
            'title' => $item->title,
            'description' => $item->description,
            'location' => $item->location,
            'image_path' => $item->image_path,
            
            'reporter_name' => $reporterName,
            'reporter_id'   => $reporterId, // <--- Simpan ID Pelapor
            
            'resolver_name' => $resolverName,
            'resolver_id'   => $resolverId, // <--- Simpan ID Penemu
            
            'completion_note' => $note,
            'completed_at' => Carbon::now(),
        ]);

        $item->delete();

        return redirect('/history')->with('success', 'Laporan selesai!');
    }

    // --- HALAMAN HISTORY ---
    public function history()
    {
        $histories = History::latest()->get();
        return view('history', compact('histories'));
    }

    // --- EDIT BARANG ---
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        // Cek kepemilikan
        if (Auth::user()->name != $item->user_name && Auth::user()->role != 'ADMIN') {
            return back()->with('error', 'Tidak punya akses!');
        }
        return view('post.edit', compact('item'));
    }

    // --- UPDATE BARANG ---
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        
        // Validasi (mirip store tapi image nullable)
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'titipkan_ke' => 'required|string',
            'image' => 'nullable|image|max:10240',
        ]);

        // Update Gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus lama
            if (file_exists(public_path('uploads/'.$item->image_path))) {
                unlink(public_path('uploads/'.$item->image_path));
            }
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads'), $imageName);
            $item->image_path = $imageName;
        }

        // Update Data Lain
        $item->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'titipkan_ke' => $request->titipkan_ke,
            'whatsapp' => $request->whatsapp,
            'instagram' => $request->instagram,
        ]);

        return redirect('/post/'.$id)->with('success', 'Data berhasil diperbarui!');
    }

    // --- HAPUS BARANG ---
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        
        // Cek kepemilikan
        if (Auth::user()->name != $item->user_name && Auth::user()->role != 'ADMIN') {
            return back()->with('error', 'Tidak punya akses!');
        }

        // Hapus Gambar
        if (file_exists(public_path('uploads/'.$item->image_path))) {
            unlink(public_path('uploads/'.$item->image_path));
        }

        $item->delete();
        return redirect('/home')->with('success', 'Postingan berhasil dihapus.');
    }
    // --- HAPUS HISTORY (KHUSUS ADMIN) ---
    public function deleteHistory($id)
    {
        // 1. Cek apakah yang akses adalah ADMIN
        if (Auth::user()->role !== 'ADMIN') {
            return back()->with('error', 'Akses ditolak! Hanya Admin yang boleh menghapus riwayat.');
        }

        $history = History::findOrFail($id);

        // 2. Hapus Foto jika ada (Agar hemat storage)
        if ($history->image_path && file_exists(public_path('uploads/' . $history->image_path))) {
            unlink(public_path('uploads/' . $history->image_path));
        }

        // 3. Hapus Data
        $history->delete();

        return back()->with('success', 'Data riwayat berhasil dihapus permanen.');
    }
}