document.addEventListener('DOMContentLoaded', function() {
    // gestion du modal
    const modal = document.getElementById('conditions-modal'); // récupère la balise ayant pour id 'conditions-modal'
    const openModalBtn = document.getElementById('open-modal'); // récupère la balise ayant pour id 'open-modal'
    const closeModalBtn = document.querySelector('.close'); // récupère la balise ayant pour id 'close'
    if (openModalBtn) {
        openModalBtn.addEventListener('click', function(e) { // si la balise ayant pour id 'open-modal' est cliqué
            // on affiche le modal
            e.preventDefault();
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
    }
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function() { // si la balise ayant pour id 'close' est cliqué
            // on cache le modal
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    }
    window.addEventListener('click', function(e) {
        if (e.target === modal) { // si on clique à l'exterieur du modal
            // on cache le modal
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });
    // gestion du menu sur petit écran
    const menuToggle = document.querySelector('.menu-toggle');
    const menu = document.querySelector('.menu');
    menuToggle.addEventListener('click', function() {
        menu.classList.toggle('active');
        const icon = menuToggle.querySelector('i');
        if (menu.classList.contains('active')) {
            icon.className = 'fas fa-times';
            menuToggle.setAttribute('aria-expanded', 'true');
        } else {
            icon.className = 'fas fa-bars';
            menuToggle.setAttribute('aria-expanded', 'false');
        }
    });
    // fermer menu si clic en dehors
    document.addEventListener('click', function(e) {
        if (!menu.contains(e.target) && !menuToggle.contains(e.target)) {
            menu.classList.remove('active');
            menuToggle.querySelector('i').className = 'fas fa-bars';
            menuToggle.setAttribute('aria-expanded', 'false');
        }
    });
    const alerts = document.querySelectorAll('.alert'); // on récupère tous les éléments ayant pour classe 'alert'
    alerts.forEach(alert => { // pour chaque élément
        setTimeout(() => { 
            // on défini un temps de 3s d'affichage de la notification puis 5s ou elle est transparente avant d'être retiré
            alert.style.opacity = '0';
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 300);
        }, 5000);
    });
});