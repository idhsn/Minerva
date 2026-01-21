<?php
    require __DIR__ . '/../partiels/header.php'

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Acceuil</title>
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    
    <main>
        <div class="lignes"><img src="/../../../imgs/lignes.png" alt=""></div>
        <section class="section_titres">
            <div class="sous_titre1">
            <i class="fa-solid fa-bahai" style="color: #FFD43B;"></i>

            <h4>Votre salle de classe numérique intelligente</h4>
            </div>
            <h1>plateforme de gestion académique pour enseignants et étudiants</h1>
            <p class="animation_flechs">>>>>></p>
            <div><a href="nvCompte.php" class="nv_compte">Commencer</a></div>
        </section>
        <section class="section_imgs">
            <div class="cercle_blue"></div>
            <div class="cercle_rouge"><img src="../../imgs/logo_central.png" alt=""></div>
        </section>
    </main>
    <section class="fonctionnalites_principales">
        <div class="titre_section"><h1>Minerva</h1></div>
        <div class="video_contenaire">
            <div class="videos_titres">
                <h1>Réinventez l'apprentissage avec une solution complète de gestion de classe, de suivi étudiant et de collaboration en temps réel.</h1>
                <p>Dans le monde éducatif d'aujourd'hui, les enseignants jonglent entre de multiples outils : un système pour les notes, un autre pour les présences, un pour partager des documents... C'est chronophage et inefficace. Les étudiants, eux, se perdent entre différentes plateformes sans avoir une vue unifiée de leur progression.</p>
            </div>
            <div class="video">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/IG-HAppi0hs?si=lmVQXdvhYGjqXTpn" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
    </section>
    <section class="section_contact">
        <div class="titre_section" style="justify-content: center;"><h1>Se Connecter</h1></div>
        <div class="form_contenair">
            <form action="#" style="min-height: 400px;">
            <p>Veuillez saisir vos informations afin de se connecter</p>
            <div><input type="text" placeholder="Votre nom ex : mouad mouad"></div>
            <div><input type="text" placeholder="Votre mot de passe"></div>
            <div><input type="submit" value="Connexion"></div>
        </form>
        </div>
    </section>
    <footer>
        <div class="first_part">
            <h3>Minerva</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe, vel! Iure odio ab ut fugit?</p>
            <div >
                <i class="fa-brands fa-facebook" style="color: #5ABDF1;"></i>
                <i class="fa-brands fa-linkedin"></i>
                <i class="fa-brands fa-github"></i>
            </div>
        </div>
        <div class="second_part">
            <h3>Servives</h3>
            <p>Lorem ipsum </p>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum </p>
            <p>Lorem ipsum </p>
        </div>
        <div class="third_part">
            <h3>Servives</h3>
            <p>Lorem ipsum </p>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum </p>
            <p>Lorem ipsum </p>
        </div>
        <div class="fourth_part">
            <h3>Stay Updated</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe, vel! Iure odio ab ut fugit?</p>
            <div><input type="text" placeholder="Votre Email"></div>
            <div><input type="submit" value="Abbonez-Vous"></div>
        </div>
    </footer>
</body>
</html>