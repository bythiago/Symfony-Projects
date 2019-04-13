angular.module('LivroApp', []).controller('LivroController', function ($http, $scope) {
    var livroList = this;

    livroList.listaLivros = function () {
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/livro/list/all'
        }).then(function (response) {
            $scope.livros = response.data;
            console.log(response.data);

        }, function (response) {
            console.log(response.status);
        });
    }

    livroList.setInterval = function () {
        setInterval(function () {
            livroList.listaLivros();
        }, 1000 * 60);
    }

    livroList.start = function () {
        livroList.listaLivros();
        livroList.setInterval();
    }

    //initializing the project
    livroList.start();

}).controller('UsuarioController', function ($scope, $http) {
    $scope.getCep = function(cep){

        if((cep.replace('-', '').length == 8) && angular.isNumber(parseInt(cep.replace('-', '')))){
            $http.get('https://viacep.com.br/ws/'+cep.replace('-', '')+'/json/')
            .then(function(response){
                $scope.data = response.data;
                if($scope.data.erro){
                    alert('O CEP ' + cep + ' é inválido');
                }
            }, function(response){
                delete $scope.data;
                alert(response.status);
            });
        }
    }
});