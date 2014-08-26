var mobile = angular.module('mobile', ['ngMessages','ngRoute','ui.bootstrap']);

function routes($routeProvider) {
    $routeProvider.when('/', {
        controller: 'IndexController',
        templateUrl: 'admin/angular/links.html'
    }).when('/devices', {
        controller: 'IndexDeviceController',
        templateUrl: 'admin/angular/devices/list.html'
    }).when('/devices/view/:imei', {
        controller: 'ViewDeviceController',
        templateUrl: 'admin/angular/devices/view.html'
    }).when('/devices/edit/:imei', {
        controller: 'EditDeviceController',
        templateUrl: 'admin/angular/devices/edit.html'
    }).when('/brands', {
        controller: 'IndexBrandController',
        templateUrl: 'admin/angular/brands/list.html'
    }).when('/brands/view/:id_brand', {
        controller: 'ViewBrandController',
        templateUrl: 'admin/angular/brands/view.html'
    }).when('/brands/edit/:id_brand', {
        controller: 'EditBrandController',
        templateUrl: 'admin/angular/brands/edit.html'
    }).otherwise({
        redirectTo: '/'
    });
}

mobile.config(routes);