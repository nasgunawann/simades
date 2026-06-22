@extends('app')

@section('content')


<main class="flex-1 overflow-y-auto p-5 lg:p-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7 animate-fade-up s1">
        <div>
            <h3 class="text-forest-900 font-bold text-xl">Daftar Template Surat</h3>
            <p class="text-gray-400 text-sm mt-0.5">Kelola template surat yang tersedia di sistem</p>
        </div>
        <a href="{{ route('template.create') }}"
            class="inline-flex items-center gap-2 bg-forest-600 hover:bg-forest-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors shadow-sm flex-shrink-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Template
        </a>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up s2">

        {{-- Toolbar --}}
        <div class="px-5 py-4 border-b border-gray-100">
            <form method="GET" action="{{ route('template.index') }}" class="flex items-center gap-2">

                <div class="relative w-full sm:w-64">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803a7.5 7.5 0 0010.607 10.607z" />
                    </svg>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama template..."
                        class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-xl
                            focus:outline-none focus:ring-2 focus:ring-forest-300
                            bg-gray-50 text-gray-700"
                    >
                </div>

                <button type="submit"
                    class="px-4 py-2 bg-forest-600 hover:bg-forest-700 text-white text-sm font-semibold rounded-xl">
                    Cari
                </button>

                @if(request('search'))
                    <a href="{{ route('template.index') }}"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold rounded-xl">
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
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Nama Template</th>
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider hidden md:table-cell">Terakhir Diperbarui</th>
                        <th class="px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($templates as $template)
                    <tr class="hover:bg-gray-50/60 transition-colors">
                        <td class="px-5 py-3.5 text-gray-400 text-xs">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-forest-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-forest-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                </div>
                                <span class="font-semibold text-forest-900">{{ $template->nama_template }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-gray-400 text-xs hidden md:table-cell">
                            {{ $template->updated_at->isoFormat('D MMM Y') }}
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-center gap-1.5">
                                <form method="POST" action="{{ route('template.destroy', $template->id) }}" id="delete-template-{{ $template->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="{{ route('template.edit', $template->id) }}" title="Edit"
                                    class="p-1.5 rounded-lg text-gray-400 hover:text-earth-600 hover:bg-earth-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                                <button type="button" title="Hapus"
                                    onclick="confirmDeleteTemplate({{ $template->id }}, '{{ addslashes($template->nama_template) }}')"
                                    class="p-1.5 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <div class="px-5 py-4 border-t border-gray-100">
            <p class="text-gray-400 text-xs">Menampilkan <span class="font-semibold text-forest-700">{{ $templates->count() }}</span> template</p>
        </div>

    </div>

</main>
@endsection

<script>
    function confirmDeleteTemplate(id, nama) {
        if (confirm('Yakin ingin menghapus template "' + nama + '"? File akan ikut terhapus.')) {
            document.getElementById('delete-template-' + id).submit();
        }
    }
</script>