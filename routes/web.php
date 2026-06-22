<?php

use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateSuratController;
use App\Http\Controllers\TemplateSuratController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Models\Warga;
use App\Models\ArsipSurat;
use App\Models\TemplateSurat;



Route::middleware('guest')->group(function () {

    Route::get('/', function () {
        return redirect()->route('login');
    });

    // authentication
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
    // end authentication

});


Route::middleware(['auth'])->group(function () {

    // authentication
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // end authentication

    Route::get('/dashboard', function () {
        $totalWarga     = Warga::count();
        $totalTemplate  = TemplateSurat::count();
        $totalArsip     = ArsipSurat::count();
        $suratBulanIni  = ArsipSurat::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $suratTerbaru   = ArsipSurat::with(['warga', 'template'])
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($arsip) {
                return (object)[
                    'nama_warga'  => $arsip->warga->nama ?? '-',
                    'jenis_surat' => $arsip->template->nama_template ?? '-',
                    'created_at'  => $arsip->created_at,
                ];
            });

        $suratTerbanyak = ArsipSurat::with('template')
            ->get()
            ->groupBy(fn($a) => $a->template->nama_template ?? 'Lainnya')
            ->map->count()
            ->sortDesc()
            ->take(4);

        return view('dashboard', compact(
            'totalWarga',
            'totalTemplate',
            'totalArsip',
            'suratBulanIni',
            'suratTerbaru',
            'suratTerbanyak'
        ));
    })->name('dashboard');



    // warga

    Route::get('/warga',        [WargaController::class, 'index'])->name('warga.index');
    Route::get('/warga/tambah', [WargaController::class, 'create'])->name('warga.create');
    Route::get('/warga/export',     [WargaController::class, 'export'])->name('warga.export');
    Route::get('/warga/{warga}', [WargaController::class, 'show'])->name('warga.show');
    Route::post('/warga',       [WargaController::class, 'store'])->name('warga.store');


    Route::get('/warga/{warga}/edit', [WargaController::class, 'edit'])->name('warga.edit');
    Route::put('/warga/{warga}',      [WargaController::class, 'update'])->name('warga.update');
    Route::delete('/warga/{warga}', [WargaController::class, 'destroy'])->name('warga.destroy');

    // end warga

    // template surat

    // Route::get('/template-surat', function () {
    //     return view('template-surat.index');
    // });

    Route::get('/template',          [TemplateSuratController::class, 'index'])->name('template.index');
    Route::get('/template/tambah',   [TemplateSuratController::class, 'create'])->name('template.create');
    Route::post('/template',         [TemplateSuratController::class, 'store'])->name('template.store');
    Route::get('/template/{template}/edit', [TemplateSuratController::class, 'edit'])->name('template.edit');
    Route::put('/template/{template}',      [TemplateSuratController::class, 'update'])->name('template.update');
    Route::delete('/template/{template}', [TemplateSuratController::class, 'destroy'])->name('template.destroy');

    // end template surat

    // generate surat

    Route::get('/generate',  [GenerateSuratController::class, 'index'])->name('generate.index');
    Route::post('/generate', [GenerateSuratController::class, 'generate'])->name('generate.generate');

    // end generate surat

    // arsip surat

    Route::get('/arsip', [ArsipSuratController::class, 'index'])->name('arsip.index');
    Route::delete('/arsip/{arsip}', [ArsipSuratController::class, 'destroy'])->name('arsip.destroy');

    // end arsip surat

    // akun
    Route::get('/akun',  [AkunController::class, 'index'])->name('akun.index');
    Route::put('/akun',  [AkunController::class, 'update'])->name('akun.update');
    // end akun


});
