<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'UTS Pem Web' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-navbar />

    <main class="page-content">
        @if (session('success'))
            <div class="alert alert-success" role="status" aria-live="polite">
                <span>{{ session('success') }}</span>
                <button class="alert-close" type="button" aria-label="Tutup notifikasi" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error" role="alert" aria-live="assertive">
                <span>{{ session('error') }}</span>
                <button class="alert-close" type="button" aria-label="Tutup notifikasi" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        {{ $slot }}
    </main>

    <x-footer />
</body>
</html>
