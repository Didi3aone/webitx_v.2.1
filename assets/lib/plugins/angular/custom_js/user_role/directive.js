app.directive("select22", function ($timeout, $parse) {
    return {
        restrict: 'AC',
        require: 'ngModel',
        link: function (scope, element, attrs) {
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

app.directive('showErrors', function($timeout) {
    return {
        restrict: 'A',
        require: '^form',
        link: function (scope, el, attrs, formCtrl) {
            // find the text box element, which has the 'name' attribute
            var inputEl   = el[0].querySelector("[name]");
            // convert the native text box element to an angular element
            var inputNgEl = angular.element(inputEl);
            // get the name on the text box
            var inputName = inputNgEl.attr('name');

            // only apply the has-error class after the user leaves the text box
            var blurred = false;
            inputNgEl.bind('blur', function() {
                blurred = true;
                el.toggleClass('has-error', formCtrl[inputName].$invalid);
            });

            scope.$watch(function() {
                return formCtrl[inputName].$invalid
            }, function(invalid) {
                // we only want to toggle the has-error class after the blur
                // event or if the control becomes valid
                if (!blurred && invalid) { return }
                el.toggleClass('has-error', invalid);
            });

            scope.$on('show-errors-check-validity', function() {
                el.toggleClass('has-error', formCtrl[inputName].$invalid);
                inputEl.focus();
                //   $('html, body').animate({
                //     scrollTop: inputNgEl.$invalid.offset().top
                // }, 2000);
            });

            scope.$on('show-errors-reset', function() {
                $timeout(function() {
                    el.removeClass('has-error');

                }, 0, false);
            });
        }
    }
});


app.directive("ngUnique", function(services) {
    return {
        // restrict: 'A',
        require: 'ngModel',
        link: function (scope, element, attrs, ngModel) {
            element.on('blur', function (evt) {
                scope.$apply(function () {
                    var keyProperty = scope.$eval(attrs.ngUnique);
                    var currentValue = element.val();
                    services.checkUniqueValue(keyProperty.table, keyProperty.userid, keyProperty.where)
                        .then(function (data) {
                            console.log('status = '+data);
                            ngModel.$setValidity('unique', data);
                        });
                });
            });

        }
    }
});

app.directive('pwCheck', function () {
    return {
        require: 'ngModel',
        link: function (scope, elem, attrs, ctrl) {
            var firstPassword = '#' + attrs.pwCheck;
            elem.add(firstPassword).on('keyup', function () {
                scope.$apply(function () {
                    var v = elem.val()===$(firstPassword).val();
                    ctrl.$setValidity('pwmatch', v);
                });
            });
        }
    }
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

app.filter('range', function() {
  return function(input, min, max) {
    min = parseInt(min); //Make string input int
    max = parseInt(max);
    for (var i=min; i<max; i++)
      input.push(i);
    return input;
  };
});