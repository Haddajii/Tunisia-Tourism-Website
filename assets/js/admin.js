const sideMenu = document.querySelector('aside');
const menuBtn = document.getElementById('menu-btn');
const closeBtn = document.getElementById('close-btn');

const darkMode = document.querySelector('.dark-mode');


document.addEventListener('DOMContentLoaded', () => {
    const sidebarLinks = document.querySelectorAll('.sidebar a');

    const defaultActiveLink = document.querySelector('.sidebar a.active');
    if (!defaultActiveLink) {
        sidebarLinks[0].classList.add('active');
    }

    sidebarLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            
            sidebarLinks.forEach(l => {
                l.classList.remove('active');
            });

            
            link.classList.add('active');
        });
    });
});

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
});

darkMode.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode-variables');
    darkMode.querySelector('span:nth-child(1)').classList.toggle('active');
    darkMode.querySelector('span:nth-child(2)').classList.toggle('active');
})


