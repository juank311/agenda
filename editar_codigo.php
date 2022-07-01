<?php include("includes/header.php") ?>
<?php
     //Consulta para mostrar como placeholder editable
    if (isset($_GET['id'])) {

        $id_categories = $_GET['id']; 

        $query_search = "SELECT * FROM agenda_s.categories WHERE id = ?";
        $stmt_search=$pdo->prepare($query_search);
        $stmt_search->execute([$id_categories]);
        $result_search = $stmt_search->fetch(PDO::FETCH_OBJ);
    } 

    

//Edicion del id de la categoria mediante nuevo id 
if (isset($_POST['editarCodigo'])) { 
    $new_id_categories = $_POST['new_id_categories'];
    $id_categories = $_GET['id']; 
    
    $query_update = "UPDATE agenda_s.categories SET id = ? WHERE id = ? ";
    $stmt_update = $pdo->prepare($query_update);
    $stmt_update->execute([$new_id_categories, $id_categories]);

    if ($stmt_update) {
        $mensaje = "Código ". $new_id_categories." editado exitosamente!!";
        header('Location: categorias.php?mensaje='.urldecode($mensaje));
    }
}

 


?>

    <div class="row">
        <div class="col-sm-6">
            <h3>Editar Código de Categoría</h3>
        </div>            
    </div>
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
    <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="new_id_categories" class="form-label">Códido ID:</label>
                <input type="text" class="form-control" name="new_id_categories" id="new_id_categories"  value=<?php echo $result_search->id;?>>
                <br>
                <label for="categories_name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="categories_name" id="categories_name" placeholder="Ingresa el nuevo nombre" value=<?php echo $result_search->categories;?> readonly >               
            </div>          

            <button type="submit" name="editarCodigo" class="btn btn-primary w-100"> <i class="bi bi-pencil-fill"></i> Editar Código</button>
            </form>
        </div>
    </div>
<?php include("includes/footer.php") ?>