app.service("reloadTable", function($http) {
    this.loadTable = function ($scope) {
        $http.get($scope.abc).success(function (result) {
            $scope.list = result;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 20; //max no of items to display in a page
            $scope.filteredItems = $scope.list.length; //Initially for no filter
            $scope.totalItems = $scope.list.length;

        });
        // $scope.setPage = function (pageNo) {
        //     $scope.currentPage = pageNo;
        // };
        // $scope.filter = function () {
        //     $timeout(function () {
        //         $scope.filteredItems = $scope.filtered.length;
        //     }, 20);
        // };
        // $scope.sort_by = function (predicate) {
        //     $scope.predicate = predicate;
        //     $scope.reverse = !$scope.reverse;
        // };

    }
});