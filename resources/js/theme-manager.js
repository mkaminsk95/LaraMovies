/* A simple js file for managing the desired layout theme. */

/* Apply a theme to the document & save the preference to local storage. */
function applyTheme(theme) {
    let html = document.documentElement;
    html.classList.toggle('dark', theme === 'dark');
    html.classList.toggle('light', theme === 'light');
    localStorage.setItem('theme', theme);
}

/* listen for the page load & apply the saved theme if it exists. */
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'light';
    applyTheme(savedTheme);
    document.body.style.display = '';
});


/* add event listeners for each theme manager button */
let themeBtns = document.getElementsByClassName('theme-manager-btn');

for (let i = 0; i < themeBtns.length; i++) {
    themeBtns[i].addEventListener('click', () => {
        applyTheme(document.documentElement.classList.contains('dark') ? 'light' : 'dark');
    });
}
