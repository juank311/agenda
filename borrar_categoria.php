<?php require 'conexion_pgs.php'?>
<?php include("includes/header.php") ?>
<?php
    if (isset($_GET['id'])) {

        $id_categories = $_GET['id']; 

        $query_search = "SELECT * FROM agenda_s.categories WHERE id = ?";
        $stmt_search=$pdo->prepare($query_search);
        $stmt_search->execute([$id_categories]);
        $result_search = $stmt_search->fetch(PDO::FETCH_OBJ);
        
    } 

if (isset($_POST['borrarCategoria'])) { 
    $categories_name = $_POST['categories_name'];
    $id_categories = $_GET['id']; 

    $query_delete = "DELETE FROM agenda_s.categories WHERE id = ? ";
    $stmt_delete = $pdo->prepare($query_delete);
    $stmt_delete->execute([$id_categories]);
        if ($stmt_delete) {
            $mensaje = "Categoria ".$id_categories. " " . $categories_name. " borrada exitosamente!!";
            header('Location: categorias.php?mensaje='.urldecode($mensaje));
        }
}

 


?>

    <div class="row">
        <div class="col-sm-6">
            <h3>Editar Categoría</h3>
        </div>            
    </div>
                
    <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="categories_name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="categories_name" id="categories_name" value=<?php echo $result_search->categories;?> readonly>               
            </div>          

            <button type="submit" name="borrarCategoria" class="btn btn-primary w-100">Borrar Categoría</button>
            </form>
        </div>
    </div>
<?php include("includes/footer.php") ?>
       