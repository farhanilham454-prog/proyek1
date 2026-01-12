<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DiagramController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $userId = Auth::user()->user_id;
        $periode = $request->get('periode', '30days');

        switch ($periode) {
            case 'today':
                $start = Carbon::today();
                $end   = Carbon::today()->endOfDay();
                $groupFormat = '%Y-%m-%d'; // harian
                break;
            case '7days':
                $start = Carbon::now()->subDays(7)->startOfDay();
                $end   = Carbon::now()->endOfDay();
                $groupFormat = '%Y-%m-%d'; // harian
                break;
            case '30days':
            default:
                $start = Carbon::now()->subDays(30)->startOfDay();
                $end   = Carbon::now()->endOfDay();
                $groupFormat = '%Y-%m-%d'; // harian
                break;
        }

        // Agregasi pemasukan
        $pemasukanGrouped = Transaksi::where('user_id', $userId)
            ->where('type', 'pemasukan')
            ->whereBetween('date', [$start, $end])
            ->selectRaw("DATE_FORMAT(date, '{$groupFormat}') AS periode, SUM(amount) AS total")
            ->groupBy('periode')
            ->orderBy('periode')
            ->pluck('total', 'periode');

        // Agregasi pengeluaran
        $pengeluaranGrouped = Transaksi::where('user_id', $userId)
            ->where('type', 'pengeluaran')
            ->whereBetween('date', [$start, $end])
            ->selectRaw("DATE_FORMAT(date, '{$groupFormat}') AS periode, SUM(amount) AS total")
            ->groupBy('periode')
            ->orderBy('periode')
            ->pluck('total', 'periode');

        // Total untuk donut chart
        $totalPemasukan = Transaksi::where('user_id', $userId)
            ->where('type', 'pemasukan')
            ->whereBetween('date', [$start, $end])
            ->sum('amount');

        $totalPengeluaran = Transaksi::where('user_id', $userId)
            ->where('type', 'pengeluaran')
            ->whereBetween('date', [$start, $end])
            ->sum('amount');

        // Daftar transaksi untuk ditampilkan di samping grafik
        $transaksi = Transaksi::where('user_id', $userId)
            ->whereBetween('date', [$start, $end])
            ->orderBy('date', 'desc')
            ->get();

        // Buat array tanggal (label) dan data pemasukan/pengeluaran per tanggal
        $labels = [];
        $pemasukanData = [];
        $pengeluaranData = [];

        foreach ($start->copy()->daysUntil($end) as $date) {
            $key = $date->format('Y-m-d');
            $labels[] = $date->format('d M');

            $pemasukanData[] = (int) ($pemasukanGrouped[$key] ?? 0);
            $pengeluaranData[] = (int) ($pengeluaranGrouped[$key] ?? 0);
        }

        return view('diagram.diagram', [
            'periode'          => $periode,
            'pemasukanGrouped' => $pemasukanGrouped,
            'pengeluaranGrouped' => $pengeluaranGrouped,
            'totalPemasukan'   => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'transaksi'        => $transaksi,
            'labels'           => $labels,
            'pemasukanData'    => $pemasukanData,
            'pengeluaranData'  => $pengeluaranData,
        ]);
    }
}
