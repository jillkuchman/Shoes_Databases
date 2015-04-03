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

        static function find($search_id)
        {
            $all_brands = Brand::getAll();
            $found_brand = null;
            foreach($all_brands as $brand){
                if ($brand->getId() == $search_id){
                    $found_brand = $brand;
                }
            }
            return $found_brand;
        }

        function update($new_title)
        {
            $GLOBALS['DB']->exec("UPDATE brands SET title = '{$new_title}' WHERE id = {$this->getId()};");
            $this->setTitle($new_title);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
        }

        function addStore($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$this->getId()}, {$store->getId()});");
        }

        function getStores()
        {
            $statement = $GLOBALS['DB']->query("SELECT stores.* FROM brands
                                                JOIN brands_stores ON (brands.id = brands_stores.brand_id)
                                                JOIN stores ON (brands_stores.store_id = stores.id)
                                                WHERE brands.id = {$this->getId()};");
            $store_id = $statement->fetchAll(PDO::FETCH_ASSOC);
            $stores = array();
            foreach($store_id as $store){
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        function deleteStore($store)
        {
            $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE (brand_id, store_id) = ({$this->getId()}, {$store->getId()});");
        }


    }

?>
