<?php 
    session_start();
    if(!$_SESSION['auth']){
        header('location: login.php');
    }
?>
<?php 
    require 'db.php';
    $id = $_GET['id'];
    $sql = 'SELECT * FROM EVENTO WHERE ID=:id';
    $statement = $connection->prepare($sql);
    $statement->execute([':id'=> $id]);
    $eventos = $statement->fetch(PDO::FETCH_OBJ);
    if(isset($_POST['evento']) && isset($_POST['data']) && isset($_POST['local']) && isset($_POST['horario'])){
        $evento = $_POST['evento'];
        $data_evento = $_POST['data'];
        $local_evento = $_POST['local'];
        $horario = $_POST['horario'];

        $sql = 'UPDATE EVENTO SET EVENTO=:evento, DATA_EVENTO=:data_evento, LOCAL_EVENTO=:local_evento, HORARIO=:horario WHERE ID=:id';
        $statement = $connection->prepare($sql);

        if($statement->execute([':evento'=>$evento,':data_evento'=>$data_evento, ':local_evento'=>$local_evento, ':horario'=>$horario, ':id'=>$id])){
            header("location: index.php");
        }
    }
?>

<?php require 'header.php'?>
<div class='container'>
    <div class='card mt-5'>
        <div class='card-header'>
            <h2>Edite um evento</h2>
        </div>
        <div class='card-body'>
            <?php if(!empty($message)):?>
            <div class='alert alert-success'>
                <?php echo $message; ?>
            </div>
            <?php endif ?>
            <form  method='POST' action="">
                <div class='form-group'>
                    <label for="evento">Evento</label>
                    <input value='<?= $eventos->EVENTO?>'type="text" name='evento' id='evento' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for="data">Data</label>
                    <input value='<?= $eventos->DATA_EVENTO?>' type="date" name='data' id='data' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for="local">Local</label>
                    <input value='<?= $eventos->LOCAL_EVENTO?>' type="text" name='local' id='local' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for="horario">Horario</label>
                    <input value='<?= $eventos->HORARIO?>' type="time" name='horario' id='horario' class='form-control'>
                </div>
                <div class='form-group'>
                    <button type='submit' name='save' class='btn btn-info'>Modificar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require 'footer.php'?>