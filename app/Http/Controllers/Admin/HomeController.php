<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $totalPengumuman = Pengumuman::count();
        $totalKehilangan = Pengumuman::kehilangan()->count();
        $totalPenemuan = Pengumuman::penemuan()->count();
        $totalUser = User::count();

        return view('pages.admin.home', compact(
            'totalPengumuman',
            'totalKehilangan',
            'totalPenemuan',
            'totalUser'
        ));
    }
}
