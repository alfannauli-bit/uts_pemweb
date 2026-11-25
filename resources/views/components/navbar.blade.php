<header class="site-header">
    <nav class="navbar" aria-label="Navigasi utama">
        <a class="brand" href="{{ url('/') }}">UTS Pem Web</a>

        <button class="nav-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="primary-menu" onclick="const menu=document.getElementById('primary-menu'); const open=this.getAttribute('aria-expanded')==='true'; this.setAttribute('aria-expanded',String(!open)); menu.classList.toggle('is-open',!open)">
            <span></span><span></span><span></span>
        </button>

        <div class="nav-content" id="primary-menu">
            <div class="nav-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/#features') }}">Features</a>
            </div>
            <div class="nav-identity">
                <span class="identity-name">Nama Mahasiswa</span>
                <span class="identity-nim">NIM: 000000000</span>
            </div>
        </div>
    </nav>
</header>
