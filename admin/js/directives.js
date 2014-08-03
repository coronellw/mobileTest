mobile.directive('ngbkFocus', function() {
    return {
        link: function(scope, element, attr, controller) {
            element[0].focus();
        }
    };
});