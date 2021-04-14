<?php
    class ExternLink{
        private $id = 0;
        private $url = null;
        private $image = null;
        private $name = null;

        function __construct($id, $url, $image, $name){
            $this->id = $id;
            $this->url = $url;
            $this->image = $image;
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
         * @param null $url
         */
        public function setUrl($url)
        {
            $this->url = $url;
        }

        /**
         * @param null $image
         */
        public function setImage($image)
        {
            $this->image = $image;
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
        public function getUrl()
        {
            return $this->url;
        }

        /**
         * @return null
         */
        public function getImage()
        {
            return $this->image;
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
