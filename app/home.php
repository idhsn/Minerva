<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Acceuil</title>
    <link rel="stylesheet" href="../app/public/styles/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="annonce">
            <p>Your learning begins here - now with an exclusive discount ! <span> Hurry, offer ends soon</span></p>
        </div>
        <div class="navbar_container">
            <div class="logo_principale">
        <img src="../imgs/logo.png" alt="">
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="#" class="active">Acceuil</a></li>
                <li><a href="#">Classes</a></li>
                <li><a href="#">Courses</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <ul class="liste_droit">
                <li style="display: flex; justify-content: center; align-items: center;"><i class="fa-solid fa-user" style="color: #5ABDF1;"></i><a href="#" class="border_droit">Se Connecter</a></li>
                <li><a href="login.php"><i class="fa-solid fa-magnifying-glass"></i></a></li>
            </ul>
        </nav>
        </div>
    </header>
    <main>
        <div class="lignes"><img src="../imgs/lignes.png" alt=""></div>
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
            <div class="cercle_rouge"><img src="../imgs/logo_central.png" alt=""></div>
        </section>
    </main>
    <section class="fonctionnalites_principales">
        <div class="titre_section"><h1>Fonctionnalités Principales</h1></div>
        <div class="contenair_fonctionnalites">
            <div class="fonctionnalite">
            <div class="fontionnalite_entete">
                <i class="fa-solid fa-id-card"></i>
                <h3>Double Système d'Authentification</h3>
            </div>
            <div class="pas_contenair">
                <div class="pas">
                <div>
                    <p>1</p>
                    <h4><span>Enseignants:</span> Tableau de bord complet avec gestion de classe</h4>
                </div>
                <div>
                    <p>2</p>
                <h4><span>Étudiants:</span>Interface simplifiée pour suivre les cours et travaux</h4>
                </div>
            </div>
            <div class="auth_pas"><img src="../imgs/auth.png" alt=""></div>
            </div>
        </div>
        <div class="fonctionnalite" style="position: relative;">
            <div class="fontionnalite_entete">
                <i class="fa-regular fa-calendar"></i>
                <h3>Système de Travaux & Évaluations</h3>
            </div>
            <div class="pas_contenair">
                <div style="display: flex; justify-content: center; align-items: center;">
                    <div class="pas">
                <div>
                    <p>1</p>
                    <h4><span>Création de travaux: </span>Documents, leçons, exercices</h4>
                </div>
                <div>
                    <p>2</p>
                <h4><span>Assignation ciblée: </span>À des étudiants ou classes spécifiques</h4>
                </div>
            </div>
            <div class="pas">
                <div>
                    <p>3</p>
                    <h4><span>Évaluation: </span>Notation avec commentaires détaillés</h4>
                </div>
                <div style="z-index: 100;">
                    <p>4</p>
                <h4><span>Soumission: </span>Upload de fichiers et réponses en ligne</h4>
                </div>
            </div>
                </div>
            <div class="auth_pas" style="position: absolute; width: 120px; bottom: 0;right: 0;"><img src="../imgs/taches.png" alt=""></div>
            </div>
        </div>
        <div class="fonctionnalite">
            <div class="fontionnalite_entete">
                <i class="fa-solid fa-comments"></i>
                <h3>Communication en Temps Réel</h3>
            </div>
            <div class="pas_contenair">
                <div class="pas">
                <div>
                    <p>1</p>
                    <h4><span>Messagerie : </span> Chat de groupe par classe</h4>
                </div>
                <div>
                    <p>2</p>
                <h4><span>étudiant-enseignant : </span>Communication étudiant-enseignant</h4>
                </div>
            </div>
            <div class="auth_pas" style="width: 100px;"><img src="../imgs/chat-removebg-preview.png" alt=""></div>
            </div>
        </div>
        <div class="fonctionnalite">
            <div class="fontionnalite_entete">
                <i class="fa-solid fa-clipboard-list"></i>
                <h3>Tableaux de Bord Intelligents</h3>
            </div>
            <div class="pas_contenair">
                <div class="pas">
                <div>
                    <p>1</p>
                    <h4><span>Enseignants:</span> Tableau de bord complet avec gestion de classe</h4>
                </div>
                <div>
                    <p>2</p>
                <h4><span>Étudiants:</span>Interface simplifiée pour suivre les cours et travaux</h4>
                </div>
            </div>
            <div class="auth_pas"><img src="../imgs/stat.png" alt=""></div>
            </div>
        </div>
        </div>
    </section>
    <section>
        <div class="titre_contenair">
        <div class="titre_section titre_gauche"><h1>Les Cours Populaires</h1></div>
        <div><a href="#">Voir Tout</a></div>
        </div>
        <div class="cours_populaires">
            <div class="cours">
                <div class="cours_btns">
                    <p>Développement</p>
                    <i class="fa-regular fa-heart"></i>
                </div>
                <div>
                    <h3>La structure MVC, Comment bien organiser votre code pour travailler collectivement</h3>
                    <div class="sciences_btns">
                        <i class="fa-solid fa-file-lines"></i>
                        <p>14 Sciences</p>
                    </div>
                    <div class="cours_footer">
                        <p>Gratuit</p>
                        <p>View Details</p>
                    </div>
                </div>
            </div>
            <div class="cours">
                <div class="cours_btns">
                    <p>Développement</p>
                    <i class="fa-regular fa-heart"></i>
                </div>
                <div>
                    <h3>La structure MVC, Comment bien organiser votre code pour travailler collectivement</h3>
                    <div class="sciences_btns">
                        <i class="fa-solid fa-file-lines"></i>
                        <p>14 Sciences</p>
                    </div>
                    <div class="cours_footer">
                        <p>Gratuit</p>
                        <p>View Details</p>
                    </div>
                </div>
            </div>
            <div class="cours">
                <div class="cours_btns">
                    <p>Développement</p>
                    <i class="fa-regular fa-heart"></i>
                </div>
                <div>
                    <h3>La structure MVC, Comment bien organiser votre code pour travailler collectivement</h3>
                    <div class="sciences_btns">
                        <i class="fa-solid fa-file-lines"></i>
                        <p>14 Sciences</p>
                    </div>
                    <div class="cours_footer">
                        <p>Gratuit</p>
                        <p>View Details</p>
                    </div>
                </div>
            </div>
            <div class="cours">
                <div class="cours_btns">
                    <p>Développement</p>
                    <i class="fa-regular fa-heart"></i>
                </div>
                <div>
                    <h3>La structure MVC, Comment bien organiser votre code pour travailler collectivement</h3>
                    <div class="sciences_btns">
                        <i class="fa-solid fa-file-lines"></i>
                        <p>14 Sciences</p>
                    </div>
                    <div class="cours_footer">
                        <p>Gratuit</p>
                        <p>View Details</p>
                    </div>
                </div>
            </div>
            <div class="cours">
                <div class="cours_btns">
                    <p>Développement</p>
                    <i class="fa-regular fa-heart"></i>
                </div>
                <div>
                    <h3>La structure MVC, Comment bien organiser votre code pour travailler collectivement</h3>
                    <div class="sciences_btns">
                        <i class="fa-solid fa-file-lines"></i>
                        <p>14 Sciences</p>
                    </div>
                    <div class="cours_footer">
                        <p>Gratuit</p>
                        <p>View Details</p>
                    </div>
                </div>
            </div>
            <div class="cours">
                <div class="cours_btns">
                    <p>Développement</p>
                    <i class="fa-regular fa-heart"></i>
                </div>
                <div>
                    <h3>La structure MVC, Comment bien organiser votre code pour travailler collectivement</h3>
                    <div class="sciences_btns">
                        <i class="fa-solid fa-file-lines"></i>
                        <p>14 Sciences</p>
                    </div>
                    <div class="cours_footer">
                        <p>Gratuit</p>
                        <p>View Details</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section_contact" id="contact_section">
        <div class="titre_section" style="justify-content: center;"><h1>Nous Contacter</h1></div>
        <div class="form_contenair">
            <form action="#">
            <p>Nous sommes toujours heureux de recevoir vos messages</p>
            <div><input type="text" placeholder="Votre nom ex : mouad mouad"></div>
            <div><select name="" id="">
                <option value="Cours">Cours</option>
                <option value="Cours">Cours</option>
                <option value="Cours">Cours</option>
            </select></div>
            <div><textarea name="" id="" placeholder="Votre Message"></textarea></div>
            <div><input type="submit" value="Envoyer"></div>
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