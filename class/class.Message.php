<?php
    class Message{
        private $id = 0;
        private $date = null;
        private $content = null;

        function __construct($id, $date, $content){
            $this->id = $id;
            $this->date = $date;
            $this->content = $content;
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
         * @param null $content
         */
        public function setContent($content)
        {
            $this->content = $content;
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
        public function getContent()
        {
            return $this->content;
        }
        //getter



    }