<?php include "integration/en-tete.php"; ?>
<?php
?>
<div class="accueil-container">
    <div class="video-wrapper">
        <iframe
            src="https://www.youtube-nocookie.com/embed/naAG7Oq96HY?autoplay=1&mute=1&controls=0&disablekb=1&modestbranding=1&playsinline=1&loop=1&playlist=naAG7Oq96HY"
            frameborder="0"
            allow="autoplay; encrypted-media">
        </iframe>
    </div>
    <div class="informations">
        <div class="card">
            <div class="img">
                <img src="<?= Database::query("SELECT url FROM image WHERE nom = 'tente1'")[0]["url"] ?>" alt="tente">
                <img src="<?= Database::query("SELECT url FROM image WHERE nom = 'camping-car1'")[0]["url"] ?>" alt="camping car">
                <img src="<?= Database::query("SELECT url FROM image WHERE nom = 'bungalow1'")[0]["url"] ?>" alt="bungalow">
            </div>
            <div class="content">
                <h1>42 emplacements disponibles</h1>
                <ul>
                    <li><i class="fa-solid fa-campground"></i> 22 réservés aux tentes</li>
                    <li><i class="fa-solid fa-caravan"></i> 8 réservés au camping-car et caravanes</li>
                    <li><i class="fa-solid fa-house-chimney-window"></i> 12 bungalow tout confort</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="history">
        <div class="card">
            <div class="content">
                <h1>L'histoire du camping</h1>
                <p>
                    Né d'un amour profond pour le Bassin d'Arcachon et ses paysages préservés, 
                    le camping <strong>Tentations Côtières</strong> a vu le jour au début des années 1980, 
                    à l'initiative d'une famille locale attachée à l'art de vivre du littoral. 
                    Situé au <strong>17 Avenue Louis Gaume, à La Teste-de-Buch</strong>, le site était à l'origine 
                    un terrain arboré où se retrouvaient pêcheurs, voyageurs et amoureux de la nature
                    en quête de simplicité et de calme.
                </p>
                <p>
                    Au fil des années, le camping s'est développé avec une ambition claire : 
                    offrir un lieu de séjour authentique, respectueux de l'environnement, 
                    tout en répondant aux attentes modernes des vacanciers. Des premiers emplacements 
                    pour tentes aux bungalows tout confort d'aujourd'hui, chaque évolution a été pensée 
                    pour préserver l'esprit convivial et familial qui fait l'identité de <strong>Tentations Côtières</strong>.
                </p>
                <p>
                    Idéalement situé entre forêt, océan et bassin, le camping est devenu un point
                    de départ privilégié pour découvrir les plages océanes, les ports ostréicoles
                    et les sentiers emblématiques de la région. Générations après générations,
                    il a su conserver son âme : celle d'un lieu où l'on prend le temps, où l'on partage,
                    et où chaque séjour devient un souvenir.
                </p>
                <p>
                    Aujourd'hui encore, <strong>Tentations Côtières</strong> continue d'accueillir ses visiteurs avec
                    la même philosophie : proposer une expérience sincère, chaleureuse et tournée vers 
                    la nature, dans un cadre paisible au cœur de La Teste-de-Buch.
                </p>
            </div>
        </div>
    </div>
    <div class="proprio">
        <div class="card">
            <div class="img">
                <img src="<?= Database::query("SELECT url FROM image WHERE nom = 'gerante'")[0]["url"] ?>" alt="gérante du camping">
            </div>
            <div class="content">
                <h1>Le mot de la gérante</h1>
                <p class="no-indent">
                    Je m'appelle Élise Moreau, et à 25 ans, j'ai le plaisir de diriger
                    le camping Tentations Côtières, un lieu qui me tient profondément à cœur.
                </p>
                <p>
                    Originaire de la région, j'ai grandi entre l'odeur des pins, les marées du Bassin 
                    et les longues soirées d'été passées à accueillir des voyageurs de tous horizons. 
                    Très tôt, j'ai su que je voulais travailler dans un endroit vivant, humain, où 
                    chaque rencontre compte. Après des études en gestion touristique et plusieurs 
                    expériences dans l'hôtellerie de plein air, j'ai naturellement choisi de revenir ici, 
                    à La Teste-de-Buch, pour poursuivre et faire évoluer cette belle aventure.
                </p>
                <p>
                    Mon ambition est simple : préserver l'authenticité et la convivialité qui font 
                    l'âme de Tentations Côtières, tout en y apportant une énergie nouvelle et des 
                    services pensés pour le confort de chacun. Chaque détail du camping est réfléchi 
                    pour que vous vous sentiez chez vous, dans un cadre naturel respecté et apaisant.
                </p>
                <p>
                    Je suis ravie de vous accueillir et de partager avec vous ce lieu que j'aime tant. 
                    J'espère que votre séjour sera synonyme de détente, de découvertes et de beaux souvenirs.
                </p>
                <p class="no-indent">
                    Au plaisir de vous rencontrer,<br>
                    <span class="signature">Élise MOREAU</span>
                </p>
                <p class="no-indent">
                    Gérante du camping Tentations Côtières
                    <span class="logo-sign">
                        <img src="<?= Database::query("SELECT url FROM image WHERE nom = 'logo'")[0]["url"] ?>" alt="Logo">
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>
<?php include "integration/pieds-page.html"; ?>