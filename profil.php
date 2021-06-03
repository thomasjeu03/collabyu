<?php
session_start();
if (!isset($_SESSION['user_uniqueid_USERS'])) {
    header("Location: login.php");
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
$bdd = new PDO (
    'mysql:host=tj9r5.myd.infomaniak.com;dbname=tj9r5_collabyu;charset=utf8',
    'tj9r5_collabyu',
    'Collabyu2021');
if (isset($_SESSION['user_uniqueid_USERS'])) {
    $showe_users = $bdd->prepare("SELECT * FROM users WHERE user_uniqueid_USERS <> ?");
    $showe_users->execute(array($_SESSION['user_uniqueid_USERS']));
} else {
    $showe_users = $bdd->prepare("SELECT * FROM users");
    $showe_users->execute(array());
}

if (isset($_SESSION['user_uniqueid_USERS'])) {
    $select_collami = $bdd->prepare("SELECT * FROM users WHERE user_uniqueid_USERS <> ?");
    $select_collami->execute(array($_SESSION['user_uniqueid_USERS']));
} else {
    $select_collami = $bdd->prepare("SELECT * FROM users");
    $select_collami->execute(array());
}

$getid = intval($_GET['user_uniqueid_USERS']);
$requser = $bdd->prepare('SELECT * FROM users WHERE user_uniqueid_USERS = ?');
$requser->execute(array($_GET['user_uniqueid_USERS']));
$userinfo = $requser->fetch();

if (isset($_POST['submit'])) {
    $getid = intval($_SESSION['user_uniqueid_USERS']);
    $username = htmlspecialchars($_POST['newusername']);
    $pseudo = htmlspecialchars($_POST['newpseudo']);
    $profil = htmlspecialchars($_POST['newprofil']);
    $bio = htmlspecialchars($_POST['newbio']);
    $localisation = htmlspecialchars($_POST['newlocalisation']);
    $instrument = htmlspecialchars($_POST['newinstrument']);
    $firstlink = htmlspecialchars($_POST['newlink']);
    $finlink = substr($firstlink, 24);
    $link = "https://open.spotify.com/embed".$finlink;

    $usernamelenght = strlen($username);
    if($usernamelenght <= 25) {
        $requsername = $bdd->prepare("SELECT * FROM users WHERE user_username_USERS = ?");
        $requsername->execute(array($username));
        $usernameexist = $requsername->rowCount();
        if ($usernameexist == 0 OR $username == $userinfo['user_username_USERS']) {
            if (isset($_POST['newusername']) and !empty($_POST['newusername']) and $_POST['newusername'] != $userinfo['user_username_USERS']) {
                $insertusername = $bdd->prepare("UPDATE users SET user_username_users = ? WHERE user_uniqueid_users = ?");
                $insertusername->execute(array($username, $_SESSION['user_uniqueid_USERS']));
                header("Location: profil.php?user_uniqueid_USERS=" . $_SESSION['user_uniqueid_USERS']);
            }
            if (isset($_POST['newpseudo']) and !empty($_POST['newpseudo']) and $_POST['newpseudo'] != $userinfo['user_name_USERS']) {
                $insertpseudo = $bdd->prepare("UPDATE users SET user_name_users = ? WHERE user_uniqueid_users = ?");
                $insertpseudo->execute(array($pseudo, $_SESSION['user_uniqueid_USERS']));
                header("Location: profil.php?user_uniqueid_USERS=" . $_SESSION['user_uniqueid_USERS']);
            }
            if (isset($_POST['newprofil']) and !empty($_POST['newprofil']) and $_POST['newprofil'] != $userinfo['user_profil_USERS']) {
                $insertprofil = $bdd->prepare("UPDATE users SET user_profil_users = ? WHERE user_uniqueid_users = ?");
                $insertprofil->execute(array($profil, $_SESSION['user_uniqueid_USERS']));
                header("Location: profil.php?user_uniqueid_USERS=" . $_SESSION['user_uniqueid_USERS']);
            }
            if (isset($_POST['newbio']) and !empty($_POST['newbio']) and $_POST['newbio'] != $userinfo['user_biographie_USERS']) {
                $insertbio = $bdd->prepare("UPDATE users SET user_biographie_users = ? WHERE user_uniqueid_users = ?");
                $insertbio->execute(array($bio, $_SESSION['user_uniqueid_USERS']));
                header("Location: profil.php?user_uniqueid_USERS=" . $_SESSION['user_uniqueid_USERS']);
            }
            if (isset($_POST['newlocalisation']) and !empty($_POST['newlocalisation']) and $_POST['newlocalisation'] != $userinfo['user_localisation_USERS']) {
                $insertlocalisation = $bdd->prepare("UPDATE users SET user_localisation_users = ? WHERE user_uniqueid_users = ?");
                $insertlocalisation->execute(array($localisation, $_SESSION['user_uniqueid_USERS']));
                header("Location: profil.php?user_uniqueid_USERS=" . $_SESSION['user_uniqueid_USERS']);
            }
            if (isset($_POST['newinstrument']) and !empty($_POST['newinstrument']) and $_POST['newinstrument'] != $userinfo['user_instrument_USERS']) {
                $insertinstrument = $bdd->prepare("UPDATE users SET user_instrument_users = ? WHERE user_uniqueid_users = ?");
                $insertinstrument->execute(array($instrument, $_SESSION['user_uniqueid_USERS']));
                header("Location: profil.php?user_uniqueid_USERS=" . $_SESSION['user_uniqueid_USERS']);
            }

           if (isset($_POST['newlink']) and !empty($_POST['newlink']) and $_POST['newlink'] != $userinfo['user_link_USERS']) {
                $insertlink = $bdd->prepare("UPDATE users SET user_link_users = ? WHERE user_uniqueid_users = ?");
                $insertlink->execute(array($link, $_SESSION['user_uniqueid_USERS']));
                header("Location: profil.php?user_uniqueid_USERS=" . $_SESSION['user_uniqueid_USERS']);
            }
        }else{
            $erreurusername = "Nom d'utilisateur déjà utilisé";
        }
    }else{
        $erreurusername = "Votre pseudo ne doit pas faire plus de 25 caractères.";
    }
}
if (isset($_POST['savePP'])) {
    $getid = intval($_SESSION['user_uniqueid_USERS']);
    if(isset($_FILES['filePP'])){
        $img_name = $_FILES['filePP']['name'];
        $img_type = $_FILES['filePP']['type'];
        $tmp_name = $_FILES['filePP']['tmp_name'];
        $img_explode = explode('.',$img_name);
        $img_ext = end($img_explode);
        $extensions = ["jpeg", "png", "jpg"];
        if(in_array($img_ext, $extensions) === true){
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if(in_array($img_type, $types) === true) {
                $time = time();
                $new_img_name = $time.$img_name;
                if(move_uploaded_file($tmp_name,"php/images/".$new_img_name)) {
                    $reqUser = $bdd->prepare("UPDATE users SET user_profilPicture_USERS='$new_img_name' WHERE user_uniqueid_USERS = '$getid'");
                    $reqUser->execute(array($new_img_name));
                    header("Location: profil.php?user_uniqueid_USERS=" . $_SESSION['user_uniqueid_USERS']);
                }
            }
        }
    }
}
if (isset($_POST['saveBanneer'])) {
    $getid = intval($_SESSION['user_uniqueid_USERS']);
    if(isset($_FILES['fileBanner'])){
        $img_name = $_FILES['fileBanner']['name'];
        $img_type = $_FILES['fileBanner']['type'];
        $tmp_name = $_FILES['fileBanner']['tmp_name'];
        $img_explode = explode('.',$img_name);
        $img_ext = end($img_explode);
        $extensions = ["jpeg", "png", "jpg"];
        if(in_array($img_ext, $extensions) === true){
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if(in_array($img_type, $types) === true) {
                $time = time();
                $new_img_name = $time.$img_name;
                if(move_uploaded_file($tmp_name,"php/images/".$new_img_name)) {
                    $reqUser = $bdd->prepare("UPDATE users SET user_banner_USERS='$new_img_name' WHERE user_uniqueid_USERS = '$getid'");
                    $reqUser->execute(array($new_img_name));
                    header("Location: profil.php?user_uniqueid_USERS=" . $_SESSION['user_uniqueid_USERS']);
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@<?php echo $userinfo['user_username_USERS']; ?> | CollabyU</title>

    <meta name="description" content="Bienvenue sur l'application web CollabyU, un projet d'équipe réalisé dans un cadre pédagogique qui permet la mise en relation de passionnés de la musique.">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/png" sizes="32x32" href="img/logo_flat.svg">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo_flat.svg">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/504485e57a.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/profil.css">
</head>
<body>
<div class="loader">
    <svg class="logoloader" xmlns="http://www.w3.org/2000/svg" width="106" height="109" viewBox="0 0 106 109">
        <g id="logo_svg" data-name="logo svg" transform="translate(-246 -597)">
            <path class="vert" id="vert" d="M17,0H35A17,17,0,0,1,52,17v0A17,17,0,0,1,35,34H0a0,0,0,0,1,0,0V17A17,17,0,0,1,17,0Z" transform="translate(300 597)" fill="#009380"/>
            <path class="rose" id="rose" d="M21,0H63a0,0,0,0,1,0,0V21A21,21,0,0,1,42,42H21A21,21,0,0,1,0,21v0A21,21,0,0,1,21,0Z" transform="translate(246 664)" fill="#ec1d53"/>
            <path id="blanc" d="M3,0H9A0,0,0,0,1,9,0V22a3,3,0,0,1-3,3H0a0,0,0,0,1,0,0V3A3,3,0,0,1,3,0Z" transform="translate(300 635)" fill="#f2f2f2"/>
        </g>
    </svg>
</div>
<header>
    <div class="nav">
        <a href="home.php?user_uniqueid_USERS=<?php echo $_SESSION['user_uniqueid_USERS'];?>" rel="noopener" class="logo">
            <img src="img/logo%20collabyU.svg" alt="Logo CollabyU">
            <h1>CollabyU</h1>
        </a>
        <a href="home.php?user_uniqueid_USERS=<?php echo $_SESSION['user_uniqueid_USERS'];?>" rel="noopener" class="btnhome">
            <svg xmlns="http://www.w3.org/2000/svg" width="23.724" height="22.24" viewBox="0 0 23.724 22.24">
                <g id="home" transform="translate(-0.001 -16.014)">
                    <path id="Tracé_8" data-name="Tracé 8" d="M23.507,26.236l-9.22-9.22a3.433,3.433,0,0,0-4.85,0l-9.22,9.22a.741.741,0,1,0,1.048,1.049l.588-.588v9.425a2.131,2.131,0,0,0,2.131,2.131H7.692a.463.463,0,0,0,.463-.463V30.932a2.317,2.317,0,0,1,2.317-2.317h2.78a2.317,2.317,0,0,1,2.317,2.317V37.79a.463.463,0,0,0,.463.463h3.707a2.131,2.131,0,0,0,2.131-2.131V26.7l.588.588a.741.741,0,1,0,1.048-1.049Z" fill="#f2f2f2"/>
                </g>
            </svg>
            <p>Accueil</p>
        </a>
        <a href="search.php?user_uniqueid_USERS=<?php echo $_SESSION['user_uniqueid_USERS'];?>" rel="noopener" class="btnsearch">
            <svg xmlns="http://www.w3.org/2000/svg" width="21.784" height="22.225" viewBox="0 0 21.784 22.225">
                <g id="loupe" transform="translate(-348.216 -121)">
                    <path id="Tracé_5" data-name="Tracé 5" d="M353.691,133.565l-5.992,5.992" transform="translate(4.093 0.093)" fill="none" stroke="#009380" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                    <path id="Tracé_7" data-name="Tracé 7" d="M353.51,133.565l-5.811,5.811" transform="translate(1.931 2.435)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    <g id="Tracé_6" data-name="Tracé 6" transform="translate(355 121)" fill="none">
                        <path d="M7.5,0A7.5,7.5,0,1,1,0,7.5,7.5,7.5,0,0,1,7.5,0Z" stroke="none"/>
                        <path d="M 7.5 1 C 3.915889739990234 1 1 3.915889739990234 1 7.5 C 1 11.08411026000977 3.915889739990234 14 7.5 14 C 11.08411026000977 14 14 11.08411026000977 14 7.5 C 14 3.915889739990234 11.08411026000977 1 7.5 1 M 7.5 0 C 11.64213943481445 0 15 3.35785961151123 15 7.5 C 15 11.64213943481445 11.64213943481445 15 7.5 15 C 3.35785961151123 15 0 11.64213943481445 0 7.5 C 0 3.35785961151123 3.35785961151123 0 7.5 0 Z" stroke="none" fill="#f2f2f2"/>
                    </g>
                </g>
            </svg>
            <p>Recherche</p>
        </a>
        <a href="message.php?user_uniqueid_USERS=<?php echo $_SESSION['user_uniqueid_USERS'];?>" rel="noopener" class="btnmessage">
            <svg id="logo_message" data-name="logo message" xmlns="http://www.w3.org/2000/svg" width="30" height="20" viewBox="0 0 30 20">
                <g id="Soustraction_1" data-name="Soustraction 1" transform="translate(0 0)" fill="none">
                    <path d="M12.174,13H6.5a6.5,6.5,0,0,1,0-13h6A6.507,6.507,0,0,1,19,6.5V8h-.5a6.474,6.474,0,0,0-6.326,5Z" stroke="none"/>
                    <path d="M 11.42574214935303 11.99960041046143 C 12.41650581359863 9.174727439880371 14.98825550079346 7.213236331939697 17.99990081787109 7.016401767730713 L 17.99990081787109 6.499800205230713 C 17.99990081787109 3.46720027923584 15.53270053863525 1.000000238418579 12.50010013580322 1.000000238418579 L 6.499800205230713 1.000000238418579 C 3.467200517654419 1.000000238418579 1.000000357627869 3.46720027923584 1.000000357627869 6.499800205230713 C 1.000000357627869 9.532400131225586 3.467200517654419 11.99960041046143 6.499800205230713 11.99960041046143 L 11.42574214935303 11.99960041046143 M 12.17372035980225 12.99960041046143 L 12.17293071746826 12.99960041046143 L 6.499800205230713 12.99960041046143 C 2.915800333023071 12.99960041046143 4.089355343239731e-07 10.08380031585693 4.089355343239731e-07 6.499800205230713 C 4.089355343239731e-07 2.915800094604492 2.915800333023071 2.052307195299363e-07 6.499800205230713 2.052307195299363e-07 L 12.50010013580322 2.052307195299363e-07 C 16.0841007232666 2.052307195299363e-07 18.99990081787109 2.915800094604492 18.99990081787109 6.499800205230713 L 18.99990081787109 8.000100135803223 L 18.50040054321289 8.000100135803223 C 15.47127056121826 8.000100135803223 12.86972045898438 10.05564975738525 12.17390060424805 12.99882984161377 L 12.17372035980225 12.99960041046143 Z" stroke="none" fill="#f2f2f2"/>
                </g>
                <g id="Tracé_4" data-name="Tracé 4" transform="translate(30 20) rotate(180)" fill="none">
                    <path d="M6.5,0H18.664V6.626c0,3.59-3.565,6.374-7.155,6.374H6.5a6.5,6.5,0,0,1,0-13Z" stroke="none"/>
                    <path d="M 6.5 1 C 3.467289924621582 1 1 3.467289924621582 1 6.5 C 1 9.532710075378418 3.467289924621582 12 6.5 12 L 11.50930976867676 12 C 13.03454971313477 12 14.59244918823242 11.41645050048828 15.7835693359375 10.39896965026855 C 16.99647903442383 9.362879753112793 17.66445922851563 8.023039817810059 17.66445922851563 6.626269817352295 L 17.66445922851563 1 L 6.5 1 M 6.5 0 L 18.66445922851563 0 L 18.66445922851563 6.626269817352295 C 18.66445922851563 10.21611976623535 15.09915924072266 13 11.50930976867676 13 L 6.5 13 C 2.910149574279785 13 0 10.0898494720459 0 6.5 C 0 2.910149574279785 2.910149574279785 0 6.5 0 Z" stroke="none" fill="#f2f2f2"/>
                </g>
                <text id="_12" data-name="12" transform="translate(5 9)" fill="#f2f2f2" font-size="8" font-family="Roboto-Regular, Roboto" opacity="0"><tspan x="0" y="0">12</tspan></text>
            </svg>
            <p>Messages</p>
        </a>
        <a href="profil.php?user_uniqueid_USERS=<?php echo $_SESSION['user_uniqueid_USERS'];?>" rel="noopener" class="btnprofil">
            <img src="php/images/<?php echo $_SESSION['user_profilPicture_USERS']; ?>" alt="photo_de_profil" width="30" height="30">
            <?php if (isset($_SESSION['user_uniqueid_USERS']) AND $userinfo['user_uniqueid_USERS'] == $_SESSION['user_uniqueid_USERS'])
            {
                ?>
                <p class="profilRed">Profil</p>
                <?php
            }else{
                ?>
                <p>Profil</p>
                <?php
            }
            ?>
        </a>
        <a href="setting.php?user_uniqueid_USERS=<?php echo $_SESSION['user_uniqueid_USERS'];?>" rel="noopener" class="btnsettings">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="3" viewBox="0 0 24 3">
                <g id="paramètre" transform="translate(-341 -348)">
                    <path id="Rectangle_4" data-name="Rectangle 4" d="M1.5,0H6A0,0,0,0,1,6,0V1.5A1.5,1.5,0,0,1,4.5,3h-3A1.5,1.5,0,0,1,0,1.5v0A1.5,1.5,0,0,1,1.5,0Z" transform="translate(341 348)" fill="#ec1d53"/>
                    <path id="Rectangle_5" data-name="Rectangle 5" d="M1.5,0h3A1.5,1.5,0,0,1,6,1.5v0A1.5,1.5,0,0,1,4.5,3H0A0,0,0,0,1,0,3V1.5A1.5,1.5,0,0,1,1.5,0Z" transform="translate(359 348)" fill="#009380"/>
                    <rect id="Rectangle_6" data-name="Rectangle 6" width="6" height="3" rx="1.5" transform="translate(350 348)" fill="#f2f2f2"/>
                </g>
            </svg>
            <p>Paramètres</p>
        </a>
    </div>
</header>
<main>
    <h2>@<?php echo $userinfo['user_username_USERS']; ?></h2>
    <?php if (isset($_SESSION['user_uniqueid_USERS']) AND $userinfo['user_uniqueid_USERS'] == $_SESSION['user_uniqueid_USERS'])
    {
    ?>
        <div class="edit">
            <svg id="Groupe_831" data-name="Groupe 831" xmlns="http://www.w3.org/2000/svg" width="18.318" height="18" viewBox="0 0 18.318 18">
                <path id="Tracé_136" data-name="Tracé 136" d="M16.907,48.7a.453.453,0,0,0-.456.45v4a1.361,1.361,0,0,1-1.369,1.35H2.281a1.361,1.361,0,0,1-1.369-1.35V41.422a1.361,1.361,0,0,1,1.369-1.35H6.332a.45.45,0,1,0,0-.9H2.281A2.268,2.268,0,0,0,0,41.422V53.147A2.268,2.268,0,0,0,2.281,55.4h12.8a2.268,2.268,0,0,0,2.281-2.25v-4A.453.453,0,0,0,16.907,48.7Zm0,0" transform="translate(0 -37.397)" fill="#f2f2f2"/>
                <path id="Tracé_137" data-name="Tracé 137" d="M120.437.862a2.053,2.053,0,0,0-2.9,0L109.394,9a.456.456,0,0,0-.117.2l-1.07,3.864a.456.456,0,0,0,.561.562l3.864-1.07a.456.456,0,0,0,.2-.117L120.972,4.3a2.055,2.055,0,0,0,0-2.9ZM110.388,9.3l6.661-6.661L119.2,4.785l-6.661,6.661Zm-.429.861,1.716,1.717-2.374.658Zm10.368-6.5-.484.484-2.148-2.148.484-.484a1.14,1.14,0,0,1,1.613,0l.536.535A1.142,1.142,0,0,1,120.327,3.656Zm0,0" transform="translate(-103.255 -0.261)" fill="#f2f2f2"/>
            </svg>
            <p>Modifier</p>
        </div>
    <?php
    }
    ?>
    <?php if ($userinfo['user_uniqueid_USERS'] != $_SESSION['user_uniqueid_USERS'])
    {
        ?>
        <a href="message.php?user_uniqueid_USERS=<?php echo $_GET['user_uniqueid_USERS'];?>" rel="noopener" class="sendmessage">
            <p>Collaborer</p>
        </a>
        <?php
    }
    ?>


    <?php if (isset($_SESSION['user_uniqueid_USERS']) AND $userinfo['user_uniqueid_USERS'] == $_SESSION['user_uniqueid_USERS'])
    {
        ?>
        <img class="banniere" style="filter: brightness(50%)" src="php/images/<?php echo $userinfo['user_banner_USERS']; ?>" alt="bannière CollabyU">
        <?php
    }else{?>
        <img class="banniere" src="php/images/<?php echo $userinfo['user_banner_USERS']; ?>" alt="bannière CollabyU">
    <?php
    }
    ?>

    <?php if (isset($_SESSION['user_uniqueid_USERS']) AND $userinfo['user_uniqueid_USERS'] == $_SESSION['user_uniqueid_USERS'])
    {
        ?>
        <img class="camera camA" src="img/camera.svg" alt="">
        <?php
    }
    ?>
    <?php if (isset($_SESSION['user_uniqueid_USERS']) AND $userinfo['user_uniqueid_USERS'] == $_SESSION['user_uniqueid_USERS'])
    {
        ?>
        <img class="photodeprofil" style="filter: brightness(50%)" src="php/images/<?php echo $userinfo['user_profilPicture_USERS']; ?>" alt="photo_de_profil" width="100" height="100">
        <?php
    }else{?>
        <img class="photodeprofil" src="php/images/<?php echo $userinfo['user_profilPicture_USERS']; ?>" alt="photo_de_profil" width="100" height="100">
        <?php
    }
    ?>

    <?php if (isset($_SESSION['user_uniqueid_USERS']) AND $userinfo['user_uniqueid_USERS'] == $_SESSION['user_uniqueid_USERS'])
    {
        ?>
        <img class="camera camB" src="img/camera.svg" alt="">
        <?php
    }
    ?>

    <div class="infouser" style="text-align: center">
        <h3 class="name"><?php echo $userinfo['user_name_USERS']; ?></h3>
        <p>@<?php echo $userinfo['user_username_USERS']; ?></p>
        <?php
        if(!empty($erreurusername)){
            ?>
            <div class="error-text"><?=$erreurusername?></div>
        <?php }
        ?>
        <p class="userprofil"><?php echo $userinfo['user_profil_USERS']; ?></p>
        <p><?php echo $userinfo['user_biographie_USERS']; ?></p>
        <?php if ($userinfo['user_localisation_USERS'] == null)
        {
            ?>
            <div style="display: none" class="yearOfPractise">
                <svg id="placeholder" xmlns="http://www.w3.org/2000/svg" width="14.312" height="20.355" viewBox="0 0 14.312 20.355">
                    <g id="Groupe_811" data-name="Groupe 811">
                        <g id="Groupe_810" data-name="Groupe 810">
                            <path id="Tracé_153" data-name="Tracé 153" d="M83.156,0a7.157,7.157,0,0,0-6.088,10.919l5.68,9.154a.6.6,0,0,0,.507.282h0a.6.6,0,0,0,.507-.29L89.3,10.822A7.157,7.157,0,0,0,83.156,0Zm5.123,10.21-5.033,8.4L78.082,10.29a5.967,5.967,0,1,1,10.2-.081Z" transform="translate(-76)" fill="#f2f2f2"/>
                        </g>
                    </g>
                    <g id="Groupe_813" data-name="Groupe 813" transform="translate(3.578 3.578)">
                        <g id="Groupe_812" data-name="Groupe 812">
                            <path id="Tracé_154" data-name="Tracé 154" d="M169.578,90a3.578,3.578,0,1,0,3.578,3.578A3.582,3.582,0,0,0,169.578,90Zm0,5.971a2.393,2.393,0,1,1,2.389-2.393A2.4,2.4,0,0,1,169.578,95.971Z" transform="translate(-166 -90)" fill="#f2f2f2"/>
                        </g>
                    </g>
                </svg>
                <p><?php echo $userinfo['user_localisation_USERS']; ?></p>
            </div>
            <?php
        }else{
            ?>
            <div class="yearOfPractise">
                <svg id="placeholder" xmlns="http://www.w3.org/2000/svg" width="14.312" height="20.355" viewBox="0 0 14.312 20.355">
                    <g id="Groupe_811" data-name="Groupe 811">
                        <g id="Groupe_810" data-name="Groupe 810">
                            <path id="Tracé_153" data-name="Tracé 153" d="M83.156,0a7.157,7.157,0,0,0-6.088,10.919l5.68,9.154a.6.6,0,0,0,.507.282h0a.6.6,0,0,0,.507-.29L89.3,10.822A7.157,7.157,0,0,0,83.156,0Zm5.123,10.21-5.033,8.4L78.082,10.29a5.967,5.967,0,1,1,10.2-.081Z" transform="translate(-76)" fill="#f2f2f2"/>
                        </g>
                    </g>
                    <g id="Groupe_813" data-name="Groupe 813" transform="translate(3.578 3.578)">
                        <g id="Groupe_812" data-name="Groupe 812">
                            <path id="Tracé_154" data-name="Tracé 154" d="M169.578,90a3.578,3.578,0,1,0,3.578,3.578A3.582,3.582,0,0,0,169.578,90Zm0,5.971a2.393,2.393,0,1,1,2.389-2.393A2.4,2.4,0,0,1,169.578,95.971Z" transform="translate(-166 -90)" fill="#f2f2f2"/>
                        </g>
                    </g>
                </svg>
                <p><?php echo $userinfo['user_localisation_USERS']; ?></p>
            </div>
            <?php
        }
        ?>
        <?php if ($userinfo['user_age_USERS'] == null)
        {
            ?>
            <p style="display: none"><?php echo $userinfo['user_age_USERS']; ?> ans</p>
            <?php
        }else{
            ?>
            <p><?php echo $userinfo['user_age_USERS']; ?> ans</p>
            <?php
        }
        ?>
        <?php if ($userinfo['user_yearOfPractice_USERS'] == null)
        {
            ?>
            <div style="display: none" class="yearOfPractise">
                <svg id="calendar" xmlns="http://www.w3.org/2000/svg" width="22.422" height="22.422" viewBox="0 0 22.422 22.422">
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
                </svg>
                <p><?php echo $userinfo['user_yearOfPractice_USERS']; ?> ans de pratique</p>
            </div>
            <?php
        }else{
            ?>
            <div class="yearOfPractise">
                <svg id="calendar" xmlns="http://www.w3.org/2000/svg" width="22.422" height="22.422" viewBox="0 0 22.422 22.422">
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
                </svg>
                <p><?php echo $userinfo['user_yearOfPractice_USERS']; ?> ans de pratique</p>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="instrumentPLUSgenreMusicaux">
        <?php if ($userinfo['user_instrument_USERS'] == null)
        {
            ?>
            <div style="display: none" class="instrumentUser">
                <p>Instrument</p>
                <div class="listesInstruments">
                    <p><?php echo $userinfo['user_instrument_USERS']; ?></p>
                </div>
            </div>
            <?php
        }else{
            ?>
            <div class="instrumentUser">
                <p>Instrument</p>
                <div class="listesInstruments">
                    <p><?php echo $userinfo['user_instrument_USERS']; ?></p>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="genreMusicauxUser">
            <p>Genres musicaux </p>
            <div class="listesGM">
                <p>Rap US</p>
            </div>
        </div>
    </div>

    <?php if ($userinfo['user_link_USERS'] == null)
    {
        ?>
        <div style="display: none;" class="titresproduits">
        </div>
        <?php
    }else{
        ?>
        <div class="titresproduits">
            <div style="display: flex; margin-bottom: 20px">
                <svg id="music" xmlns="http://www.w3.org/2000/svg" width="17.489" height="17.489" viewBox="0 0 17.489 17.489">
                    <g id="Groupe_803" data-name="Groupe 803">
                        <path id="Tracé_138" data-name="Tracé 138" d="M17.281.163A.634.634,0,0,0,16.8.008L5.553,1.257A.625.625,0,0,0,5,1.878V13.009A3.614,3.614,0,0,0,3.123,12.5C1.4,12.5,0,13.617,0,14.995s1.4,2.5,3.123,2.5,3.123-1.12,3.123-2.5V5.563L16.24,4.45v7.308a3.614,3.614,0,0,0-1.874-.511c-1.722,0-3.123,1.121-3.123,2.5s1.4,2.5,3.123,2.5,3.123-1.12,3.123-2.5V.629A.625.625,0,0,0,17.281.163Z" transform="translate(0 -0.004)" fill="#f2f2f2"/>
                    </g>
                </svg>
                <p style="margin-left: 6px">Titres dernièrement produits</p>
            </div>
            <div style="left: 0; width: 100%; height: 380px; position: relative;">
                <iframe src="<?php echo $userinfo['user_link_USERS']; ?>"
                        style="top: 0; opacity: 0.8; border-radius: 0 10px 10px 10px; box-shadow: 3px 6px 30px rgba(0,0,0,0.5); left: 0; width: 100%; height: 100%; position: absolute; border: 0;" allowfullscreen allow="encrypted-media">
                </iframe>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="collami">
        <div style="display: flex; margin-bottom: 20px">
            <svg xmlns="http://www.w3.org/2000/svg" width="23.493" height="18.814" viewBox="0 0 23.493 18.814">
                <g id="Groupe_822" data-name="Groupe 822" transform="translate(0.518)">
                    <g id="icon_profil" data-name="icon profil">
                        <g id="Ellipse_2583" data-name="Ellipse 2583" transform="translate(2.312)" fill="none" stroke="#f2f2f2" stroke-width="1">
                            <ellipse cx="4.14" cy="4.158" rx="4.14" ry="4.158" stroke="none"/>
                            <ellipse cx="4.14" cy="4.158" rx="3.64" ry="3.658" fill="none"/>
                        </g>
                        <path id="Tracé_123" data-name="Tracé 123" d="M4786.116,454.24h13.415s.724-6.176-6.744-6.176S4786.116,454.24,4786.116,454.24Z" transform="translate(-4786.091 -437.927)" fill="#ec1d53" stroke="#f2f2f2" stroke-width="1"/>
                    </g>
                    <g id="icon_profil-2" data-name="icon profil" transform="translate(9 2)">
                        <g id="Ellipse_2583-2" data-name="Ellipse 2583" transform="translate(2.312)" fill="none" stroke="#f2f2f2" stroke-width="1">
                            <ellipse cx="4.14" cy="4.158" rx="4.14" ry="4.158" stroke="none"/>
                            <ellipse cx="4.14" cy="4.158" rx="3.64" ry="3.658" fill="none"/>
                        </g>
                        <path id="Tracé_123-2" data-name="Tracé 123" d="M4786.116,454.24h13.415s.724-6.176-6.744-6.176S4786.116,454.24,4786.116,454.24Z" transform="translate(-4786.091 -437.927)" fill="#009380" stroke="#f2f2f2" stroke-width="1"/>
                    </g>
                </g>
            </svg>
            <p style="margin-left: 6px">Collami</p>
        </div>
        <div class="carousel">
            <ul class="carousel_items">
                <li class="collab">
                    <img style="border-radius: 50%; border: #F2F2F2 1px solid" src="php/images/pp.png" alt="" width="60" height="60">
                    <div class="droite">
                        <p style="font-size: 18px">Tanguy Plaissard</p>
                        <p style="font-size: 14px">Beatmaker</p>
                        <p style="font-size: 13px">Je suis principalement beatmaker et aime être ... </p>
                    </div>
                </li>
                <li class="collab">
                    <img style="border-radius: 50%; border: #F2F2F2 1px solid" src="php/images/pp.png" alt="" width="60" height="60">
                    <div class="droite">
                        <p style="font-size: 18px">Tanguy Plaissard</p>
                        <p style="font-size: 14px">Beatmaker</p>
                        <p style="font-size: 13px">Je suis principalement beatmaker et aime être ... </p>
                    </div>
                </li>
                <li class="collab">
                    <img style="border-radius: 50%; border: #F2F2F2 1px solid" src="php/images/pp.png" alt="profil pictur CollabyU" width="60" height="60">
                    <div class="droite">
                        <p style="font-size: 18px">Tanguy Plaissard</p>
                        <p style="font-size: 14px">Beatmaker</p>
                        <p style="font-size: 13px">Je suis principalement beatmaker et aime être ... </p>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</main>
<aside>
    <div class="searchAside">
        <div class="search-area">
            <button class="search-button">
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
        <div class="search-mid">
            <svg id="horloge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <g id="Ellipse_3" data-name="Ellipse 3" fill="none" stroke="#f2f2f2" stroke-width="1" opacity="0.8">
                    <circle cx="12" cy="12" r="12" stroke="none"/>
                    <circle cx="12" cy="12" r="11.5" fill="none"/>
                </g>
                <g id="eguilles" transform="translate(12 4.719)">
                    <path id="Tracé_12" data-name="Tracé 12" d="M353,93.255V85.974" transform="translate(-353 -85.974)"
                          fill="none" stroke="#009380" stroke-linecap="round" stroke-width="2"/>
                    <path id="Tracé_13" data-name="Tracé 13" d="M0,6.078V0"
                          transform="translate(6.078 7.281) rotate(90)" fill="none" stroke="#ec1d53"
                          stroke-linecap="round" stroke-width="2"/>
                </g>
            </svg>
            <p>Récents</p>
        </div>
        <div class="search-recommandation">
            <?php
            foreach ($showe_users as $am) {
                ?>
                <a href="profil.php?user_uniqueid_USERS=<?php echo $am['user_uniqueid_USERS']; ?>"
                   class="profil-search">
                    <div class="left">
                        <img src="php/images/<?php echo $am['user_profilPicture_USERS']; ?>" alt="pp" height="60"
                             width="60">
                    </div>
                    <div class="right">
                        <p><?php echo $am['user_name_USERS']; ?></p>
                        <p>@<?php echo $am['user_username_USERS']; ?></p>
                        <p><?php echo $am['user_profil_USERS']; ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</aside>
<?php if (isset($_SESSION['user_uniqueid_USERS']) AND $userinfo['user_uniqueid_USERS'] == $_SESSION['user_uniqueid_USERS'])
{
    ?>
    <div class="editPage">
        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="formleft">
                <div class="field input">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23.9" height="27.961" viewBox="0 0 23.9 27.961">
                        <g id="icon_profil" data-name="icon profil" transform="translate(0.531)">
                            <g id="Ellipse_2583" data-name="Ellipse 2583" transform="translate(3.923)" fill="none" stroke="#f2f2f2" stroke-width="1">
                                <ellipse cx="7.027" cy="7" rx="7.027" ry="7" stroke="none"/>
                                <ellipse cx="7.027" cy="7" rx="6.527" ry="6.5" fill="none"/>
                            </g>
                            <path id="Tracé_123" data-name="Tracé 123" d="M4786.133,458.461H4808.9s1.23-10.4-11.445-10.4S4786.133,458.461,4786.133,458.461Z" transform="translate(-4786.091 -431)" fill="none" stroke="#f2f2f2" stroke-width="1"/>
                        </g>
                    </svg>
                    <input type="text" name="newusername" placeholder="Nom d'utilisateur" value="<?php echo $userinfo['user_username_USERS']; ?>">
                </div>
                <div class="field input">
                    <svg xmlns="http://www.w3.org/2000/svg" width="31.719" height="27.961" viewBox="0 0 31.719 27.961">
                        <g id="icon_profil" data-name="icon profil" transform="translate(0.531)">
                            <g id="Ellipse_2583" data-name="Ellipse 2583" transform="translate(3.908)" fill="none" stroke="#f2f2f2" stroke-width="1">
                                <circle cx="7" cy="7" r="7" stroke="none"/>
                                <circle cx="7" cy="7" r="6.5" fill="none"/>
                            </g>
                            <path id="Tracé_123" data-name="Tracé 123" d="M4786.133,458.461h22.679s1.226-10.4-11.4-10.4S4786.133,458.461,4786.133,458.461Z" transform="translate(-4786.092 -431)" fill="none" stroke="#f2f2f2" stroke-width="1"/>
                            <path id="Tracé_151" data-name="Tracé 151" d="M2.641,9.807,0,15.088l5.564-1.132L20.086,4.243,16.974,0Z" transform="translate(7.623 10.539) rotate(-13)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                        </g>
                    </svg>
                    <input type="text" name="newpseudo" value="<?php echo $userinfo['user_name_USERS']; ?>" placeholder="Pseudonyme">
                </div>
                <div class="field input">
                    <svg id="badge" xmlns="http://www.w3.org/2000/svg" width="21.565" height="29.56" viewBox="0 0 21.565 29.56">
                        <path id="Tracé_144" data-name="Tracé 144" d="M21.024,9.273,19.636,7.589a1.489,1.489,0,0,1-.335-.809l-.209-2.172a2.378,2.378,0,0,0-2.135-2.135l-2.172-.209a1.493,1.493,0,0,1-.809-.335L12.292.541a2.378,2.378,0,0,0-3.02,0L7.589,1.929a1.491,1.491,0,0,1-.809.335l-2.172.209A2.378,2.378,0,0,0,2.473,4.609L2.264,6.781a1.493,1.493,0,0,1-.335.809L.541,9.273a2.378,2.378,0,0,0,0,3.02l1.388,1.684a1.493,1.493,0,0,1,.335.809l.209,2.172a2.378,2.378,0,0,0,2.135,2.135l1.328.128L2.782,26.758a.575.575,0,0,0,.686.774L6.2,26.759a.025.025,0,0,1,.029.011L7.6,29.263a.569.569,0,0,0,.5.3h.03a.572.572,0,0,0,.5-.352l3.33-7.959a2.366,2.366,0,0,0,.325-.225l1.684-1.388a1.489,1.489,0,0,1,.74-.326l3.016,7.207-2.135-.6a.9.9,0,0,0-1.035.433L13.5,28.292l-1.416-3.384a.438.438,0,1,0-.809.338l1.659,3.964a.571.571,0,0,0,.5.35h.03a.57.57,0,0,0,.5-.3l1.37-2.492a.025.025,0,0,1,.029-.012l2.736.773a.575.575,0,0,0,.686-.774L15.629,19.22l1.328-.128a2.378,2.378,0,0,0,2.135-2.135l.209-2.172a1.489,1.489,0,0,1,.335-.808l1.388-1.684a2.377,2.377,0,0,0,0-3.02ZM8.07,28.292,7,26.348a.9.9,0,0,0-1.035-.432l-2.134.6,3.016-7.207a1.49,1.49,0,0,1,.741.326l1.684,1.388a2.369,2.369,0,0,0,1.51.541l.1,0ZM20.348,11.735,18.96,13.419a2.364,2.364,0,0,0-.531,1.282l-.209,2.172a1.5,1.5,0,0,1-1.347,1.347l-1.908.184-.023,0-.242.023a2.365,2.365,0,0,0-1.282.531l-1.684,1.388a1.5,1.5,0,0,1-1.9,0L8.147,18.96a2.363,2.363,0,0,0-1.282-.531l-.243-.023-.02,0L4.693,18.22a1.5,1.5,0,0,1-1.347-1.347L3.137,14.7a2.364,2.364,0,0,0-.531-1.282L1.218,11.735a1.5,1.5,0,0,1,0-1.9L2.606,8.147a2.364,2.364,0,0,0,.531-1.282l.209-2.172A1.5,1.5,0,0,1,4.693,3.346l2.172-.209a2.365,2.365,0,0,0,1.282-.531L9.831,1.218a1.5,1.5,0,0,1,1.9,0l1.684,1.388a2.363,2.363,0,0,0,1.282.531l2.172.209A1.5,1.5,0,0,1,18.22,4.692l.209,2.172a2.364,2.364,0,0,0,.531,1.282l1.388,1.684a1.5,1.5,0,0,1,0,1.9Zm0,0" transform="translate(0 0)" fill="#f2f2f2"/>
                        <path id="Tracé_145" data-name="Tracé 145" d="M75,68.156a6.917,6.917,0,0,0-.876.055.438.438,0,0,0,.111.87A6.039,6.039,0,0,1,75,69.032a5.966,5.966,0,1,1-2.443.521.438.438,0,0,0-.359-.8,6.851,6.851,0,1,0,2.8-.6Zm0,0" transform="translate(-64.221 -64.221)" fill="#f2f2f2"/>
                        <path id="Tracé_146" data-name="Tracé 146" d="M104.963,134.6a1.342,1.342,0,0,0,0,1.9l1.914,1.915a1.341,1.341,0,0,0,1.9,0l4.179-4.179a1.34,1.34,0,0,0-1.9-1.9l-3.231,3.232-.967-.967a1.342,1.342,0,0,0-1.9,0Zm2.862,2.025a.438.438,0,0,0,.31-.129l3.541-3.541a.464.464,0,1,1,.656.656l-4.179,4.179a.464.464,0,0,1-.656,0l-1.915-1.914a.464.464,0,0,1,.656-.656l1.277,1.277A.438.438,0,0,0,107.825,136.628Zm0,0" transform="translate(-98.534 -124.329)" fill="#f2f2f2"/>
                    </svg>
                    <input type="text" name="newprofil" value="<?php echo $userinfo['user_profil_USERS']; ?>" placeholder="Profil / Métier">
                </div>
                <div class="field input">
                    <svg id="edit" xmlns="http://www.w3.org/2000/svg" width="26.431" height="26.298" viewBox="0 0 26.431 26.298">
                        <path id="Tracé_136" data-name="Tracé 136" d="M24.395,53.114a.658.658,0,0,0-.658.658v5.845a1.977,1.977,0,0,1-1.975,1.975H3.291a1.977,1.977,0,0,1-1.975-1.975V42.463a1.977,1.977,0,0,1,1.975-1.975H9.136a.658.658,0,1,0,0-1.317H3.291A3.3,3.3,0,0,0,0,42.463V59.617a3.3,3.3,0,0,0,3.291,3.291h18.47a3.3,3.3,0,0,0,3.291-3.291V53.772A.658.658,0,0,0,24.395,53.114Zm0,0" transform="translate(0 -36.611)" fill="#f2f2f2"/>
                        <path id="Tracé_137" data-name="Tracé 137" d="M125.86,1.128a2.962,2.962,0,0,0-4.189,0L109.927,12.872a.658.658,0,0,0-.169.29l-1.544,5.575a.658.658,0,0,0,.81.81L114.6,18a.658.658,0,0,0,.29-.169L126.633,6.09a2.965,2.965,0,0,0,0-4.189ZM111.362,13.3l9.611-9.612,3.1,3.1L114.461,16.4Zm-.619,1.242,2.476,2.477-3.426.949ZM125.7,5.159l-.7.7-3.1-3.1.7-.7a1.646,1.646,0,0,1,2.327,0l.773.772A1.648,1.648,0,0,1,125.7,5.159Zm0,0" transform="translate(-101.068 -0.261)" fill="#f2f2f2"/>
                    </svg>
                    <input name="newbio" value="<?php echo $userinfo['user_biographie_USERS']; ?>" placeholder="Biographie"></input>
                </div>
                <div class="field input">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13.359" height="19" viewBox="0 0 13.359 19">
                        <g id="placeholder" transform="translate(0)">
                            <g id="Groupe_811" data-name="Groupe 811">
                                <g id="Groupe_810" data-name="Groupe 810">
                                    <path id="Tracé_153" data-name="Tracé 153" d="M82.68,0A6.681,6.681,0,0,0,77,10.192l5.3,8.545a.557.557,0,0,0,.473.263h0a.557.557,0,0,0,.473-.271L88.417,10.1A6.681,6.681,0,0,0,82.68,0Zm4.782,9.53-4.7,7.844L77.943,9.605a5.57,5.57,0,1,1,9.518-.075Z" transform="translate(-76 0)" fill="#f2f2f2"/>
                                </g>
                            </g>
                            <g id="Groupe_813" data-name="Groupe 813" transform="translate(3.34 3.34)">
                                <g id="Groupe_812" data-name="Groupe 812">
                                    <path id="Tracé_154" data-name="Tracé 154" d="M169.34,90a3.34,3.34,0,1,0,3.34,3.34A3.344,3.344,0,0,0,169.34,90Zm0,5.574a2.234,2.234,0,1,1,2.23-2.234A2.236,2.236,0,0,1,169.34,95.574Z" transform="translate(-166 -90)" fill="#f2f2f2"/>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <input type="text" name="newlocalisation" value="<?php echo $userinfo['user_localisation_USERS']; ?>" placeholder="Localisation">
                </div>
                <input type="submit" class="editCTA" name="submit" value="Enregistrer">
            </div>

            <div class="formright">
                <div class="field input">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26.14" height="26.124" viewBox="0 0 26.14 26.124">
                        <g id="guitar" transform="translate(0 0)">
                            <g id="Groupe_805" data-name="Groupe 805" transform="translate(3.487 16.975)">
                                <g id="Groupe_804" data-name="Groupe 804">
                                    <path id="Tracé_139" data-name="Tracé 139" d="M69.563,315.493l-3.485-3.485a.436.436,0,0,0-.616,0l-1.307,1.307a.436.436,0,0,0,0,.616l3.485,3.485a.436.436,0,0,0,.616,0l1.307-1.307A.436.436,0,0,0,69.563,315.493Zm-1.615,1-2.869-2.869.691-.691,2.869,2.869Z" transform="translate(-64.028 -311.881)" fill="#f2f2f2"/>
                                </g>
                            </g>
                            <g id="Groupe_807" data-name="Groupe 807">
                                <g id="Groupe_806" data-name="Groupe 806">
                                    <path id="Tracé_140" data-name="Tracé 140" d="M25.705,3.8a1.488,1.488,0,0,0,0-2.1L24.579.574a1.525,1.525,0,0,0-2.1,0L22.22.829,21.657.266l-.616.616.563.563-.691.691-.563-.563-.616.616.581.581a1.474,1.474,0,0,0-.273.854,1.537,1.537,0,0,0,.023.233L14.256,9.664,13.9,9.307a3.043,3.043,0,0,0-4.3,0h0L8.37,10.532a5.639,5.639,0,0,1-2.722,1.509l-.6.138A6.514,6.514,0,0,0,1.91,23.133l1.236,1.236A6.515,6.515,0,0,0,14.1,21.228l.138-.6a5.635,5.635,0,0,1,1.508-2.722l1.225-1.225a3.046,3.046,0,0,0,0-4.3l-.357-.357,5.808-5.808a1.535,1.535,0,0,0,.233.023,1.473,1.473,0,0,0,.853-.273l.581.581.616-.616-.563-.563.691-.691.563.563.616-.616-.563-.563ZM16.356,16.067l-1.225,1.225a6.508,6.508,0,0,0-1.743,3.141l-.138.6a5.643,5.643,0,0,1-9.489,2.722L2.526,22.517a5.643,5.643,0,0,1,2.721-9.489l.6-.137a6.509,6.509,0,0,0,3.142-1.743l1.226-1.225a2.171,2.171,0,0,1,3.071,0h0l.357.357-2.068,2.068c-.081-.007-.162-.011-.244-.011a2.614,2.614,0,1,0,2.614,2.614c0-.082,0-.163-.012-.244L16,12.639l.357.357A2.175,2.175,0,0,1,16.356,16.067Zm-3.8-2.349a1.743,1.743,0,0,1,0,2.464h0a1.786,1.786,0,0,1-2.464,0,1.743,1.743,0,0,1,2.464-2.465Zm1.091.036a2.606,2.606,0,0,0-1.127-1.127l7.952-7.952L21.6,5.8ZM25.089,3.188l-2,2a.63.63,0,0,1-.871,0L21.093,4.059a.616.616,0,0,1,0-.871l2-2a.616.616,0,0,1,.871,0h0l1.127,1.126A.616.616,0,0,1,25.089,3.188Z" transform="translate(0 -0.153)" fill="#f2f2f2"/>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <input type="text" name="newinstrument" placeholder="Instrument" value="<?php echo $userinfo['user_instrument_USERS']; ?>">
                </div>
                <div class="field input">
                    <svg id="music" xmlns="http://www.w3.org/2000/svg" width="17.489" height="17.489" viewBox="0 0 17.489 17.489">
                        <g id="Groupe_803" data-name="Groupe 803">
                            <path id="Tracé_138" data-name="Tracé 138" d="M17.281.163A.634.634,0,0,0,16.8.008L5.553,1.257A.625.625,0,0,0,5,1.878V13.009A3.614,3.614,0,0,0,3.123,12.5C1.4,12.5,0,13.617,0,14.995s1.4,2.5,3.123,2.5,3.123-1.12,3.123-2.5V5.563L16.24,4.45v7.308a3.614,3.614,0,0,0-1.874-.511c-1.722,0-3.123,1.121-3.123,2.5s1.4,2.5,3.123,2.5,3.123-1.12,3.123-2.5V.629A.625.625,0,0,0,17.281.163Z" transform="translate(0 -0.004)" fill="#f2f2f2"/>
                        </g>
                    </svg>
                    <input type="text" name="newlink" placeholder="Lien de votre album Spotify" value="<?php echo $userinfo['user_link_USERS']; ?>">
                </div>
                <div class="addCollami">
                    <div class="label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23.493" height="18.814" viewBox="0 0 23.493 18.814">
                            <g id="Groupe_822" data-name="Groupe 822" transform="translate(0.518)">
                                <g id="icon_profil" data-name="icon profil">
                                    <g id="Ellipse_2583" data-name="Ellipse 2583" transform="translate(2.312)" fill="none" stroke="#f2f2f2" stroke-width="1">
                                        <ellipse cx="4.14" cy="4.158" rx="4.14" ry="4.158" stroke="none"/>
                                        <ellipse cx="4.14" cy="4.158" rx="3.64" ry="3.658" fill="none"/>
                                    </g>
                                    <path id="Tracé_123" data-name="Tracé 123" d="M4786.116,454.24h13.415s.724-6.176-6.744-6.176S4786.116,454.24,4786.116,454.24Z" transform="translate(-4786.091 -437.927)" fill="#ec1d53" stroke="#f2f2f2" stroke-width="1"/>
                                </g>
                                <g id="icon_profil-2" data-name="icon profil" transform="translate(9 2)">
                                    <g id="Ellipse_2583-2" data-name="Ellipse 2583" transform="translate(2.312)" fill="none" stroke="#f2f2f2" stroke-width="1">
                                        <ellipse cx="4.14" cy="4.158" rx="4.14" ry="4.158" stroke="none"/>
                                        <ellipse cx="4.14" cy="4.158" rx="3.64" ry="3.658" fill="none"/>
                                    </g>
                                    <path id="Tracé_123-2" data-name="Tracé 123" d="M4786.116,454.24h13.415s.724-6.176-6.744-6.176S4786.116,454.24,4786.116,454.24Z" transform="translate(-4786.091 -437.927)" fill="#009380" stroke="#f2f2f2" stroke-width="1"/>
                                </g>
                            </g>
                        </svg>
                        <p style="margin-left: 10px">Collami</p>
                    </div>
                    <div class="search-area">
                        <input type="text" name="search-text" class="search-collami" placeholder="Ajouter un Collami" autocomplete="off">
                    </div>
                    <div class="collami-recommandation">
                        <?php
                        foreach ($select_collami as $am) {
                            ?>
                            <a href="profil.php?user_uniqueid_USERS=<?php echo $am['user_uniqueid_USERS']; ?>"
                               class="profil-search">
                                <div class="left">
                                    <img src="php/images/<?php echo $am['user_profilPicture_USERS']; ?>" alt="pp" height="60"
                                         width="60">
                                </div>
                                <div class="right">
                                    <p><?php echo $am['user_name_USERS']; ?></p>
                                    <p>@<?php echo $am['user_username_USERS']; ?></p>
                                    <p><?php echo $am['user_profil_USERS']; ?></p>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="editBanner">
        <svg class="closeCrosse closeA" xmlns="http://www.w3.org/2000/svg" width="56.569" height="56.569" viewBox="0 0 56.569 56.569">
            <g id="closeCrsse" transform="translate(-51.59 -857.75) rotate(45)">
                <path id="Tracé_190" data-name="Tracé 190" d="M20,0A20,20,0,1,1,0,20,20,20,0,0,1,20,0Z" transform="translate(663 550.041)" fill="#ec1d53"/>
                <line id="Ligne_13" data-name="Ligne 13" y2="18" transform="translate(683 561.041)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-width="4"/>
                <line id="Ligne_14" data-name="Ligne 14" y2="18" transform="translate(692 570.041) rotate(90)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-width="4"/>
            </g>
        </svg>
        <div class="drag-areaB">
            <svg class="svgPeliculeB" style="transition: 0.3s ease-in-out;" xmlns="http://www.w3.org/2000/svg" width="115.964" height="106.3" viewBox="0 0 115.964 106.3">
                <g id="image-gallery" transform="translate(0 -2)" opacity="0.8">
                    <g id="Groupe_834" data-name="Groupe 834" transform="translate(0 39.21)">
                        <path id="Tracé_166" data-name="Tracé 166" d="M84.328,78.791a9.638,9.638,0,0,1-2.464-.319L7.149,58.463A9.752,9.752,0,0,1,.317,46.625L9.744,11.489a2.416,2.416,0,0,1,4.668,1.247L4.989,47.862A4.9,4.9,0,0,0,8.42,53.8l74.685,20a4.81,4.81,0,0,0,5.88-3.4l3.774-13.983a2.417,2.417,0,0,1,4.668,1.256L93.658,71.635a9.651,9.651,0,0,1-9.33,7.156Z" transform="translate(0 -9.701)" fill="#f2f2f2"/>
                    </g>
                    <g id="Groupe_835" data-name="Groupe 835" transform="translate(19.325 2)">
                        <path id="Tracé_167" data-name="Tracé 167" d="M90.972,79.309H13.664A9.673,9.673,0,0,1,4,69.645V11.664A9.673,9.673,0,0,1,13.664,2H90.972a9.673,9.673,0,0,1,9.664,9.664V69.645A9.673,9.673,0,0,1,90.972,79.309ZM13.664,6.832a4.84,4.84,0,0,0-4.832,4.832V69.645a4.84,4.84,0,0,0,4.832,4.832H90.972A4.84,4.84,0,0,0,95.8,69.645V11.664a4.84,4.84,0,0,0-4.832-4.832Z" transform="translate(-4 -2)" fill="#f2f2f2"/>
                    </g>
                    <g id="Groupe_836" data-name="Groupe 836" transform="translate(33.821 16.495)">
                        <path id="Tracé_168" data-name="Tracé 168" d="M16.664,24.327a9.664,9.664,0,1,1,9.664-9.664A9.673,9.673,0,0,1,16.664,24.327Zm0-14.5A4.832,4.832,0,1,0,21.5,14.664,4.84,4.84,0,0,0,16.664,9.832Z" transform="translate(-7 -5)" fill="#f2f2f2"/>
                    </g>
                    <g id="Groupe_837" data-name="Groupe 837" transform="translate(19.662 28.816)">
                        <path id="Tracé_169" data-name="Tracé 169" d="M6.487,52.872a2.413,2.413,0,0,1-1.71-4.122L27.6,25.93a7.426,7.426,0,0,1,10.248,0l6.794,6.794L63.444,10.159A7.259,7.259,0,0,1,68.962,7.55h.053a7.243,7.243,0,0,1,5.5,2.527l25.27,29.484a2.416,2.416,0,1,1-3.667,3.146L70.851,13.223a2.39,2.39,0,0,0-1.836-.841,2.565,2.565,0,0,0-1.855.87l-20.5,24.6a2.407,2.407,0,0,1-1.749.865,2.326,2.326,0,0,1-1.817-.705l-8.663-8.663a2.482,2.482,0,0,0-3.416,0L8.192,52.167a2.407,2.407,0,0,1-1.706.705Z" transform="translate(-4.07 -7.55)" fill="#f2f2f2"/>
                    </g>
                </g>
            </svg>
            <img id="previewBanner" class="previewBanner">
        </div>
        <p style="line-height: 18px; font-size: 16px" class="p2">Choisiser votre nouvelle bannière</p>
        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
            <input class="inputFile" type="file" name="fileBanner" id="fileBanner" onchange="previewImagebanner();" accept="image/x-png,image/gif,image/jpeg,image/jpg">
            <button class="saveFile" name="saveBanneer">Enregistrer</button>
        </form>
    </div>
    <div class="editPP">
        <svg class="closeCrosse closeB" xmlns="http://www.w3.org/2000/svg" width="56.569" height="56.569" viewBox="0 0 56.569 56.569">
            <g id="clseCrosse" transform="translate(-51.59 -857.75) rotate(45)">
                <path id="Tracé_190" data-name="Tracé 190" d="M20,0A20,20,0,1,1,0,20,20,20,0,0,1,20,0Z" transform="translate(663 550.041)" fill="#ec1d53"/>
                <line id="Ligne_13" data-name="Ligne 13" y2="18" transform="translate(683 561.041)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-width="4"/>
                <line id="Ligne_14" data-name="Ligne 14" y2="18" transform="translate(692 570.041) rotate(90)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-width="4"/>
            </g>
        </svg>
        <div class="drag-area">
            <svg class="svgPelicule" style="transition: 0.3s ease-in-out;" xmlns="http://www.w3.org/2000/svg" width="115.964" height="106.3" viewBox="0 0 115.964 106.3">
                <g id="image-gallery" transform="translate(0 -2)" opacity="0.8">
                    <g id="Groupe_834" data-name="Groupe 834" transform="translate(0 39.21)">
                        <path id="Tracé_166" data-name="Tracé 166" d="M84.328,78.791a9.638,9.638,0,0,1-2.464-.319L7.149,58.463A9.752,9.752,0,0,1,.317,46.625L9.744,11.489a2.416,2.416,0,0,1,4.668,1.247L4.989,47.862A4.9,4.9,0,0,0,8.42,53.8l74.685,20a4.81,4.81,0,0,0,5.88-3.4l3.774-13.983a2.417,2.417,0,0,1,4.668,1.256L93.658,71.635a9.651,9.651,0,0,1-9.33,7.156Z" transform="translate(0 -9.701)" fill="#f2f2f2"/>
                    </g>
                    <g id="Groupe_835" data-name="Groupe 835" transform="translate(19.325 2)">
                        <path id="Tracé_167" data-name="Tracé 167" d="M90.972,79.309H13.664A9.673,9.673,0,0,1,4,69.645V11.664A9.673,9.673,0,0,1,13.664,2H90.972a9.673,9.673,0,0,1,9.664,9.664V69.645A9.673,9.673,0,0,1,90.972,79.309ZM13.664,6.832a4.84,4.84,0,0,0-4.832,4.832V69.645a4.84,4.84,0,0,0,4.832,4.832H90.972A4.84,4.84,0,0,0,95.8,69.645V11.664a4.84,4.84,0,0,0-4.832-4.832Z" transform="translate(-4 -2)" fill="#f2f2f2"/>
                    </g>
                    <g id="Groupe_836" data-name="Groupe 836" transform="translate(33.821 16.495)">
                        <path id="Tracé_168" data-name="Tracé 168" d="M16.664,24.327a9.664,9.664,0,1,1,9.664-9.664A9.673,9.673,0,0,1,16.664,24.327Zm0-14.5A4.832,4.832,0,1,0,21.5,14.664,4.84,4.84,0,0,0,16.664,9.832Z" transform="translate(-7 -5)" fill="#f2f2f2"/>
                    </g>
                    <g id="Groupe_837" data-name="Groupe 837" transform="translate(19.662 28.816)">
                        <path id="Tracé_169" data-name="Tracé 169" d="M6.487,52.872a2.413,2.413,0,0,1-1.71-4.122L27.6,25.93a7.426,7.426,0,0,1,10.248,0l6.794,6.794L63.444,10.159A7.259,7.259,0,0,1,68.962,7.55h.053a7.243,7.243,0,0,1,5.5,2.527l25.27,29.484a2.416,2.416,0,1,1-3.667,3.146L70.851,13.223a2.39,2.39,0,0,0-1.836-.841,2.565,2.565,0,0,0-1.855.87l-20.5,24.6a2.407,2.407,0,0,1-1.749.865,2.326,2.326,0,0,1-1.817-.705l-8.663-8.663a2.482,2.482,0,0,0-3.416,0L8.192,52.167a2.407,2.407,0,0,1-1.706.705Z" transform="translate(-4.07 -7.55)" fill="#f2f2f2"/>
                    </g>
                </g>
            </svg>
            <img id="preview" class="previewPP">
        </div>
        <p style="line-height: 18px; font-size: 16px">Choisiser votre nouvelle photo de profil</p>
        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
            <input class="inputFile" type="file" name="filePP" id="file" onchange="previewImage();" accept="image/x-png,image/gif,image/jpeg,image/jpg">
            <button class="saveFile" name="savePP">Enregistrer</button>
        </form>
    </div>
    <?php
}
?>
<!--loader-->
<script>
    const loader = document.querySelector('.loader');
    window.addEventListener('load', () => {
        loader.classList.add('disparition');
    })
</script>
<!--les 3 modules d'edit + le drag and drop-->
<?php if (isset($_SESSION['user_uniqueid_USERS']) AND $userinfo['user_uniqueid_USERS'] == $_SESSION['user_uniqueid_USERS'])
{
    ?>
    <!--previw file-->
    <script>
        function previewImagebanner() {
            var file = document.getElementById("fileBanner").files;
            if (file.length > 0) {
                var  fileReader = new FileReader();

                fileReader.onload = function (event) {
                    document.getElementById("previewBanner").setAttribute("src", event.target.result);
                };

                fileReader.readAsDataURL(file[0])
            }
        }
        function previewImage() {
            var file = document.getElementById("file").files;
            if (file.length > 0) {
                var  fileReader = new FileReader();

                fileReader.onload = function (event) {
                    document.getElementById("preview").setAttribute("src", event.target.result);
                };

                fileReader.readAsDataURL(file[0])
            }
        }
    </script>
    <!--drag and drop-->
    <script>
        const dropArea = document.querySelector(".drag-area"),
            svgPelicule = document.querySelector(".svgPelicule"),
            dragTexte = document.querySelector(".editPP p");
        let file;
        /*entre dans la zone*/
        dropArea.addEventListener("dragover", (event)=>{
            event.preventDefault();
            svgPelicule.style.transform = "scale(1.1) rotate(-15deg)";
            dragTexte.textContent = "Lâcher votre image";
        });
        /*quite la zone*/
        dropArea.addEventListener("dragleave", ()=>{
            svgPelicule.style.transform = "scale(1) rotate(0deg)";
            dragTexte.textContent = "Glisser-déposer votre image";
        });
        /*drop le fichier*/
        dropArea.addEventListener("drop", (event)=>{
            event.preventDefault();
            svgPelicule.style.transform = "scale(1) rotate(0deg)";
            dragTexte.textContent = "Glisser-déposer une autre image ?";
            file = event.dataTransfer.files[0];
            showFile();
        });
        function showFile (){
            let fileType = file.type;
            let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
            if(validExtensions.includes(fileType)){
                let fileReader = new FileReader();
                fileReader.onload = ()=>{
                    let fileURL = fileReader.result;
                    let imgTag = `<img src="${fileURL}" alt="">`;
                    dropArea.innerHTML = imgTag;
                }
                fileReader.readAsDataURL(file);
            }else {
                alert("Utiliser une image .jpeg ou .jpg ou .png");
                svgPelicule.style.transform = "scale(1) rotate(0deg)";
            }
        }



        const dropArea2 = document.querySelector(".drag-areaB"),
            svgPelicule2 = document.querySelector(".svgPeliculeB"),
            dragTexte2 = document.querySelector(".p2");
        let file2;
        dropArea2.addEventListener("dragover", (event)=>{
            event.preventDefault();
            svgPelicule2.style.transform = "scale(1.1) rotate(-15deg)";
            dragTexte2.textContent = "Lâcher votre image";
        });
        /*quite la zone*/
        dropArea2.addEventListener("dragleave", ()=>{
            svgPelicule2.style.transform = "scale(1) rotate(0deg)";
            dragTexte2.textContent = "Glisser-déposer votre image";
        });
        /*drop le fichier*/
        dropArea2.addEventListener("drop", (event)=>{
            event.preventDefault();
            svgPelicule2.style.transform = "scale(1) rotate(0deg)";
            dragTexte2.textContent = "Glisser-déposer une autre image ?";
            file2 = event.dataTransfer.files[0];
            showFile2();
        });
        function showFile2 (){
            let fileType = file2.type;
            let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
            if(validExtensions.includes(fileType)){
                let fileReader = new FileReader();
                fileReader.onload = ()=>{
                    let fileURL = fileReader.result;
                    let imgTag = `<img src="${fileURL}" alt="">`;
                    dropArea2.innerHTML = imgTag;
                }
                fileReader.readAsDataURL(file2);
            }else {
                alert("Utiliser une image .jpeg ou .jpg ou .png");
                svgPelicule2.style.transform = "scale(1) rotate(0deg)";
            }
        }
    </script>
    <!--les 3 modules d'edit-->
    <script>
        const banner = document.querySelector(".banniere"),
            photodeprofil = document.querySelector(".photodeprofil"),
            editBanner = document.querySelector(".editBanner"),
            header = document.querySelector("header"),
            main = document.querySelector("main"),
            aside = document.querySelector("aside"),
            editPP = document.querySelector(".editPP"),
            pageEdit = document.querySelector(".editPage"),
            openEdit = document.querySelector(".edit"),
            btncloseA= document.querySelector(".closeA"),
            camA= document.querySelector(".camA"),
            btncloseB= document.querySelector(".closeB"),
            camB= document.querySelector(".camB"),
            closeEdit = document.querySelector(".editCTA");


        banner.addEventListener('click', apparitionEditBanner);
        camB.addEventListener('click', apparitionEditBanner);
        photodeprofil.addEventListener('click', apparitionEditPP);
        camA.addEventListener('click', apparitionEditPP);

        btncloseA.addEventListener('click', disparitionEditBanner);
        btncloseB.addEventListener('click', disparitionEditPP);

        openEdit.addEventListener('click', apparition);
        closeEdit.addEventListener('click', disparition);

        function apparitionEditBanner() {
            editBanner.classList.add("displayBlock");
            header.classList.add("flou");
            main.classList.add("flou");
            aside.classList.add("flou");
            editPP.classList.remove("displayBlock");
        }
        function apparitionEditPP() {
            editPP.classList.add("displayBlock");
            header.classList.add("flou");
            main.classList.add("flou");
            aside.classList.add("flou");
            editBanner.classList.remove("displayBlock");
        }

        function disparitionEditBanner() {
            editBanner.classList.remove("displayBlock");
            header.classList.remove("flou");
            main.classList.remove("flou");
            aside.classList.remove("flou");
        }
        function disparitionEditPP() {
            editPP.classList.remove("displayBlock");
            header.classList.remove("flou");
            main.classList.remove("flou");
            aside.classList.remove("flou");
        }

        function apparition() {
            pageEdit.classList.add("displayBlock");
            header.classList.add("flou");
            main.classList.add("flou");
            aside.classList.add("flou");
        }
        function disparition() {
            pageEdit.classList.remove("displayBlock");
            header.classList.remove("flou");
            main.classList.remove("flou");
            aside.classList.remove("flou");
        }
    </script>
    <?php
}
?>
<!--ajax de la barre de recherche-->
<script>
    const searchBar = document.querySelector(".search-input"),
        searchBtn = document.querySelector(".search-button"),
        userList = document.querySelector(".search-recommandation");

    searchBar.onkeyup = ()=>{
        let searchTerm = searchBar.value;
        if(searchTerm !=""){
            searchBar.classList.add("active");
        }else{
            searchBar.classList.remove("active");
        }
        //start Ajax
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/search.php", true);
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
<!--ajax de l'edit de collami-->
<script>
    const collamiSearchBar = document.querySelector(".search-collami"),
        collamiUserList = document.querySelector(".collami-recommandation");

    collamiSearchBar.onkeyup = ()=>{
        let searchTerm = collamiSearchBar.value;
        if(searchTerm !=""){
            collamiSearchBar.classList.add("active");
        }else{
            collamiSearchBar.classList.remove("active");
        }
        //start Ajax
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/search-collami.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    collamiUserList.innerHTML = data;
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("searchTerm=" + searchTerm);
    }
</script>
