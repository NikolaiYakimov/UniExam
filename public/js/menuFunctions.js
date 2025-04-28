// Мобилно меню
const menuToggle = document.getElementById('menuToggle');
const sidebar = document.getElementById('sidebar');

menuToggle.addEventListener('click', (e) => {
    e.stopPropagation();
    sidebar.classList.toggle('left-0');
    sidebar.classList.toggle('left-[-100%]');
});

// Close the menu when we click outside of it
document.addEventListener('click', (e) => {
    if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
        sidebar.classList.remove('left-0');
        sidebar.classList.add('left-[-100%]');
    }
});

//Close when we reach the dekstop size
window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024) {
        sidebar.classList.remove('left-0');
        sidebar.classList.add('left-[-100%]');
    }
});
