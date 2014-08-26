mobile.controller('IndexController', function($scope, Links) {
    $scope.title = "Index";
    $scope.links = Links.query();
});
// DEVICE CONTROLLER
mobile.controller('IndexDeviceController', function($scope, Devices) {
    $scope.title = "General list of devices";
    $scope.devices = {};
    $scope.filteredDevices = {};
    $scope.itemsPerPage = 10;
    $scope.currentPage = 1;
    $scope.maxSize = 5;
    $scope.sizes = [5,10,15,20];

    Devices.allDevices().success(function(data) {
        $scope.devices = data;
        $scope.filteredDevices = $scope.devices.slice(0, $scope.itemsPerPage);
        $scope.totalItems = $scope.devices.length;
    });

    $scope.remove = function(index){
        var device = $scope.filteredDevices[index];
        var q = confirm("Are you sure to delete IMEI: "+ device.imei +"?");
        var msg = {};
        if (q) {
            Devices.deleteDevice(device.id_device).success(function(data){
                if (data.result==="ok") {
                    var page_index = (($scope.currentPage - 1) * $scope.itemsPerPage);
                    $scope.filteredDevices.splice(index,1);
                    $scope.devices.splice(page_index + index,1);
                    msg  = {message: "The device was deleted", type: "success"};
                    console.log("Imei was deleted");
                }else{
                    alert("Unable to delete device.\nHINT: " + data.error_msg);
                    msg  = {message: "The device with IMEI : " + device.imei + "couldn't be deleted, HINT: "+data.error_msg, 
                            type: "danger"};
                }
                
            });
        }
    };

    $scope.$watch('currentPage + itemsPerPage',function(){
        var begin = (($scope.currentPage - 1) * $scope.itemsPerPage);
        var end = begin + $scope.itemsPerPage;
        if ($scope.devices!=="undefined" && $scope.devices.length > 0) {
            $scope.filteredDevices = $scope.devices.slice(begin, end);
        };
    });
});

mobile.controller('ViewDeviceController', function($scope, $routeParams, Devices, Tests) {
    $scope.title = "Viewing device";
    $scope.evaluations = {};
    $scope.device = {};
    $scope.itemsPerPage = 10;
    $scope.currentPage = 1;
    $scope.maxSize = 5;
    $scope.sizes = [5,10,15,20];

    Devices.getDevice({imei: $routeParams.imei, detailed: true}).success(function(data) {
        $scope.device = data.device;
        $scope.evaluations = $scope.device.evaluations.slice(0, $scope.itemsPerPage);
        $scope.totalItems = $scope.device.evaluations.length;
    });

    Tests.allTests().success(function(data) {
        $scope.tests = data;
    });

    $scope.$watch('currentPage + itemsPerPage',function(){
        var begin = (($scope.currentPage - 1) * $scope.itemsPerPage)
        var end = begin + $scope.itemsPerPage;
        if ($scope.device.evaluations!=="undefined" && $scope.device.evaluations) {
            $scope.evaluations = $scope.device.evaluations.slice(begin, end);
        };
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
                console.log("There was an error when updating the device\nHINT: " + data.error_msg);
            }
        });
    };
});

// BRANDS CONTROLLER

mobile.controller('IndexBrandController', function($scope, Brands){
    $scope.title = "General list of brands";
    $scope.brands = {};
    $scope.filteredBrands = {};
    $scope.itemsPerPage = 10;
    $scope.currentPage = 1;
    $scope.maxSize = 5;
    $scope.sizes = [5,10,15,20];
    
    Brands.allBrands().success(function(data){
        $scope.brands = data.brands;
        $scope.filteredBrands = $scope.brands.slice(0, $scope.itemsPerPage);
        $scope.totalItems = $scope.brands.length;
    });

    $scope.$watch('currentPage + itemsPerPage',function(){
        var begin = (($scope.currentPage - 1) * $scope.itemsPerPage)
        var end = begin + $scope.itemsPerPage;
        if ($scope.brands!=="undefined" && $scope.brands.length > 0) {
            $scope.filteredBrands = $scope.brands.slice(begin, end);
        };
    });
});

mobile.controller('ViewBrandController', function($scope, $routeParams, Brands){
    $scope.title = "Viewing brand";
    Brands.getBrand({id_brand: $routeParams.id_brand}).success(function(data){
        $scope.brand = data.brand;
    });    
});

mobile.controller('EditBrandController', function($scope, $routeParams, Brands){
    $scope.title = "Editing brand";

    $scope.brand = {};

    Brands.getBrand({id_brand: $routeParams.id_brand}).success(function(data){
        $scope.brand = data.brand;
    });

    $scope.updateBrand = function(){
        Brands.updateBrand($scope.brand).success(function(data){
            if (data.result==="ok") {
                console.log("The brand was update successfully");
                msg  = {message: "The brand was update successfully", type: "success"};
                
                window.location.href = "#/brands/view/"+data.id_brand;
            }else{
                console.log("There was an error when updating this brand\nHINT: "+data.error_msg);
            }
        });
    };
});