<?php
    class Collaboration{
        private $id = 0;
        private $date = null;
        private $userOne = null;
        private $userTwo = null;

        function __construct($id, $date, $userOne, $userTwo){
            $this->id = $id;
            $this->date = $date;
            $this->userOne = $userOne;
            $this->userTwo = $userTwo;
        }

        /**
         * @param int $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @param null $date
         */
        public function setDate($date)
        {
            $this->date = $date;
        }

        /**
         * @param null $userOne
         */
        public function setUserOne($userOne)
        {
            $this->userOne = $userOne;
        }

        /**
         * @param null $userTwo
         */
        public function setUserTwo($userTwo)
        {
            $this->userTwo = $userTwo;
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
        public function getDate()
        {
            return $this->date;
        }

        /**
         * @return null
         */
        public function getUserOne()
        {
            return $this->userOne;
        }

        /**
         * @return null
         */
        public function getUserTwo()
        {
            return $this->userTwo;
        }
        //getter
    }
