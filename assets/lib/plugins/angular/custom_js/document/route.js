

// configure our routes
app.config(function($routeProvider) {
    $routeProvider

    // route for the home page
        .when('/list', {
            templateUrl : 'invoice/listView',
            controller  : 'ListController'
        })

        // route for the about page


        .when('/create', {
            templateUrl : 'invoice/create',
            controller  : 'CreateController'
        })

        .when('/product', {
            templateUrl : 'master_document/product',
            controller  : 'productController'
        })

        .when('/product/create', {
            templateUrl : 'master_document/createProduct',
            controller  : 'CreateProdController'
        })

        .when('/file', {
            templateUrl : 'master_document/file',
            controller  : 'fileController'
        })

        .when('/product/edit/:param', {
            templateUrl : 'master_document/createProduct',
            controller  : 'CreateProdController'
        })

        // route for the contact page
        .when('/contact', {
            templateUrl : 'pages/contact.html',
            controller  : 'contactController'
        });
});