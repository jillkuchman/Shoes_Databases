<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    require_once "src/Store.php";
    require_once "src/Brand.php";

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Journeys";
            $id = 1;
            $test_store = new Store($name, $id);

            //Act
            $result = $test_store->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            //Arrange
            $name = "Journeys";
            $id = 1;
            $test_store = new Store($name, $id);
            $name2 = "Payless";

            //Act
            $test_store->setName($name2);
            $result = $test_store->getName();

            //Assert
            $this->assertEquals($name2, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Journeys";
            $id = 1;
            $test_store = new Store($name, $id);

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_setId()
        {
            //Arrange
            $name = "Journeys";
            $id = 1;
            $test_store = new Store($name, $id);
            $id2 = "2";

            //Act
            $test_store->setId($id2);
            $result = $test_store->getId();

            //Assert
            $this->assertEquals($id2, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Payless";
            $test_store = new Store($name);
            $test_store->save();

            //Act
            $result = Store::getAll();

            //Arrange
            $this->assertEquals([$test_store], $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Payless";
            $test_store = new Store($name);
            $test_store->save();

            $name2 = "OnlineShoes";
            $test_store2 = new Store($name2);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Arrange
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Payless";
            $test_store = new Store($name);
            $test_store->save();

            $name2 = "OnlineShoes";
            $test_store2 = new Store($name2);
            $test_store2->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Arrange
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Payless";
            $test_store = new Store($name);
            $test_store->save();

            $name2 = "OnlineShoes";
            $test_store2 = new Store($name2);
            $test_store2->save();

            //Act
            $result = Store::find($test_store2->getId());

            //Arrange
            $this->assertEquals($test_store2, $result);
        }

        function test_update()
        {
            //Arrange
            $name = "Payless";
            $test_store = new Store($name);
            $test_store->save();
            $new_name = "OnlineShoes";

            //Act
            $test_store->update($new_name);
            $result = $test_store->getName();

            //Arrange
            $this->assertEquals($new_name, $result);
        }

        function test_delete()
        {
            //Arrange
            $name = "Payless";
            $test_store = new Store($name);
            $test_store->save();

            $name2 = "OnlineShoes";
            $test_store2 = new Store($name2);
            $test_store2->save();

            //Act
            $test_store->delete();
            $result = Store::getAll();

            //Arrange
            $this->assertEquals([$test_store2], $result);
        }

        function test_addBrand()
        {
            //Arrange
            $name = "Payless";
            $test_store = new Store($name);
            $test_store->save();

            $title = "Reebok";
            $test_brand = new Brand($title);
            $test_brand->save();

            //Act
            $test_store->addBrand($test_brand);
            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand], $result);
        }

        function test_getBrands()
        {
            //Arrange
            $name = "Payless";
            $test_store = new Store($name);
            $test_store->save();

            $title = "Reebok";
            $test_brand = new Brand($title);
            $test_brand->save();

            $title2 = "Adidas";
            $test_brand2 = new Brand($title2);
            $test_brand2->save();

            //Act
            $test_store->addBrand($test_brand);
            $test_store->addBrand($test_brand2);
            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function test_deleteBook()
        {
            //Arrange
            $name = "Payless";
            $test_store = new Store($name);
            $test_store->save();

            $title = "Reebok";
            $test_brand = new Brand($title);
            $test_brand->save();

            $title2 = "Adidas";
            $test_brand2 = new Brand($title2);
            $test_brand2->save();

            //Act
            $test_store->addBrand($test_brand);
            $test_store->addBrand($test_brand2);
            $test_store->deleteBrand($test_brand);
            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand2], $result);
        }

    }

?>
