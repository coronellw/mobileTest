mobile.controller('IndexController', function($scope, Links) {
    $scope.title = "Index";
    $scope.links = Links.query();
});
// DEVICE CONTROLLER
mobile.controller('IndexDeviceController', function($scope, Devices) {
    $scope.title = "General list of devices";

    Devices.allDevices().success(function(data) {
        $scope.devices = data;
    });
});

mobile.controller('ViewDeviceController', function($scope, $routeParams, Devices, Tests) {
    $scope.title = "Viewing device";
    Devices.getDevice({imei: $routeParams.imei, detailed: true}).success(function(data) {
        $scope.device = data.device;
    });

    Tests.allTests().success(function(data) {
        $scope.tests = data;
    });
});

mobile.controller('EditDeviceController', function($scope, $routeParams, Devices, Brands, Models) {
    $scope.title = "Editing device";
    $scope.device = {};

    Devices.getDevice({imei: $routeParams.imei}).success(function(data) {
        $scope.device = data.device;
        Brands.allBrands().success(function(data) {
            $scope.brands = data.brands;
            Models.allModels({id_brand: $scope.device.id_brand}).success(function(data) {
                $scope.models = data.models;
            });
        });
    });

    $scope.$watch("device.id_brand", function() {
        Models.allModels({id_brand: $scope.device.id_brand}).success(function(data) {
            $scope.models = data.models;
        });
    });

    $scope.updateDevice = function() {
        Devices.updateDevice($scope.device).success(function(data) {
            if (data.result === "ok") {
                console.log("The device was updated successfully");
                window.location.href = "#/devices/view/" + data.imei;
            } else {
                console.log("There was an error whe updatin the device\nHINT: " + data.error_msg);
            }
        });
    };
});