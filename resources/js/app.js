import './bootstrap';

function toggleSidebar() {
    const sidebar = document.getElementById('sidebarMenu');
    const toggleBtn = document.getElementById('toggleBtn');

    // toggle sidebar aktif/nonaktif
    sidebar.classList.toggle('active');

    // sembunyikan tombol ☰ saat sidebar aktif
    if (sidebar.classList.contains('active')) {
        toggleBtn.classList.add('hidden');
    } else {
        toggleBtn.classList.remove('hidden');
    }
}

