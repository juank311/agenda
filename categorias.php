<?php require 'conexion_pgs.php'?>
<?php include("includes/header.php") ?>
<?php 

//SECCION DE CONSULTA INSERT
$query_search = "SELECT * FROM agenda_s.categories";
$stmt_search = $pdo->query($query_search);
$categories_table = $stmt_search->fetchAll(PDO::FETCH_OBJ);

//var_dump($categories_table);



?>


<div class="row">
    <div class="col-sm-6">
        <h3>Lista de Categorías</h3>
    </div> 
                   
    <div class="col-sm-4 offset-2">
        <a href="crear_categoria.php" class="btn btn-success w-100"><i class="bi bi-plus-circle-fill"></i> Nueva Categoría</a>
    </div>    
</div>
<div class="row mt-2 caja">
                    <?php if (isset($_GET['mensaje'])) : ?>
                    <!-- mensaje --> 
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php echo $_GET['mensaje'];?></strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif ?>
                    <!-- error --> 
                    <?php if (isset($_GET['error'])) : ?>
                        <h6 class="bg-danger text-white"><?php echo $_GET['error']; ?></h6>
                    <?php endif ?>
                    <!-- end error -->
    <div class="col-sm-12">
            <table id="tblCategorias" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>                
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                   
                    <?php  foreach ($categories_table as $row) : ?>
                    <tr>
                        <td><?php echo $row->id; ?></td>
                        <td><?php echo $row->categories; ?></td>
                        <td>
                        <a href="editar_categoria.php?id=<?php echo $row->id; ?>" class="btn btn-warning"><i class="bi bi-pencil-fill"></i>Editar</a>
                        <a href="borrar_categoria.php?id=<?php echo $row->id; ?>" class="btn btn-danger"><i class="class = bi bi-trash"></i>Borrar</a>
                        </td>
                        
                    </tr>
                    <?php endforeach ?>                                     
                </tbody>       
            </table>
    </div>
</div>
<?php include("includes/footer.php") ?>

<script>
    $(document).ready( function () {
        $('#tblCategorias').DataTable();
    });
</script>