<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=restaurant_db_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_getId()
        {
            //arrange
            $type = "Tacos";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Nathans";
            $cuisine_id = $test_cuisine->getId();
            $price_range = 1;
            $neighborhood = "Felony Flats";
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant->save();

            //act
            $result = $test_restaurant->getId();

            //assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getCuisineId()
        {
            //arrange
            $type = "Tacos";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Nathans";
            $cuisine_id = $test_cuisine->getId();
            $price_range = 1;
            $neighborhood = "Felony Flats";
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant->save();

            //act
            $result = $test_restaurant->getCuisineId();

            //assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {

            //arrange
            $type = "Tacos";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Nathans";
            $price_range = 1;
            $neighborhood = "Felony Flats";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $price_range, $neighborhood);

            //act
            $test_restaurant->save();

            //assert
            $result = Restaurant::getAll();
            $this->assertEquals($test_restaurant, $result[0]);
        }

        function test_getAll()
        {
            //arrange
            $type = "Tacos";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Nathans";
            $cuisine_id = $test_cuisine->getId();
            $price_range = 1;
            $neighborhood = "Felony Flats";
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant->save();

            $name2 = "Joses";
            $price_range = 2;
            $neighborhood = "Buckman";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant2 = new Restaurant($name2, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant2->save();

            //act
            $result = Restaurant::getAll();

            //assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function test_deleteAll()
        {
            //arrange
            $type = "Tacos";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Nathans";
            $cuisine_id = $test_cuisine->getId();
            $price_range = 1;
            $neighborhood = "Felony Flats";
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant->save();

            $name2 = "Joses";
            $price_range = 2;
            $neighborhood = "Buckman";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant2 = new Restaurant($name2, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant2->save();

            //act
            Restaurant::deleteAll();

            //assert
            $result = Restaurant::getAll();
            $this->assertEquals([], $result);
        }

        function test_findRestaurantName()
        {
            //arrange
            $type = "Tacos";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Nathans";
            $cuisine_id = $test_cuisine->getId();
            $price_range = 1;
            $neighborhood = "Felony Flats";
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant->save();

            $name2 = "Joses";
            $cuisine_id = $test_cuisine->getId();
            $price_range = 2;
            $neighborhood = "Buckman";
            $test_restaurant2 = new Restaurant($name2, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant2->save();

            //act
            $result = Restaurant::findRestaurantName("jose");

            //assert
            $this->assertEquals([$test_restaurant2], $result);
        }

        function test_UpdateName()
        {
            //arrange
            $type = "Tacos";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Nathans";
            $cuisine_id = $test_cuisine->getId();
            $price_range = 1;
            $neighborhood = "Felony Flats";
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant->save();

            $new_name = "Natalies";

            //act
            $test_restaurant->updateName($new_name);

            //assert
            $this->assertEquals("Natalies", $test_restaurant->getName());
        }

        function test_UpdatePriceRange()
        {
            //arrange
            $type = "Tacos";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Nathans";
            $cuisine_id = $test_cuisine->getId();
            $price_range = 1;
            $neighborhood = "Felony Flats";
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant->save();

            $new_price_range = 4;

            //act
            $test_restaurant->updatePriceRange($new_price_range);

            //assert
            $this->assertEquals(4, $test_restaurant->getPriceRange());
        }

        function test_UpdateNeighborhood()
        {
            //arrange
            $type = "Tacos";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Nathans";
            $cuisine_id = $test_cuisine->getId();
            $price_range = 1;
            $neighborhood = "Felony Flats";
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant->save();

            $new_neighborhood = "Foster";

            //act
            $test_restaurant->updateNeighborhood($new_neighborhood);

            //assert
            $this->assertEquals("Foster", $test_restaurant->getNeighborhood());
        }

        function testDelete()
        {
            //Arrange
            $type = "Tacos";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Nathans";
            $cuisine_id = $test_cuisine->getId();
            $price_range = 1;
            $neighborhood = "Felony Flats";
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant->save();

            $name2 = "Joses";
            $cuisine_id = $test_cuisine->getId();
            $price_range = 2;
            $neighborhood = "Buckman";
            $test_restaurant2 = new Restaurant($name2, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant2->save();

            //act
            $test_restaurant->delete();

            //Assert
            $this->assertEquals([$test_restaurant2], Restaurant::getAll());

        }


    }


?>
