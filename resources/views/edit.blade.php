@extends('layouts.app')

@section('title', 'Edit Surat Jalan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Back Button & Header -->
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('history') }}"
           class="ios-btn-secondary flex h-10 w-10 items-center justify-center rounded-full text-white/70 hover:text-white transition-all group">
            <svg class="h-5 w-5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">Edit Surat Jalan</h1>
            <p class="text-xs text-white/50 uppercase tracking-wider font-semibold mt-1">Dokumen: {{ $kurangKirim->nomor_surat_jalan }}</p>
        </div>
    </div>

    <!-- === Main Glass Card: Edit Form === -->
    <div class="ios-glass-card rounded-[32px] relative overflow-hidden shadow-2xl">
        <!-- Top Specular Highlight Edge -->
        <div class="absolute inset-x-0 top-0 h-[1.5px] bg-gradient-to-r from-transparent via-white/50 to-transparent pointer-events-none"></div>

        <div class="p-6 sm:p-10">
            <form id="editForm" action="{{ route('kurang-kirim.update', $kurangKirim) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Kode Toko -->
                <div>
                    <label for="toko_id" class="block text-sm font-medium text-white/80 mb-2">
                        Pilih Toko <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <select id="toko_id" name="toko_id" required class="w-full ios-input cursor-pointer">
                            <option value="">— Cari & Pilih Toko —</option>
                            @foreach($tokoList as $toko)
                                <option value="{{ $toko->id }}" {{ old('toko_id', $kurangKirim->toko_id) == $toko->id ? 'selected' : '' }}>
                                    {{ $toko->kode_toko }} — {{ $toko->nama_toko }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('toko_id')
                        <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Grid 2 Kolom: Tanggal & Nomor SJ -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Tanggal Kirim -->
                    <div>
                        <label for="tgl_kirim" class="block text-sm font-medium text-white/80 mb-2">
                            Tanggal Kirim <span class="text-rose-400">*</span>
                        </label>
                        <div class="relative">
                            <input type="date" id="tgl_kirim" name="tgl_kirim" value="{{ old('tgl_kirim', $kurangKirim->tgl_kirim ? $kurangKirim->tgl_kirim->format('Y-m-d') : '') }}" required
                                class="w-full ios-input px-4 py-3 text-sm text-white [color-scheme:dark]">
                        </div>
                        @error('tgl_kirim')
                            <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Surat Jalan -->
                    <div>
                        <label for="nomor_surat_jalan" class="block text-sm font-medium text-white/80 mb-2">
                            Nomor Surat Jalan <span class="text-rose-400">*</span>
                        </label>
                        <input type="text" id="nomor_surat_jalan" name="nomor_surat_jalan" value="{{ old('nomor_surat_jalan', $kurangKirim->nomor_surat_jalan) }}" required
                            class="w-full ios-input px-4 py-3 text-sm text-white placeholder-white/30 font-mono">
                        @error('nomor_surat_jalan')
                            <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- File Upload Edit Section -->
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">
                        Lampiran File
                    </label>
                    
                    @if($kurangKirim->lampiran)
                        <!-- Current File Display -->
                        <div class="ios-glass-card-subtle rounded-[20px] p-4 flex items-center gap-4 mb-4 border-emerald-500/30">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/20">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="text-[10px] font-semibold text-emerald-400 uppercase tracking-wider mb-0.5">Dokumen Saat Ini</div>
                                <p class="text-sm font-medium text-white truncate">{{ basename($kurangKirim->lampiran) }}</p>
                            </div>
                            <a href="{{ route('kurang-kirim.view', $kurangKirim) }}" target="_blank"
                               class="shrink-0 ios-btn-secondary rounded-xl px-3 py-1.5 text-xs font-semibold text-white">
                                Pratinjau
                            </a>
                        </div>
                    @endif

                    <!-- Change File Input -->
                    <div class="relative group">
                        <input type="file" id="lampiran" name="lampiran" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="ios-input border-dashed border-white/20 bg-white/[0.02] hover:bg-white/[0.05] p-4 rounded-2xl flex items-center gap-3 transition-colors">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white/70 group-hover:bg-blue-500/20 group-hover:text-blue-400 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-white group-hover:text-blue-400 transition-colors" id="filePlaceholder">
                                    Ganti lampiran dokumen...
                                </p>
                                <p class="text-xs text-white/40">Biarkan kosong jika tidak ingin mengubah lampiran.</p>
                            </div>
                        </div>
                    </div>
                    @error('lampiran')
                        <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Buttons -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-6 border-t border-white/10">
                    <button type="submit" class="flex-1 ios-btn-primary rounded-2xl py-3.5 px-6 font-semibold flex items-center justify-center gap-2 text-white shadow-lg">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('history') }}" class="sm:w-auto ios-btn-secondary rounded-2xl py-3.5 px-6 font-medium text-white/80 hover:text-white text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // TomSelect initialization
    if (document.getElementById('toko_id')) {
        new TomSelect('#toko_id', {
            create: false,
            placeholder: '— Cari & Pilih Toko —',
            maxOptions: 50,
        });
    }

    const fileInput = document.getElementById('lampiran');
    const filePlaceholder = document.getElementById('filePlaceholder');

    if (fileInput && filePlaceholder) {
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                filePlaceholder.textContent = `File dipilih: ${e.target.files[0].name}`;
                filePlaceholder.classList.add('text-blue-400');
            } else {
                filePlaceholder.textContent = 'Ganti lampiran dokumen...';
                filePlaceholder.classList.remove('text-blue-400');
            }
        });
    }
});
</script>
@endpush
