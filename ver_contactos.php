<?php
// Incluir el archivo de conexión
include 'CRUD/conexion.php';

// Inicializar las variables de filtro
$motivoFiltro = isset($_POST['motivo_filtro']) ? $_POST['motivo_filtro'] : '';
$fechaFiltro = isset($_POST['fecha_filtro']) ? $_POST['fecha_filtro'] : '';

// Crear la consulta con filtros si se seleccionan
$sql = "SELECT c.*, m.descripcion AS motivo FROM contactos c
        JOIN motivos m ON c.motivo_id = m.id
        WHERE 1";

// Filtro por motivo
if ($motivoFiltro) {
    $sql .= " AND m.descripcion = '$motivoFiltro'";
}

// Filtro por fecha
if ($fechaFiltro) {
    $sql .= " AND DATE(c.fecha_envio) = '$fechaFiltro'";
}

$sql .= " ORDER BY c.fecha_envio DESC";

// Ejecutar la consulta
$resultado = $conn->query($sql);

// Comprobar si la consulta se ejecutó correctamente
if (!$resultado) {
    echo "Error en la consulta: " . $conn->error;
    exit;
}

// Eliminar mensajes seleccionados
if (isset($_POST['delete_ids']) && is_array($_POST['delete_ids'])) {
    $delete_ids = implode(',', $_POST['delete_ids']); // Convertir el array de IDs en una cadena separada por comas
    $delete_sql = "DELETE FROM contactos WHERE id IN ($delete_ids)";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Mensajes eliminados exitosamente.'); window.location.href='';</script>";
    } else {
        echo "Error al eliminar los mensajes: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mensajes de Contacto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script>
        // Función para filtrar los resultados de la tabla en tiempo real
        function filterTable() {
            let input = document.getElementById('searchInput');
            let filter = input.value.toLowerCase();
            let table = document.getElementById('contactosTable');
            let rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName('td');
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j]) {
                        let cellText = cells[j].textContent || cells[j].innerText;
                        if (cellText.toLowerCase().indexOf(filter) > -1) {
                            match = true;
                        }
                    }
                }

                if (match) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1>Mensajes de Contacto</h1>

        <!-- Formulario de filtros -->
        <form method="POST" class="mb-3">
            <!-- Filtro por motivo -->
            <div class="row">
                <div class="col">
                    <select name="motivo_filtro" class="form-control">
                        <option value="">Seleccionar motivo</option>
                        <option value="queja" <?php echo $motivoFiltro == 'queja' ? 'selected' : ''; ?>>Queja</option>
                        <option value="reclamo" <?php echo $motivoFiltro == 'reclamo' ? 'selected' : ''; ?>>Reclamo</option>
                        <option value="felicitacion" <?php echo $motivoFiltro == 'felicitacion' ? 'selected' : ''; ?>>Felicitación</option>
                        <option value="consulta" <?php echo $motivoFiltro == 'consulta' ? 'selected' : ''; ?>>Consulta</option>
                    </select>
                </div>

                <!-- Filtro por fecha -->
                <div class="col">
                    <input type="date" name="fecha_filtro" value="<?php echo $fechaFiltro; ?>" class="form-control">
                </div>

                <!-- Botón de Filtrar -->
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        <!-- Formulario de búsqueda -->
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar mensajes..." onkeyup="filterTable()">
        </div>

        <!-- Formulario para eliminar múltiples mensajes -->
        <form method="POST" id="deleteForm">
            <!-- Botón de eliminar múltiples mensajes -->
            <button type="submit" class="btn btn-danger mb-3">Eliminar Mensajes Seleccionados</button>

            <!-- Tabla de mensajes -->
            <table id="contactosTable" class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll" onclick="toggleSelectAll()"></th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Motivo</th> 
                        <th>Mensaje</th>
                        <th>Fecha de Envío</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Comprobar si hay resultados
                    if ($resultado->num_rows > 0): 
                        // Si hay resultados, mostrar cada fila
                        while ($fila = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td><input type="checkbox" name="delete_ids[]" value="<?php echo $fila['id']; ?>"></td>
                                <td><?php echo $fila['id']; ?></td>
                                <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($fila['correo']); ?></td>
                                <td><?php echo htmlspecialchars($fila['motivo']); ?></td>
                                <td><?php echo nl2br(htmlspecialchars($fila['mensaje'])); ?></td>
                                <td><?php echo $fila['fecha_envio']; ?></td>
                            </tr>
                        <?php endwhile; 
                    else: ?>
                        <tr><td colspan="7">No hay mensajes de contacto disponibles.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </form>

        <a href="perfil.php" class="btn btn-secondary mt-3">Volver al Perfil</a>
    </div>

    <script>
        // Función para alternar la selección de todos los checkboxes
        function toggleSelectAll() {
            let selectAllCheckbox = document.getElementById('selectAll');
            let checkboxes = document.getElementsByName('delete_ids[]');
            for (let checkbox of checkboxes) {
                checkbox.checked = selectAllCheckbox.checked;
            }
        }
    </script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
