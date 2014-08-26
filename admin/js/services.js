mobile.factory('Links', function($http) {
    var links = {};
    links.query = function() {
        return [
        {name: "Devices", path: "#/devices"},
        {name: "Brands", path: "#/brands"}
        ];
    };
    return links;
});

mobile.factory('Devices', function($http) {
    var devices = {};
    devices.allDevices = function() {
        return $http.get('/admin/angular/requests/getDevices.php');
    };

    devices.getDevice = function(options) {
        return $http.post('/admin/angular/requests/getDevice.php', {imei: options.imei, options: options});
    };

    devices.createDevice = function(device) {
        return $http.post('/admin/angular/requests/createDevice.php', {device: device});
    };

    devices.updateDevice = function(device) {
        return $http.post('/admin/angular/requests/updateDevice.php', {device: device});
    };

    devices.deleteDevice = function(id_device){
        return $http.post('/admin/angular/requests/deleteDevice.php', {id_device: id_device})
    };

    return devices;
});

mobile.factory('Brands', function($http) {
    var brands = {};
    brands.allBrands = function() {
        return $http.get('/admin/angular/requests/getBrands.php');
    };

    brands.getBrand = function(options) {
        return $http.post('/admin/angular/requests/getBrand.php', {id_brand: options.id_brand});
    };

    brands.createBrand = function(brand) {
        return $http.post('/admin/angular/requests/createBrand.php', {brand: brand});
    };

    brands.updateBrand = function(brand) {
        return $http.post('/admin/angular/requests/updateBrand.php', {brand: brand});
    };

    brands.deleteBrand = function(id_brand){
        return $http.post('/admin/angular/requests/deleteBrand.php', {id_brand: id_brand})
    };

    return brands;
});

mobile.factory('Models', function($http) {
    var models = {};
    models.allModels = function(options) {
        return $http.post('/admin/angular/requests/getModels.php', {id_brand: options.id_brand});
    };

    models.getModel = function(options) {
        return $http.post('/admin/angular/requests/getModel.php', {imei: options.imei});
    };

    models.createModel = function(model) {
        return $http.post('/admin/angular/requests/createModel.php', {model: model});
    };

    models.updateModel = function(model) {
        return $http.post('/admin/angular/requests/updateModel.php', {model: model});
    };

    models.deleteModel = function(id_model){
        return $http.post('/admin/angular/requests/deleteModel.php', {id_model: id_model})
    };

    return models;
});

mobile.factory('Tests', function($http) {
    var tests = {};
    tests.allTests = function() {
        return $http.get('/admin/angular/requests/getTests.php');
    };

    tests.getTest = function(options) {
        return $http.post('/admin/angular/requests/getTest.php', {id_test: options.id_test});
    };

    tests.createTest = function(test) {
        return $http.post('/admin/angular/requests/createTest.php', {test: test});
    };

    tests.updateTest = function(test) {
        return $http.post('/admin/angular/requests/updateTest.php', {test: test});
    };

    tests.deleteTest = function(id_test){
        return $http.post('/admin/angular/requests/deleteTest.php', {id_test: id_test})
    };
    
    return tests;
});

mobile.factory('Evaluations', function($http){
    var evaluations = {};

    return evaluations;
});

mobile.factory('Events', function($http){
    var events = {};

    return events;
});

mobile.factory('Results', function($http){
    var results = {};

    return results;
});

mobile.value('Alerts', {});