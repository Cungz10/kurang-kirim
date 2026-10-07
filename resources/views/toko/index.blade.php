@extends('layouts.app')

@section('title', 'Master Toko')

@section('content')
<div class="space-y-6">
    <!-- Header & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 text-xs font-medium mb-2">
                <span class="h-1.5 w-1.5 rounded-full bg-purple-400"></span>
                Database Toko
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">Master Toko</h1>
            <p class="mt-1 text-sm text-white/60">Kelola daftar toko mitra yang tersedia di sistem.</p>
        </div>
        <div class="flex items-center">
            <a href="{{ route('toko.create') }}"
               class="ios-btn-primary inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-semibold text-white shadow-md active:scale-95">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Toko Baru
            </a>
        </div>
    </div>

    <!-- Search Bar & Summary -->
    <div class="ios-glass-card-subtle rounded-[24px] p-4 flex flex-col sm:flex-row gap-4 justify-between items-center">
        <form method="GET" action="{{ route('toko.index') }}" class="w-full sm:max-w-md relative">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 h-4 w-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama toko..."
                   class="w-full ios-input pl-10 pr-4 py-2.5 text-xs sm:text-sm text-white placeholder-white/40">
            @if(request('search'))
                <a href="{{ route('toko.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-white/40 hover:text-white">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </a>
            @endif
        </form>

        <div class="flex items-center gap-3 w-full sm:w-auto px-2">
            <div class="flex items-center gap-2 text-sm text-white/60">
                Total data: <span class="font-bold text-white">{{ $tokoList->total() }}</span> toko
            </div>
        </div>
    </div>

    <!-- iOS Inset Grouped Table Card -->
    <div class="ios-glass-card rounded-[32px] overflow-hidden relative shadow-2xl">
        <div class="absolute inset-x-0 top-0 h-[1px] bg-gradient-to-r from-transparent via-white/40 to-transparent pointer-events-none"></div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/10 bg-white/[0.04]">
                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white/50 w-16">No</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white/50">Kode Toko</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white/50">Nama Toko</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold uppercase tracking-wider text-white/50">Status</th>
                        <th class="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider text-white/50">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.07]">
                    @if($tokoList->count() > 0)
                        @foreach($tokoList as $index => $toko)
                            <tr class="hover:bg-white/[0.05] transition-colors duration-150">
                                <td class="px-5 py-4 text-white/40 font-mono text-xs">{{ $tokoList->firstItem() + $index }}</td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center rounded-full bg-purple-500/15 border border-purple-400/30 px-3 py-1 text-xs font-semibold text-purple-300 font-mono">
                                        {{ $toko->kode_toko }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-white font-medium text-sm">{{ $toko->nama_toko }}</td>
                                <td class="px-5 py-4 text-center">
                                    <form action="{{ route('toko.toggle', $toko) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="group relative inline-flex h-6 w-11 shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition-colors ease-in-out duration-200 {{ $toko->status == 1 ? 'bg-emerald-500' : 'bg-white/20' }}" title="Klik untuk mengubah status">
                                            @if($toko->status == 1)
                                                <span class="absolute inset-0 rounded-full animate-ping bg-emerald-400 opacity-20"></span>
                                            @endif
                                            <span aria-hidden="true" class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $toko->status == 1 ? 'translate-x-2.5' : '-translate-x-2.5' }}"></span>
                                        </button>
                                    </form>
                                    <div class="mt-1 text-[10px] uppercase font-bold tracking-wider {{ $toko->status == 1 ? 'text-emerald-400' : 'text-white/40' }}">
                                        {{ $toko->status == 1 ? 'Aktif' : 'Nonaktif' }}
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('toko.edit', $toko) }}"
                                           class="flex h-8 w-8 items-center justify-center rounded-full bg-amber-500/15 border border-amber-500/30 text-amber-300 hover:bg-amber-500/30 transition-all"
                                           title="Edit Toko">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('toko.destroy', $toko) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus toko ini?\n\nPERINGATAN: Semua data Surat Jalan yang terkait dengan toko ini juga akan ikut terhapus secara permanen!')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="flex h-8 w-8 items-center justify-center rounded-full bg-rose-500/15 border border-rose-500/30 text-rose-300 hover:bg-rose-500/30 transition-all"
                                                    title="Hapus Toko">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="flex h-16 w-16 items-center justify-center rounded-[20px] bg-white/[0.06] border border-white/10 text-white/40">
                                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <p class="text-white/60 text-sm">Belum ada data toko yang cocok.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination Bar -->
        @if($tokoList->lastPage() > 1)
            <div class="border-t border-white/10 px-5 py-4 flex flex-col sm:flex-row items-center justify-between gap-3 bg-white/[0.02]">
                <p class="text-xs text-white/50">
                    Menampilkan <span class="text-white font-medium">{{ $tokoList->firstItem() }}</span> - <span class="text-white font-medium">{{ $tokoList->lastItem() }}</span> dari <span class="text-white font-medium">{{ $tokoList->total() }}</span> toko
                </p>
                <div class="flex items-center gap-1.5">
                    @if($tokoList->currentPage() > 1)
                        <a href="{{ $tokoList->previousPageUrl() }}" class="ios-btn-secondary rounded-lg px-3 py-1.5 text-xs text-white/80">Sebelumnya</a>
                    @endif
                    
                    @for($p = 1; $p <= $tokoList->lastPage(); $p++)
                        @if ($p == $tokoList->currentPage())
                            <span class="rounded-lg px-3 py-1.5 text-xs font-medium transition-all ios-btn-primary text-white font-bold">{{ $p }}</span>
                        @else
                            <a href="{{ $tokoList->url($p) }}" class="rounded-lg px-3 py-1.5 text-xs font-medium transition-all bg-white/5 text-white/60 hover:bg-white/10 hover:text-white">{{ $p }}</a>
                        @endif
                    @endfor

                    @if($tokoList->hasMorePages())
                        <a href="{{ $tokoList->nextPageUrl() }}" class="ios-btn-secondary rounded-lg px-3 py-1.5 text-xs text-white/80">Selanjutnya</a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
