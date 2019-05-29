app.factory("services", function($http) {
    var obj = {};
    obj.postValue = function(url,data){
        return $http.post(url,data);
    };
    obj.getValue = function(url){
        return $http.get(url);
    };

    return obj;
});