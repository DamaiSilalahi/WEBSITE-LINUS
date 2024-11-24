const toggleSwitch = document.getElementById('darkModeToggle');
const sunIcon = document.querySelector(',sun-icon');
const moonIcon = document.querySelector('.moon-icon');

if (localStorage.getItem('darkmode') === 'enabled' ){
    document.body.classList.add('dark-mode');
    toggleSwitch.checked = true;
    sunIcon.style.display = 'none';
    moonIcon.style.display = 'block';
} else {
    sunIcon.style.display = 'block';
    moonIcon.style.display = 'none';
}

toggleSwitch.addEventListener('change', () => {
    document.body.classList,toggle('dark-mode');

    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('darkMode', 'enabled');
        sunIcon.style.display = 'none';
        moonIcon.style.display = 'block';
    } else {
        localStorage.removeItem('darkMode');
        sunIcon.style.display = 'block';
        moonIcon.style.display = 'none';
    }
})