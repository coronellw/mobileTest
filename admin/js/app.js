var mobile = angular.module('mobile', ['ngMessages','ngRoute']);

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
    }).otherwise({
        redirectTo: '/'
    });
}

mobile.config(routes);