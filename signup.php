<?php
require_once ('recaptcha/autoload.php');
if(isset($_POST['submit'])) {
    if (isset($_POST['g-recaptcha-response'])) {
        $recaptcha = new \ReCaptcha\ReCaptcha('6LfOP5QaAAAAACrDMq8b25Ca0Trxx7iVY7mmbcP-');
        $resp = $recaptcha->verify($_POST['g-recaptcha-response']);
    }
}

$bdd = new PDO (
    'mysql:host=127.0.0.1;dbname=collabyu;charset=utf8',
    'root',
    'root');

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
            if($usernameexist == 0){
                if (filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $reqmail = $bdd->prepare("SELECT * FROM users WHERE user_mail_USERS = ?");
                    $reqmail->execute(array($email));
                    $mailexist = $reqmail->rowCount();
                    if($mailexist == 0){
                        if ($password == $password2) {
                            $insertuser = $bdd->prepare("INSERT INTO users(user_username_USERS,user_mail_USERS,user_password_USERS,user_name_USERS,user_age_USERS) VALUES(?,?,?,?,?)");
                            $insertuser->execute(array($username, $email, $password2, $pseudo, $age));
                            $_SESSION['comptecree'] = "Votre compte a bien été créé !";
                            header('Location: home.php');
                        } else {
                            $erreurpassword = "Votre mot de passe n'a pas été confirmé";
                        }
                    }else{
                        $erreurmail = "Adresse mail déjà utilisée";
                    }
                }else{
                    $erreurmailcorrect = "Adresse mail pas correct";
                }
            }else{
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
                    <label for="CGU"><a href="cgu.php" rel="noopener">J'ai lu et j'accepte les conditions générales d'utilisations</a></label>
                </div>
                <div class="field button">
                        <input type="submit" class="ctaform" name="submit" value="S'inscrire">
                </div>
                <?php
                    if(isset($erreur)){
                        echo $erreur;
                    }
                ?>
                <p>Tous les champs sont obligatoires</p>
            </form>
        </div>

        <div class="carddeux formspon">
            <h1>Personnaliser votre expérience</h1>
            <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="select">
                    <svg id="music" xmlns="http://www.w3.org/2000/svg" width="25.589" height="25.589" viewBox="0 0 25.589 25.589">
                        <g id="Groupe_803" data-name="Groupe 803">
                            <path id="Tracé_138" data-name="Tracé 138" d="M25.285.237a.928.928,0,0,0-.71-.228L8.125,1.837a.914.914,0,0,0-.813.908V19.032a5.288,5.288,0,0,0-2.742-.75c-2.52,0-4.57,1.64-4.57,3.656s2.05,3.656,4.569,3.656,4.569-1.639,4.569-3.656V8.138L23.761,6.509V17.2a5.288,5.288,0,0,0-2.742-.748c-2.52,0-4.569,1.64-4.569,3.656s2.05,3.656,4.569,3.656,4.569-1.639,4.569-3.656V.918A.914.914,0,0,0,25.285.237Z" transform="translate(0 -0.004)" fill="#f2f2f2"/>
                        </g>
                    </svg>
                    <select name="Genre musicaux">
                        <option value="0">Genre musicaux</option>
                        <option value="1">Beatbox</option>
                        <option value="2">Blues</option>
                        <option value="3">Chœur</option>
                        <option value="4">Classique</option>
                        <option value="5">Dubstep</option>
                        <option value="6">EDM</option>
                        <option value="7">Electro Swing</option>
                        <option value="8">Hardrock</option>
                        <option value="9">Hip Hop</option>
                        <option value="10">Indie</option>
                        <option value="11">Jazz</option>
                        <option value="12">Jazz contemporain</option>
                        <option value="13">Lo-fi</option>
                        <option value="14">Métal</option>
                        <option value="15">Musique de chambre</option>
                        <option value="16">Pop</option>
                        <option value="17">Rap FR</option>
                        <option value="18">Rap US</option>
                        <option value="19">Raggae</option>
                        <option value="20">Rhythm and blues</option>
                        <option value="21">Rock'n'roll</option>
                        <option value="22">Variété française</option>
                    </select>
                </div>
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
                    <input type="text" name="instrument" placeholder="Instrument">
                </div>
                <div class="select">
                    <svg id="Groupe_809" data-name="Groupe 809" xmlns="http://www.w3.org/2000/svg" width="22.422" height="22.422" viewBox="0 0 22.422 22.422">
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
                    </svg>
                    <input type="number" name="yearOfPractise" min="1" max="100" placeholder="Année.s de pratique" required>
                </div>
                <div class="back">
                    <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="10.591" height="18.643" viewBox="0 0 10.591 18.643">
                        <path id="Tracé_152" data-name="Tracé 152" d="M-7.266,0l-9.385,8.615,9.385,8.615" transform="translate(17.151 0.706)" fill="none" stroke="#009380" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                    </svg>
                    <p>Modifier mes informations</p>
                </div>
                <div class="field input">
                    <svg id="badge" xmlns="http://www.w3.org/2000/svg" width="21.565" height="29.56" viewBox="0 0 21.565 29.56">
                        <path id="Tracé_144" data-name="Tracé 144" d="M21.024,9.273,19.636,7.589a1.489,1.489,0,0,1-.335-.809l-.209-2.172a2.378,2.378,0,0,0-2.135-2.135l-2.172-.209a1.493,1.493,0,0,1-.809-.335L12.292.541a2.378,2.378,0,0,0-3.02,0L7.589,1.929a1.491,1.491,0,0,1-.809.335l-2.172.209A2.378,2.378,0,0,0,2.473,4.609L2.264,6.781a1.493,1.493,0,0,1-.335.809L.541,9.273a2.378,2.378,0,0,0,0,3.02l1.388,1.684a1.493,1.493,0,0,1,.335.809l.209,2.172a2.378,2.378,0,0,0,2.135,2.135l1.328.128L2.782,26.758a.575.575,0,0,0,.686.774L6.2,26.759a.025.025,0,0,1,.029.011L7.6,29.263a.569.569,0,0,0,.5.3h.03a.572.572,0,0,0,.5-.352l3.33-7.959a2.366,2.366,0,0,0,.325-.225l1.684-1.388a1.489,1.489,0,0,1,.74-.326l3.016,7.207-2.135-.6a.9.9,0,0,0-1.035.433L13.5,28.292l-1.416-3.384a.438.438,0,1,0-.809.338l1.659,3.964a.571.571,0,0,0,.5.35h.03a.57.57,0,0,0,.5-.3l1.37-2.492a.025.025,0,0,1,.029-.012l2.736.773a.575.575,0,0,0,.686-.774L15.629,19.22l1.328-.128a2.378,2.378,0,0,0,2.135-2.135l.209-2.172a1.489,1.489,0,0,1,.335-.808l1.388-1.684a2.377,2.377,0,0,0,0-3.02ZM8.07,28.292,7,26.348a.9.9,0,0,0-1.035-.432l-2.134.6,3.016-7.207a1.49,1.49,0,0,1,.741.326l1.684,1.388a2.369,2.369,0,0,0,1.51.541l.1,0ZM20.348,11.735,18.96,13.419a2.364,2.364,0,0,0-.531,1.282l-.209,2.172a1.5,1.5,0,0,1-1.347,1.347l-1.908.184-.023,0-.242.023a2.365,2.365,0,0,0-1.282.531l-1.684,1.388a1.5,1.5,0,0,1-1.9,0L8.147,18.96a2.363,2.363,0,0,0-1.282-.531l-.243-.023-.02,0L4.693,18.22a1.5,1.5,0,0,1-1.347-1.347L3.137,14.7a2.364,2.364,0,0,0-.531-1.282L1.218,11.735a1.5,1.5,0,0,1,0-1.9L2.606,8.147a2.364,2.364,0,0,0,.531-1.282l.209-2.172A1.5,1.5,0,0,1,4.693,3.346l2.172-.209a2.365,2.365,0,0,0,1.282-.531L9.831,1.218a1.5,1.5,0,0,1,1.9,0l1.684,1.388a2.363,2.363,0,0,0,1.282.531l2.172.209A1.5,1.5,0,0,1,18.22,4.692l.209,2.172a2.364,2.364,0,0,0,.531,1.282l1.388,1.684a1.5,1.5,0,0,1,0,1.9Zm0,0" transform="translate(0 0)" fill="#f2f2f2"/>
                        <path id="Tracé_145" data-name="Tracé 145" d="M75,68.156a6.917,6.917,0,0,0-.876.055.438.438,0,0,0,.111.87A6.039,6.039,0,0,1,75,69.032a5.966,5.966,0,1,1-2.443.521.438.438,0,0,0-.359-.8,6.851,6.851,0,1,0,2.8-.6Zm0,0" transform="translate(-64.221 -64.221)" fill="#f2f2f2"/>
                        <path id="Tracé_146" data-name="Tracé 146" d="M104.963,134.6a1.342,1.342,0,0,0,0,1.9l1.914,1.915a1.341,1.341,0,0,0,1.9,0l4.179-4.179a1.34,1.34,0,0,0-1.9-1.9l-3.231,3.232-.967-.967a1.342,1.342,0,0,0-1.9,0Zm2.862,2.025a.438.438,0,0,0,.31-.129l3.541-3.541a.464.464,0,1,1,.656.656l-4.179,4.179a.464.464,0,0,1-.656,0l-1.915-1.914a.464.464,0,0,1,.656-.656l1.277,1.277A.438.438,0,0,0,107.825,136.628Zm0,0" transform="translate(-98.534 -124.329)" fill="#f2f2f2"/>
                    </svg>
                    <input type="text" name="profil" placeholder="Profil">
                </div>
                <div class="field input inputbio">
                    <svg id="edit" xmlns="http://www.w3.org/2000/svg" width="26.431" height="26.298" viewBox="0 0 26.431 26.298">
                        <path id="Tracé_136" data-name="Tracé 136" d="M24.395,53.114a.658.658,0,0,0-.658.658v5.845a1.977,1.977,0,0,1-1.975,1.975H3.291a1.977,1.977,0,0,1-1.975-1.975V42.463a1.977,1.977,0,0,1,1.975-1.975H9.136a.658.658,0,1,0,0-1.317H3.291A3.3,3.3,0,0,0,0,42.463V59.617a3.3,3.3,0,0,0,3.291,3.291h18.47a3.3,3.3,0,0,0,3.291-3.291V53.772A.658.658,0,0,0,24.395,53.114Zm0,0" transform="translate(0 -36.611)" fill="#f2f2f2"/>
                        <path id="Tracé_137" data-name="Tracé 137" d="M125.86,1.128a2.962,2.962,0,0,0-4.189,0L109.927,12.872a.658.658,0,0,0-.169.29l-1.544,5.575a.658.658,0,0,0,.81.81L114.6,18a.658.658,0,0,0,.29-.169L126.633,6.09a2.965,2.965,0,0,0,0-4.189ZM111.362,13.3l9.611-9.612,3.1,3.1L114.461,16.4Zm-.619,1.242,2.476,2.477-3.426.949ZM125.7,5.159l-.7.7-3.1-3.1.7-.7a1.646,1.646,0,0,1,2.327,0l.773.772A1.648,1.648,0,0,1,125.7,5.159Zm0,0" transform="translate(-101.068 -0.261)" fill="#f2f2f2"/>
                    </svg>
                    <textarea name="bio" id="bio" placeholder="Biographie"></textarea>
                </div>
                <div class="field button">
                    <a href="feed.php" rel="noopener">
                        <input type="submit" class="ctaform" name="submit2" value="C'est parti">
                    </a>
                </div>
            </form>
        </div>
    </div>
</header>

<script>
    const loader = document.querySelector('.loader');
    window.addEventListener('load', () => {
        loader.classList.add('disparition');
    })
</script>
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
    /*
    const firstform = document.querySelector('.card');
    const secondeform = document.querySelector('.carddeux');
    const formcta = document.querySelector('.card .ctaform');
    const back = document.querySelector('.back');

    formcta.addEventListener('click', apparition);
    back.addEventListener('click', comeback);

    function apparition() {
        firstform.classList.add("formspon");
        secondeform.classList.remove("formspon");
    }
    function comeback() {
        firstform.classList.remove("formspon");
        secondeform.classList.add("formspon");
    }*/
</script>
</body>
</html>
