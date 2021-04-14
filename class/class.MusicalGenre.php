<?php
    class MusicalGenre{
        private $id = 0;
        private $name = null;

        function __construct($id, $name){
            $this->id = $id;
            $this->name = $name;
        }

        /**
         * @param int $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @param null $name
         */
        public function setName($name)
        {
            $this->name = $name;
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
        public function getName()
        {
            return $this->name;
        }
        //getter


    }
