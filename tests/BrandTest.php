<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    require_once "src/Brand.php";

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
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

    }

?>
