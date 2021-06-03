<?php
session_start();
if (!isset($_SESSION['user_uniqueid_USERS'])) {
    header("Location: login.php");
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once
'class/class.User.php';
require_once
'class/class.MusicalGenre.php';
$bdd = new PDO (
    'mysql:host=tj9r5.myd.infomaniak.com;dbname=tj9r5_collabyu;charset=utf8',
    'tj9r5_collabyu',
    'Collabyu2021');


$query = 'SELECT * FROM users';
$requete = $bdd->prepare($query);
$listUser = array();
if ($requete->execute()) {
    while ($donnees = $requete->fetch()) {
        $user = new User($donnees);
        $listUser[] = $user;
    }
} else {
    echo 'Requete incorrecte <br/>';
}


$query = 'SELECT * FROM musicalgenre';
$requete = $bdd->prepare($query);
$listGenre = array();
if ($requete->execute()) {
    while ($donnees = $requete->fetch()) {
        $genre = new MusicalGenre($donnees);
        $listGenre[] = $genre;
    }
} else {
    echo 'Requete incorrecte <br/>';
}
?>
<?php
    /*connection à BDD*/
    $bdd = new PDO (
        'mysql:host=tj9r5.myd.infomaniak.com;dbname=tj9r5_collabyu;charset=utf8',
        'tj9r5_collabyu',
        'Collabyu2021');

    /*afficher tout les users*/
    if (isset($_SESSION['user_uniqueid_USERS'])) {
        $show_users = $bdd->prepare("SELECT * FROM users WHERE user_uniqueid_USERS <> ? ORDER BY RAND() ");
        $show_users->execute(array($_SESSION['user_uniqueid_USERS']));
    } else {
        $show_users = $bdd->prepare("SELECT * FROM users DESC");
        $show_users->execute(array());
    }

    /*toute les infos du user connecté*/
    $requser = $bdd->prepare('SELECT * FROM users WHERE user_uniqueid_USERS = ?');
    $requser->execute(array($_SESSION['user_uniqueid_USERS']));
    $userinfo = $requser->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CollabyU | Recherche</title>

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
    <link rel="stylesheet" href="css/search.css">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
    <h2>Rechercher</h2>
</div>
<main>
    <div class="liste">
        <?php
        foreach ($show_users as $am) {
            ?>
            <?php if ($am['user_link_USERS'] == null)
            {
                ?>
                <div style="border-radius: 42px;" class="cardProfil">
                    <div style="width: auto" class="left">
                        <div class="id">
                            <a href="profil.php?user_uniqueid_USERS=<?php echo $am['user_uniqueid_USERS']; ?>"
                               rel="noopener">
                                <img src="php/images/<?php echo $am['user_profilPicture_USERS']; ?>" alt="Photo de profil"
                                     height="60" width="60">
                            </a>
                            <div class="cardIdRight">
                                <a href="profil.php?user_uniqueid_USERS=<?php echo $am['user_uniqueid_USERS']; ?>"
                                   rel="noopener">
                                    <p style="font-size: 18px; font-family: Gotham; font-weight: 500;"><?php echo $am['user_name_USERS']; ?></p>
                                    <p style="opacity: 0.8; font-size: 13px;">@<?php echo $am['user_username_USERS']; ?></p>
                                </a>
                                <p><?php echo $am['user_profil_USERS']; ?></p>
                            </div>
                        </div>
                        <p><?php echo $am['user_biographie_USERS']; ?></p>
                        <?php if ($am['user_localisation_USERS'] == null)
                        {
                            ?>
                            <div style="display: none" class="localisation">
                                <svg id="placeholder" xmlns="http://www.w3.org/2000/svg" width="14.312" height="20.355"
                                     viewBox="0 0 14.312 20.355">
                                    <g id="Groupe_811" data-name="Groupe 811">
                                        <g id="Groupe_810" data-name="Groupe 810">
                                            <path id="Tracé_153" data-name="Tracé 153"
                                                  d="M83.156,0a7.157,7.157,0,0,0-6.088,10.919l5.68,9.154a.6.6,0,0,0,.507.282h0a.6.6,0,0,0,.507-.29L89.3,10.822A7.157,7.157,0,0,0,83.156,0Zm5.123,10.21-5.033,8.4L78.082,10.29a5.967,5.967,0,1,1,10.2-.081Z"
                                                  transform="translate(-76)" fill="#f2f2f2"/>
                                        </g>
                                    </g>
                                    <g id="Groupe_813" data-name="Groupe 813" transform="translate(3.578 3.578)">
                                        <g id="Groupe_812" data-name="Groupe 812">
                                            <path id="Tracé_154" data-name="Tracé 154"
                                                  d="M169.578,90a3.578,3.578,0,1,0,3.578,3.578A3.582,3.582,0,0,0,169.578,90Zm0,5.971a2.393,2.393,0,1,1,2.389-2.393A2.4,2.4,0,0,1,169.578,95.971Z"
                                                  transform="translate(-166 -90)" fill="#f2f2f2"/>
                                        </g>
                                    </g>
                                </svg>
                                <p><?php echo $am['user_localisation_USERS']; ?></p>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="localisation">
                                <svg id="placeholder" xmlns="http://www.w3.org/2000/svg" width="14.312" height="20.355"
                                     viewBox="0 0 14.312 20.355">
                                    <g id="Groupe_811" data-name="Groupe 811">
                                        <g id="Groupe_810" data-name="Groupe 810">
                                            <path id="Tracé_153" data-name="Tracé 153"
                                                  d="M83.156,0a7.157,7.157,0,0,0-6.088,10.919l5.68,9.154a.6.6,0,0,0,.507.282h0a.6.6,0,0,0,.507-.29L89.3,10.822A7.157,7.157,0,0,0,83.156,0Zm5.123,10.21-5.033,8.4L78.082,10.29a5.967,5.967,0,1,1,10.2-.081Z"
                                                  transform="translate(-76)" fill="#f2f2f2"/>
                                        </g>
                                    </g>
                                    <g id="Groupe_813" data-name="Groupe 813" transform="translate(3.578 3.578)">
                                        <g id="Groupe_812" data-name="Groupe 812">
                                            <path id="Tracé_154" data-name="Tracé 154"
                                                  d="M169.578,90a3.578,3.578,0,1,0,3.578,3.578A3.582,3.582,0,0,0,169.578,90Zm0,5.971a2.393,2.393,0,1,1,2.389-2.393A2.4,2.4,0,0,1,169.578,95.971Z"
                                                  transform="translate(-166 -90)" fill="#f2f2f2"/>
                                        </g>
                                    </g>
                                </svg>
                                <p><?php echo $am['user_localisation_USERS']; ?></p>
                            </div>
                            <?php
                        }
                        ?>
                        <?php if ($am['user_instrument_USERS'] == null)
                        {
                            ?>
                            <div style="display: none" class="instrument">
                                <p>Intrument</p>
                                <div class="instrumentListe">
                                    <p><?php echo $am['user_instrument_USERS']; ?></p>
                                </div>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="instrument">
                                <p>Intrument</p>
                                <div class="instrumentListe">
                                    <p><?php echo $am['user_instrument_USERS']; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="musicalGenre">
                            <p>Genre musicaux</p>
                            <div class="musicalGenreListe">
                                <p><?= $listGenre[0]->getName() ?></p>
                                <p><?= $listGenre[2]->getName() ?></p>
                                <p><?= $listGenre[17]->getName() ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="right" style="display: none">
                    </div>
                </div>
                <?php
            }else{ ?>
                <div style="border-radius: 42px 0 42px 42px;" class="cardProfil">
                    <div style="width: 55%" class="left">
                        <div class="id">
                            <a href="profil.php?user_uniqueid_USERS=<?php echo $am['user_uniqueid_USERS']; ?>"
                               rel="noopener">
                                <img src="php/images/<?php echo $am['user_profilPicture_USERS']; ?>" alt="Photo de profil"
                                     height="60" width="60">
                            </a>
                            <div class="cardIdRight">
                                <a href="profil.php?user_uniqueid_USERS=<?php echo $am['user_uniqueid_USERS']; ?>"
                                   rel="noopener">
                                    <p style="font-size: 18px; font-family: Gotham; font-weight: 500;"><?php echo $am['user_name_USERS']; ?></p>
                                    <p style="opacity: 0.8; font-size: 13px;">@<?php echo $am['user_username_USERS']; ?></p>
                                </a>
                                <p><?php echo $am['user_profil_USERS']; ?></p>
                            </div>
                        </div>
                        <p><?php echo $am['user_biographie_USERS']; ?></p>
                        <?php if ($am['user_localisation_USERS'] == null)
                        {
                            ?>
                            <div style="display: none" class="localisation">
                                <svg id="placeholder" xmlns="http://www.w3.org/2000/svg" width="14.312" height="20.355"
                                     viewBox="0 0 14.312 20.355">
                                    <g id="Groupe_811" data-name="Groupe 811">
                                        <g id="Groupe_810" data-name="Groupe 810">
                                            <path id="Tracé_153" data-name="Tracé 153"
                                                  d="M83.156,0a7.157,7.157,0,0,0-6.088,10.919l5.68,9.154a.6.6,0,0,0,.507.282h0a.6.6,0,0,0,.507-.29L89.3,10.822A7.157,7.157,0,0,0,83.156,0Zm5.123,10.21-5.033,8.4L78.082,10.29a5.967,5.967,0,1,1,10.2-.081Z"
                                                  transform="translate(-76)" fill="#f2f2f2"/>
                                        </g>
                                    </g>
                                    <g id="Groupe_813" data-name="Groupe 813" transform="translate(3.578 3.578)">
                                        <g id="Groupe_812" data-name="Groupe 812">
                                            <path id="Tracé_154" data-name="Tracé 154"
                                                  d="M169.578,90a3.578,3.578,0,1,0,3.578,3.578A3.582,3.582,0,0,0,169.578,90Zm0,5.971a2.393,2.393,0,1,1,2.389-2.393A2.4,2.4,0,0,1,169.578,95.971Z"
                                                  transform="translate(-166 -90)" fill="#f2f2f2"/>
                                        </g>
                                    </g>
                                </svg>
                                <p><?php echo $am['user_localisation_USERS']; ?></p>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="localisation">
                                <svg id="placeholder" xmlns="http://www.w3.org/2000/svg" width="14.312" height="20.355"
                                     viewBox="0 0 14.312 20.355">
                                    <g id="Groupe_811" data-name="Groupe 811">
                                        <g id="Groupe_810" data-name="Groupe 810">
                                            <path id="Tracé_153" data-name="Tracé 153"
                                                  d="M83.156,0a7.157,7.157,0,0,0-6.088,10.919l5.68,9.154a.6.6,0,0,0,.507.282h0a.6.6,0,0,0,.507-.29L89.3,10.822A7.157,7.157,0,0,0,83.156,0Zm5.123,10.21-5.033,8.4L78.082,10.29a5.967,5.967,0,1,1,10.2-.081Z"
                                                  transform="translate(-76)" fill="#f2f2f2"/>
                                        </g>
                                    </g>
                                    <g id="Groupe_813" data-name="Groupe 813" transform="translate(3.578 3.578)">
                                        <g id="Groupe_812" data-name="Groupe 812">
                                            <path id="Tracé_154" data-name="Tracé 154"
                                                  d="M169.578,90a3.578,3.578,0,1,0,3.578,3.578A3.582,3.582,0,0,0,169.578,90Zm0,5.971a2.393,2.393,0,1,1,2.389-2.393A2.4,2.4,0,0,1,169.578,95.971Z"
                                                  transform="translate(-166 -90)" fill="#f2f2f2"/>
                                        </g>
                                    </g>
                                </svg>
                                <p><?php echo $am['user_localisation_USERS']; ?></p>
                            </div>
                            <?php
                        }
                        ?>
                        <?php if ($am['user_instrument_USERS'] == null)
                        {
                            ?>
                            <div style="display: none" class="instrument">
                                <p>Intrument</p>
                                <div class="instrumentListe">
                                    <p><?php echo $am['user_instrument_USERS']; ?></p>
                                </div>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="instrument">
                                <p>Intrument</p>
                                <div class="instrumentListe">
                                    <p><?php echo $am['user_instrument_USERS']; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="musicalGenre">
                            <p>Genre musicaux</p>
                            <div class="musicalGenreListe">
                                <p><?= $listGenre[0]->getName() ?></p>
                                <p><?= $listGenre[2]->getName() ?></p>
                                <p><?= $listGenre[17]->getName() ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div style="left: 0; width: 100%; height: 310px; position: relative;">
                            <iframe src="<?php echo $am['user_link_USERS']; ?>"
                                    style="top: 0; opacity: 0.8; border-radius: 0 0 42px 0; left: 0; width: 100%; height: 100%; position: absolute; border: 0;" allowfullscreen allow="encrypted-media">
                            </iframe>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        <?php } ?>
    </div>
    <a class="copyrightlink" href="mentions_legales.html" rel="noopener">Copyright 2021-2022 - Tous droits réservés</a>
</main>
<aside>
    <div class="searchAside">
        <div class="search-area">
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" width="21.784" height="22.225" viewBox="0 0 21.784 22.225">
                    <g id="loupe" transform="translate(1.414)" opacity="0.5">
                        <path id="Tracé_5" data-name="Tracé 5" d="M353.691,133.565l-5.992,5.992"
                              transform="translate(-345.537 -120.907)" fill="none" stroke="#009380"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                        <path id="Tracé_7" data-name="Tracé 7" d="M353.51,133.565l-5.811,5.811"
                              transform="translate(-347.699 -118.565)" fill="none" stroke="#f2f2f2"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                        <g id="Tracé_6" data-name="Tracé 6" transform="translate(5.37)" fill="none">
                            <path d="M7.5,0A7.5,7.5,0,1,1,0,7.5,7.5,7.5,0,0,1,7.5,0Z" stroke="none"/>
                            <path d="M 7.5 1 C 3.915889739990234 1 1 3.915889739990234 1 7.5 C 1 11.08411026000977 3.915889739990234 14 7.5 14 C 11.08411026000977 14 14 11.08411026000977 14 7.5 C 14 3.915889739990234 11.08411026000977 1 7.5 1 M 7.5 0 C 11.64213943481445 0 15 3.35785961151123 15 7.5 C 15 11.64213943481445 11.64213943481445 15 7.5 15 C 3.35785961151123 15 0 11.64213943481445 0 7.5 C 0 3.35785961151123 3.35785961151123 0 7.5 0 Z"
                                  stroke="none" fill="#f2f2f2"/>
                        </g>
                    </g>
                </svg>
            </button>
            <input type="text" name="search-text" class="search-input" placeholder="Rechercher..." autocomplete="off">
        </div>
        <div class="search-recommandation">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="359" height="406" viewBox="0 0 359 406">
                <defs>
                    <filter id="Ellipse_2592" x="206" y="95.794" width="39" height="39" filterUnits="userSpaceOnUse">
                        <feOffset input="SourceAlpha"/>
                        <feGaussianBlur stdDeviation="5" result="blur"/>
                        <feFlood/>
                        <feComposite operator="in" in2="blur"/>
                        <feComposite in="SourceGraphic"/>
                    </filter>
                    <filter id="Rectangle_25" x="216" y="83" width="63" height="36" filterUnits="userSpaceOnUse">
                        <feOffset dy="3" input="SourceAlpha"/>
                        <feGaussianBlur stdDeviation="3" result="blur-2"/>
                        <feFlood flood-opacity="0.278"/>
                        <feComposite operator="in" in2="blur-2"/>
                        <feComposite in="SourceGraphic"/>
                    </filter>
                </defs>
                <g id="CTA_s_inscrire" data-name="CTA s&apos;inscrire" transform="translate(194.75 370)">
                    <path id="Rectangle_4" data-name="Rectangle 4" d="M18,0H144a18,18,0,0,1,18,18v0a18,18,0,0,1-18,18H0a0,0,0,0,1,0,0V18A18,18,0,0,1,18,0Z" fill="#ec1d53"/>
                    <text id="Rechercher" transform="translate(80 23)" fill="#f2f2f2" font-size="16" font-family="Gotham-Medium, Gotham" font-weight="500"><tspan x="-45.944" y="0">Rechercher</tspan></text>
                </g>
                <g id="colaboré" transform="translate(2.5 299.739)">
                    <text id="Déjà_collaborés_" data-name="Déjà collaborés ?" transform="translate(0 15)" fill="#f2f2f2" stroke="rgba(0,0,0,0)" stroke-width="1" font-size="16" font-family="Roboto-Light, Roboto" font-weight="300"><tspan x="0" y="0">Déjà collaborés ?</tspan></text>
                    <g id="oui" transform="translate(159 0)">
                        <text id="Oui-2" data-name="Oui" transform="translate(20.488 15)" fill="#f2f2f2" stroke="rgba(0,0,0,0)" stroke-width="1" font-size="16" font-family="Roboto-Light, Roboto" font-weight="300"><tspan x="0" y="0">Oui</tspan></text>
                        <g id="Rectangle_26" data-name="Rectangle 26" transform="translate(0 2.022)" fill="none" stroke="#009380" stroke-width="1">
                            <path d="M0,0H7a7,7,0,0,1,7,7V7a7,7,0,0,1-7,7H7A7,7,0,0,1,0,7V0A0,0,0,0,1,0,0Z" stroke="none"/>
                            <path d="M1,.5H7A6.5,6.5,0,0,1,13.5,7V7A6.5,6.5,0,0,1,7,13.5H7A6.5,6.5,0,0,1,.5,7V1A.5.5,0,0,1,1,.5Z" fill="none"/>
                        </g>
                    </g>
                    <g id="non" transform="translate(249 0)">
                        <text id="Non-2" data-name="Non" transform="translate(18.473 15)" fill="#f2f2f2" stroke="rgba(0,0,0,0)" stroke-width="1" font-size="16" font-family="Roboto-Light, Roboto" font-weight="300"><tspan x="0" y="0">Non</tspan></text>
                        <g id="Rectangle_27" data-name="Rectangle 27" transform="translate(14 16.022) rotate(180)" fill="none" stroke="#ec1d53" stroke-width="1">
                            <path d="M0,0H7a7,7,0,0,1,7,7V7a7,7,0,0,1-7,7H7A7,7,0,0,1,0,7V0A0,0,0,0,1,0,0Z" stroke="none"/>
                            <path d="M1,.5H7A6.5,6.5,0,0,1,13.5,7V7A6.5,6.5,0,0,1,7,13.5H7A6.5,6.5,0,0,1,.5,7V1A.5.5,0,0,1,1,.5Z" fill="none"/>
                        </g>
                    </g>
                </g>
                <g id="age" transform="translate(2.5 232)">
                    <line id="Ligne_1" data-name="Ligne 1" x2="355.5" transform="translate(0 38.739)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-width="2"/>
                    <text id="Age-2" data-name="Age" transform="translate(40.5 18.239)" fill="#f2f2f2" stroke="rgba(0,0,0,0)" stroke-width="1" font-size="16" font-family="Roboto-Light, Roboto" font-weight="300" opacity="0.6"><tspan x="0" y="0">Age</tspan></text>
                    <path id="Tracé_131" data-name="Tracé 131" d="M1303.965,445.373l5.379,5.048,5.379-5.048" transform="translate(-973.628 -431.958)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                    <g id="birthday-cake" transform="translate(3.467)">
                        <path id="Tracé_147" data-name="Tracé 147" d="M25.463,139.071V135.31a2.091,2.091,0,0,0-2.089-2.089H21.7v-4.179a.418.418,0,0,0-.418-.418H18.778a.418.418,0,0,0-.418.418v4.179H14.6v-5.014a.418.418,0,0,0-.418-.418H11.674a.418.418,0,0,0-.418.418v5.014H7.5v-4.179a.418.418,0,0,0-.418-.418H4.571a.418.418,0,0,0-.418.418v4.179H2.482A2.092,2.092,0,0,0,.392,135.31v3.761a2.424,2.424,0,0,0,1.254,2.161v4.525H.81a.418.418,0,0,0,0,.836H25.046a.418.418,0,0,0,0-.836H24.21v-4.518A2.515,2.515,0,0,0,25.463,139.071ZM19.2,129.46h1.671v3.761H19.2Zm-7.1-.836h1.671v4.6H12.092Zm-7.1.836H6.66v3.761H4.989Zm-3.761,5.85a1.253,1.253,0,0,1,1.254-1.254H23.374a1.253,1.253,0,0,1,1.254,1.254v3.761a1.682,1.682,0,0,1-1,1.533,1.709,1.709,0,0,1-1.853-.348,1.678,1.678,0,0,1-.489-1.185V137.4a1.667,1.667,0,0,0-.925-1.488l-.026-.014a1.6,1.6,0,0,0-.206-.081c-.042-.014-.08-.028-.121-.038a1.611,1.611,0,0,0-.162-.029c-.037-.005-.072-.016-.109-.019-.02,0-.039,0-.059,0s-.041-.006-.063-.006c-.046,0-.091.01-.137.013s-.095.006-.142.014a1.672,1.672,0,0,0-.213.055c-.038.012-.076.02-.113.034a1.6,1.6,0,0,0-.225.113c-.026.015-.054.026-.08.042a1.68,1.68,0,0,0-.271.219,1.66,1.66,0,0,0-.49,1.182v.836a1.671,1.671,0,1,1-3.343,0V137.4a1.667,1.667,0,0,0-.925-1.488l-.026-.014a1.6,1.6,0,0,0-.206-.081c-.042-.014-.08-.028-.121-.038a1.611,1.611,0,0,0-.162-.029c-.037-.005-.072-.016-.109-.019-.02,0-.039,0-.059,0s-.041-.006-.063-.006c-.046,0-.091.01-.137.013s-.095.006-.142.014a1.675,1.675,0,0,0-.213.055c-.038.012-.077.02-.113.034a1.624,1.624,0,0,0-.224.112c-.027.015-.055.026-.081.042a1.664,1.664,0,0,0-.761,1.4v2.507a1.671,1.671,0,0,1-3.343,0V137.4a1.667,1.667,0,0,0-.925-1.488l-.026-.014a1.6,1.6,0,0,0-.206-.081c-.042-.014-.08-.028-.121-.038a1.611,1.611,0,0,0-.162-.029c-.037-.005-.072-.016-.109-.019s-.08,0-.122,0A1.671,1.671,0,0,0,4.571,137.4v1.671a1.674,1.674,0,0,1-.486,1.182,1.724,1.724,0,0,1-1.561.443,1.667,1.667,0,0,1-.292-.091,1.72,1.72,0,0,1-.514-.349,1.678,1.678,0,0,1-.489-1.185Zm1.254,10.446v-4.213c.042.007.084.009.125.014l.032,0a2.516,2.516,0,0,0,1.082-.125,2.547,2.547,0,0,0,.31-.133l.064-.033a2.564,2.564,0,0,0,.236-.145c.024-.017.049-.032.073-.05a2.437,2.437,0,0,0,1-2V137.4a.83.83,0,0,1,.245-.59.847.847,0,0,1,.137-.11l.027-.014a.827.827,0,0,1,.128-.064l.039-.012a.8.8,0,0,1,.125-.031c.02,0,.042,0,.061-.006a.911.911,0,0,1,.106,0,1.07,1.07,0,0,1,.172.025l.03.009a.913.913,0,0,1,.6.869v2.437a2.507,2.507,0,0,0,5.014,0V137.4a.833.833,0,0,1,.383-.7l.023-.012a.834.834,0,0,1,.133-.066l.036-.011a.886.886,0,0,1,.125-.033l.06-.006a.833.833,0,0,1,.106,0,1.072,1.072,0,0,1,.172.025l.03.009a.913.913,0,0,1,.6.869v.765a2.507,2.507,0,1,0,5.014,0V137.4a.83.83,0,0,1,.245-.59.848.848,0,0,1,.137-.11l.028-.015a.858.858,0,0,1,.128-.063c.013,0,.027-.008.042-.012a.78.78,0,0,1,.123-.031c.02,0,.042,0,.061-.006a.918.918,0,0,1,.106,0,1.074,1.074,0,0,1,.172.025l.03.009a.913.913,0,0,1,.6.869v1.6a2.51,2.51,0,0,0,.734,1.776,2.553,2.553,0,0,0,.264.225c.027.02.055.037.084.056.07.048.141.092.215.133l.088.046a2.56,2.56,0,0,0,.259.111l.053.02a2.541,2.541,0,0,0,.71.134h0a2.5,2.5,0,0,0,.349-.01l.042,0c.042,0,.084-.006.125-.013v4.213Zm0,0" transform="translate(-0.392 -121.114)" fill="#f2f2f2"/>
                        <path id="Tracé_148" data-name="Tracé 148" d="M202.487,5.839a2.092,2.092,0,0,0,2.089-2.089c0-1-1.454-3.159-1.745-3.58a.434.434,0,0,0-.688,0c-.292.422-1.745,2.577-1.745,3.58A2.092,2.092,0,0,0,202.487,5.839Zm0-4.677a8.131,8.131,0,0,1,1.254,2.587,1.254,1.254,0,0,1-2.507,0A8.131,8.131,0,0,1,202.487,1.162Zm0,0" transform="translate(-189.951 0)" fill="#f2f2f2"/>
                        <path id="Tracé_149" data-name="Tracé 149" d="M338.487,21.839a2.092,2.092,0,0,0,2.089-2.089c0-1-1.454-3.159-1.745-3.58a.434.434,0,0,0-.688,0c-.292.422-1.745,2.577-1.745,3.58A2.092,2.092,0,0,0,338.487,21.839Zm0-4.677a8.131,8.131,0,0,1,1.254,2.587,1.254,1.254,0,0,1-2.507,0A8.131,8.131,0,0,1,338.487,17.162Zm0,0" transform="translate(-318.848 -15.164)" fill="#f2f2f2"/>
                        <path id="Tracé_150" data-name="Tracé 150" d="M66.487,21.839a2.092,2.092,0,0,0,2.089-2.089c0-1-1.454-3.159-1.745-3.58a.434.434,0,0,0-.688,0c-.292.422-1.745,2.577-1.745,3.58A2.092,2.092,0,0,0,66.487,21.839Zm0-4.677a8.131,8.131,0,0,1,1.254,2.587,1.254,1.254,0,1,1-2.507,0A8.131,8.131,0,0,1,66.487,17.162Zm0,0" transform="translate(-61.055 -15.164)" fill="#f2f2f2"/>
                    </g>
                </g>
                <g id="année_de_prratique" data-name="année de prratique" transform="translate(2 165.794)">
                    <line id="Ligne_2" data-name="Ligne 2" x2="356" transform="translate(0 37.206)" fill="none" stroke="#f2eae2" stroke-linecap="round" stroke-width="2"/>
                    <text id="Année_de_pratique" data-name="Année de pratique" transform="translate(40 16.711)" fill="#f2f2f2" stroke="rgba(0,0,0,0)" stroke-width="1" font-size="16" font-family="Roboto-Light, Roboto" font-weight="300" opacity="0.6"><tspan x="0" y="0">Année de pratique</tspan></text>
                    <path id="Tracé_134" data-name="Tracé 134" d="M1303.965,445.373l5.379,5.048,5.379-5.048" transform="translate(-975.628 -434.747)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                    <g id="calendar" transform="translate(3.517)">
                        <g id="Groupe_809" data-name="Groupe 809">
                            <g id="Groupe_808" data-name="Groupe 808">
                                <circle id="Ellipse_2584" data-name="Ellipse 2584" cx="1" cy="1" r="1" transform="translate(16.211 8.211)" fill="#f2f2f2"/>
                                <path id="Tracé_141" data-name="Tracé 141" d="M18.919,1.752H17.78V.876a.876.876,0,0,0-1.752,0v.876H12.043V.876a.876.876,0,0,0-1.752,0v.876H6.35V.876A.876.876,0,0,0,4.6.876v.876H3.5A3.507,3.507,0,0,0,0,5.255V18.919a3.507,3.507,0,0,0,3.5,3.5h6.7a.876.876,0,0,0,0-1.752H3.5a1.754,1.754,0,0,1-1.752-1.752V5.255A1.754,1.754,0,0,1,3.5,3.5H4.6v.876a.876.876,0,0,0,1.752,0V3.5h3.941v.876a.876.876,0,0,0,1.752,0V3.5h3.985v.876a.876.876,0,0,0,1.752,0V3.5h1.139a1.754,1.754,0,0,1,1.752,1.752v4.992a.876.876,0,1,0,1.752,0V5.255A3.507,3.507,0,0,0,18.919,1.752Z" fill="#f2f2f2"/>
                                <path id="Tracé_142" data-name="Tracé 142" d="M275.3,270a5.3,5.3,0,1,0,5.3,5.3A5.3,5.3,0,0,0,275.3,270Zm0,8.846a3.547,3.547,0,1,1,3.547-3.547A3.551,3.551,0,0,1,275.3,278.846Z" transform="translate(-258.176 -258.176)" fill="#f2f2f2"/>
                                <path id="Tracé_143" data-name="Tracé 143" d="M373.146,331.8h-.394v-.92a.876.876,0,1,0-1.752,0v1.8a.876.876,0,0,0,.876.876h1.27a.876.876,0,1,0,0-1.752Z" transform="translate(-354.753 -315.548)" fill="#f2f2f2"/>
                                <circle id="Ellipse_2585" data-name="Ellipse 2585" cx="1" cy="1" r="1" transform="translate(12.211 8.211)" fill="#f2f2f2"/>
                                <circle id="Ellipse_2586" data-name="Ellipse 2586" cx="1" cy="1" r="1" transform="translate(8.211 12.211)" fill="#f2f2f2"/>
                                <circle id="Ellipse_2587" data-name="Ellipse 2587" cx="1" cy="1" r="1" transform="translate(4.211 8.211)" fill="#f2f2f2"/>
                                <circle id="Ellipse_2588" data-name="Ellipse 2588" cx="1" cy="1" r="1" transform="translate(4.211 12.211)" fill="#f2f2f2"/>
                                <circle id="Ellipse_2589" data-name="Ellipse 2589" cx="1" cy="1" r="1" transform="translate(4.211 16.211)" fill="#f2f2f2"/>
                                <circle id="Ellipse_2590" data-name="Ellipse 2590" cx="1" cy="1" r="1" transform="translate(8.211 16.211)" fill="#f2f2f2"/>
                                <circle id="Ellipse_2591" data-name="Ellipse 2591" cx="1" cy="1" r="1" transform="translate(8.211 8.211)" fill="#f2f2f2"/>
                            </g>
                        </g>
                    </g>
                </g>
                <g id="Localisation" transform="translate(1 67.794)">
                    <g id="Groupe_811" data-name="Groupe 811" transform="translate(8)">
                        <g id="Groupe_810" data-name="Groupe 810">
                            <path id="Tracé_153" data-name="Tracé 153" d="M83.156,0a7.157,7.157,0,0,0-6.088,10.919l5.68,9.154a.6.6,0,0,0,.507.282h0a.6.6,0,0,0,.507-.29L89.3,10.822A7.157,7.157,0,0,0,83.156,0Zm5.123,10.21-5.033,8.4L78.082,10.29a5.967,5.967,0,1,1,10.2-.081Z" transform="translate(-76)" fill="#f2f2f2"/>
                        </g>
                    </g>
                    <g id="Groupe_813" data-name="Groupe 813" transform="translate(11.578 3.578)">
                        <g id="Groupe_812" data-name="Groupe 812">
                            <path id="Tracé_154" data-name="Tracé 154" d="M169.578,90a3.578,3.578,0,1,0,3.578,3.578A3.582,3.582,0,0,0,169.578,90Zm0,5.971a2.393,2.393,0,1,1,2.389-2.393A2.4,2.4,0,0,1,169.578,95.971Z" transform="translate(-166 -90)" fill="#f2f2f2"/>
                        </g>
                    </g>
                    <text id="Localisation-2" data-name="Localisation" transform="translate(42 15.294)" fill="#f2f2f2" stroke="rgba(0,0,0,0)" stroke-width="1" font-size="16" font-family="Roboto-Light, Roboto" font-weight="300"><tspan x="0" y="0">Localisation</tspan></text>
                    <text id="_0_km" data-name="0 km" transform="translate(0.156 65)" fill="#f2f2f2" stroke="rgba(0,0,0,0)" stroke-width="1" font-size="14" font-family="Roboto-Light, Roboto" font-weight="300"><tspan x="0" y="0">0 km</tspan></text>
                    <text id="_250_km" data-name="250 km" transform="translate(357 65)" fill="#f2f2f2" stroke="rgba(0,0,0,0)" stroke-width="1" font-size="14" font-family="Roboto-Light, Roboto" font-weight="300"><tspan x="-45.944" y="0">250 km</tspan></text>
                    <rect id="Rectangle_23" data-name="Rectangle 23" width="353" height="1" rx="0.5" transform="translate(4 47)" fill="#f2f2f2" opacity="0.8"/>
                    <rect id="Rectangle_24" data-name="Rectangle 24" width="224" height="3" rx="1.5" transform="translate(0 46)" fill="#009380"/>
                    <g id="Groupe_817" data-name="Groupe 817" transform="translate(220 21.206)">
                        <g transform="matrix(1, 0, 0, 1, -221, -89)" filter="url(#Ellipse_2592)">
                            <circle id="Ellipse_2592-2" data-name="Ellipse 2592" cx="4.5" cy="4.5" r="4.5" transform="translate(221 110.79)" fill="#f2f2f2"/>
                        </g>
                        <g id="Groupe_816" data-name="Groupe 816" transform="translate(4)">
                            <g transform="matrix(1, 0, 0, 1, -225, -89)" filter="url(#Rectangle_25)">
                                <path id="Rectangle_25-2" data-name="Rectangle 25" d="M9,0H36a9,9,0,0,1,9,9V9a9,9,0,0,1-9,9H0a0,0,0,0,1,0,0V9A9,9,0,0,1,9,0Z" transform="translate(225 89)" fill="#f2f2f2"/>
                            </g>
                            <text id="_150_" data-name="150 " transform="translate(34 13)" fill="#ec1d53" stroke="rgba(0,0,0,0)" stroke-width="1" font-size="12" font-family="Roboto-Light, Roboto" font-weight="300"><tspan x="-22.869" y="0">150 </tspan></text>
                        </g>
                    </g>
                </g>
                <g id="genre_musicaux" data-name="genre musicaux" transform="translate(1)">
                    <path id="Tracé_155" data-name="Tracé 155" d="M0,0H356" transform="translate(0 38.794)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-width="2"/>
                    <g id="Groupe_800" data-name="Groupe 800" transform="translate(0.174)">
                        <text id="Genres_musicaux" data-name="Genres musicaux" transform="translate(40.326 18.294)" fill="#f2f2f2" stroke="rgba(0,0,0,0)" stroke-width="1" font-size="16" font-family="Roboto-Light, Roboto" font-weight="300" opacity="0.6"><tspan x="0" y="0">Genres musicaux</tspan></text>
                        <g id="music">
                            <g id="Groupe_803" data-name="Groupe 803">
                                <path id="Tracé_138" data-name="Tracé 138" d="M25.285.237a.928.928,0,0,0-.71-.228L8.125,1.837a.914.914,0,0,0-.813.908V19.032a5.288,5.288,0,0,0-2.742-.75c-2.52,0-4.57,1.64-4.57,3.656s2.05,3.656,4.569,3.656,4.569-1.639,4.569-3.656V8.138L23.761,6.509V17.2a5.288,5.288,0,0,0-2.742-.748c-2.52,0-4.569,1.64-4.569,3.656s2.05,3.656,4.569,3.656,4.569-1.639,4.569-3.656V.918A.914.914,0,0,0,25.285.237Z" transform="translate(0 -0.004)" fill="#f2f2f2"/>
                            </g>
                        </g>
                    </g>
                    <path id="Tracé_131-2" data-name="Tracé 131" d="M1303.965,445.373l5.379,5.048,5.379-5.048" transform="translate(-974.128 -431.876)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                </g>
            </svg>
        </div>
    </div>
</aside>
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
    const searchBar = document.querySelector(".search-input"),
        searchBtn = document.querySelector(".search-button"),
        userList = document.querySelector(".liste");

    searchBar.onkeyup = ()=>{
        let searchTerm = searchBar.value;
        if(searchTerm !=""){
            searchBar.classList.add("active");
        }else{
            searchBar.classList.remove("active");
        }
        //start Ajax
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/bigsearch.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    userList.innerHTML = data;
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("searchTerm=" + searchTerm);
    }
</script>