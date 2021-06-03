<?php
    while ($row = mysqli_fetch_assoc($sql)){

        $output .= '<a href="profil.php?user_uniqueid_USERS='. $row['user_uniqueid_USERS'] .'" class="profil-search">
                                <div class="left">
                                    <img src="php/images/'. $row['user_profilPicture_USERS'] .'" alt="pp" height="60"
                                         width="60">
                                    
                                </div>
                                <div class="right">
                                    <p>'. $row['user_name_USERS'] .'</p>
                                    <p>@'. $row['user_username_USERS'] .'</p>
                                    <p>'. $row['user_profil_USERS'] .'</p>
                                </div>
                            </a>';
    }