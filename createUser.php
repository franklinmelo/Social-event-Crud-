<?php
    require 'db.php';
    $message= '';
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password_user'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password_user = md5($_POST['password_user']);

        $sql='INSERT INTO USUARIO(USUARIO, EMAIL, SENHA) VALUE(:username, :email, :password_user)';
        $statement = $connection->prepare($sql);

        if($statement->execute([':username'=>$username, ':email'=>$email, ':password_user'=>$password_user])){
            header('location: index.php');
        }
        else{
            $message = 'Usuario já existe';
        }
    }
?>

<?php require 'headerLogin.php'?>
    <div class='container'>
        <div class='card mt-5'>
            <div class='card-header'>
                <h2>Registre-se</h2>
            </div>
            <div class='card-body'>
                <?php if(!empty($message)):?>
                    <div class='alert alert-success'>
                        <?php echo $message; ?>
                    </div>
                <?php endif ?>
                <form  method='POST' action="">
                    <div class='form-group'>
                        <label for="username">Usuario</label>
                        <input type="text" name='username'  class='form-control' required>
                    </div>
                    <div class='form-group'>
                        <label for="email">Email</label>
                        <input type="email" name='email'  class='form-control' required>
                    </div>
                    <div class='form-group'>
                        <label for="password_user">Senha</label>
                        <input type="password" name='password_user' class='form-control' required>
                    </div>
                    <div class='form-group'>
                        <button type='submit' name='save' class='btn btn-info'>Cadastrar</button>
                    </div>
                </form>
                <p>Já possui conta? <a href="login.php">Entre</a></p>
            </div>
        </div>
    </div>
<?php require 'footer.php'?>