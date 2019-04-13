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

});