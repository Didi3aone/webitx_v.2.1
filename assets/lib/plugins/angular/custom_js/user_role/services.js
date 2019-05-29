app.factory("services", function($http) {
    var obj = {};
    obj.postValue = function(url,data){
        return $http.post(url,data);
    };
    obj.getValue = function(url){
        return $http.get(url);
    };
    obj.checkUniqueValue = function(table, userid, where) {
        var data = {
            table: table,
            userid: userid,
            where: where
        };
        return $http.post(baseUrl + "identity/user/isUniqueValue", data).then(function (result) {
            return result.data.status;
        });
    };

    return obj;
});