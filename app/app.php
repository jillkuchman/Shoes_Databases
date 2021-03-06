<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    use Symfony\Component\HttpFoundation\Request;
        Request::enableHttpMethodParameterOverride();

    $DB = new PDO('pgsql:host=localhost;dbname=shoes');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    //Home Page
    $app->get("/", function() use($app) {
        return $app['twig']->render('index.html.twig');
    });


/////////STORES pages////////////
    //GET: This route displays list of stores with links to each store, form to add a new store to list of stores
    $app->get("/stores", function() use($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    //POST: this route adds a new store to list of stores
    $app->post("/stores", function() use($app) {
        $new_store = new Store($_POST['store_name']);
        $new_store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    //DELETE: this route deletes all stores from the database
    $app->delete("/delete_all_stores", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    //INDIVIDUAL STORE PAGES//
    //GET: this route loads store page with list of brands the store carries and the option to add a brand from the list of brands
    $app->get("/stores/{id}", function($id) use($app) {
        $current_store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $current_store, 'brands' => $current_store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    //POST: this route adds the brand that was selected in the Get route to the current store's list of brands, submitted from a form with the name "brand_id"
    $app->post("/add_brand", function() use ($app) {
        $current_store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $current_store->addBrand($brand);
        return $app['twig']->render('store.html.twig', array('store' => $current_store, 'brands' => $current_store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    //DELETE: this route deletes a specific brand from a store's list of brands
    $app->delete("/delete_brands", function() use($app) {
        $current_store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $current_store->deleteBrand($brand);
        return $app['twig']->render('store.html.twig', array('store' => $current_store, 'brands' => $current_store->getBrands(), 'all_brands' => Brand::getAll()));
    });


    //DELETE: this route deletes the store from the list of stores
    $app->delete("/delete_store", function() use($app) {
        $current_store = Store::find($_POST['store_id']);
        $current_store->delete();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getall()));
    });


///////BRANDS pages///////////
    //GET: this route displays list of brands with links to each brand, form to add new brand to list of brands
    $app->get("/brands", function() use($app) {
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    //POST: adds a new brand to list of brands
    $app->post("/brands", function() use($app) {
        $new_brand = new Brand($_POST['brand_title']);
        $new_brand->save();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    //DELETE: this route deletes all brands from the database
    $app->delete("/delete_all_brands", function() use ($app) {
        Brand::deleteAll();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });


    //INDIVIDUAL BRAND PAGES//
    //GET: this route loads brand page with list of stores that carry the brand, and the option to add a store to the list of stores
    $app->get("/brands/{id}", function($id) use($app) {
        $current_brand = Brand::find($id);
        return $app['twig']->render('brand.html.twig', array('brand' => $current_brand, 'stores' => $current_brand->getStores(), 'all_stores' => Store::getAll()));
    });

    //POST: this route adds the store that was selected in the Get route to the current brand's list of stores, submitted from a form with the name "store_id"
    $app->post("/add_store", function() use ($app) {
        $current_brand = Brand::find($_POST['brand_id']);
        $store = Store::find($_POST['store_id']);
        $current_brand->addStore($store);
        return $app['twig']->render('brand.html.twig', array('brand' => $current_brand, 'stores' => $current_brand->getStores(), 'all_stores' => Store::getAll()));
    });

    //DELETE: this route femoves a store from a brand's list of stores
    $app->delete("/delete_stores", function() use($app) {
        $current_brand = Brand::find($_POST['brand_id']);
        $store = Store::find($_POST['store_id']);
        $current_brand->deleteStore($store);
        return $app['twig']->render('brand.html.twig', array('brand' => $current_brand, 'stores' => $current_brand->getStores(), 'all_stores' => Store::getAll()));
    });


    //DELETE: this route will delete a specific brand from the list of brands
    $app->delete("/delete_brand", function() use($app) {
        $current_brand = Brand::find($_POST['brand_id']);
        $current_brand->delete();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getall()));
    });


    return $app;
?>
