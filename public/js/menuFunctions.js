document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const menuContainer = document.getElementById('menuContainer');

    menuToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        const isOpen = sidebar.style.left === '0px';

        if(isOpen) {
            sidebar.style.left = '-288px';
            menuContainer.classList.remove('hidden');
        } else {
            sidebar.style.left = '0';
            menuContainer.classList.add('hidden');
        }
    });

    document.addEventListener('click', function(e) {
        if(window.innerWidth < 1024 && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
            sidebar.style.left = '-100%';
            menuContainer.classList.remove('hidden');
        }
    });

    window.addEventListener('resize', function() {
        if(window.innerWidth >= 1024) {
            sidebar.style.left = '0';
        } else {
            sidebar.style.left = '-100%';
            menuContainer.classList.remove('hidden');
        }
    });
});
