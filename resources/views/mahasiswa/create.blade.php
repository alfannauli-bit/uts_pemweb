<x-layout title="Tambah Mahasiswa | UTS Pem Web">
    <section class="student-form-page">
        <div class="student-form-heading">
            <a class="form-back-link" href="{{ route('mahasiswa.index') }}">&larr; Kembali ke daftar</a>
            <p class="student-eyebrow">Biodata mahasiswa</p>
            <h1>Tambah Mahasiswa</h1>
            <p class="student-intro">Lengkapi informasi mahasiswa di bawah ini.</p>
        </div>

        <form class="student-form" action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-field">
                <label for="nama">Nama mahasiswa</label>
                <input id="nama" name="nama" type="text" value="{{ old('nama') }}" required maxlength="255" autocomplete="name" aria-describedby="nama-error" class="{{ $errors->has('nama') ? 'is-invalid' : '' }}">
                @error('nama')<p class="field-error" id="nama-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-field">
                <label for="nim">NIM</label>
                <input id="nim" name="nim" type="text" value="{{ old('nim') }}" required maxlength="255" aria-describedby="nim-error" class="{{ $errors->has('nim') ? 'is-invalid' : '' }}">
                @error('nim')<p class="field-error" id="nim-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-field">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="5" required aria-describedby="deskripsi-error" class="{{ $errors->has('deskripsi') ? 'is-invalid' : '' }}">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')<p class="field-error" id="deskripsi-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-field">
                <label for="foto">Foto mahasiswa <span class="field-hint">(JPG, JPEG, PNG, WEBP; maksimal 2 MB)</span></label>
                <input id="foto" name="foto" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" aria-describedby="foto-help foto-error" class="file-input {{ $errors->has('foto') ? 'is-invalid' : '' }}">
                <p class="field-help" id="foto-help">Foto bersifat opsional.</p>
                @error('foto')<p class="field-error" id="foto-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-actions">
                <a class="form-cancel-button" href="{{ route('mahasiswa.index') }}">Batal</a>
                <button class="form-submit-button" type="submit">Simpan Mahasiswa</button>
            </div>
        </form>
    </section>
</x-layout>
