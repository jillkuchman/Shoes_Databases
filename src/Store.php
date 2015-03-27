<?php

    class Store
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
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
            $statement = $GLOBALS['DB']->query("INSERT INTO stores (name) VALUES ('{$this->getName()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $all_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $returned_stores = array();
            foreach($all_stores as $store) {
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($returned_stores, $new_store);
            }
            return $returned_stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores *;");
        }

        static function find($search_id)
        {
            $all_stores = Store::getAll();
            $found_store = null;
            foreach($all_stores as $store){
                if ($store->getId() == $search_id){
                    $found_store = $store;
                }
            }
            return $found_store;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        }

        function addBrand($brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brands_id, stores_id) VALUES ({$brand->getId()}, {$this->getId()});");
        }

        function getBrands()
        {
            $statement = $GLOBALS['DB']->query("SELECT brands.* FROM stores
                                                JOIN brands_stores ON (stores.id = brands_stores.stores_id)
                                                JOIN brands ON (brands_stores.brands_id = brands.id)
                                                WHERE stores.id = {$this->getId()};");
            $brand_id = $statement->fetchAll(PDO::FETCH_ASSOC);
            $brands = array();
            foreach($brand_id as $brand){
                $title = $brand['title'];
                $id = $brand['id'];
                $new_brand = new Brand($title, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        function deleteBrand($brand)
        {
            $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE (brands_id, stores_id) = ({$brand->getId()}, {$this->getId()});");
        }

    }

?>
