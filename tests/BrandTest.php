<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    require_once "src/Brand.php";
    require_once "src/Store.php";

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function test_getTitle()
        {
            //Arrange
            $title = "Nike";
            $id = 1;
            $test_brand = new Brand($title, $id);

            //Act
            $result = $test_brand->getTitle();

            //Assert
            $this->assertEquals($title, $result);
        }

        function test_setTitle()
        {
            //Arrange
            $title = "Nike";
            $id = 1;
            $test_brand = new Brand($title, $id);
            $title2 = "Reebok";

            //Act
            $test_brand->setTitle($title2);
            $result = $test_brand->getTitle();

            //Assert
            $this->assertEquals($title2, $result);
        }

        function test_getId()
        {
            //Arrange
            $title = "Nike";
            $id = 1;
            $test_brand = new Brand($title, $id);

            //Act
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_setId()
        {
            //Arrange
            $title = "Nike";
            $id = 1;
            $test_brand = new Brand($title, $id);
            $id2 = "2";

            //Act
            $test_brand->setId($id2);
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals($id2, $result);
        }

        function test_save()
        {
            //Arrange
            $title = "Reebok";
            $test_brand = new Brand($title);
            $test_brand->save();

            //Act
            $result = Brand::getAll();

            //Arrange
            $this->assertEquals([$test_brand], $result);
        }

        function test_getAll()
        {
            //Arrange
            $title = "Reebok";
            $test_brand = new Brand($title);
            $test_brand->save();

            $title2 = "Adidas";
            $test_brand2 = new Brand($title2);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Arrange
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $title = "Reebok";
            $test_brand = new Brand($title);
            $test_brand->save();

            $title2 = "Adidas";
            $test_brand2 = new Brand($title2);
            $test_brand2->save();

            //Act
            Brand::deleteAll();
            $result = Brand::getAll();

            //Arrange
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $title = "Reebok";
            $test_brand = new Brand($title);
            $test_brand->save();

            $title2 = "Adidas";
            $test_brand2 = new Brand($title2);
            $test_brand2->save();

            //Act
            $result = Brand::find($test_brand2->getId());

            //Arrange
            $this->assertEquals($test_brand2, $result);
        }

        function test_update()
        {
            //Arrange
            $title = "Reebok";
            $test_brand = new Brand($title);
            $test_brand->save();
            $new_title = "Adidas";

            //Act
            $test_brand->update($new_title);
            $result = $test_brand->getTitle();

            //Arrange
            $this->assertEquals($new_title, $result);
        }

        function test_delete()
        {
            //Arrange
            $title = "Reebok";
            $test_brand = new Brand($title);
            $test_brand->save();

            $title2 = "Adidas";
            $test_brand2 = new Brand($title2);
            $test_brand2->save();

            //Act
            $test_brand->delete();
            $result = Brand::getAll();

            //Arrange
            $this->assertEquals([$test_brand2], $result);
        }

        function test_addStore()
        {
            //Arrange
            $title = "Reebok";
            $test_brand = new Brand($title);
            $test_brand->save();

            $name = "Payless";
            $test_store = new Store($name);
            $test_store->save();

            //Act
            $test_brand->addStore($test_store);
            $result = $test_brand->getStores();

            //Assert
            $this->assertEquals([$test_store], $result);
        }

        function test_getStores()
        {
            //Arrange
            $title = "Reebok";
            $test_brand = new Brand($title);
            $test_brand->save();

            $name = "Payless";
            $test_store = new Store($name);
            $test_store->save();

            $name2 = "OnlineShoes";
            $test_store2 = new Store($name2);
            $test_store2->save();

            //Act
            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);
            $result = $test_brand->getStores();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function test_deleteStore()
        {
            //Arrange
            $title = "Reebok";
            $test_brand = new Brand($title);
            $test_brand->save();

            $name = "Payless";
            $test_store = new Store($name);
            $test_store->save();

            $name2 = "OnlineShoes";
            $test_store2 = new Store($name2);
            $test_store2->save();

            //Act
            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);
            $test_brand->deleteStore($test_store);
            $result = $test_brand->getStores();

            //Assert
            $this->assertEquals([$test_store2], $result);
        }

    }

?>
