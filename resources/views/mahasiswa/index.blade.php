<x-layout title="Daftar Mahasiswa | UTS Pem Web">
    <section class="student-page" aria-labelledby="student-heading">
        <div class="student-heading-row">
            <div>
                <p class="student-eyebrow">UTS Pemrograman Web</p>
                <h1 id="student-heading">Daftar Mahasiswa</h1>
                <p class="student-intro">Kelola biodata mahasiswa dalam satu tempat.</p>
            </div>
            <a class="add-student-button" href="{{ route('mahasiswa.create') }}">+ <span>Tambah Mahasiswa</span></a>
        </div>

        @if ($mahasiswas->isEmpty())
            <div class="student-empty-state">
                <div class="empty-icon" aria-hidden="true">+</div>
                <h2>Belum ada data mahasiswa</h2>
                <p>Tambahkan data pertama untuk mulai mengisi daftar mahasiswa.</p>
                <a class="add-student-button" href="{{ route('mahasiswa.create') }}">Tambah Mahasiswa</a>
            </div>
        @else
            <div class="student-grid">
                @foreach ($mahasiswas as $mahasiswa)
                    <article class="student-card">
                        <div class="student-photo-wrap">
                            @if ($mahasiswa->foto_path)
                                <img class="student-photo" src="{{ \Illuminate\Support\Str::startsWith($mahasiswa->foto_path, ['http://', 'https://']) ? $mahasiswa->foto_path : asset('storage/' . $mahasiswa->foto_path) }}" alt="Foto {{ $mahasiswa->nama }}" loading="lazy">
                            @else
                                <div class="student-photo-placeholder" aria-label="Foto belum tersedia">
                                    <svg viewBox="0 0 48 48" aria-hidden="true"><circle cx="24" cy="17" r="9"/><path d="M7 42c1-9 7-14 17-14s16 5 17 14"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="student-card-body">
                            <h2>{{ $mahasiswa->nama }}</h2>
                            <p class="student-nim">NIM: {{ $mahasiswa->nim }}</p>
                            <p class="student-description">{{ $mahasiswa->deskripsi }}</p>
                            <div class="student-actions">
                                <a class="student-edit-button" href="{{ route('mahasiswa.edit', $mahasiswa) }}">Edit</a>
                                <form action="{{ route('mahasiswa.destroy', $mahasiswa) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data {{ addslashes($mahasiswa->nama) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="student-delete-button" type="submit">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach

                <a class="student-add-card" href="{{ route('mahasiswa.create') }}" aria-label="Tambah mahasiswa">
                    <span class="student-add-circle" aria-hidden="true">+</span>
                    <span>Tambah Mahasiswa</span>
                </a>
            </div>
        @endif
    </section>
</x-layout>
