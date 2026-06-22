@extends('app')

@section('content')

<main class="flex-1 overflow-y-auto p-5 lg:p-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7 animate-fade-up s1">
        <div>
            <h3 class="text-forest-900 font-bold text-xl">Daftar Warga</h3>
            <p class="text-gray-400 text-sm mt-0.5">Kelola data warga desa secara terpusat</p>
        </div>
        
        <div class="flex items-center gap-2 flex-shrink-0"> {{-- ← BUNGKUS JADI DIV --}}

            {{-- Tombol Export Excel --}}
            <a href="{{ route('warga.export', request()->only('search')) }}"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Export Excel
            </a>

            {{-- Tombol Tambah Warga (tetap sama) --}}
            <a href="{{ route('warga.create') }}"
                class="inline-flex items-center gap-2 bg-forest-600 hover:bg-forest-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Warga
            </a>

        </div>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up s2">

        {{-- Toolbar --}}
        <div class="px-5 py-4 border-b border-gray-100">
            <form method="GET" action="{{ route('warga.index') }}" class="flex gap-2">
                <div class="relative w-full sm:w-64">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIK..."
                        class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 bg-gray-50 placeholder-gray-400 text-gray-700">
                </div>
                <button type="submit" class="px-4 py-2 bg-forest-600 hover:bg-forest-700 text-white text-sm font-semibold rounded-xl transition-colors">
                    Cari
                </button>
                @if (request('search'))
                <a href="{{ route('warga.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold rounded-xl transition-colors">
                    Reset
                </a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100">
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider w-10">#</th>
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Nama Lengkap</th>
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">NIK</th>
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider hidden md:table-cell">Jenis Kelamin</th>
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider hidden lg:table-cell">Alamat</th>
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider hidden sm:table-cell">No. HP</th>
                        <th class="px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($wargas as $i => $warga)
                    <tr class="hover:bg-gray-50/60 transition-colors">
                        <td class="px-5 py-3.5 text-gray-400 text-xs">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <!-- <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-xs {{ $warga['jenis_kelamin'] === 'Laki-laki' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-600' }}">
                                    {{ strtoupper(substr($warga['nama'], 0, 2)) }}
                                </div> -->
                                <span class="font-semibold text-forest-900">{{ $warga['nama'] }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-gray-500 font-mono text-xs tracking-wide">{{ $warga['nik'] }}</td>
                        <td class="px-5 py-3.5 hidden md:table-cell">
                            @if ($warga['jenis_kelamin'] === 'Laki-laki')
                            <span class="text-[11px] font-semibold bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full">Laki-laki</span>
                            @else
                            <span class="text-[11px] font-semibold bg-pink-50 text-pink-500 px-2 py-0.5 rounded-full">Perempuan</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5 text-gray-500 text-xs hidden lg:table-cell max-w-[200px] truncate">{{ $warga['alamat'] }}</td>
                        <td class="px-5 py-3.5 text-gray-500 text-xs hidden sm:table-cell">{{ $warga['nomor_telepon'] }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('warga.show', $warga->id) }}" title="Detail"
                                    class="p-1.5 rounded-lg text-gray-400 hover:text-forest-600 hover:bg-forest-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </a>
                                <a href="{{ route('warga.edit', $warga->id) }}" title="Edit"
                                    class="p-1.5 rounded-lg text-gray-400 hover:text-earth-600 hover:bg-earth-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('warga.destroy', $warga->id) }}" id="delete-form-{{ $warga->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" title="Hapus"
                                        onclick="confirmDelete({{ $warga->id }}, '{{ addslashes($warga->nama) }}')"
                                        class="p-1.5 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors mt-3">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Footer info --}}
        <div class="px-5 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-gray-400 text-xs">
                Menampilkan
                <span class="font-semibold text-forest-700">{{ $wargas->firstItem() ?? 0 }}</span>
                –
                <span class="font-semibold text-forest-700">{{ $wargas->lastItem() ?? 0 }}</span>
                dari
                <span class="font-semibold text-forest-700">{{ $wargas->total() }}</span>
                data
            </p>

            <div class="flex items-center gap-1">
                {{-- Prev --}}
                @if ($wargas->onFirstPage())
                <span class="px-3 py-1.5 text-xs text-gray-300 bg-gray-50 border border-gray-200 rounded-lg cursor-not-allowed">
                    &laquo;
                </span>
                @else
                <a href="{{ $wargas->previousPageUrl() }}" class="px-3 py-1.5 text-xs text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-forest-50 hover:text-forest-600 hover:border-forest-200 transition-colors">
                    &laquo;
                </a>
                @endif

                {{-- Page numbers --}}
                @foreach ($wargas->getUrlRange(1, $wargas->lastPage()) as $page => $url)
                @if ($page == $wargas->currentPage())
                <span class="px-3 py-1.5 text-xs font-bold text-white bg-forest-600 border border-forest-600 rounded-lg">
                    {{ $page }}
                </span>
                @else
                <a href="{{ $url }}" class="px-3 py-1.5 text-xs text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-forest-50 hover:text-forest-600 hover:border-forest-200 transition-colors">
                    {{ $page }}
                </a>
                @endif
                @endforeach

                {{-- Next --}}
                @if ($wargas->hasMorePages())
                <a href="{{ $wargas->nextPageUrl() }}" class="px-3 py-1.5 text-xs text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-forest-50 hover:text-forest-600 hover:border-forest-200 transition-colors">
                    &raquo;
                </a>
                @else
                <span class="px-3 py-1.5 text-xs text-gray-300 bg-gray-50 border border-gray-200 rounded-lg cursor-not-allowed">
                    &raquo;
                </span>
                @endif
            </div>
        </div>

    </div>

</main>
@endsection

{{-- Modal Konfirmasi Hapus --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeDeleteModal()"></div>

    {{-- Modal Box --}}
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 animate-fade-up">
        <div class="flex flex-col items-center text-center">
            <div class="w-14 h-14 rounded-full bg-red-50 flex items-center justify-center mb-4">
                <svg class="w-7 h-7 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </div>
            <h4 class="text-forest-900 font-bold text-lg">Hapus Data Warga?</h4>
            <p class="text-gray-400 text-sm mt-1">Data <span id="deleteNama" class="font-semibold text-gray-600"></span> akan dihapus permanen dan tidak dapat dikembalikan.</p>
        </div>

        <div class="flex gap-3 mt-6">
            <button onclick="closeDeleteModal()"
                class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold rounded-xl transition-colors">
                Batal
            </button>
            <button id="deleteConfirmBtn"
                class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-bold rounded-xl transition-colors">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id, nama) {
        document.getElementById('deleteNama').textContent = nama;
        document.getElementById('deleteConfirmBtn').onclick = () => {
            document.getElementById('delete-form-' + id).submit();
        };
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>