document.addEventListener('DOMContentLoaded', function() {
    const filtreLieu = document.getElementById('filtre-lieu');
    const cartes = document.querySelectorAll('.carte-monstre');

    filtreLieu.addEventListener('change', function() {
        const val = this.value;
        cartes.forEach(carte => {
            carte.style.display = (!val || carte.dataset.lieu === val) ? '' : 'none';
        });
    });
});