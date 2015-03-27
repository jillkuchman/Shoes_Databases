<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    require_once "src/Store.php";

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
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

    }

?>