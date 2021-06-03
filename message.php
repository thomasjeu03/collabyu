<?php
session_start();

if (!isset($_SESSION['user_uniqueid_USERS'])) {
    header("Location: login.php");
}
?>
    <?php
    $bdd = new PDO (
        'mysql:host=tj9r5.myd.infomaniak.com;dbname=tj9r5_collabyu;charset=utf8',
        'tj9r5_collabyu',
        'Collabyu2021');

    if (isset($_SESSION['user_uniqueid_USERS'])) {
        $show_users = $bdd->prepare("SELECT * FROM users WHERE user_uniqueid_USERS <> ?");
        $show_users->execute(array($_SESSION['user_uniqueid_USERS']));
    } else {
        $show_users = $bdd->prepare("SELECT * FROM users");
        $show_users->execute(array());
    }


    $requser = $bdd->prepare("SELECT * FROM users WHERE user_uniqueid_USERS = {$_SESSION['user_uniqueid_USERS']}");
    $requser->execute(array($_SESSION['user_uniqueid_USERS']));
    $userinfo = $requser->fetch();
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>CollabyU | Messagerie</title>
        <meta name="description" content="Démarrez de toutes nouvelles collaborations musicales en ligne, grâce à cette messagerie sur CollabyU.">

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
        <link rel="stylesheet" href="css/messagerie.css">
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
                <img src="php/images/<?php echo $userinfo['user_profilPicture_USERS']; ?>" alt="photo_de_profil" width="30" height="30">
                <p>Profil</p>
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
        <?php
        $hostname = "tj9r5.myd.infomaniak.com";
        $username = "tj9r5_collabyu";
        $password = "Collabyu2021";
        $dbname = "tj9r5_collabyu";

        $conn = mysqli_connect($hostname, $username, $password, $dbname);

        $userMessageId = mysqli_real_escape_string($conn, $_GET['user_uniqueid_USERS']);

        $sqlMessage = mysqli_query($conn, "SELECT * FROM users WHERE user_uniqueid_USERS = {$userMessageId}");
        if(mysqli_num_rows($sqlMessage) > 0){
            $rowMessage = mysqli_fetch_assoc($sqlMessage);
        }
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_uniqueid_USERS = {$_SESSION['user_uniqueid_USERS']}");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
        }

        ?>
        <?php if ($_GET['user_uniqueid_USERS'] == $_SESSION['user_uniqueid_USERS'])
        {
            ?>
            <h2>Choisisez un profil</h2>
            <?php
        }else{
            ?>
            <a href="profil.php?user_uniqueid_USERS=<?php echo $rowMessage['user_uniqueid_USERS']; ?>">
                <h2>@<?php echo $rowMessage['user_username_USERS']; ?></h2>
            </a>
            <?php
        }
        ?>
        <?php
        $user_id = mysqli_real_escape_string($conn, $_GET['user_uniqueid_USERS']);
        ?>

        <div class="chat-box">

        </div>
        <?php if ($_GET['user_uniqueid_USERS'] == $_SESSION['user_uniqueid_USERS'])
        {
            ?>
            <h3>Démarrez une conversation en choisissant un profil</h3>
            <form style="display: none" action="#" class="typing-area">
                <input type="text" name="message" class="input-field" placeholder="Votre message" autocomplete="off">
                <button>Envoyer</button>
            </form>
            <?php
        }else{
            ?>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="outgoing_id" value="<?php echo $_SESSION['user_uniqueid_USERS']; ?>" hidden>
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $userMessageId; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Votre message" autocomplete="off">
                <button>Envoyer</button>
            </form>
            <?php
        }
        ?>
    </main>
    <aside>
        <div class="searchAside">
            <div class="search-area">
                <button class="search-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21.784" height="22.225" viewBox="0 0 21.784 22.225">
                        <g id="loupe" transform="translate(1.414)" opacity="0.5">
                            <path id="Tracé_5" data-name="Tracé 5" d="M353.691,133.565l-5.992,5.992" transform="translate(-345.537 -120.907)" fill="none" stroke="#009380" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                            <path id="Tracé_7" data-name="Tracé 7" d="M353.51,133.565l-5.811,5.811" transform="translate(-347.699 -118.565)" fill="none" stroke="#f2f2f2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            <g id="Tracé_6" data-name="Tracé 6" transform="translate(5.37)" fill="none">
                                <path d="M7.5,0A7.5,7.5,0,1,1,0,7.5,7.5,7.5,0,0,1,7.5,0Z" stroke="none"/>
                                <path d="M 7.5 1 C 3.915889739990234 1 1 3.915889739990234 1 7.5 C 1 11.08411026000977 3.915889739990234 14 7.5 14 C 11.08411026000977 14 14 11.08411026000977 14 7.5 C 14 3.915889739990234 11.08411026000977 1 7.5 1 M 7.5 0 C 11.64213943481445 0 15 3.35785961151123 15 7.5 C 15 11.64213943481445 11.64213943481445 15 7.5 15 C 3.35785961151123 15 0 11.64213943481445 0 7.5 C 0 3.35785961151123 3.35785961151123 0 7.5 0 Z" stroke="none" fill="#f2f2f2"/>
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
                        <path id="Tracé_12" data-name="Tracé 12" d="M353,93.255V85.974" transform="translate(-353 -85.974)" fill="none" stroke="#009380" stroke-linecap="round" stroke-width="2"/>
                        <path id="Tracé_13" data-name="Tracé 13" d="M0,6.078V0" transform="translate(6.078 7.281) rotate(90)" fill="none" stroke="#ec1d53" stroke-linecap="round" stroke-width="2"/>
                    </g>
                </svg>
                <p>Messages récents</p>
            </div>
            <div class="search-recommandation">

            </div>
        </div>
    </aside>
    </body>
    <script>
        const loader = document.querySelector('.loader');
        window.addEventListener('load', () => {
            loader.classList.add('disparition');
        })
    </script>
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
            xhr.open("POST", "php/search-message.php", true);
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
        setInterval(() =>{
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "php/message.php", true);
            xhr.onload = ()=>{
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        if(!searchBar.classList.contains("active")){
                            userList.innerHTML = data;
                        }
                    }
                }
            }
            xhr.send();
        }, 500);
    </script>
    <script src="js/chat.js"></script>
    </html>