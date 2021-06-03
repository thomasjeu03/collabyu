<?php
    session_start();
    $bdd = new PDO (
        'mysql:host=tj9r5.myd.infomaniak.com;dbname=tj9r5_collabyu;charset=utf8',
        'tj9r5_collabyu',
        'Collabyu2021');
    if (isset($_SESSION['user_uniqueid_USERS'])) {
        $show_users = $bdd->prepare("SELECT * FROM users WHERE user_uniqueid_USERS <> ? ORDER BY RAND() ");
        $show_users->execute(array($_SESSION['user_uniqueid_USERS']));
    } else {
        $show_users = $bdd->prepare("SELECT * FROM users DESC");
        $show_users->execute(array());
    }

    while ($row = mysqli_fetch_assoc($sql)){

        if ($row['user_link_USERS'] == null){
            $output .='
            <div style="border-radius: 42px;" class="cardProfil">
                <div style="width: 100%" class="left">
                    <div class="id">
                        <a href="profil.php?user_uniqueid_USERS='. $row['user_uniqueid_USERS'] .'"
                           rel="noopener">
                            <img src="php/images/'. $row['user_profilPicture_USERS'] .'" alt="Photo de profil"
                                 height="60" width="60">
                        </a>
                        <div class="cardIdRight">
                            <a href="profil.php?user_uniqueid_USERS='. $row['user_uniqueid_USERS'] .'"
                               rel="noopener">
                                <p style="font-size: 18px; font-family: Gotham; font-weight: 500;">'. $row['user_name_USERS'] .'</p>
                                <p style="opacity: 0.8; font-size: 13px;">@'. $row['user_username_USERS'] .'</p>
                            </a>
                            <p>'. $row['user_profil_USERS'] .'</p>
                        </div>
                    </div>
                        <p>'. $row['user_biographie_USERS'] .'</p>
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
                            <p>'. $row['user_localisation_USERS'] .'</p>
                        </div>
                        <div class="instrument">
                            <p>Intrument</p>
                            <div class="instrumentListe">
                                <p>'. $row['user_instrument_USERS'] .'</p>
                            </div>
                        </div>
                    <div class="musicalGenre">
                        <p>Genre musicaux</p>
                        <div class="musicalGenreListe">
                            <p>Beatbox</p>
                            <p>Choeur</p>
                            <p>Rap US</p>
                        </div>
                    </div>
                </div>
                <div style="display: none" class="right">
                       
                    </div>
            </div>';
        }else{
            $output .='
            <div style="border-radius: 42px 0 42px 42px;" class="cardProfil">
                <div class="left">
                    <div class="id">
                        <a href="profil.php?user_uniqueid_USERS='. $row['user_uniqueid_USERS'] .'"
                           rel="noopener">
                            <img src="php/images/'. $row['user_profilPicture_USERS'] .'" alt="Photo de profil"
                                 height="60" width="60">
                        </a>
                        <div class="cardIdRight">
                            <a href="profil.php?user_uniqueid_USERS='. $row['user_uniqueid_USERS'] .'"
                               rel="noopener">
                                <p style="font-size: 18px; font-family: Gotham; font-weight: 500;">'. $row['user_name_USERS'] .'</p>
                                <p style="opacity: 0.8; font-size: 13px;">@'. $row['user_username_USERS'] .'</p>
                            </a>
                            <p>'. $row['user_profil_USERS'] .'</p>
                        </div>
                    </div>
                        <p>'. $row['user_biographie_USERS'] .'</p>
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
                            <p>'. $row['user_localisation_USERS'] .'</p>
                        </div>
                        <div class="instrument">
                            <p>Intrument</p>
                            <div class="instrumentListe">
                                <p>'. $row['user_instrument_USERS'] .'</p>
                            </div>
                        </div>
                    <div class="musicalGenre">
                        <p>Genre musicaux</p>
                        <div class="musicalGenreListe">
                            <p>Beatbox</p>
                            <p>Choeur</p>
                            <p>Rap US</p>
                        </div>
                    </div>
                </div>
                <div class="right">
                        <div style="left: 0; width: 100%; height: 310px; position: relative;">
                            <iframe src="'. $row['user_link_USERS'] .'"
                                    style="top: 0; opacity: 0.8; border-radius: 0 0 42px 0; left: 0; width: 100%; height: 100%; position: absolute; border: 0;" allowfullscreen allow="encrypted-media">
                            </iframe>
                        </div>
                    </div>
            </div>';
        }

    }
