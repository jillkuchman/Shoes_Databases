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


    //STORES pages
    //STORES page, GET: list of stores with links to each store, form to add a new Store
    $app->get("/stores", function() use($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    //STORES page, POST: adds a new store to list of stores
    $app->post("/stores", function() use($app) {
        $new_store = new Store($_POST['store_name']);
        $new_store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    //INDIVIDUAL STORE PAGES
    //Get: loads store page with list of brands the store carries and the option to add a brand from the list of brands
    $app->get("/stores/{id}", function($id) use($app) {
        $current_store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $current_store, 'brands' => $current_store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    //Post: adds the brand that was selected in the Get route to the current store's list of brands, submitted from a form with the name "brand_id"
    $app->post("/stores/{id}", function($id) use($app) {
        $current_store = Store::find($id);
        $new_brand = Brand::find($_POST['brand_id']);
        $current_store->addBrand($new_brand);
        return $app['twig']->render('store.html.twig', array('store' => $current_store, 'brands' => $current_store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    //BRANDS pages

    //BRANDS page, GET: list of brands with links to each brand, form to add new Brand
    $app->get("/brands", function() use($app) {
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    //BRANDS page, POST: adds a new brand to list of brands
    $app->post("/brands", function() use($app) {
        $new_brand = new Brand($_POST['brand_title']);
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    //INDIVIDUAL BRAND PAGES
    //Get: loads brand page with list of stores that carry the brand, and the option to add a store to the list of stores
    $app->get("/brands/{id}", function($id) use($app) {
        $current_brand = Brand::find($id);
        return $app['twig']->render('brand.html.twig', array('brand' => $current_brand, 'stores' => $current_brand->getStores(), 'all_stores' => Store::getAll()));
    });

    //Post: adds the store that was selected in the Get route to the current brand's list of stores, submitted from a form with the name "store_id"
    $app->post("/brands/{id}", function($id) use($app) {
        $current_brand = Brand::find($id);
        $new_store = Store::find($_POST['store_id']);
        $current_brand->addStore($new_store);
        return $app['twig']->render('brand.html.twig', array('brand' => $current_brand, 'stores' => $current_brand->getStores(), 'all_stores' => Store::getAll()));
    });

    return $app;
?>
