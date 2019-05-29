app.factory("services", function($http) {
    var obj = {};
    obj.viewByParam = function(url){
        return $http.get(url);
    }
    obj.postValue = function(url,data){
        return $http.post(url,data);
    }
    obj.getValue = function(url){
        return $http.get(url);
    }
    obj.viewReservation = function(url,bookCode){
        return $http.get(url + '?bookCode=' + bookCode);
    }
    obj.viewReservationDetail = function(url,id){
        return $http.get(url + '?id=' + id);
    }

    obj.getAttachment = function (url,data) {
        return $http.post(url, data);
    };

    obj.loadInvoice = function (url,data) {
        return $http.post(url, data);
    };

    obj.insertInvoice = function (url,data) {
        return $http.post(url, data);
    };

    obj.insert = function (url,data) {
        return $http.post(url, data).then(function (results) {
            return results;
        });
    };

    obj.delete = function (url,id) {
        return $http.post(url + '?id=' + id);
    };

    // obj.reloadTable = function (url) {
    //     $http.get(url).success(function (data) {
    //         $scope.list = data;
    //         $scope.currentPage = 1; //current page
    //         $scope.entryLimit = 20; //max no of items to display in a page
    //         $scope.filteredItems = $scope.list.length; //Initially for no filter
    //         $scope.totalItems = $scope.list.length;
    //     });
    //     $scope.setPage = function (pageNo) {
    //         $scope.currentPage = pageNo;
    //     };
    //     $scope.filter = function () {
    //         $timeout(function () {
    //             $scope.filteredItems = $scope.filtered.length;
    //         }, 20);
    //     };
    //     $scope.sort_by = function (predicate) {
    //         $scope.predicate = predicate;
    //         $scope.reverse = !$scope.reverse;
    //     };
    // }

    return obj;
});

app.service("load", function($http, $timeout) {
    this.table = function ($scope) {
        $http.get($scope.url).success(function (result) {
            $scope.list = result;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 20; //max no of items to display in a page
            $scope.filteredItems = $scope.list.length; //Initially for no filter
            $scope.totalItems = $scope.list.length;

        });
        $scope.setPage = function (pageNo) {
            $scope.currentPage = pageNo;
        };
        $scope.filter = function () {
            $timeout(function () {
                $scope.filteredItems = $scope.filtered.length;
            }, 20);
        };
        $scope.sort_by = function (predicate) {
            $scope.predicate = predicate;
            $scope.reverse = !$scope.reverse;
        };

    };

    // this.masterSupplier = function ($scope){
    //     $http.get($scope.urlMaintenance)
    //         .success(function (response) {
    //             $scope.listSupplier = response;
    //         });
    // };
});