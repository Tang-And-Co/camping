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
    const menuToggle = document.createElement('button'); // on créé un boutton
    menuToggle.className = 'menu-toggle'; // on lui assigne une classe
    menuToggle.innerHTML = '<i class="fas fa-bars"></i>'; // on insère du html pour faire les 3 traits
    menuToggle.setAttribute('aria-label', 'Menu'); // on lui donne des attributs
    const menu = document.querySelector('.menu'); // on récupère le boutton ayant pour classe menu
    if (menu) {
        menu.parentNode.insertBefore(menuToggle, menu); // on insert le boutton ayant pour classe menu avant le boutton que l'on a créé
        menuToggle.addEventListener('click', function() { // si le boutton que l'on a créé est cliqué
            menu.classList.toggle('active'); // on ouvre le menu
            const icon = menuToggle.querySelector('i'); // on récupère l'icone des 3 traits du menu
            if (menu.classList.contains('active')) { // si le menu est ouvert
                icon.className = 'fas fa-times'; // on change l'icone par une croix
                menuToggle.setAttribute('aria-expanded', 'true'); // on modifie l'attribut aria-expanded en valeur true
            } else { // si le menu est fermé
                icon.className = 'fas fa-bars'; // on change l'icone par les 3 barres
                menuToggle.setAttribute('aria-expanded', 'false'); // on modifie l'attribut aria-expanded en valeur false
            }
        });
        menu.querySelectorAll('a').forEach(link => { // pour tous les liens du menu
            link.addEventListener('click', () => { // si l'on clique dessus
                // on cache le menu et on remet l'icone des 3 barres
                menu.classList.remove('active');
                menuToggle.querySelector('i').className = 'fas fa-bars';
                menuToggle.setAttribute('aria-expanded', 'false');
            });
        });
        document.addEventListener('click', function(e) {
            if (!menu.contains(e.target) && !menuToggle.contains(e.target)) { // si on clique ailleur que dans un des choix du menu
                // on cache le menu et on remet l'icone des 3 barres
                menu.classList.remove('active');
                menuToggle.querySelector('i').className = 'fas fa-bars';
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }
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