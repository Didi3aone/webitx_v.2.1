app.factory("services", function($http) {
    var obj = {};
    obj.postValue = function(url,data){
        return $http.post(url,data);
    };
    obj.getValue = function(url){
        return $http.get(url);
    };
    obj.checkUniqueValue = function(password) {
        var data = {
            password: password
        };
        return $http.post(baseUrl + "my_profile/validatePassword", data).then(function (result) {
            return result.data.status;
        });
    };

    return obj;
});