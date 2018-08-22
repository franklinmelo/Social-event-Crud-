<?php 
    require 'db.php';
    require 'functions.php';
    $message= '';
    $status=false;
    if(isset ($_POST['username']) && isset ($_POST['password_user'])){
        $username = $_POST['username'];
        $password_user = $_POST['password_user'];
        $passwordmd5 = md5($password_user);

        $sql = "SELECT * FROM USUARIO WHERE USUARIO='$username' AND SENHA='$passwordmd5'";
        $statement= $connection->prepare($sql);
        $statement->execute();
        $stmt = $statement->fetch(PDO::FETCH_ASSOC);
        if($stmt != null){
            session_start();
            $_SESSION['auth']=true;
            $status = true;
            usuarioLogado($stmt['USUARIO']);
            idUsuario($stmt['ID']);
            header('location: index.php');
        }
        else{
           $message ='Usuario ou Senha invalidos';
        }
    }
?>

<?php require 'headerLogin.php' ?>
    <div class='container'>
        <div class='card mt-5'>
            <div class='card-header'>
                <h2>Realize Login</h2>
            </div>
            <div class='card-body'>
                <?php if(!empty($message)):?>
                    <div class='alert alert-success'>
                        <?php echo $message; ?>
                    </div>
                <?php endif ?>
                <form method="POST">
                    <div class='form-group'>
                        <label>Usuario</label>
                        <input type="text" name='username' class='form-control'>
                    </div>
                    <div class='form-group'>
                        <label>Senha</label>
                        <input type="password" name='password_user' class='form-control'>
                    </div>
                    <div class='form-group'>
                        <button type='submit' class='btn btn-info'>Login</button>
                </form>
                <p>Não possui conta? <a href="createUser.php">Cadastre-se</a></p>
            </div>
        </div>
    </div>
<?php require 'footer.php'?>