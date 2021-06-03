<?php
session_start();
if (!isset($_SESSION['user_uniqueid_USERS'])) {
    header("Location: login.php");
}
?>
<?php
/*connection à BDD*/
include "configPDO.php";

/*toute les infos du user connecté*/
$requser = $bdd->prepare('SELECT * FROM users WHERE user_uniqueid_USERS = ?');
$requser->execute(array($_SESSION['user_uniqueid_USERS']));
$userinfo = $requser->fetch();

if(isset($_POST['comfirmer'])){
    $getid = intval($_SESSION['user_uniqueid_USERS']);
    $newmdp = sha1($_POST['newmdp']);
    $newmdp2 = sha1($_POST['newmdp2']);
    if(!empty($_POST['mdp']) AND !empty($_POST['newmdp'])  AND !empty($_POST['newmdp2'])){
        if ($newmdp == $newmdp2) {
            $ran_id = rand(time(), 100000000);
            $reqUser = $bdd->prepare("UPDATE users SET user_password_USERS='$newmdp2' WHERE user_uniqueid_USERS = '$getid'");
            $reqUser->execute(array($newmdp2));
            header("Location: home.php?user_uniqueid_USERS=".$_SESSION['user_uniqueid_USERS']);
        } else {
            $erreur = "Votre nouveau mot de passe n'a pas été confirmé";
        }
    } else {
        $erreur = "Tous les champs sont obligatoires";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CollabyU | Paramètres</title>

    <meta name="description"
          content="Bienvenue sur l'application web CollabyU, un projet d'équipe réalisé dans un cadre pédagogique qui permet la mise en relation de passionnés de la musique.">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/png" sizes="32x32" href="img/logo_flat.svg">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo_flat.svg">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/504485e57a.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/setting.css">
</head>
<body>
<div class="loader">
    <svg class="logoloader" xmlns="http://www.w3.org/2000/svg" width="106" height="109" viewBox="0 0 106 109">
        <g id="logo_svg" data-name="logo svg" transform="translate(-246 -597)">
            <path class="vert" id="vert"
                  d="M17,0H35A17,17,0,0,1,52,17v0A17,17,0,0,1,35,34H0a0,0,0,0,1,0,0V17A17,17,0,0,1,17,0Z"
                  transform="translate(300 597)" fill="#009380"/>
            <path class="rose" id="rose"
                  d="M21,0H63a0,0,0,0,1,0,0V21A21,21,0,0,1,42,42H21A21,21,0,0,1,0,21v0A21,21,0,0,1,21,0Z"
                  transform="translate(246 664)" fill="#ec1d53"/>
            <path id="blanc" d="M3,0H9A0,0,0,0,1,9,0V22a3,3,0,0,1-3,3H0a0,0,0,0,1,0,0V3A3,3,0,0,1,3,0Z"
                  transform="translate(300 635)" fill="#f2f2f2"/>
        </g>
    </svg>
</div>
<header>
    <div class="nav">
        <a href="home.php?user_uniqueid_USERS=<?php echo $_SESSION['user_uniqueid_USERS']; ?>" rel="noopener"
           class="logo">
            <img src="img/logo%20collabyU.svg" alt="Logo CollabyU">
            <h1>CollabyU</h1>
        </a>
        <a href="home.php?user_uniqueid_USERS=<?php echo $_SESSION['user_uniqueid_USERS']; ?>" rel="noopener"
           class="btnhome">
            <svg xmlns="http://www.w3.org/2000/svg" width="23.724" height="22.24" viewBox="0 0 23.724 22.24">
                <g id="home" transform="translate(-0.001 -16.014)">
                    <path id="Tracé_8" data-name="Tracé 8"
                          d="M23.507,26.236l-9.22-9.22a3.433,3.433,0,0,0-4.85,0l-9.22,9.22a.741.741,0,1,0,1.048,1.049l.588-.588v9.425a2.131,2.131,0,0,0,2.131,2.131H7.692a.463.463,0,0,0,.463-.463V30.932a2.317,2.317,0,0,1,2.317-2.317h2.78a2.317,2.317,0,0,1,2.317,2.317V37.79a.463.463,0,0,0,.463.463h3.707a2.131,2.131,0,0,0,2.131-2.131V26.7l.588.588a.741.741,0,1,0,1.048-1.049Z"
                          fill="#f2f2f2"/>
                </g>
            </svg>
            <p>Accueil</p>
        </a>
        <a href="search.php?user_uniqueid_USERS=<?php echo $_SESSION['user_uniqueid_USERS']; ?>" rel="noopener"
           class="btnsearch">
            <svg xmlns="http://www.w3.org/2000/svg" width="21.784" height="22.225" viewBox="0 0 21.784 22.225">
                <g id="loupe" transform="translate(-348.216 -121)">
                    <path id="Tracé_5" data-name="Tracé 5" d="M353.691,133.565l-5.992,5.992"
                          transform="translate(4.093 0.093)" fill="none" stroke="#009380" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="1"/>
                    <path id="Tracé_7" data-name="Tracé 7" d="M353.51,133.565l-5.811,5.811"
                          transform="translate(1.931 2.435)" fill="none" stroke="#f2f2f2" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="2"/>
                    <g id="Tracé_6" data-name="Tracé 6" transform="translate(355 121)" fill="none">
                        <path d="M7.5,0A7.5,7.5,0,1,1,0,7.5,7.5,7.5,0,0,1,7.5,0Z" stroke="none"/>
                        <path d="M 7.5 1 C 3.915889739990234 1 1 3.915889739990234 1 7.5 C 1 11.08411026000977 3.915889739990234 14 7.5 14 C 11.08411026000977 14 14 11.08411026000977 14 7.5 C 14 3.915889739990234 11.08411026000977 1 7.5 1 M 7.5 0 C 11.64213943481445 0 15 3.35785961151123 15 7.5 C 15 11.64213943481445 11.64213943481445 15 7.5 15 C 3.35785961151123 15 0 11.64213943481445 0 7.5 C 0 3.35785961151123 3.35785961151123 0 7.5 0 Z"
                              stroke="none" fill="#f2f2f2"/>
                    </g>
                </g>
            </svg>
            <p>Recherche</p>
        </a>
        <a href="message.php?user_uniqueid_USERS=<?php echo $_SESSION['user_uniqueid_USERS']; ?>" rel="noopener"
           class="btnmessage">
            <svg id="logo_message" data-name="logo message" xmlns="http://www.w3.org/2000/svg" width="30" height="20"
                 viewBox="0 0 30 20">
                <g id="Soustraction_1" data-name="Soustraction 1" transform="translate(0 0)" fill="none">
                    <path d="M12.174,13H6.5a6.5,6.5,0,0,1,0-13h6A6.507,6.507,0,0,1,19,6.5V8h-.5a6.474,6.474,0,0,0-6.326,5Z"
                          stroke="none"/>
                    <path d="M 11.42574214935303 11.99960041046143 C 12.41650581359863 9.174727439880371 14.98825550079346 7.213236331939697 17.99990081787109 7.016401767730713 L 17.99990081787109 6.499800205230713 C 17.99990081787109 3.46720027923584 15.53270053863525 1.000000238418579 12.50010013580322 1.000000238418579 L 6.499800205230713 1.000000238418579 C 3.467200517654419 1.000000238418579 1.000000357627869 3.46720027923584 1.000000357627869 6.499800205230713 C 1.000000357627869 9.532400131225586 3.467200517654419 11.99960041046143 6.499800205230713 11.99960041046143 L 11.42574214935303 11.99960041046143 M 12.17372035980225 12.99960041046143 L 12.17293071746826 12.99960041046143 L 6.499800205230713 12.99960041046143 C 2.915800333023071 12.99960041046143 4.089355343239731e-07 10.08380031585693 4.089355343239731e-07 6.499800205230713 C 4.089355343239731e-07 2.915800094604492 2.915800333023071 2.052307195299363e-07 6.499800205230713 2.052307195299363e-07 L 12.50010013580322 2.052307195299363e-07 C 16.0841007232666 2.052307195299363e-07 18.99990081787109 2.915800094604492 18.99990081787109 6.499800205230713 L 18.99990081787109 8.000100135803223 L 18.50040054321289 8.000100135803223 C 15.47127056121826 8.000100135803223 12.86972045898438 10.05564975738525 12.17390060424805 12.99882984161377 L 12.17372035980225 12.99960041046143 Z"
                          stroke="none" fill="#f2f2f2"/>
                </g>
                <g id="Tracé_4" data-name="Tracé 4" transform="translate(30 20) rotate(180)" fill="none">
                    <path d="M6.5,0H18.664V6.626c0,3.59-3.565,6.374-7.155,6.374H6.5a6.5,6.5,0,0,1,0-13Z" stroke="none"/>
                    <path d="M 6.5 1 C 3.467289924621582 1 1 3.467289924621582 1 6.5 C 1 9.532710075378418 3.467289924621582 12 6.5 12 L 11.50930976867676 12 C 13.03454971313477 12 14.59244918823242 11.41645050048828 15.7835693359375 10.39896965026855 C 16.99647903442383 9.362879753112793 17.66445922851563 8.023039817810059 17.66445922851563 6.626269817352295 L 17.66445922851563 1 L 6.5 1 M 6.5 0 L 18.66445922851563 0 L 18.66445922851563 6.626269817352295 C 18.66445922851563 10.21611976623535 15.09915924072266 13 11.50930976867676 13 L 6.5 13 C 2.910149574279785 13 0 10.0898494720459 0 6.5 C 0 2.910149574279785 2.910149574279785 0 6.5 0 Z"
                          stroke="none" fill="#f2f2f2"/>
                </g>
                <text id="_12" data-name="12" transform="translate(5 9)" fill="#f2f2f2" font-size="8"
                      font-family="Roboto-Regular, Roboto" opacity="0">
                    <tspan x="0" y="0">12</tspan>
                </text>
            </svg>
            <p>Messages</p>
        </a>
        <a href="profil.php?user_uniqueid_USERS=<?php echo $_SESSION['user_uniqueid_USERS']; ?>" rel="noopener"
           class="btnprofil">
            <img src="php/images/<?php echo $userinfo['user_profilPicture_USERS']; ?>" alt="photo_de_profil" width="30"
                 height="30">
            <p>Profil</p>
        </a>
        <a href="setting.php?user_uniqueid_USERS=<?php echo $_SESSION['user_uniqueid_USERS']; ?>" rel="noopener"
           class="btnsettings">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="3" viewBox="0 0 24 3">
                <g id="paramètre" transform="translate(-341 -348)">
                    <path id="Rectangle_4" data-name="Rectangle 4"
                          d="M1.5,0H6A0,0,0,0,1,6,0V1.5A1.5,1.5,0,0,1,4.5,3h-3A1.5,1.5,0,0,1,0,1.5v0A1.5,1.5,0,0,1,1.5,0Z"
                          transform="translate(341 348)" fill="#ec1d53"/>
                    <path id="Rectangle_5" data-name="Rectangle 5"
                          d="M1.5,0h3A1.5,1.5,0,0,1,6,1.5v0A1.5,1.5,0,0,1,4.5,3H0A0,0,0,0,1,0,3V1.5A1.5,1.5,0,0,1,1.5,0Z"
                          transform="translate(359 348)" fill="#009380"/>
                    <rect id="Rectangle_6" data-name="Rectangle 6" width="6" height="3" rx="1.5"
                          transform="translate(350 348)" fill="#f2f2f2"/>
                </g>
            </svg>
            <p>Paramètres</p>
        </a>
    </div>
</header>
<div class="h2">
    <h2>Paramètres</h2>
</div>
<main>
    <div class="left">
        <div class="navleft">
            <p class="red btnOptCo">Option de connexion</p>
            <p class="btnAPropos">À propos</p>
            <a href="mentions_legales.html" rel="noopener">
                <p>Mentions légales </p>
                <svg xmlns="http://www.w3.org/2000/svg" width="12.414" height="12.414" viewBox="0 0 12.414 12.414">
                    <g id="arrow" transform="translate(-763.793 -371.793)">
                        <line id="Ligne_17" data-name="Ligne 17" y1="11" x2="11" transform="translate(764.5 372.5)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-width="1"/>
                        <path id="Tracé_173" data-name="Tracé 173" d="M10563,2606.5h5.518v5.781" transform="translate(-9793 -2234)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                    </g>
                </svg>
            </a>
            <a href="index.php" rel="noopener">
                <p>Landing Page </p>
                <svg xmlns="http://www.w3.org/2000/svg" width="12.414" height="12.414" viewBox="0 0 12.414 12.414">
                    <g id="arrow" transform="translate(-763.793 -371.793)">
                        <line id="Ligne_17" data-name="Ligne 17" y1="11" x2="11" transform="translate(764.5 372.5)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-width="1"/>
                        <path id="Tracé_173" data-name="Tracé 173" d="M10563,2606.5h5.518v5.781" transform="translate(-9793 -2234)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                    </g>
                </svg>
            </a>
        </div>
    </div>
    <div class="optionCo">
        <h3>Options de connexion</h3>
        <div class="changePassWord">
            <h4>Changer le mot de passe</h4>
            <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="formleft">
                    <div class="field input inputun">
                        <svg xmlns="http://www.w3.org/2000/svg" width="29.46" height="27.074" viewBox="0 0 29.46 27.074">
                            <g id="Groupe_840" data-name="Groupe 840" transform="translate(0.375 0.5)">
                                <g id="icon_cadena" data-name="icon cadena" transform="translate(2.271)">
                                    <path id="Tracé_122" data-name="Tracé 122" d="M4790.99,521.838v-5.887a4.456,4.456,0,0,1,4.675-4.239c4.491,0,4.841,3.191,4.841,4.239v5.887" transform="translate(-4785.248 -511.712)" fill="none" stroke="#009380" stroke-linejoin="round" stroke-width="1"/>
                                    <g id="Rectangle_17" data-name="Rectangle 17" transform="translate(0 9.575)" fill="none" stroke="#f2f2f2" stroke-width="1">
                                        <rect width="21" height="17" rx="4" stroke="none"/>
                                        <rect x="0.5" y="0.5" width="20" height="16" rx="3.5" fill="none"/>
                                    </g>
                                    <g id="Ellipse_2582" data-name="Ellipse 2582" transform="translate(8 12.575)" fill="none" stroke="#ec1d53" stroke-width="1">
                                        <circle cx="2.5" cy="2.5" r="2.5" stroke="none"/>
                                        <circle cx="2.5" cy="2.5" r="2" fill="none"/>
                                    </g>
                                    <line id="Ligne_3" data-name="Ligne 3" y2="5" transform="translate(10.5 17.075)" fill="none" stroke="#ec1d53" stroke-linecap="round" stroke-width="1"/>
                                </g>
                            </g>
                        </svg>
                        <input type="password" name="mdp" placeholder="Mot de passe actuel">
                        <i class="fas fa-eye oeilUn"></i>
                    </div>
                    <?php if(!empty($erreur)){ ?><div class="error-text"><?=$erreur?></div><?php } ?>
                </div>
                <div class="formright">
                    <div class="field input inputdeux">
                        <svg xmlns="http://www.w3.org/2000/svg" width="29.46" height="27.074" viewBox="0 0 29.46 27.074">
                            <g id="Groupe_840" data-name="Groupe 840" transform="translate(0.375 0.5)">
                                <g id="icon_cadena" data-name="icon cadena" transform="translate(2.271)">
                                    <path id="Tracé_122" data-name="Tracé 122" d="M4790.99,521.838v-5.887a4.456,4.456,0,0,1,4.675-4.239c4.491,0,4.841,3.191,4.841,4.239v5.887" transform="translate(-4785.248 -511.712)" fill="none" stroke="#009380" stroke-linejoin="round" stroke-width="1"/>
                                    <g id="Rectangle_17" data-name="Rectangle 17" transform="translate(0 9.575)" fill="none" stroke="#f2f2f2" stroke-width="1">
                                        <rect width="21" height="17" rx="4" stroke="none"/>
                                        <rect x="0.5" y="0.5" width="20" height="16" rx="3.5" fill="none"/>
                                    </g>
                                    <g id="Ellipse_2582" data-name="Ellipse 2582" transform="translate(8 12.575)" fill="none" stroke="#ec1d53" stroke-width="1">
                                        <circle cx="2.5" cy="2.5" r="2.5" stroke="none"/>
                                        <circle cx="2.5" cy="2.5" r="2" fill="none"/>
                                    </g>
                                    <line id="Ligne_3" data-name="Ligne 3" y2="5" transform="translate(10.5 17.075)" fill="none" stroke="#ec1d53" stroke-linecap="round" stroke-width="1"/>
                                </g>
                            </g>
                        </svg>
                        <input type="password" name="newmdp" placeholder="Nouveau mot de passe">
                        <i class="fas fa-eye oeilDeux"></i>
                    </div>
                    <div class="field input inputtrois">
                        <svg xmlns="http://www.w3.org/2000/svg" width="29.46" height="27.074" viewBox="0 0 29.46 27.074">
                            <g id="Groupe_840" data-name="Groupe 840" transform="translate(0.375 0.5)">
                                <g id="icon_cadena" data-name="icon cadena" transform="translate(2.271)">
                                    <path id="Tracé_122" data-name="Tracé 122" d="M4790.99,521.838v-5.887a4.456,4.456,0,0,1,4.675-4.239c4.491,0,4.841,3.191,4.841,4.239v5.887" transform="translate(-4785.248 -511.712)" fill="none" stroke="#009380" stroke-linejoin="round" stroke-width="1"/>
                                    <g id="Rectangle_17" data-name="Rectangle 17" transform="translate(0 9.575)" fill="none" stroke="#f2f2f2" stroke-width="1">
                                        <rect width="21" height="17" rx="4" stroke="none"/>
                                        <rect x="0.5" y="0.5" width="20" height="16" rx="3.5" fill="none"/>
                                    </g>
                                    <g id="Ellipse_2582" data-name="Ellipse 2582" transform="translate(8 12.575)" fill="none" stroke="#ec1d53" stroke-width="1">
                                        <circle cx="2.5" cy="2.5" r="2.5" stroke="none"/>
                                        <circle cx="2.5" cy="2.5" r="2" fill="none"/>
                                    </g>
                                    <line id="Ligne_3" data-name="Ligne 3" y2="5" transform="translate(10.5 17.075)" fill="none" stroke="#ec1d53" stroke-linecap="round" stroke-width="1"/>
                                </g>
                            </g>
                        </svg>
                        <input type="password" name="newmdp2" placeholder="Confirmer le mot de passe">
                        <i class="fas fa-eye oeilTrois"></i>
                    </div>
                    <div class="field button">
                        <input type="submit" class="ctaform" name="comfirmer" value="Confirmer">
                    </div>
                </div>
            </form>
        </div>
        <div class="deconnection">
            <h4>Déconnexion</h4>
            <div style="display: flex; flex-direction: row; align-items: center" class="displayRow">
                <p>Êtes-vous certain de vous déconnecter ?</p>
                <?php
                if(isset($_SESSION['user_uniqueid_USERS']) AND $userinfo['user_uniqueid_USERS'] == $_SESSION['user_uniqueid_USERS']){?>
                    <a class="ctaform" href="logout.php">Déconnexion</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="aPropos displayNone">
        <h3>À propos</h3>
        <p>Ce site a été réalisé par Alexandre ANTHOINE, Thomas JEU et Martin LIGER. Nous sommes tous les 3 étudiants en première année au département MMI (Métiers du Multimédia et de l’Internet) de Montbéliard.</p>
        <img style="margin: 30px 0 30px 0" src="img/nous3.png" alt="Les 3 fondateurs de CollabyU">
        <p>Ce site est notre projet pour notre second semestre. Notre but était de concevoir un projet innovant qui avait pour but de résoudre un problème.
            CollabyU résout le problème suivant : ce site permettra de faciliter la collaboration entre musiciens, qu’il soit amateur ou professionnel, ou bien encore faciliter la création de groupes de musiques.
        </p>
        <img style="margin: 30px 0 0 0" src="img/Union 1.png" alt="">
    </div>
</main>
<script>
    AOS.init();
</script>
<script>
    const loader = document.querySelector('.loader');
    window.addEventListener('load', () => {
        loader.classList.add('disparition');
    })
</script>
<script>
    const btnOptnCo = document.querySelector(".btnOptCo");
    const btnAPropos = document.querySelector(".btnAPropos");
    const optnCo = document.querySelector(".optionCo");
    const aPropos = document.querySelector(".aPropos");

    btnAPropos.addEventListener('click',affichePropos);
    btnOptnCo.addEventListener('click',afficheOptnCo);

    function affichePropos (){
        btnOptnCo.classList.remove("red");
        btnAPropos.classList.add("red");
        optnCo.classList.add("displayNone");
        aPropos.classList.remove("displayNone");
        console.log("afficher page à propos");
    }
    function afficheOptnCo (){
        btnOptnCo.classList.add("red");
        btnAPropos.classList.remove("red");
        optnCo.classList.remove("displayNone");
        aPropos.classList.add("displayNone");
        console.log("afficher page option de connexion");
    }


</script>
<script>
    const pswrdField = document.querySelector(".inputun input[type='password']");
    const pswrdField2 = document.querySelector(".inputdeux input[type='password']");
    const pswrdField3 = document.querySelector(".inputtrois input[type='password']");
    const toggleBtn = document.querySelector(".oeilUn");
    const toggleBtn2 = document.querySelector(".oeilDeux");
    const toggleBtn3 = document.querySelector(".oeilTrois");

    toggleBtn.addEventListener('click',clicksuroeil);
    toggleBtn2.addEventListener('click',clicksuroeil2);
    toggleBtn3.addEventListener('click',clicksuroeil3);

    function clicksuroeil () {
        if(pswrdField.type == "password"){
            pswrdField.type = "text";
            toggleBtn.classList.add("active");
        }else{
            pswrdField.type = "password";
            toggleBtn.classList.remove("active");
        }
    }
    function clicksuroeil2 () {
        if(pswrdField2.type == "password"){
            pswrdField2.type = "text";
            toggleBtn2.classList.add("active");
        }else{
            pswrdField2.type = "password";
            toggleBtn2.classList.remove("active");
        }
    }
    function clicksuroeil3 () {
        if(pswrdField3.type == "password"){
            pswrdField3.type = "text";
            toggleBtn3.classList.add("active");
        }else{
            pswrdField3.type = "password";
            toggleBtn3.classList.remove("active");
        }
    }
</script>
</body>
</html>