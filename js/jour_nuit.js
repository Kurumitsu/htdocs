document.addEventListener('DOMContentLoaded', function() {   
   const btnTheme = document.getElementById('toggle-theme');
    btnTheme.addEventListener('click', function() {
        document.body.classList.toggle('nuit');
        btnTheme.textContent = document.body.classList.contains('nuit') ? 'Mode jour' : 'Mode nuit';
    });
});