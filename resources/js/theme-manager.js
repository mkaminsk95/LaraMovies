function applyTheme(theme) {
    let html = document.documentElement;
    html.classList.toggle('dark', theme === 'dark');
    html.classList.toggle('light', theme === 'light');
    localStorage.setItem('theme', theme);
}

let themeBtns = document.getElementsByClassName('theme-manager-btn');

for (let i = 0; i < themeBtns.length; i++) {
    themeBtns[i].addEventListener('click', () => {
        applyTheme(document.documentElement.classList.contains('dark') ? 'light' : 'dark');
    });
}
