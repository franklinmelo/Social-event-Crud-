<?php 
    
    function usuarioLogado($user){
        $_SESSION['usuarioLogado'] = $user;
    }

    function sessionInit(){
        return isset($_SESSION['usuarioLogado']);
    }

    function idUsuario($id){
        $_SESSION['idUsuarioLogado'] = $id;
    }

    function returnidUser(){
        return isset($_SESSION['idUsuarioLogado']);
    }
?>