<x-app-layout title="Tutorial Pengguna">
    <div class="max-w-5xl mx-auto px-4 py-8 bg-white rounded-xl shadow-md space-y-6">
        <div class="flex gap-x-2">
            <h1 class="text-2xl font-bold text-biruPrimary">Tutorial Penggunaan Sistem Bulikakan</h1>
            <img class="h-16 w-auto -mt-5" src="{{ asset('logo/loop-nobg.png') }}" alt="Logo">
        </div>

        <div class="space-y-4">
            <h2 class="text-xl font-semibold text-biruPrimary">Pastikan Anda Telah Mengakses Sistem <a href="https://bulikakan.my.id" class="text-blue-500">https://bulikakan.my.id</a></h2>
            <h2 class="text-xl font-semibold text-biruPrimary">1. User Mendaftar (Registrasi)</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>Masuk ke halaman Register</li>
                <li>Masukkan username, email aktif, dan password</li>
                <li>Pastikan data sudah sesuai dan password dapat diingat, bisa tekan icon mata untuk melihat password</li>
                <li>Klik Daftar / Register</li>
                <li>Pastikan registrasi sukses lewat notifikasi sukses, jika gagal silakan ulangi pendaftaran</li>
            </ul>

            <h2 class="text-xl font-semibold text-biruPrimary">2. User Login ke Sistem</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>Masuk ke halaman login</li>
                <li>Masukkan Username / Email dan password yang terdaftar</li>
                <li>Klik Login</li>
            </ul>

            <h2 class="text-xl font-semibold text-biruPrimary">3. Login / Daftar dengan Google</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>Masuk ke halaman Register atau Login</li>
                <li>Klik Icon Google</li>
                <li>Pilih akun Google yang ingin digunakan</li>
                <li>Setujui semua persyaratan</li>
                <li>Anda akan masuk ke sistem dan dapat mengakses semua fitur yang tersedia</li>
            </ul>

            <h2 class="text-xl font-semibold text-biruPrimary">4. Lupa Password</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>Klik "Lupa Password"</li>
                <li>Input email yang terdaftar</li>
                <li>Link reset password akan dikirimkan ke email jika terdaftar</li>
                <li>Buka Gmail, klik link reset password</li>
                <li>Masukkan dan konfirmasi password baru</li>
                <li>Klik Reset Password</li>
                <li>Anda akan diarahkan ke halaman "Password Berubah", lalu login ulang</li>
            </ul>

            <h2 class="text-xl font-semibold text-biruPrimary">5. Mengakses Menu Tutorial</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>Klik menu Tutorial pada dropdown di kanan atas</li>
                <li>Pelajari tutorial terkait sistem Bulikakan</li>
            </ul>

            <h2 class="text-xl font-semibold text-biruPrimary">6. Mengakses Menu Contact Kami</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>Klik menu Contact Kami pada dropdown di kanan atas</li>
                <li>Pastikan Anda telah login</li>
                <li>Isi judul dan pesan yang akan dikirimkan ke developer</li>
            </ul>

            <h2 class="text-xl font-semibold text-biruPrimary">7. Melihat Pengumuman Kehilangan/Penemuan</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>Silahkan Akses Sistem Bulikakan</li>
                <li>Pilih menu Kehilangan atau Penemuan sesuai kebutuhan</li>
                <li>Gunakan fitur pencarian dan filter berdasarkan tipe barang</li>
            </ul>

            <h2 class="text-xl font-semibold text-biruPrimary">8. Mengakses Fitur Kehilangan/Penemuan</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>Wajib login terlebih dahulu</li>
                <li>Klik ikon tambah di menu bawah</li>
                <li>Pilih jenis pengumuman: Kehilangan atau Penemuan</li>
                <li>Isi data barang dan deskripsi</li>
                <li>Klik Simpan</li>
            </ul>

            <h2 class="text-xl font-semibold text-biruPrimary">9. Mengedit atau Menghapus Pengumuman</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>Pastikan login terlebih dahulu</li>
                <li>Klik Lihat Detail pada pengumuman Anda</li>
                <li>Gunakan tombol Edit untuk mengubah atau Hapus untuk menghapus pengumuman</li>
            </ul>

            <h2 class="text-xl font-semibold text-biruPrimary">10. Request Akun Menjadi Official</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>Login terlebih dahulu</li>
                <li>Klik menu "Request Official" di dropdown kanan atas</li>
                <li>Isi data dan unggah dokumen pendukung seperti : id card/ kartu anggota instansi, surat pengantar resmi dari instansi yang menegaskan bahwa orang tersebut atau akun tersebut memang diberi wewenang dalam menangani keamanan instansi tersebut</li>
                <li>Tunggu verifikasi dari admin</li>
                <li>Jika disetujui, akun Anda akan memiliki lencana verifikasi</li>
            </ul>

            <h2 class="text-xl font-semibold text-biruPrimary">11. Merubah Data Profil</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>Login terlebih dahulu</li>
                <li>Buka menu "Profile" di bottom menu</li>
                <li>Klik "Edit Profile"</li>
                <li>Rubah data seperti foto, username, email, atau password</li>
                <li>Klik Simpan</li>
            </ul>
        </div>
    </div>
</x-app-layout>
