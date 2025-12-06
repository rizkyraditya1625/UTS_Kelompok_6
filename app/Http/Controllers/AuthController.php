<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    
    public function login(Request $request) {
        $credentials = $request->validate(['email'=>'required|email', 'password'=>'required']);
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/home');
        }
        return back()->with('error', 'Login Gagal!');
    }

    public function showRegister() { return view('auth.register'); }

   public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'USER'
        ]);

        return redirect('/')->with('success', 'Akun berhasil dibuat, silakan login!');
    }

    public function profile() { return view('auth.profile', ['user'=>Auth::user()]); }

    public function updatePhoto(Request $request) {
        $request->validate(['profile_photo'=>'required|image|max:10240']);
        $file = $request->file('profile_photo');
        $name = time().'_profile.'.$file->extension();
        $file->move(public_path('uploads/profiles'), $name);
        
        $user = Auth::user(); /** @var \App\Models\User $user */
        $user->update(['profile_photo' => $name]);
        return back();
    }

    public function logout(Request $request) {
        Auth::logout(); $request->session()->invalidate(); return redirect('/');
    }

    // Menampilkan Profil Orang Lain (Public)
    public function showUserProfile($id)
    {
        $user = User::findOrFail($id); // Cari user by ID
        return view('auth.public_profile', compact('user'));
    }
    // --- FITUR LUPA PASSWORD ---

    // 1. Tampilkan Form Input Email
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    // 2. Proses Kirim Link Reset
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        // HAPUS TOKEN LAMA (Ini perbaikan utamanya)
        // Agar tidak error "Duplicate Entry" saat request berkali-kali
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        $token = Str::random(64);

        // Simpan Token Baru
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Kirim Email (Cek storage/logs/laravel.log)
        Mail::to($request->email)->send(new ResetPasswordMail($token, $request->email));

        return back()->with('success', 'Link reset password telah dikirim! Cek Log/Email Anda.');
    }

    // 3. Tampilkan Form Reset Password Baru
    public function showResetPassword($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // 4. Proses Update Password Baru
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed', // Butuh input password_confirmation
            'token' => 'required'
        ]);

        // Cek Token Valid
        $checkToken = DB::table('password_reset_tokens')
                        ->where(['email' => $request->email, 'token' => $request->token])
                        ->first();

        if(!$checkToken){
            return back()->with('error', 'Token tidak valid atau sudah kadaluarsa!');
        }

        // Update User
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Hapus Token agar tidak bisa dipakai lagi
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('success', 'Password berhasil diubah! Silakan login.');
    }
}