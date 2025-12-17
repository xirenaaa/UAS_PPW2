<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index() {
        // Data untuk pie chart (gender)
        $genderData = Pegawai::select('gender', DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->pluck('total', 'gender')
            ->toArray();

        $maleCount = $genderData['male'] ?? 0;
        $femaleCount = $genderData['female'] ?? 0;

        // Data untuk bar chart (top 5 pekerjaan dengan pegawai terbanyak)
        $topPekerjaan = Pekerjaan::withCount('pegawai')
            ->orderBy('pegawai_count', 'desc')
            ->limit(5)
            ->get();

        $pekerjaanLabels = $topPekerjaan->pluck('nama')->toArray();
        $pekerjaanData = $topPekerjaan->pluck('pegawai_count')->toArray();

        return view('index', compact('maleCount', 'femaleCount', 'pekerjaanLabels', 'pekerjaanData'));
    }
}
