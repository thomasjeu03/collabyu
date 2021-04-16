<?php
    class User{
        private $id = 0;
        private $userName = null;
        private $name = null;
        private $lastlogin = null;
        private $profil = null;
        private $biographie = null;
        private $localisation = null;
        private $age = null;
        private $instrument = null;
        private $yearOfPractice = null;
        private $profilPicture = null;
        private $mail = null;
        private $password = null;
        private $creationDate = null;
        private $banner = null;

        function __construct(array $donnees){
            $this->id = $donnees["user_id_USERS"];
            $this->userName = $donnees["user_username_USERS"];
            $this->name = $donnees["user_name_USERS"];
            $this->lastlogin = $donnees["user_lastlogin_USERS"];
            $this->profil = $donnees["user_profil_USERS"];
            $this->biographie = $donnees["user_biographie_USERS"];
            $this->localisation = $donnees["user_localisation_USERS"];
            $this->age = $donnees["user_age_USERS"];
            $this->instrument = $donnees["user_instrument_USERS"];
            $this->yearOfPractice = $donnees["user_yearOfPractice_USERS"];
            $this->profilPicture = $donnees["user_profilPicture_USERS"];
            $this->mail = $donnees["user_mail_USERS"];
            $this->password = $donnees["user_password_USERS"];
            $this->creationDate = $donnees["user_creationDate_USERS"];
            $this->banner = $donnees["user_banner_USERS"];
        }

        /**
         * @param int $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @param null $userName
         */
        public function setUserName($userName)
        {
            $this->userName = $userName;
        }

        /**
         * @param null $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }

        /**
         * @param null $lastlogin
         */
        public function setLastlogin($lastlogin)
        {
            $this->lastlogin = $lastlogin;
        }

        /**
         * @param null $profil
         */
        public function setProfil($profil)
        {
            $this->profil = $profil;
        }

        /**
         * @param null $biographie
         */
        public function setBiographie($biographie)
        {
            $this->biographie = $biographie;
        }

        /**
         * @param null $localisation
         */
        public function setLocalisation($localisation)
        {
            $this->localisation = $localisation;
        }

        /**
         * @param null $age
         */
        public function setAge($age)
        {
            $this->age = $age;
        }

        /**
         * @param null $instrument
         */
        public function setInstrument($instrument)
        {
            $this->instrument = $instrument;
        }

        /**
         * @param null $yearOfPractice
         */
        public function setYearOfPractice($yearOfPractice)
        {
            $this->yearOfPractice = $yearOfPractice;
        }

        /**
         * @param null $profilPicture
         */
        public function setProfilPicture($profilPicture)
        {
            $this->profilPicture = $profilPicture;
        }

        /**
         * @param null $mail
         */
        public function setMail($mail)
        {
            $this->mail = $mail;
        }

        /**
         * @param null $password
         */
        public function setPassword($password)
        {
            $this->password = $password;
        }

        /**
         * @param null $creationDate
         */
        public function setCreationDate($creationDate)
        {
            $this->creationDate = $creationDate;
        }

        /**
         * @param null $banner
         */
        public function setBanner($banner)
        {
            $this->banner = $banner;
        }
        //setter



        /**
         * @return int
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @return null
         */
        public function getUserName()
        {
            return $this->userName;
        }

        /**
         * @return null
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @return null
         */
        public function getLastlogin()
        {
            return $this->lastlogin;
        }

        /**
         * @return null
         */
        public function getProfil()
        {
            return $this->profil;
        }

        /**
         * @return null
         */
        public function getBiographie()
        {
            return $this->biographie;
        }

        /**
         * @return null
         */
        public function getLocalisation()
        {
            return $this->localisation;
        }

        /**
         * @return null
         */
        public function getAge()
        {
            return $this->age;
        }

        /**
         * @return null
         */
        public function getInstrument()
        {
            return $this->instrument;
        }

        /**
         * @return null
         */
        public function getYearOfPractice()
        {
            return $this->yearOfPractice;
        }

        /**
         * @return null
         */
        public function getProfilPicture()
        {
            return $this->profilPicture;
        }

        /**
         * @return null
         */
        public function getMail()
        {
            return $this->mail;
        }

        /**
         * @return null
         */
        public function getPassword()
        {
            return $this->password;
        }

        /**
         * @return null
         */
        public function getCreationDate()
        {
            return $this->creationDate;
        }

        /**
         * @return null
         */
        public function getBanner()
        {
            return $this->banner;
        }
        //getter

    }

