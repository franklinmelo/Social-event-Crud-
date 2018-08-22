<?php 
    session_start();
    if(!$_SESSION['auth']){
        header('location: login.php');
    }
?>

<?php
    require 'db.php';
    require 'functions.php';
    $id_user = $_SESSION['idUsuarioLogado'];
    $sql = "SELECT * FROM EVENTO WHERE ID_USUARIO = '$id_user'";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $eventos = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>
<?php require 'header.php'?>
<div class='container'>
    <div class='card  mt-5'>
        <div class='card-header'>
            <h2>Todos os eventos</h2>
        </div>
        <div class='card-body'>
            <table class='table table-bordered'>
                <tr>
                    <th>Evento</th>
                    <th>Data</th>
                    <th>Action</th>
                </tr>
                <?php foreach($eventos as $evento): ?>
                    <tr>
                        <td><?= $evento->EVENTO; ?></td>
                        <td><?= $evento->DATA_EVENTO; ?></td>
                        <td>
                            <a href="edit.php?id=<?= $evento->ID?>" class='btn btn-info'>Detalhes</a>
                            <a onClick="return confirm('Tem certeza que quer deletar este evento?')" href="delete.php?id=<?= $evento->ID?>" class='btn btn-danger'>Deletar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
<?php require 'footer.php'?>