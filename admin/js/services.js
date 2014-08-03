mobile.factory('Links', function($http) {
    var links = {};
    links.query = function() {
        return [{name: "devices", path: "#/devices"}];
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

    devices.updateDevice = function(device) {
        return $http.post('/admin/angular/requests/updateDevice.php', {device: device});
    };

    return devices;
});

mobile.factory('Brands', function($http) {
    var brands = {};
    brands.allBrands = function() {
        return $http.get('/admin/angular/requests/getBrands.php');
    };

    brands.getBrand = function(options) {
        return $http.post('/admin/angular/requests/getBrand.php', {imei: options.imei});
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

    return models;
});

mobile.factory('Tests', function($http) {
    var tests = {};
    tests.allTests = function() {
        return $http.get('/admin/angular/requests/getTests.php');
    };
    return tests;
});
