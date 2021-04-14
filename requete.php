    <?php

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        require_once
        'class/class.User.php';
        $pdo = new PDO (
            'mysql:host=127.0.0.1;dbname=collabyu;charset=utf8',
            'root',
            'root');

        $query = 'SELECT * FROM users';

        $requete = $pdo->prepare($query);

        $listUser = array();

        if($requete->execute()){
            while ($donnees = $requete->fetch()){
                $user = new User($donnees);
                $listUser[] = $user;
            }
        }else{
            echo 'Requete incorrecte <br/>';
        }
    ?>
