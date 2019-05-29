app.factory("services", function($http) {
    app.service("load", function($http) {
        this.table = function ($scope) {
            setTimeout(function() {
                $('.datatable-nested').DataTable({
                    destroy: true,
                    processing: true,
                    data: $scope.dataSet,
                    buttons: {
                        buttons: $scope.buttons
                    },
                    columnDefs: $scope.columnDefs
                });
            }, 300);
            };

        };
    });
});