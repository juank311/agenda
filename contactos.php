<?php require 'conexion_pgs.php'?>
<?php include("includes/header.php") ?>

<?php
/* //esta es la consulta
$query_search = "SELECT cat.id AS categories_id, cat.categories, con.name, con.last_name, con.phone, con.email 
FROM agenda_s.contacts con 
INNER JOIN agenda_s.categories cat 
ON con.id_categories = cat.id;";
$stmt_search = $pdo->query($query_search);
$contacts_table = $stmt_search->fetchAll(PDO::FETCH_OBJ); 
$query_search = "SELECT cat.id, cat.categories, con.name, 
con.last_name, con.phone, con.email 
FROM agenda_s.contacts con
INNER JOIN agenda_s.categories cat
ON con.id_categories = cat.id;";
$stmt_search = $pdo->query($query_search);
$contacts_table = $stmt_search->fetchAll(PDO::FETCH_OBJ);
*/

//esta es la consulta
$query_search = "SELECT *
FROM agenda_s.contacts con
INNER JOIN agenda_s.categories cat
ON con.id_categories = cat.id;";
$stmt_search = $pdo->query($query_search);
$contacts_table = $stmt_search->fetchAll(PDO::FETCH_OBJ);

?>



<div class="row">
    <div class="col-sm-6">
        <h3>Lista de Contactos</h3>
    </div> 
    <div class="col-sm-4 offset-2">
        <a href="crear_contacto.php" class="btn btn-success w-100"><i class="bi bi-plus-circle-fill"></i>Nuevo Contacto</a>
    </div>    
</div>
<div class="row mt-2 caja">
    <div class="col-sm-12">
            <table id="tblContactos" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Email</th> 
                        <th>Categoría</th>                    
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php  foreach ($contacts_table as $value) : ?>
                    <tr>
                        <td><?php echo $value->id; ?></td>
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo $value->last_name; ?></td>
                        <td><?php echo $value->phone; ?></td>
                        <td><?php echo $value->email; ?></td>
                        <td><?php echo $value->categories; ?></td>
                        <td>
                            <a href="editar_contacto.php" class="btn btn-warning"><i class="bi bi-pencil-fill"></i> Editar</a>
                            <a href="borrar_contacto.php" class="btn btn-danger"><i class="bi bi-x-circle-fill"></i> Borrar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                   
                        </td>
                    </tr>                                          
                </tbody>       
            </table>
    </div>
</div>
<?php include("includes/footer.php") ?>

<script>
    $(document).ready( function () {
        $('#tblContactos').DataTable();
    });
</script>