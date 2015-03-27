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


    //STORES pages, list of stores with links to each store, can edit each store from individual page
    $app->get("/stores", function() use($app) {
        return $app['twig']->render('stores.html.twig', array('stores' = Store::getAll()));
    });

    $app->post("/stores", function() use($app) {
        $new_store = new Store($_POST['name']);
        $new_store->save();
        return $app['twig']->render('stores.html.twig', array('stores' = Store::getAll()));
    });

    //Individual Store pages
    //Get: loads store page with list of brands the store carries and the option to add a brand from the list of brands
    $app->get("/stores/{id}", function($id) use($app) {
        $current_store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $current_store, 'brands' => $current_store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    //Post: adds the brand that was selected in the Get page to the current store's list of brands, submitted from a form with the name "brand_id"
    $app->post("/stores/{id}", function($id) use($app) {
        $current_store = Store::find($id);
        $new_brand = Brand::find($_POST['brand_id'])
        $current_store->addBrand($new_brand);
        return $app['twig']->render('store.html.twig', array('store' => $current_store, 'brands' => $current_store->getBrands(), 'all_brands' => Brand::getAll()));
    });



    return $app;
?>
