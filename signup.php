<?php
require_once ('recaptcha/autoload.php');
if(isset($_POST['submit'])) {
    if (isset($_POST['g-recaptcha-response'])) {
        $recaptcha = new \ReCaptcha\ReCaptcha('6LfOP5QaAAAAACrDMq8b25Ca0Trxx7iVY7mmbcP-');
        $resp = $recaptcha->verify($_POST['g-recaptcha-response']);
    }
}

include_once "configPDO.php";

if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = sha1($_POST['password']);
    $password2 = sha1($_POST['password2']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $age = htmlspecialchars($_POST['age']);

    if(!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['password2']) AND !empty($_POST['pseudo']) AND !empty($_POST['age']) AND !empty($_POST['interest'])){
        $usernamelenght = strlen($username);
        if($usernamelenght <= 25) {
            $requsername = $bdd->prepare("SELECT * FROM users WHERE user_username_USERS = ?");
            $requsername->execute(array($username));
            $usernameexist = $requsername->rowCount();
            $nom_img = "pp.png";
            $nom_banner = "banner.png";
                if ($usernameexist == 0) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $reqmail = $bdd->prepare("SELECT * FROM users WHERE user_mail_USERS = ?");
                        $reqmail->execute(array($email));
                        $mailexist = $reqmail->rowCount();
                        if ($mailexist == 0) {
                            if ($password == $password2) {
                                $ran_id = rand(time(), 100000000);
                                $insertuser = $bdd->prepare("INSERT INTO users(user_uniqueid_USERS,user_username_USERS,user_mail_USERS,user_password_USERS,user_name_USERS,user_age_USERS,user_profilPicture_USERS,user_banner_USERS) VALUES(?,?,?,?,?,?,?,?)");
                                $insertuser->execute(array($ran_id, $username, $email, $password2, $pseudo, $age, $nom_img, $nom_banner));
                                $_SESSION['comptecree'] = "Votre compte a bien été créé !";
                                header("Location: login.php");
                            } else {
                                $erreurpassword = "Votre mot de passe n'a pas été confirmé";
                            }
                        } else {
                            $erreurmail = "Adresse mail déjà utilisée";
                        }
                    } else {
                        $erreurmailcorrect = "Adresse mail pas correcte";
                    }
                } else {
                    $erreurusername = "Nom d'utilisateur déjà utilisé";
                }
        }else{
            $erreurusernamenb = "Votre pseudo ne doit pas faire plus de 25 caractères.";
        }
    }else{
        $erreur = "";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CollabyU | Inscription</title>
    <meta name="description" content="Inscrivez-vous à CollabyU et démarrez de toutes nouvelles collaborations musicales en ligne.">

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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>

<header>
    <div class="gauche">
        <div class="shader"></div>
    </div>
    <div class="droite">
        <svg class="grille2points" xmlns="http://www.w3.org/2000/svg" width="549" height="408" viewBox="0 0 549 408">
            <g id="grille_de_point" data-name="grille de point" transform="translate(-1376.6 -43.6)" opacity="0.47">
                <g id="Groupe_30" data-name="Groupe 30" transform="translate(1658.128 44)">
                    <g id="Groupe_25" data-name="Groupe 25" transform="translate(224.903)">
                        <circle id="Ellipse_3" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.431 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_6" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.431 28.6)" fill="#fff"/>
                        <circle id="Ellipse_7" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.431 56.6)" fill="#fff"/>
                        <circle id="Ellipse_8" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.431 84.6)" fill="#fff"/>
                        <circle id="Ellipse_9" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.431 112.6)" fill="#fff"/>
                        <circle id="Ellipse_10" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.569 84.6)" fill="#fff"/>
                        <circle id="Ellipse_13" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.569 112.6)" fill="#fff"/>
                        <circle id="Ellipse_11" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.569 56.6)" fill="#fff"/>
                        <circle id="Ellipse_12" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.569 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_5" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.569 28.6)" fill="#fff"/>
                    </g>
                    <g id="Groupe_26" data-name="Groupe 26" transform="translate(168.677)">
                        <circle id="Ellipse_3-2" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.205 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_6-2" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.205 28.6)" fill="#fff"/>
                        <circle id="Ellipse_7-2" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.205 56.6)" fill="#fff"/>
                        <circle id="Ellipse_8-2" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.205 84.6)" fill="#fff"/>
                        <circle id="Ellipse_9-2" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.205 112.6)" fill="#fff"/>
                        <circle id="Ellipse_10-2" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(27.795 84.6)" fill="#fff"/>
                        <circle id="Ellipse_13-2" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(27.795 112.6)" fill="#fff"/>
                        <circle id="Ellipse_11-2" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(27.795 56.6)" fill="#fff"/>
                        <circle id="Ellipse_12-2" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(27.795 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_5-2" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(27.795 28.6)" fill="#fff"/>
                    </g>
                    <g id="Groupe_27" data-name="Groupe 27" transform="translate(112.451)">
                        <circle id="Ellipse_3-3" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.021 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_6-3" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.021 28.6)" fill="#fff"/>
                        <circle id="Ellipse_7-3" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.021 56.6)" fill="#fff"/>
                        <circle id="Ellipse_8-3" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.021 84.6)" fill="#fff"/>
                        <circle id="Ellipse_9-3" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.021 112.6)" fill="#fff"/>
                        <circle id="Ellipse_10-3" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.021 84.6)" fill="#fff"/>
                        <circle id="Ellipse_13-3" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.021 112.6)" fill="#fff"/>
                        <circle id="Ellipse_11-3" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.021 56.6)" fill="#fff"/>
                        <circle id="Ellipse_12-3" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.021 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_5-3" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.021 28.6)" fill="#fff"/>
                    </g>
                    <g id="Groupe_28" data-name="Groupe 28" transform="translate(56.226)">
                        <circle id="Ellipse_3-4" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.246 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_6-4" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.246 28.6)" fill="#fff"/>
                        <circle id="Ellipse_7-4" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.246 56.6)" fill="#fff"/>
                        <circle id="Ellipse_8-4" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.246 84.6)" fill="#fff"/>
                        <circle id="Ellipse_9-4" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.246 112.6)" fill="#fff"/>
                        <circle id="Ellipse_10-4" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.246 84.6)" fill="#fff"/>
                        <circle id="Ellipse_13-4" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.246 112.6)" fill="#fff"/>
                        <circle id="Ellipse_11-4" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.246 56.6)" fill="#fff"/>
                        <circle id="Ellipse_12-4" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.246 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_5-4" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.246 28.6)" fill="#fff"/>
                    </g>
                    <g id="Groupe_29" data-name="Groupe 29">
                        <circle id="Ellipse_3-5" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.472 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_6-5" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.472 28.6)" fill="#fff"/>
                        <circle id="Ellipse_7-5" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.472 56.6)" fill="#fff"/>
                        <circle id="Ellipse_8-5" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.472 84.6)" fill="#fff"/>
                        <circle id="Ellipse_9-5" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.472 112.6)" fill="#fff"/>
                        <circle id="Ellipse_10-5" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.472 84.6)" fill="#fff"/>
                        <circle id="Ellipse_13-5" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.472 112.6)" fill="#fff"/>
                        <circle id="Ellipse_11-5" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.472 56.6)" fill="#fff"/>
                        <circle id="Ellipse_12-5" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.472 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_5-5" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.472 28.6)" fill="#fff"/>
                    </g>
                </g>
                <g id="Groupe_31" data-name="Groupe 31" transform="translate(1658.128 184.564)">
                    <g id="Groupe_25-2" data-name="Groupe 25" transform="translate(224.903 0)">
                        <circle id="Ellipse_3-6" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.431 0.036)" fill="#fff"/>
                        <circle id="Ellipse_6-6" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.431 28.036)" fill="#fff"/>
                        <circle id="Ellipse_7-6" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.431 56.036)" fill="#fff"/>
                        <circle id="Ellipse_8-6" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.431 84.036)" fill="#fff"/>
                        <circle id="Ellipse_9-6" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.431 112.036)" fill="#fff"/>
                        <circle id="Ellipse_10-6" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.569 84.036)" fill="#fff"/>
                        <circle id="Ellipse_13-6" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.569 112.036)" fill="#fff"/>
                        <circle id="Ellipse_11-6" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.569 56.036)" fill="#fff"/>
                        <circle id="Ellipse_12-6" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.569 0.036)" fill="#fff"/>
                        <circle id="Ellipse_5-6" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.569 28.036)" fill="#fff"/>
                    </g>
                    <g id="Groupe_26-2" data-name="Groupe 26" transform="translate(168.677 0)">
                        <circle id="Ellipse_3-7" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.205 0.036)" fill="#fff"/>
                        <circle id="Ellipse_6-7" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.205 28.036)" fill="#fff"/>
                        <circle id="Ellipse_7-7" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.205 56.036)" fill="#fff"/>
                        <circle id="Ellipse_8-7" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.205 84.036)" fill="#fff"/>
                        <circle id="Ellipse_9-7" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.205 112.036)" fill="#fff"/>
                        <circle id="Ellipse_10-7" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(27.795 84.036)" fill="#fff"/>
                        <circle id="Ellipse_13-7" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(27.795 112.036)" fill="#fff"/>
                        <circle id="Ellipse_11-7" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(27.795 56.036)" fill="#fff"/>
                        <circle id="Ellipse_12-7" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(27.795 0.036)" fill="#fff"/>
                        <circle id="Ellipse_5-7" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(27.795 28.036)" fill="#fff"/>
                    </g>
                    <g id="Groupe_27-2" data-name="Groupe 27" transform="translate(112.451 0)">
                        <circle id="Ellipse_3-8" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.021 0.036)" fill="#fff"/>
                        <circle id="Ellipse_6-8" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.021 28.036)" fill="#fff"/>
                        <circle id="Ellipse_7-8" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.021 56.036)" fill="#fff"/>
                        <circle id="Ellipse_8-8" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.021 84.036)" fill="#fff"/>
                        <circle id="Ellipse_9-8" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.021 112.036)" fill="#fff"/>
                        <circle id="Ellipse_10-8" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.021 84.036)" fill="#fff"/>
                        <circle id="Ellipse_13-8" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.021 112.036)" fill="#fff"/>
                        <circle id="Ellipse_11-8" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.021 56.036)" fill="#fff"/>
                        <circle id="Ellipse_12-8" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.021 0.036)" fill="#fff"/>
                        <circle id="Ellipse_5-8" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.021 28.036)" fill="#fff"/>
                    </g>
                    <g id="Groupe_28-2" data-name="Groupe 28" transform="translate(56.226 0)">
                        <circle id="Ellipse_3-9" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.246 0.036)" fill="#fff"/>
                        <circle id="Ellipse_6-9" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.246 28.036)" fill="#fff"/>
                        <circle id="Ellipse_7-9" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.246 56.036)" fill="#fff"/>
                        <circle id="Ellipse_8-9" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.246 84.036)" fill="#fff"/>
                        <circle id="Ellipse_9-9" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.246 112.036)" fill="#fff"/>
                        <circle id="Ellipse_10-9" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.246 84.036)" fill="#fff"/>
                        <circle id="Ellipse_13-9" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.246 112.036)" fill="#fff"/>
                        <circle id="Ellipse_11-9" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.246 56.036)" fill="#fff"/>
                        <circle id="Ellipse_12-9" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.246 0.036)" fill="#fff"/>
                        <circle id="Ellipse_5-9" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.246 28.036)" fill="#fff"/>
                    </g>
                    <g id="Groupe_29-2" data-name="Groupe 29" transform="translate(0 0)">
                        <circle id="Ellipse_3-10" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.472 0.036)" fill="#fff"/>
                        <circle id="Ellipse_6-10" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.472 28.036)" fill="#fff"/>
                        <circle id="Ellipse_7-10" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.472 56.036)" fill="#fff"/>
                        <circle id="Ellipse_8-10" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.472 84.036)" fill="#fff"/>
                        <circle id="Ellipse_9-10" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.472 112.036)" fill="#fff"/>
                        <circle id="Ellipse_10-10" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.472 84.036)" fill="#fff"/>
                        <circle id="Ellipse_13-10" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.472 112.036)" fill="#fff"/>
                        <circle id="Ellipse_11-10" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.472 56.036)" fill="#fff"/>
                        <circle id="Ellipse_12-10" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.472 0.036)" fill="#fff"/>
                        <circle id="Ellipse_5-10" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.472 28.036)" fill="#fff"/>
                    </g>
                </g>
                <g id="Groupe_32" data-name="Groupe 32" transform="translate(1658.128 325.128)">
                    <g id="Groupe_25-3" data-name="Groupe 25" transform="translate(224.903 0)">
                        <circle id="Ellipse_3-11" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.431 0.472)" fill="#fff"/>
                        <circle id="Ellipse_6-11" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.431 28.472)" fill="#fff"/>
                        <circle id="Ellipse_7-11" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.431 56.472)" fill="#fff"/>
                        <circle id="Ellipse_8-11" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.431 84.472)" fill="#fff"/>
                        <circle id="Ellipse_9-11" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.431 112.472)" fill="#fff"/>
                        <circle id="Ellipse_10-11" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.569 84.472)" fill="#fff"/>
                        <circle id="Ellipse_13-11" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.569 112.472)" fill="#fff"/>
                        <circle id="Ellipse_11-11" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.569 56.472)" fill="#fff"/>
                        <circle id="Ellipse_12-11" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.569 0.472)" fill="#fff"/>
                        <circle id="Ellipse_5-11" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.569 28.472)" fill="#fff"/>
                    </g>
                    <g id="Groupe_26-3" data-name="Groupe 26" transform="translate(168.677 0)">
                        <circle id="Ellipse_3-12" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.205 0.472)" fill="#fff"/>
                        <circle id="Ellipse_6-12" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.205 28.472)" fill="#fff"/>
                        <circle id="Ellipse_7-12" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.205 56.472)" fill="#fff"/>
                        <circle id="Ellipse_8-12" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.205 84.472)" fill="#fff"/>
                        <circle id="Ellipse_9-12" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.205 112.472)" fill="#fff"/>
                        <circle id="Ellipse_10-12" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(27.795 84.472)" fill="#fff"/>
                        <circle id="Ellipse_13-12" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(27.795 112.472)" fill="#fff"/>
                        <circle id="Ellipse_11-12" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(27.795 56.472)" fill="#fff"/>
                        <circle id="Ellipse_12-12" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(27.795 0.472)" fill="#fff"/>
                        <circle id="Ellipse_5-12" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(27.795 28.472)" fill="#fff"/>
                    </g>
                    <g id="Groupe_27-3" data-name="Groupe 27" transform="translate(112.451 0)">
                        <circle id="Ellipse_3-13" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.021 0.472)" fill="#fff"/>
                        <circle id="Ellipse_6-13" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.021 28.472)" fill="#fff"/>
                        <circle id="Ellipse_7-13" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.021 56.472)" fill="#fff"/>
                        <circle id="Ellipse_8-13" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.021 84.472)" fill="#fff"/>
                        <circle id="Ellipse_9-13" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.021 112.472)" fill="#fff"/>
                        <circle id="Ellipse_10-13" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.021 84.472)" fill="#fff"/>
                        <circle id="Ellipse_13-13" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.021 112.472)" fill="#fff"/>
                        <circle id="Ellipse_11-13" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.021 56.472)" fill="#fff"/>
                        <circle id="Ellipse_12-13" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.021 0.472)" fill="#fff"/>
                        <circle id="Ellipse_5-13" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.021 28.472)" fill="#fff"/>
                    </g>
                    <g id="Groupe_28-3" data-name="Groupe 28" transform="translate(56.226 0)">
                        <circle id="Ellipse_3-14" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.246 0.472)" fill="#fff"/>
                        <circle id="Ellipse_6-14" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.246 28.472)" fill="#fff"/>
                        <circle id="Ellipse_7-14" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.246 56.472)" fill="#fff"/>
                        <circle id="Ellipse_8-14" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.246 84.472)" fill="#fff"/>
                        <circle id="Ellipse_9-14" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.246 112.472)" fill="#fff"/>
                        <circle id="Ellipse_10-14" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.246 84.472)" fill="#fff"/>
                        <circle id="Ellipse_13-14" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.246 112.472)" fill="#fff"/>
                        <circle id="Ellipse_11-14" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.246 56.472)" fill="#fff"/>
                        <circle id="Ellipse_12-14" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.246 0.472)" fill="#fff"/>
                        <circle id="Ellipse_5-14" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.246 28.472)" fill="#fff"/>
                    </g>
                    <g id="Groupe_29-3" data-name="Groupe 29" transform="translate(0 0)">
                        <circle id="Ellipse_3-15" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.472 0.472)" fill="#fff"/>
                        <circle id="Ellipse_6-15" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.472 28.472)" fill="#fff"/>
                        <circle id="Ellipse_7-15" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.472 56.472)" fill="#fff"/>
                        <circle id="Ellipse_8-15" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.472 84.472)" fill="#fff"/>
                        <circle id="Ellipse_9-15" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.472 112.472)" fill="#fff"/>
                        <circle id="Ellipse_10-15" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.472 84.472)" fill="#fff"/>
                        <circle id="Ellipse_13-15" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.472 112.472)" fill="#fff"/>
                        <circle id="Ellipse_11-15" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.472 56.472)" fill="#fff"/>
                        <circle id="Ellipse_12-15" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.472 0.472)" fill="#fff"/>
                        <circle id="Ellipse_5-15" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.472 28.472)" fill="#fff"/>
                    </g>
                </g>
                <g id="Groupe_35" data-name="Groupe 35" transform="translate(1377 325.128)">
                    <g id="Groupe_25-4" data-name="Groupe 25" transform="translate(224.903 0)">
                        <circle id="Ellipse_3-16" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.302 0.472)" fill="#fff"/>
                        <circle id="Ellipse_6-16" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.302 28.472)" fill="#fff"/>
                        <circle id="Ellipse_7-16" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.302 56.472)" fill="#fff"/>
                        <circle id="Ellipse_8-16" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.302 84.472)" fill="#fff"/>
                        <circle id="Ellipse_9-16" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.302 112.472)" fill="#fff"/>
                        <circle id="Ellipse_10-16" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(27.698 84.472)" fill="#fff"/>
                        <circle id="Ellipse_13-16" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(27.698 112.472)" fill="#fff"/>
                        <circle id="Ellipse_11-16" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(27.698 56.472)" fill="#fff"/>
                        <circle id="Ellipse_12-16" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(27.698 0.472)" fill="#fff"/>
                        <circle id="Ellipse_5-16" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(27.698 28.472)" fill="#fff"/>
                    </g>
                    <g id="Groupe_26-4" data-name="Groupe 26" transform="translate(168.677 0)">
                        <circle id="Ellipse_3-17" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.077 0.472)" fill="#fff"/>
                        <circle id="Ellipse_6-17" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.077 28.472)" fill="#fff"/>
                        <circle id="Ellipse_7-17" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.077 56.472)" fill="#fff"/>
                        <circle id="Ellipse_8-17" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.077 84.472)" fill="#fff"/>
                        <circle id="Ellipse_9-17" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.077 112.472)" fill="#fff"/>
                        <circle id="Ellipse_10-17" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(27.923 84.472)" fill="#fff"/>
                        <circle id="Ellipse_13-17" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(27.923 112.472)" fill="#fff"/>
                        <circle id="Ellipse_11-17" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(27.923 56.472)" fill="#fff"/>
                        <circle id="Ellipse_12-17" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(27.923 0.472)" fill="#fff"/>
                        <circle id="Ellipse_5-17" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(27.923 28.472)" fill="#fff"/>
                    </g>
                    <g id="Groupe_27-4" data-name="Groupe 27" transform="translate(112.451 0)">
                        <circle id="Ellipse_3-18" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.149 0.472)" fill="#fff"/>
                        <circle id="Ellipse_6-18" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.149 28.472)" fill="#fff"/>
                        <circle id="Ellipse_7-18" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.149 56.472)" fill="#fff"/>
                        <circle id="Ellipse_8-18" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.149 84.472)" fill="#fff"/>
                        <circle id="Ellipse_9-18" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.149 112.472)" fill="#fff"/>
                        <circle id="Ellipse_10-18" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.149 84.472)" fill="#fff"/>
                        <circle id="Ellipse_13-18" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.149 112.472)" fill="#fff"/>
                        <circle id="Ellipse_11-18" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.149 56.472)" fill="#fff"/>
                        <circle id="Ellipse_12-18" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.149 0.472)" fill="#fff"/>
                        <circle id="Ellipse_5-18" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.149 28.472)" fill="#fff"/>
                    </g>
                    <g id="Groupe_28-4" data-name="Groupe 28" transform="translate(56.226 0)">
                        <circle id="Ellipse_3-19" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.374 0.472)" fill="#fff"/>
                        <circle id="Ellipse_6-19" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.374 28.472)" fill="#fff"/>
                        <circle id="Ellipse_7-19" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.374 56.472)" fill="#fff"/>
                        <circle id="Ellipse_8-19" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.374 84.472)" fill="#fff"/>
                        <circle id="Ellipse_9-19" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.374 112.472)" fill="#fff"/>
                        <circle id="Ellipse_10-19" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.374 84.472)" fill="#fff"/>
                        <circle id="Ellipse_13-19" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.374 112.472)" fill="#fff"/>
                        <circle id="Ellipse_11-19" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.374 56.472)" fill="#fff"/>
                        <circle id="Ellipse_12-19" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.374 0.472)" fill="#fff"/>
                        <circle id="Ellipse_5-19" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.374 28.472)" fill="#fff"/>
                    </g>
                    <g id="Groupe_29-4" data-name="Groupe 29" transform="translate(0 0)">
                        <circle id="Ellipse_3-20" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.4 0.472)" fill="#fff"/>
                        <circle id="Ellipse_6-20" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.4 28.472)" fill="#fff"/>
                        <circle id="Ellipse_7-20" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.4 56.472)" fill="#fff"/>
                        <circle id="Ellipse_8-20" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.4 84.472)" fill="#fff"/>
                        <circle id="Ellipse_9-20" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.4 112.472)" fill="#fff"/>
                        <circle id="Ellipse_10-20" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.6 84.472)" fill="#fff"/>
                        <circle id="Ellipse_13-20" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.6 112.472)" fill="#fff"/>
                        <circle id="Ellipse_11-20" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.6 56.472)" fill="#fff"/>
                        <circle id="Ellipse_12-20" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.6 0.472)" fill="#fff"/>
                        <circle id="Ellipse_5-20" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.6 28.472)" fill="#fff"/>
                    </g>
                </g>
                <g id="Groupe_36" data-name="Groupe 36" transform="translate(1377 184.564)">
                    <g id="Groupe_25-5" data-name="Groupe 25" transform="translate(224.903 0)">
                        <circle id="Ellipse_3-21" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.302 0.036)" fill="#fff"/>
                        <circle id="Ellipse_6-21" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.302 28.036)" fill="#fff"/>
                        <circle id="Ellipse_7-21" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.302 56.036)" fill="#fff"/>
                        <circle id="Ellipse_8-21" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.302 84.036)" fill="#fff"/>
                        <circle id="Ellipse_9-21" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.302 112.036)" fill="#fff"/>
                        <circle id="Ellipse_10-21" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(27.698 84.036)" fill="#fff"/>
                        <circle id="Ellipse_13-21" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(27.698 112.036)" fill="#fff"/>
                        <circle id="Ellipse_11-21" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(27.698 56.036)" fill="#fff"/>
                        <circle id="Ellipse_12-21" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(27.698 0.036)" fill="#fff"/>
                        <circle id="Ellipse_5-21" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(27.698 28.036)" fill="#fff"/>
                    </g>
                    <g id="Groupe_26-5" data-name="Groupe 26" transform="translate(168.677 0)">
                        <circle id="Ellipse_3-22" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.077 0.036)" fill="#fff"/>
                        <circle id="Ellipse_6-22" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.077 28.036)" fill="#fff"/>
                        <circle id="Ellipse_7-22" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.077 56.036)" fill="#fff"/>
                        <circle id="Ellipse_8-22" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.077 84.036)" fill="#fff"/>
                        <circle id="Ellipse_9-22" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.077 112.036)" fill="#fff"/>
                        <circle id="Ellipse_10-22" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(27.923 84.036)" fill="#fff"/>
                        <circle id="Ellipse_13-22" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(27.923 112.036)" fill="#fff"/>
                        <circle id="Ellipse_11-22" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(27.923 56.036)" fill="#fff"/>
                        <circle id="Ellipse_12-22" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(27.923 0.036)" fill="#fff"/>
                        <circle id="Ellipse_5-22" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(27.923 28.036)" fill="#fff"/>
                    </g>
                    <g id="Groupe_27-5" data-name="Groupe 27" transform="translate(112.451 0)">
                        <circle id="Ellipse_3-23" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.149 0.036)" fill="#fff"/>
                        <circle id="Ellipse_6-23" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.149 28.036)" fill="#fff"/>
                        <circle id="Ellipse_7-23" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.149 56.036)" fill="#fff"/>
                        <circle id="Ellipse_8-23" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.149 84.036)" fill="#fff"/>
                        <circle id="Ellipse_9-23" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.149 112.036)" fill="#fff"/>
                        <circle id="Ellipse_10-23" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.149 84.036)" fill="#fff"/>
                        <circle id="Ellipse_13-23" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.149 112.036)" fill="#fff"/>
                        <circle id="Ellipse_11-23" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.149 56.036)" fill="#fff"/>
                        <circle id="Ellipse_12-23" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.149 0.036)" fill="#fff"/>
                        <circle id="Ellipse_5-23" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.149 28.036)" fill="#fff"/>
                    </g>
                    <g id="Groupe_28-5" data-name="Groupe 28" transform="translate(56.226 0)">
                        <circle id="Ellipse_3-24" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.374 0.036)" fill="#fff"/>
                        <circle id="Ellipse_6-24" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.374 28.036)" fill="#fff"/>
                        <circle id="Ellipse_7-24" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.374 56.036)" fill="#fff"/>
                        <circle id="Ellipse_8-24" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.374 84.036)" fill="#fff"/>
                        <circle id="Ellipse_9-24" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.374 112.036)" fill="#fff"/>
                        <circle id="Ellipse_10-24" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.374 84.036)" fill="#fff"/>
                        <circle id="Ellipse_13-24" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.374 112.036)" fill="#fff"/>
                        <circle id="Ellipse_11-24" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.374 56.036)" fill="#fff"/>
                        <circle id="Ellipse_12-24" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.374 0.036)" fill="#fff"/>
                        <circle id="Ellipse_5-24" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.374 28.036)" fill="#fff"/>
                    </g>
                    <g id="Groupe_29-5" data-name="Groupe 29" transform="translate(0 0)">
                        <circle id="Ellipse_3-25" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.4 0.036)" fill="#fff"/>
                        <circle id="Ellipse_6-25" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.4 28.036)" fill="#fff"/>
                        <circle id="Ellipse_7-25" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.4 56.036)" fill="#fff"/>
                        <circle id="Ellipse_8-25" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.4 84.036)" fill="#fff"/>
                        <circle id="Ellipse_9-25" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.4 112.036)" fill="#fff"/>
                        <circle id="Ellipse_10-25" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.6 84.036)" fill="#fff"/>
                        <circle id="Ellipse_13-25" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.6 112.036)" fill="#fff"/>
                        <circle id="Ellipse_11-25" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.6 56.036)" fill="#fff"/>
                        <circle id="Ellipse_12-25" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.6 0.036)" fill="#fff"/>
                        <circle id="Ellipse_5-25" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.6 28.036)" fill="#fff"/>
                    </g>
                </g>
                <g id="Groupe_37" data-name="Groupe 37" transform="translate(1377 44)">
                    <g id="Groupe_25-6" data-name="Groupe 25" transform="translate(224.903)">
                        <circle id="Ellipse_3-26" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.302 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_6-26" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.302 28.6)" fill="#fff"/>
                        <circle id="Ellipse_7-26" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.302 56.6)" fill="#fff"/>
                        <circle id="Ellipse_8-26" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.302 84.6)" fill="#fff"/>
                        <circle id="Ellipse_9-26" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.302 112.6)" fill="#fff"/>
                        <circle id="Ellipse_10-26" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(27.698 84.6)" fill="#fff"/>
                        <circle id="Ellipse_13-26" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(27.698 112.6)" fill="#fff"/>
                        <circle id="Ellipse_11-26" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(27.698 56.6)" fill="#fff"/>
                        <circle id="Ellipse_12-26" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(27.698 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_5-26" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(27.698 28.6)" fill="#fff"/>
                    </g>
                    <g id="Groupe_26-6" data-name="Groupe 26" transform="translate(168.677)">
                        <circle id="Ellipse_3-27" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.077 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_6-27" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.077 28.6)" fill="#fff"/>
                        <circle id="Ellipse_7-27" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.077 56.6)" fill="#fff"/>
                        <circle id="Ellipse_8-27" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.077 84.6)" fill="#fff"/>
                        <circle id="Ellipse_9-27" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.077 112.6)" fill="#fff"/>
                        <circle id="Ellipse_10-27" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(27.923 84.6)" fill="#fff"/>
                        <circle id="Ellipse_13-27" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(27.923 112.6)" fill="#fff"/>
                        <circle id="Ellipse_11-27" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(27.923 56.6)" fill="#fff"/>
                        <circle id="Ellipse_12-27" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(27.923 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_5-27" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(27.923 28.6)" fill="#fff"/>
                    </g>
                    <g id="Groupe_27-6" data-name="Groupe 27" transform="translate(112.451)">
                        <circle id="Ellipse_3-28" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.149 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_6-28" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.149 28.6)" fill="#fff"/>
                        <circle id="Ellipse_7-28" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.149 56.6)" fill="#fff"/>
                        <circle id="Ellipse_8-28" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.149 84.6)" fill="#fff"/>
                        <circle id="Ellipse_9-28" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.149 112.6)" fill="#fff"/>
                        <circle id="Ellipse_10-28" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.149 84.6)" fill="#fff"/>
                        <circle id="Ellipse_13-28" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.149 112.6)" fill="#fff"/>
                        <circle id="Ellipse_11-28" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.149 56.6)" fill="#fff"/>
                        <circle id="Ellipse_12-28" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.149 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_5-28" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.149 28.6)" fill="#fff"/>
                    </g>
                    <g id="Groupe_28-6" data-name="Groupe 28" transform="translate(56.226)">
                        <circle id="Ellipse_3-29" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(0.374 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_6-29" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(0.374 28.6)" fill="#fff"/>
                        <circle id="Ellipse_7-29" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(0.374 56.6)" fill="#fff"/>
                        <circle id="Ellipse_8-29" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(0.374 84.6)" fill="#fff"/>
                        <circle id="Ellipse_9-29" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(0.374 112.6)" fill="#fff"/>
                        <circle id="Ellipse_10-29" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.374 84.6)" fill="#fff"/>
                        <circle id="Ellipse_13-29" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.374 112.6)" fill="#fff"/>
                        <circle id="Ellipse_11-29" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.374 56.6)" fill="#fff"/>
                        <circle id="Ellipse_12-29" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.374 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_5-29" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.374 28.6)" fill="#fff"/>
                    </g>
                    <g id="Groupe_29-6" data-name="Groupe 29">
                        <circle id="Ellipse_3-30" data-name="Ellipse 3" cx="7" cy="7" r="7" transform="translate(-0.4 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_6-30" data-name="Ellipse 6" cx="7" cy="7" r="7" transform="translate(-0.4 28.6)" fill="#fff"/>
                        <circle id="Ellipse_7-30" data-name="Ellipse 7" cx="7" cy="7" r="7" transform="translate(-0.4 56.6)" fill="#fff"/>
                        <circle id="Ellipse_8-30" data-name="Ellipse 8" cx="7" cy="7" r="7" transform="translate(-0.4 84.6)" fill="#fff"/>
                        <circle id="Ellipse_9-30" data-name="Ellipse 9" cx="7" cy="7" r="7" transform="translate(-0.4 112.6)" fill="#fff"/>
                        <circle id="Ellipse_10-30" data-name="Ellipse 10" cx="7" cy="7" r="7" transform="translate(28.6 84.6)" fill="#fff"/>
                        <circle id="Ellipse_13-30" data-name="Ellipse 13" cx="7" cy="7" r="7" transform="translate(28.6 112.6)" fill="#fff"/>
                        <circle id="Ellipse_11-30" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(28.6 56.6)" fill="#fff"/>
                        <circle id="Ellipse_12-30" data-name="Ellipse 12" cx="7" cy="7" r="7" transform="translate(28.6 -0.4)" fill="#fff"/>
                        <circle id="Ellipse_5-30" data-name="Ellipse 5" cx="7" cy="7" r="7" transform="translate(28.6 28.6)" fill="#fff"/>
                    </g>
                </g>
            </g>
        </svg>
        <svg class="grille3points" xmlns="http://www.w3.org/2000/svg" width="1178.999" height="351" viewBox="0 0 1178.999 351">
            <path id="Exclusion_1" data-name="Exclusion 1" d="M891.5,706a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,706Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,706Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,683Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,683Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,660Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,660Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,637Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,637Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,614Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,614Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,591Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,591Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,568Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,568Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,545Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,545Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,522Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,522Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,499Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,499Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,476Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,476Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,453Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,453Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,430Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,430Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,407Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,407Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,384Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,384Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,361Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,361Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,338Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,338Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,315Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,315Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,292Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,292Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,269Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,269Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,246Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,246Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,223Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,223Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,200Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,200Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,177Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,177Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,154Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,154Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,131Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,131Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,108Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,108Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,85Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,85Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,62Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,62Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,39Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,39Zm345-23a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,891.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,868.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,845.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,822.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,799.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,776.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,753.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,730.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,707.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,684.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,661.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,638.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,615.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,592.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,569.5,16Zm-23,0a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,546.5,16Zm345-23A2.5,2.5,0,0,1,889-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,894-9.5,2.5,2.5,0,0,1,891.5-7Zm-23,0A2.5,2.5,0,0,1,866-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,871-9.5,2.5,2.5,0,0,1,868.5-7Zm-23,0A2.5,2.5,0,0,1,843-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,848-9.5,2.5,2.5,0,0,1,845.5-7Zm-23,0A2.5,2.5,0,0,1,820-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,825-9.5,2.5,2.5,0,0,1,822.5-7Zm-23,0A2.5,2.5,0,0,1,797-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,802-9.5,2.5,2.5,0,0,1,799.5-7Zm-23,0A2.5,2.5,0,0,1,774-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,779-9.5,2.5,2.5,0,0,1,776.5-7Zm-23,0A2.5,2.5,0,0,1,751-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,756-9.5,2.5,2.5,0,0,1,753.5-7Zm-23,0A2.5,2.5,0,0,1,728-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,733-9.5,2.5,2.5,0,0,1,730.5-7Zm-23,0A2.5,2.5,0,0,1,705-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,710-9.5,2.5,2.5,0,0,1,707.5-7Zm-23,0A2.5,2.5,0,0,1,682-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,687-9.5,2.5,2.5,0,0,1,684.5-7Zm-23,0A2.5,2.5,0,0,1,659-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,664-9.5,2.5,2.5,0,0,1,661.5-7Zm-23,0A2.5,2.5,0,0,1,636-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,641-9.5,2.5,2.5,0,0,1,638.5-7Zm-23,0A2.5,2.5,0,0,1,613-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,618-9.5,2.5,2.5,0,0,1,615.5-7Zm-23,0A2.5,2.5,0,0,1,590-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,595-9.5,2.5,2.5,0,0,1,592.5-7Zm-23,0A2.5,2.5,0,0,1,567-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,572-9.5,2.5,2.5,0,0,1,569.5-7Zm-23,0A2.5,2.5,0,0,1,544-9.5a2.5,2.5,0,0,1,2.5-2.5A2.5,2.5,0,0,1,549-9.5,2.5,2.5,0,0,1,546.5-7Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-30Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-30Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-53Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-53Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-76Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-76Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-99Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-99Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-122Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-122Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-145Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-145Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-168Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-168Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-191Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-191Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-214Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-214Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-237Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-237Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-260Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-260Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-283Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-283Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-306Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-306Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-329Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-329Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-352Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-352Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-375Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-375Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-398Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-398Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-421Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-421Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-444Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-444Zm345-23a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,891.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,868.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,845.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,822.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,799.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,776.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,753.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,730.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,707.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,684.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,661.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,638.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,615.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,592.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,569.5-467Zm-23,0a2.5,2.5,0,0,1-2.5-2.5,2.5,2.5,0,0,1,2.5-2.5,2.5,2.5,0,0,1,2.5,2.5A2.5,2.5,0,0,1,546.5-467Z" transform="translate(472.499 894.501) rotate(-90)" fill="#f2f2f2" stroke="rgba(0,0,0,0)" stroke-miterlimit="10" stroke-width="1" opacity="0.15"/>
        </svg>
        <a href="index.php" rel="noopener">
            <svg class="logo" xmlns="http://www.w3.org/2000/svg" width="266" height="69" viewBox="0 0 266 69">
                <g id="collabyU" transform="translate(-1061 -132)">
                    <g id="CollabyU-2" data-name="CollabyU" transform="translate(832.523 -608.719)">
                        <g id="Groupe_1" data-name="Groupe 1" transform="translate(283.953 755.165)">
                            <text id="CollabyU-3" data-name="CollabyU" transform="translate(6.523 46.554)" fill="#009380" font-size="44" font-family="Gotham-Bold, Gotham" font-weight="700" opacity="0.38"><tspan x="0" y="0">CollabyU</tspan></text>
                            <text id="CollabyU-4" data-name="CollabyU" transform="translate(-0.477 40.554)" fill="#ec1d53" font-size="44" font-family="Gotham-Bold, Gotham" font-weight="700" opacity="0.37"><tspan x="0" y="0">CollabyU</tspan></text>
                            <text id="CollabyU-5" data-name="CollabyU" transform="translate(2.523 43.554)" fill="#f2f2f2" font-size="44" font-family="Gotham-Bold, Gotham" font-weight="700"><tspan x="0" y="0">CollabyU</tspan></text>
                        </g>
                        <g id="logo_svg" data-name="logo svg" transform="translate(228 741.176)">
                            <path id="Rectangle_1" data-name="Rectangle 1" d="M10,0h8A10,10,0,0,1,28,10v0A10,10,0,0,1,18,20H0a0,0,0,0,1,0,0V10A10,10,0,0,1,10,0Z" transform="translate(30.476 -0.457)" fill="#009380"/>
                            <path id="Rectangle_2" data-name="Rectangle 2" d="M12,0H35a0,0,0,0,1,0,0V12A12,12,0,0,1,23,24H12A12,12,0,0,1,0,12v0A12,12,0,0,1,12,0Z" transform="translate(0.476 37.543)" fill="#ec1d53"/>
                            <path id="Rectangle_3" data-name="Rectangle 3" d="M3,0H5A0,0,0,0,1,5,0V11a3,3,0,0,1-3,3H0a0,0,0,0,1,0,0V3A3,3,0,0,1,3,0Z" transform="translate(30.476 21.542)" fill="#f2f2f2"/>
                        </g>
                    </g>
                </g>
            </svg>
        </a>
        <div class="card">
            <h1>S'inscrire</h1>
            <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="field input inputun">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23.9" height="27.961" viewBox="0 0 23.9 27.961">
                        <g id="icon_profil" data-name="icon profil" transform="translate(0.531)">
                            <g id="Ellipse_2583" data-name="Ellipse 2583" transform="translate(3.923)" fill="none" stroke="#f2f2f2" stroke-width="1">
                                <ellipse cx="7.027" cy="7" rx="7.027" ry="7" stroke="none"/>
                                <ellipse cx="7.027" cy="7" rx="6.527" ry="6.5" fill="none"/>
                            </g>
                            <path id="Tracé_123" data-name="Tracé 123" d="M4786.133,458.461H4808.9s1.23-10.4-11.445-10.4S4786.133,458.461,4786.133,458.461Z" transform="translate(-4786.091 -431)" fill="none" stroke="#f2f2f2" stroke-width="1"/>
                        </g>
                    </svg>
                    <input type="text" name="username" placeholder="Nom d'utilisateur" value="<?php if (isset($username)) {echo $username;}?>" autofocus required>
                </div>
                <?php
                if(!empty($erreurusername)){
                    ?>
                    <div class="error-text"><?=$erreurusername?></div>
                <?php }
                ?>
                <?php
                if(!empty($erreurusernamenb)){
                    ?>
                    <div class="error-text"><?=$erreurusernamenb?></div>
                <?php }
                ?>
                <div class="field input inputun">
                    <svg id="mail" xmlns="http://www.w3.org/2000/svg" width="23.64" height="16.622" viewBox="0 0 23.64 16.622">
                        <g id="Groupe_801" data-name="Groupe 801">
                            <path id="Tracé_130" data-name="Tracé 130" d="M21.562,76H2.078A2.081,2.081,0,0,0,0,78.078V90.544a2.081,2.081,0,0,0,2.078,2.078H21.562a2.08,2.08,0,0,0,2.078-2.078V78.078A2.08,2.08,0,0,0,21.562,76Zm-.291,1.385-7.982,7.94a2.078,2.078,0,0,1-2.94,0L2.369,77.385ZM1.385,90.262v-11.9l5.986,5.954Zm.984.974,5.983-5.945L9.371,86.3a3.463,3.463,0,0,0,4.9,0l1.02-1.014,5.983,5.945Zm19.885-.974-5.986-5.948,5.986-5.954Z" transform="translate(0 -76)" fill="#f2f2f2"/>
                        </g>
                    </svg>
                    <input type="email" name="email" value="<?php if (isset($email)) {echo $email;}?>" placeholder="Adresse mail" required>
                </div>
                <?php
                if(!empty($erreurmailcorrect)){
                    ?>
                    <div class="error-text"><?=$erreurmailcorrect?></div>
                <?php }
                ?>
                <?php
                if(!empty($erreurmail)){
                    ?>
                    <div class="error-text"><?=$erreurmail?></div>
                <?php }
                ?>
                <div class="field input inputdeux inputun">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21.082" height="27.074" viewBox="0 0 21.082 27.074">
                        <g id="icon_cadena" data-name="icon cadena" transform="translate(0 0.5)">
                            <path id="Tracé_122" data-name="Tracé 122" d="M4790.99,521.838v-5.887a4.464,4.464,0,0,1,4.693-4.239c4.508,0,4.86,3.191,4.86,4.239v5.887" transform="translate(-4785.225 -511.712)" fill="none" stroke="#009380" stroke-linejoin="round" stroke-width="1"/>
                            <g id="Rectangle_17" data-name="Rectangle 17" transform="translate(0 9.575)" fill="none" stroke="#f2f2f2" stroke-width="1">
                                <rect width="21.082" height="17" rx="4" stroke="none"/>
                                <rect x="0.5" y="0.5" width="20.082" height="16" rx="3.5" fill="none"/>
                            </g>
                            <g id="Ellipse_2582" data-name="Ellipse 2582" transform="translate(8.031 12.575)" fill="none" stroke="#ec1d53" stroke-width="1">
                                <ellipse cx="2.51" cy="2.5" rx="2.51" ry="2.5" stroke="none"/>
                                <ellipse cx="2.51" cy="2.5" rx="2.01" ry="2" fill="none"/>
                            </g>
                            <line id="Ligne_3" data-name="Ligne 3" y2="5" transform="translate(10.541 17.075)" fill="none" stroke="#ec1d53" stroke-linecap="round" stroke-width="1"/>
                        </g>
                    </svg>
                    <input type="password" name="password" placeholder="Mot de passe" required>
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
                            <path id="Tracé_126" data-name="Tracé 126" d="M1166.13,514.975a2.538,2.538,0,0,1-.264,2.232,1.363,1.363,0,0,1,1.8.867l.122.147c-.24-.582-.255-1.822.346-2.218C1167.444,516.306,1166.13,514.975,1166.13,514.975Z" transform="translate(-1165.866 -511.909)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.75"/>
                            <path id="Tracé_127" data-name="Tracé 127" d="M3.049,0a3.169,3.169,0,0,0,.4,3.052A2.139,2.139,0,0,0,.71,4.237s0,0-.185.2C.89,3.642.913,1.947,0,1.4,1.054,1.821,3.049,0,3.049,0Z" transform="translate(25.103 10.895) rotate(8)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                        </g>
                    </svg>
                    <input type="password" name="password2" placeholder="Comfirmer le mot de passe" required>
                    <i class="fas fa-eye"></i>
                </div>
                <?php
                    if(!empty($erreurpassword)){
                        ?>
                        <div class="error-text"><?=$erreurpassword?></div>
                    <?php }
                    ?>
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
                    <input type="text" name="pseudo" value="<?php if (isset($pseudo)) {echo $pseudo;}?>" placeholder="Pseudonyme" required>
                </div>
                <div class="field input">
                    <svg id="birthday-cake" xmlns="http://www.w3.org/2000/svg" width="25.071" height="25.478" viewBox="0 0 25.071 25.478">
                        <path id="Tracé_147" data-name="Tracé 147" d="M25.463,139.071V135.31a2.091,2.091,0,0,0-2.089-2.089H21.7v-4.179a.418.418,0,0,0-.418-.418H18.778a.418.418,0,0,0-.418.418v4.179H14.6v-5.014a.418.418,0,0,0-.418-.418H11.674a.418.418,0,0,0-.418.418v5.014H7.5v-4.179a.418.418,0,0,0-.418-.418H4.571a.418.418,0,0,0-.418.418v4.179H2.482A2.092,2.092,0,0,0,.392,135.31v3.761a2.424,2.424,0,0,0,1.254,2.161v4.525H.81a.418.418,0,0,0,0,.836H25.046a.418.418,0,0,0,0-.836H24.21v-4.518A2.515,2.515,0,0,0,25.463,139.071ZM19.2,129.46h1.671v3.761H19.2Zm-7.1-.836h1.671v4.6H12.092Zm-7.1.836H6.66v3.761H4.989Zm-3.761,5.85a1.253,1.253,0,0,1,1.254-1.254H23.374a1.253,1.253,0,0,1,1.254,1.254v3.761a1.682,1.682,0,0,1-1,1.533,1.709,1.709,0,0,1-1.853-.348,1.678,1.678,0,0,1-.489-1.185V137.4a1.667,1.667,0,0,0-.925-1.488l-.026-.014a1.6,1.6,0,0,0-.206-.081c-.042-.014-.08-.028-.121-.038a1.611,1.611,0,0,0-.162-.029c-.037-.005-.072-.016-.109-.019-.02,0-.039,0-.059,0s-.041-.006-.063-.006c-.046,0-.091.01-.137.013s-.095.006-.142.014a1.672,1.672,0,0,0-.213.055c-.038.012-.076.02-.113.034a1.6,1.6,0,0,0-.225.113c-.026.015-.054.026-.08.042a1.68,1.68,0,0,0-.271.219,1.66,1.66,0,0,0-.49,1.182v.836a1.671,1.671,0,1,1-3.343,0V137.4a1.667,1.667,0,0,0-.925-1.488l-.026-.014a1.6,1.6,0,0,0-.206-.081c-.042-.014-.08-.028-.121-.038a1.611,1.611,0,0,0-.162-.029c-.037-.005-.072-.016-.109-.019-.02,0-.039,0-.059,0s-.041-.006-.063-.006c-.046,0-.091.01-.137.013s-.095.006-.142.014a1.675,1.675,0,0,0-.213.055c-.038.012-.077.02-.113.034a1.624,1.624,0,0,0-.224.112c-.027.015-.055.026-.081.042a1.664,1.664,0,0,0-.761,1.4v2.507a1.671,1.671,0,0,1-3.343,0V137.4a1.667,1.667,0,0,0-.925-1.488l-.026-.014a1.6,1.6,0,0,0-.206-.081c-.042-.014-.08-.028-.121-.038a1.611,1.611,0,0,0-.162-.029c-.037-.005-.072-.016-.109-.019s-.08,0-.122,0A1.671,1.671,0,0,0,4.571,137.4v1.671a1.674,1.674,0,0,1-.486,1.182,1.724,1.724,0,0,1-1.561.443,1.667,1.667,0,0,1-.292-.091,1.72,1.72,0,0,1-.514-.349,1.678,1.678,0,0,1-.489-1.185Zm1.254,10.446v-4.213c.042.007.084.009.125.014l.032,0a2.516,2.516,0,0,0,1.082-.125,2.547,2.547,0,0,0,.31-.133l.064-.033a2.564,2.564,0,0,0,.236-.145c.024-.017.049-.032.073-.05a2.437,2.437,0,0,0,1-2V137.4a.83.83,0,0,1,.245-.59.847.847,0,0,1,.137-.11l.027-.014a.827.827,0,0,1,.128-.064l.039-.012a.8.8,0,0,1,.125-.031c.02,0,.042,0,.061-.006a.911.911,0,0,1,.106,0,1.07,1.07,0,0,1,.172.025l.03.009a.913.913,0,0,1,.6.869v2.437a2.507,2.507,0,0,0,5.014,0V137.4a.833.833,0,0,1,.383-.7l.023-.012a.834.834,0,0,1,.133-.066l.036-.011a.886.886,0,0,1,.125-.033l.06-.006a.833.833,0,0,1,.106,0,1.072,1.072,0,0,1,.172.025l.03.009a.913.913,0,0,1,.6.869v.765a2.507,2.507,0,1,0,5.014,0V137.4a.83.83,0,0,1,.245-.59.848.848,0,0,1,.137-.11l.028-.015a.858.858,0,0,1,.128-.063c.013,0,.027-.008.042-.012a.78.78,0,0,1,.123-.031c.02,0,.042,0,.061-.006a.918.918,0,0,1,.106,0,1.074,1.074,0,0,1,.172.025l.03.009a.913.913,0,0,1,.6.869v1.6a2.51,2.51,0,0,0,.734,1.776,2.553,2.553,0,0,0,.264.225c.027.02.055.037.084.056.07.048.141.092.215.133l.088.046a2.56,2.56,0,0,0,.259.111l.053.02a2.541,2.541,0,0,0,.71.134h0a2.5,2.5,0,0,0,.349-.01l.042,0c.042,0,.084-.006.125-.013v4.213Zm0,0" transform="translate(-0.392 -121.114)" fill="#f2f2f2"/>
                        <path id="Tracé_148" data-name="Tracé 148" d="M202.487,5.839a2.092,2.092,0,0,0,2.089-2.089c0-1-1.454-3.159-1.745-3.58a.434.434,0,0,0-.688,0c-.292.422-1.745,2.577-1.745,3.58A2.092,2.092,0,0,0,202.487,5.839Zm0-4.677a8.131,8.131,0,0,1,1.254,2.587,1.254,1.254,0,0,1-2.507,0A8.131,8.131,0,0,1,202.487,1.162Zm0,0" transform="translate(-189.951 0)" fill="#f2f2f2"/>
                        <path id="Tracé_149" data-name="Tracé 149" d="M338.487,21.839a2.092,2.092,0,0,0,2.089-2.089c0-1-1.454-3.159-1.745-3.58a.434.434,0,0,0-.688,0c-.292.422-1.745,2.577-1.745,3.58A2.092,2.092,0,0,0,338.487,21.839Zm0-4.677a8.131,8.131,0,0,1,1.254,2.587,1.254,1.254,0,0,1-2.507,0A8.131,8.131,0,0,1,338.487,17.162Zm0,0" transform="translate(-318.848 -15.164)" fill="#f2f2f2"/>
                        <path id="Tracé_150" data-name="Tracé 150" d="M66.487,21.839a2.092,2.092,0,0,0,2.089-2.089c0-1-1.454-3.159-1.745-3.58a.434.434,0,0,0-.688,0c-.292.422-1.745,2.577-1.745,3.58A2.092,2.092,0,0,0,66.487,21.839Zm0-4.677a8.131,8.131,0,0,1,1.254,2.587,1.254,1.254,0,1,1-2.507,0A8.131,8.131,0,0,1,66.487,17.162Zm0,0" transform="translate(-61.055 -15.164)" fill="#f2f2f2"/>
                    </svg>
                    <input type="number" name="age" min="1" max="100" value="<?php if (isset($age)) {echo $age;}?>" placeholder="Age" required>
                </div>
                <div class="g-recaptcha" data-sitekey="6LfOP5QaAAAAAOTF8Nr7ek3mUg2vp8LbR3Hgx42i"></div>
                <div class="field checkbox">
                    <input type="checkbox" id="coding" name="interest" value="CGU" required>
                    <label for="CGU"><p class="a">J'ai lu et j'accepte les conditions générales d'utilisations</p></label>
                </div>
                <div class="field button">
                    <input type="submit" class="ctaform" name="submit" value="S'inscrire">
                </div>
                <p>Tous les champs sont obligatoires</p>
                <?php
                if(!empty($erreurfile)){
                    ?>
                    <div class="error-text"><?=$erreurfile?></div>
                <?php }
                ?>
            </form>
        </div>
    </div>
</header>

<article class="CGU CGUdisplayblock">
    <div class="centreCGU">
        <h2>Condition Générale d'Utilisation de CollabyU</h2>
        <br>
        <br>
        <b>Politique de confidentialité</b>
        <p>Sécurité et protection des données personnelles</p>
        <br>
        <b>Définitions :</b>
        <p>L'Éditeur : Thomas Jeu. </p>
        <p>Le site : collabyu.thomasjeu.fr</p>
        <p>L'utilisateur : La personne utilisant le Site et les services.</p>
        <br>
        <b>Nature des données collectées</b>
        <p>Dans le cadre de l'utilisation des Sites, l'Éditeur est susceptible de collecter les catégories de données suivantes concernant ses Utilisateurs : </p>
        <p>- Données d'état-civil, d'identité, d'identification... </p>
        <p>- Données relatives à la vie personnelle ( habitudes de vie, situation familiale, hors données sensibles ou dangereuses) </p>
        <br>
        <b>Communication des données personnelles à des tiers</b>
        <i>Pas de communication à des tiers</i>
        <p>Vos données ne font l'objet d'aucune communication à des tiers. Vous êtes toutefois informés qu'elles pourront être divulguées en application d'une loi, d'un règlement ou en vertu d'une décision d'une autorité réglementaire ou judiciaire compétente. </p>
        <br>
        <b>Information préalable pour la communication des données personnelles à des tiers en cas de fusion/absorption </b>
        <i>Collecte de l’opt-in ( consentement ) préalable à la transmission des données suite à une fusion/acquisition. </i>
        <p>Dans le cas où nous prendrons part à une opération de fusion, d’acquisition ou à toute autre forme de cession d’actifs, nous nous engageons à obtenir votre consentement préalable à la transmission de vos données personnelles et à maintenir le niveau de confidentialité de vos données personnelles auquel vous avez consenti. </p>
        <br>
        <b>Finalité de la réutilisation des données personnelles collectées</b>
        <p>Effectuer les opérations relatives à la gestion des clients concernant :</p>
        <p>- les contrats ; les commandes ; les livraisons ; les factures ; la comptabilité et en particulier la gestion des comptes clients ;</p>
        <p>- un programme de fidélité au sein d'une entité ou plusieurs entités juridiques ; </p>
        <p>- le suivi de la relation client tel que la réalisation d'enquêtes de satisfaction, la gestion des réclamations et du service après-vente ; </p>
        <p>- la sélection de clients pour réaliser des études, sondages et tests produits ( sauf consentement des personnes concernées recueilli dans les conditions prévues à l’article 6, ces opérations ne doivent pas conduire à l'établissement de profils susceptibles de faire apparaître des données sensibles-origines raciales ou ethniques, opinions philosophiques, politiques, syndicales, religieuses, vie sexuelle ou santé des personnes ).</p>
        <br>
        <b>Agrégation des données</b>
        <i>Agrégation avec des données non personnelles</i>
        <p>Nous pouvons publier, divulguer et utiliser les informations agrégées ( informations relatives à tous nos Utilisateurs ou à des groupes ou catégories spécifiques d'Utilisateurs que nous combinons de manière à ce qu'un Utilisateur individuel ne puisse plus être identifié ou mentionné ) et les informations non personnelles à des fins d'analyse du secteur et du marché, de profilage démographique, à des fins promotionnelles et publicitaires et à d'autres fins commerciales.</p>
        <i>Agrégation avec des données personnelles disponibles sur les comptes sociaux de l'Utilisateur</i>
        <p>Si vous connectez votre compte à un compte d’un autre service afin de faire des envois croisés, le dit service pourra nous communiquer vos informations de profil, de connexion, ainsi que toute autre information dont vous avez autorisé la divulgation. Nous pouvons agréger les informations relatives à tous nos autres Utilisateurs, groupes, comptes, aux données personnelles disponibles sur l’Utilisateur.</p>
        <br>
        <b>Collecte des données d'identification </b>
        <i>Utilisation de l'identifiant de l’utilisateur uniquement pour l’accès aux services.</i>
        <p>Nous utilisons vos identifiants électroniques seulement pour et pendant l'exécution du contrat.</p>
        <br>
        <b>Collecte des données du terminal </b>
        <i>Aucune collecte des données techniques </i>
        <p>Nous ne collectons et ne conservons aucune donnée technique de votre appareil ( adresse IP, fournisseur d'accès à Internet... ). </p>
        <br>
        <b>Cookies </b>
        <i>Durée de conservation des cookies </i>
        <p>Conformément aux recommandations de la CNIL, la durée maximale de conservation des cookies est de 13 mois au maximum après leur premier dépôt dans le terminal de l'Utilisateur, tout comme la durée de la validité du consentement de l’Utilisateur à l’utilisation de ces cookies. La durée de vie des cookies n’est pas prolongée à chaque visite. Le consentement de l’Utilisateur devra donc être renouvelé à l'issue de ce délai. </p>
        <i>Finalité cookies  </i>
        <p>Les cookies peuvent être utilisés pour des fins statistiques notamment pour optimiser les services rendus à l'Utilisateur, à partir du traitement des informations concernant la fréquence d'accès, la personnalisation des pages ainsi que les opérations réalisées et les informations consultées. Vous êtes informé que l'Éditeur est susceptible de déposer des cookies sur votre terminal. Le cookie enregistre des informations relatives à la navigation sur le service ( les pages que vous avez consultées, la date et l'heure de la consultation... ) que nous pourrons lire lors de vos visites ultérieures.</p>
        <i>Droit de l'Utilisateur de refuser les cookies</i>
        <p>Vous reconnaissez avoir été informé que l'Éditeur peut avoir recours à des cookies. Si vous ne souhaitez pas que des cookies soient utilisés sur votre terminal, la plupart des navigateurs vous permettent de désactiver les cookies en passant par les options de réglage. </p>
        <br>
        <b>Conservation des données techniques</b>
        <i>Durée de conservation des données techniques </i>
        <p>Les données techniques sont conservées pour la durée strictement nécessaire à la réalisation des finalités visées ci-avant.</p>
        <br>
        <b>Délai de conservation des données personnelles et d'anonymisation</b>
        <i>Conservation des données pendant la durée de la relation contractuelle </i>
        <p>Conformément à l'article 6-5° de la loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers et aux libertés, les données à caractère personnel faisant l'objet d'un traitement ne sont pas conservées au-delà du temps nécessaire à l'exécution des obligations définies lors de la conclusion du contrat ou de la durée prédéfinie de la relation contractuelle.</p>
        <i>Conservation des données anonymisées au-delà de la relation contractuelle/après la suppression du compte </i>
        <p>Nous conservons les données personnelles pour la durée strictement nécessaire à la réalisation des finalités décrites dans les présentes CGU. Au-delà de cette durée, elles seront anonymisées et conservées à des fins exclusivement statistiques et ne donneront lieu à aucune exploitation, de quelque nature que ce soit. Suppression des données après suppression du compte Des moyens de purge de données sont mis en place à fin d'en prévoir la suppression effective dès lors que la durée de conservation ou d'archivage nécessaire à l'accomplissement des finalités déterminées ou imposées est atteinte. Conformément à la loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers et aux libertés, vous disposez par ailleurs d'un droit de suppression sur vos données que vous pouvez exercer à tout moment en prenant contact avec l'Éditeur.</p>
        <br>
        <b>Suppression du compte</b>
        <i>Suppression du compte à la demande </i>
        <p>L'Utilisateur a la possibilité de supprimer son Compte à tout moment, par simple demande à l'Éditeur OU par le menu de suppression de Compte présent dans les paramètres du Compte le cas échéant.</p>
        <i>Suppression du compte en cas de violation des CGU</i>
        <p>En cas de violation d'une ou de plusieurs dispositions des CGU ou de tout autre document incorporé aux présents par référence, l'Éditeur se réserve le droit de mettre fin ou restreindre sans aucun avertissement préalable et à sa seule discrétion, votre usage et accès aux services, à votre compte et à tous les Sites.</p>
        <br>
        <b>Indications en cas de faille de sécurité décelée par l'Éditeur</b>
        <i>Information de l'Utilisateur en cas de faille de sécurité</i>
        <p>Nous nous engageons à mettre en oeuvre toutes les mesures techniques et organisationnelles appropriées afin de garantir un niveau de sécurité adapté au regard des risques d'accès accidentels, non autorisés ou illégaux, de divulgation, d'altération, de perte ou encore de destruction des données personnelles vous concernant. Dans l'éventualité où nous prendrons connaissance d'un accès illégal aux données personnelles vous concernant stockées sur nos serveurs ou ceux de nos prestataires, ou d'un accès non autorisé ayant pour conséquence la réalisation des risques identifiés ci-dessus, nous nous engageons à :</p>
        <p>- Vous notifier l'incident dans les plus brefs délais ;</p>
        <p>- Examiner les causes de l'incident et vous en informer ; </p>
        <p>- Prendre les mesures nécessaires dans la limite du raisonnable afin d'amoindrir les effets négatifs et préjudices pouvant résulter dudit incident. </p>
        <i>Limitation de la responsabilité </i>
        <p>En aucun cas les engagements définis au point ci-dessus relatifs à la notification en cas de faille de sécurité ne peuvent être assimilés à une quelconque reconnaissance de faute ou de responsabilité quant à la survenance de l'incident en question.</p>
        <br>
        <b>Modification des CGU et de la politique de confidentialité</b>
        <p>En cas de modification des présentes CGU, engagement de ne pas baisser le niveau de confidentialité de manière substantielle sans l'information préalable des personnes concernées </p>
        <p>Nous nous engageons à vous informer en cas de modification substantielle des présentes CGU, et à ne pas baisser le niveau de confidentialité de vos données de manière substantielle sans vous en informer et obtenir votre consentement.</p>
        <br>
        <b>Droit applicable et modalités de recours</b>
        <i>Application du droit français ( législation CNIL ) et compétence des tribunaux</i>
        <p>Les présentes CGU et votre utilisation du Site sont régies et interprétées conformément aux lois de France, et notamment à la Loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers et aux libertés. Le choix de la loi applicable ne porte pas atteinte à vos droits en tant que consommateur conformément à la loi applicable de votre lieu de résidence. Si vous êtes un consommateur, vous et nous acceptons de ses ou mettre à la compétence non-exclusive des juridictions françaises, ce qui signifie que vous pouvez engager une action relative aux présentes CGU en France ou dans le pays de l'UE dans lequel vous vivez. Si vous êtes un professionnel, toutes les actions à notre encontre doivent être engagées devant une juridiction en France. En cas de litige, les parties chercheront une solution amiable avant toute action judiciaire. En cas d'échec de ces tentatives, toutes contestations à la validité, l'interprétation et/ou l'exécution des présentes CGU devront être portées même en cas de pluralité des défendeurs ou d'appel en garantie, devant les tribunaux français. </p>
        <br>
        <b>Portabilité des données</b>
        <p>L'Éditeur s'engage à vous offrir la possibilité de vous faire restituer l'ensemble des données vous concernant sur simple demande. L'Utilisateur se voit ainsi garantir d’une meilleure maîtrise de ses données, et garde la possibilité de les réutiliser. Ces données devront être fournies dans un format ouvert et aisément réutilisable.</p>
        <br>
        <br>
        <p class="retour">Retour</p>
    </div>

</article>

<script>
    const pswrdField = document.querySelector(".inputdeux input[type='password']");
    const pswrdField2 = document.querySelector(".inputtrois input[type='password']");
    const toggleBtn = document.querySelector("i");

    toggleBtn.addEventListener('click',clicksuroeil);

    function clicksuroeil () {
        if(pswrdField.type == "password"){
            pswrdField.type = "text";
            toggleBtn.classList.add("active");
            pswrdField2.type = "text";
        }else{
            pswrdField.type = "password";
            toggleBtn.classList.remove("active");
            pswrdField2.type = "password";
        }
    }
</script>
<script>
    const header = document.querySelector('header');
    const CGU = document.querySelector('.CGU');
    const lienCGU = document.querySelector('.a');
    const retour = document.querySelector('.retour');

    lienCGU.addEventListener('click', apparition);
    retour.addEventListener('click', comeback);

    function apparition() {
        header.classList.add("CGUdisplayblock");
        CGU.classList.remove("CGUdisplayblock");
    }
    function comeback() {
        header.classList.remove("CGUdisplayblock");
        CGU.classList.add("CGUdisplayblock");
    }
</script>
</body>
</html>
