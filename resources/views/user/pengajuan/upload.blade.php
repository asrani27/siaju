@extends('layouts.master')

@section('title', 'Upload Persyaratan - ' . $pengajuan->nomor_pengajuan)
@section('header_title', 'Upload Persyaratan')
@section('header_subtitle', $pengajuan->nomor_pengajuan)

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm">
        <a href="{{ route('user.dashboard') }}"
            class="text-text-muted hover:text-primary transition-colors">Dashboard</a>
        <span class="text-text-muted">/</span>
        <a href="{{ route('user.pengajuan.show', $pengajuan) }}"
            class="text-text-muted hover:text-primary transition-colors">{{ $pengajuan->nomor_pengajuan }}</a>
        <span class="text-text-muted">/</span>
        <span class="text-text">Upload Persyaratan</span>
    </nav>

    <!-- Alert -->
    <div class="bg-warning/10 border border-warning/20 rounded-xl p-4 flex items-start gap-3">
        <svg class="w-5 h-5 text-warning flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
        </svg>
        <div>
            <p class="text-sm font-medium text-warning">Pengajuan ini memerlukan revisi</p>
            <p class="text-xs text-text-muted mt-1">Silakan upload ulang dokumen persyaratan sesuai catatan dari admin.
            </p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-card overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h5 class="font-heading font-bold text-lg text-text">Upload Dokumen Persyaratan</h5>
            <p class="text-sm text-text-muted mt-1">Lengkapi dokumen yang diperlukan untuk melanjutkan proses pengajuan.
            </p>
        </div>

        <form action="{{ route('user.pengajuan.upload.store', $pengajuan) }}" method="POST"
            enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Per-Persyaratan Upload Section -->
            @if($persyaratans->count() > 0)
            <div class="space-y-4">
                <h6 class="font-semibold text-sm text-text">Dokumen yang Diperlukan:</h6>

                @foreach($persyaratans as $persyaratan)
                @php
                $existingFiles = $uploadedFiles->get($persyaratan->id) ?? collect();
                @endphp
                <div class="bg-surface rounded-xl p-4 border border-gray-100"
                    data-persyaratan-id="{{ $persyaratan->id }}">
                    <!-- Header -->
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            <div>
                                <h6 class="font-medium text-sm text-text">{{ $persyaratan->nama }}</h6>
                                @if($persyaratan->deskripsi)
                                <p class="text-xs text-text-muted mt-0.5">{{ $persyaratan->deskripsi }}</p>
                                @endif
                                <p class="text-xs text-text-muted mt-1">Format: PDF, JPG, PNG - Max 5MB</p>
                            </div>
                        </div>
                        @if($existingFiles->count() > 0)
                        <span
                            class="inline-flex items-center gap-1 px-2 py-1 bg-success/10 text-success text-xs font-medium rounded-lg">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            Uploaded
                        </span>
                        @endif
                    </div>

                    <!-- Existing Files -->
                    @if($existingFiles->count() > 0)
                    <div class="mb-3 space-y-2">
                        @foreach($existingFiles as $file)
                        <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-100">
                            <div class="flex items-center gap-3">
                                @if($file->isPdf())
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </div>
                                @else
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                </div>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-text">{{ $file->nama_file }}</p>
                                    <p class="text-xs text-text-muted">{{ $file->formatted_size }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ $file->url }}" target="_blank"
                                    class="p-2 text-text-muted hover:text-primary transition-colors" title="Lihat File">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Upload Area -->
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-primary/50 transition-colors cursor-pointer bg-white"
                        id="dropzone-{{ $persyaratan->id }}" data-persyaratan-id="{{ $persyaratan->id }}">
                        <input type="file" name="files[{{ $persyaratan->id }}]" id="file_input_{{ $persyaratan->id }}"
                            class="hidden" accept=".pdf,.jpg,.jpeg,.png">
                        <svg class="w-8 h-8 text-text-muted mx-auto mb-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                        </svg>
                        <p class="text-xs text-text-muted">
                            @if($existingFiles->count() > 0)
                            Klik untuk ganti file
                            @else
                            Klik untuk upload file
                            @endif
                        </p>
                    </div>

                    <!-- File Preview -->
                    <div id="file_preview_{{ $persyaratan->id }}" class="mt-3"></div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <svg class="w-12 h-12 text-text-muted mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <p class="text-sm text-text-muted">Tidak ada dokumen persyaratan untuk layanan ini.</p>
            </div>
            @endif

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('user.pengajuan.show', $pengajuan) }}"
                    class="px-6 py-3 text-sm font-medium text-text-muted hover:text-text transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-3 bg-gray-100 text-text text-sm font-semibold rounded-xl hover:bg-gray-200 transition-colors">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Get all dropzones
    const dropzones = document.querySelectorAll('[id^="dropzone-"]');
    
    dropzones.forEach(dropzone => {
        const persyaratanId = dropzone.dataset.persyaratanId;
        const fileInput = document.getElementById(`file_input_${persyaratanId}`);
        const filePreview = document.getElementById(`file_preview_${persyaratanId}`);
        
        if (!fileInput) return;
        
        // Click to upload
        dropzone.addEventListener('click', () => fileInput.click());
        
        // Drag events
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('border-primary', 'bg-primary/5');
        });
        
        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('border-primary', 'bg-primary/5');
        });
        
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-primary', 'bg-primary/5');
            if (e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
                showFilePreview(persyaratanId, fileInput.files[0], filePreview);
            }
        });
        
        // File input change
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                showFilePreview(persyaratanId, fileInput.files[0], filePreview);
            }
        });
    });
    
    function showFilePreview(persyaratanId, file, previewContainer) {
        const isPdf = file.type === 'application/pdf';
        const iconBg = isPdf ? 'bg-red-100' : 'bg-blue-100';
        const iconColor = isPdf ? 'text-red-600' : 'text-blue-600';
        const icon = isPdf 
            ? `<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />`
            : `<path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />`;
        
        const fileSize = (file.size / (1024 * 1024)).toFixed(2);
        
        previewContainer.innerHTML = `
            <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-success/30">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 ${iconBg} rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 ${iconColor}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            ${icon}
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-text">${file.name}</p>
                        <p class="text-xs text-text-muted">${fileSize} MB</p>
                    </div>
                </div>
                <span class="px-2 py-1 bg-warning/10 text-warning text-xs font-medium rounded-lg">
                    Pending Upload
                </span>
            </div>
        `;
    }
});
</script>
@endpush
@endsection