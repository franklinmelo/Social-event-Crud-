<?php 
    session_start();
    if(!$_SESSION['auth']){
        header('location: login.php');
    }
?>

<?php 

    require 'db.php';
    $message = '';
    if(isset($_POST['evento']) && isset($_POST['data']) && isset($_POST['local']) && isset($_POST['horario']) && isset($_POST['idUser'])){
        $evento = $_POST['evento'];
        $data_evento = $_POST['data'];
        $local_evento = $_POST['local'];
        $horario = $_POST['horario'];
        $id_user = $_POST['idUser'];

        $sql = 'INSERT INTO EVENTO(EVENTO, DATA_EVENTO, LOCAL_EVENTO, HORARIO, ID_USUARIO) VALUES(:evento, :data_evento, :local_evento, :horario, :id_user)';
        $statement = $connection->prepare($sql);

        if($statement->execute([':evento'=>$evento,':data_evento'=>$data_evento, ':local_evento'=>$local_evento, ':horario'=>$horario, ':id_user'=>$id_user])){
            $message = 'evento inserido com sucesso';
            header("location: index.php");
        }
    }
?>

<?php require 'header.php'?>
    <div class='container'>
        <div class='card mt-5'>
            <div class='card-header'>
                <h2>Crie um evento</h2>
            </div>
            <div class='card-body'>
                <?php if(!empty($message)):?>
                <div class='alert alert-success'>
                    <?php echo $message; ?>
                </div>
                <?php endif ?>
                <form  method='POST' action="">
                    <?php require 'functions.php'?>
                    <input type="hidden" name='idUser' value=<?=$_SESSION['idUsuarioLogado'] ?>>
                    <div class='form-group'>
                        <label for="evento">Evento</label>
                        <input type="text" name='evento' id='evento' class='form-control'>
                    </div>
                    <div class='form-group'>
                        <label for="data">Data</label>
                        <input type="date" name='data' id='data' class='form-control'>
                    </div>
                    <div class='form-group'>
                        <label for="local">Local</label>
                        <input type="text" name='local' id='local' class='form-control'>
                    </div>
                    <div class='form-group'>
                        <label for="horario">Horario</label>
                        <input type="time" name='horario' id='horario' class='form-control'>
                    </div>
                    <div class='form-group'>
                        <button type='submit' name='save' class='btn btn-info'>Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require 'footer.php'?>