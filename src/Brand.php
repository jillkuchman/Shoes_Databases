<?php

    class Brand
    {
        private $title;
        private $id;

        function __construct($title, $id = null)
        {
            $this->title = $title;
            $this->id = $id;
        }

        function getTitle()
        {
            return $this->title;
        }

        function setTitle($new_title)
        {
            $this->title = $new_title;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO brands (title) VALUES ('{$this->getTitle()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $all_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $returned_brands = array();
            foreach($all_brands as $brand) {
                $title = $brand['title'];
                $id = $brand['id'];
                $new_brand = new Brand($title, $id);
                array_push($returned_brands, $new_brand);
            }
            return $returned_brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands *;");
        }
    }

?>
