app.directive("select22", function ($timeout, $parse) {
    return {
        restrict: 'AC',
        require: 'ngModel',
        link: function (scope, element, attrs) {
            console.log(attrs);
            $timeout(function () {
                element.select2();
                element.select2Initialized = true;
            });

            var refreshSelect = function () {
                if (!element.select2Initialized) return;
                $timeout(function () {
                    element.trigger('change');
                });
            };

            var recreateSelect = function () {
                if (!element.select2Initialized) return;
                $timeout(function () {
                    element.select2('destroy');
                    element.select2();
                });
            };

            scope.$watch(attrs.ngModel, refreshSelect);

            if (attrs.ngOptions) {
                var list = attrs.ngOptions.match(/ in ([^ ]*)/)[1];
                // watch for option list change
                scope.$watch(list, recreateSelect);
            }

            if (attrs.ngDisabled) {
                scope.$watch(attrs.ngDisabled, refreshSelect);
            }
        }
    };
});

app.directive(
    "bnUniform",
    function() {
        return({
            link: link,
            restrict: "A"
        });
        function link( scope, element, attributes ) {
            // applied.
            var uniformedElement = null;
            element.uniform({ radioClass: 'choice' });
            scope.$watch( attributes.ngModel, handleModelChange );
            scope.$on( "$destroy", handleDestroy );
            function handleDestroy() {
                if ( ! uniformedElement ) {
                    return;
                }
                uniformedElement.uniform.restore( uniformedElement );
            }
            function handleModelChange( newValue, oldValue ) {
                scope.$evalAsync( synchronizeUniform );
            }
            function synchronizeUniform() {
                if ( ! scope.$parent ) {
                    return;
                }
                if ( ! uniformedElement ) {
                    return( uniformedElement = element.uniform() );
                }
                uniformedElement.uniform.update( uniformedElement );
            }
        }
    }
);

app.filter('rupiah', function () {
    return function (val) {
        while (/(\d+)(\d{3})/.test(val)){
            val = val.replace(/(\d+)(\d{3})/, '$1'+'.'+'$2');
        }
        var val = val;
        return val;
    };
});

app.filter('range', function() {
    return function(input, min, max) {
        min = parseInt(min); //Make string input int
        max = parseInt(max);
        for (var i=min; i<max; i++)
            input.push(i);
        return input;
    };
});

app.filter('startFrom', function () {
    return function (input, start) {
        if (input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});

app.directive("limitTo", [function () {
    return {
        restrict: "A",
        link: function (scope, elem, attrs) {
            var limit = parseInt(attrs.limitTo);
            var allowedKeys = [8, 38, 40, 46];

            angular.element(elem).on("keypress", function (event) {
                var key = event.which || event.keyCode;
                if (this.value.length === limit && allowedKeys.indexOf(key) < 0) {
                    event.preventDefault();
                }
            });
        }
    };
}]);

app.directive('numbersOnly', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attrs, modelCtrl) {
            modelCtrl.$parsers.push(function (inputValue) {
                if (inputValue == undefined) return ''
                var transformedInput = inputValue.replace(/[^0-9]/g, '');
                if (transformedInput != inputValue) {
                    modelCtrl.$setViewValue(transformedInput);
                    modelCtrl.$render();
                }

                return transformedInput;
            });
        }
    };
});