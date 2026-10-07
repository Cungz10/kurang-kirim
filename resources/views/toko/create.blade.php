@extends('layouts.app')

@section('title', 'Tambah Toko Baru')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Back Button & Header -->
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('toko.index') }}"
           class="ios-btn-secondary flex h-10 w-10 items-center justify-center rounded-full text-white/70 hover:text-white transition-all group">
            <svg class="h-5 w-5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">Tambah Toko Baru</h1>
            <p class="text-xs text-white/50 mt-1">Daftarkan mitra toko ke dalam sistem</p>
        </div>
    </div>

    <!-- === Main Glass Card: Create Form === -->
    <div class="ios-glass-card rounded-[32px] relative overflow-hidden shadow-2xl">
        <div class="absolute inset-x-0 top-0 h-[1.5px] bg-gradient-to-r from-transparent via-white/50 to-transparent pointer-events-none"></div>

        <div class="p-6 sm:p-10">
            <form action="{{ route('toko.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Kode Toko -->
                <div>
                    <label for="kode_toko" class="block text-sm font-medium text-white/80 mb-2">
                        Kode Toko <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" id="kode_toko" name="kode_toko" value="{{ old('kode_toko') }}" required placeholder="Contoh: T-001"
                        class="w-full ios-input px-4 py-3 text-sm text-white placeholder-white/30 font-mono uppercase">
                    @error('kode_toko')
                        <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                    @else
                        <p class="mt-1.5 text-xs text-white/40">Gunakan kode unik untuk identifikasi (maks. 20 karakter).</p>
                    @enderror
                </div>

                <!-- Nama Toko -->
                <div>
                    <label for="nama_toko" class="block text-sm font-medium text-white/80 mb-2">
                        Nama Toko <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" id="nama_toko" name="nama_toko" value="{{ old('nama_toko') }}" required placeholder="Contoh: Toko Berkah Jaya"
                        class="w-full ios-input px-4 py-3 text-sm text-white placeholder-white/30">
                    @error('nama_toko')
                        <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Buttons -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-6 border-t border-white/10">
                    <button type="submit" class="flex-1 ios-btn-primary rounded-2xl py-3.5 px-6 font-semibold flex items-center justify-center gap-2 text-white shadow-lg">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Toko
                    </button>
                    <a href="{{ route('toko.index') }}" class="sm:w-auto ios-btn-secondary rounded-2xl py-3.5 px-6 font-medium text-white/80 hover:text-white text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
