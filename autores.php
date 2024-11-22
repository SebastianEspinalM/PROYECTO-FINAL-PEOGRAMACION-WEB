<?php 
    include_once("header.php");

    
    $host = 'sql101.infinityfree.com'; 
    $dbname = 'if0_37766404_dblibreria'; 
    $username = 'if0_37766404'; 
    $password = 'hZoT6mmiL4uhOhH'; 
    try {
        
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       
        $sql = "SELECT id_autor, apellido, nombre, telefono, direccion, ciudad, estado, pais, cod_postal FROM autores";
        $stmt = $pdo->query($sql);
    } catch (PDOException $e) {
        die("Error al conectar: " . $e->getMessage());
    }
?>
<body class="d-flex flex-column h-100 bg-light">
<style>
    .table thead th {
        background: linear-gradient(90deg, #6c63ff, #9c88ff);
        color: white;
        text-align: center;
        padding: 12px;
    }
    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .table tbody tr:hover {
        background-color: #ddd;
    }
    .table td {
        text-align: center;
        padding: 10px;
    }
</style>

    <main class="flex-shrink-0">
        
        <div class="container px-5 my-5">
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Autores</span></h1>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-11 col-xl-9 col-xxl-8">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Apellido</th>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Ciudad</th>
                                <th>Estado</th>
                                <th>País</th>
                                <th>Código Postal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($stmt->rowCount() > 0): ?>
                                <?php while ($autor = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($autor['id_autor']) ?></td>
                                        <td><?= htmlspecialchars($autor['apellido']) ?></td>
                                        <td><?= htmlspecialchars($autor['nombre']) ?></td>
                                        <td><?= htmlspecialchars($autor['telefono']) ?></td>
                                        <td><?= htmlspecialchars($autor['direccion']) ?></td>
                                        <td><?= htmlspecialchars($autor['ciudad']) ?></td>
                                        <td><?= htmlspecialchars($autor['estado']) ?></td>
                                        <td><?= htmlspecialchars($autor['pais']) ?></td>
                                        <td><?= htmlspecialchars($autor['cod_postal']) ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center">No se encontraron autores.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php 
        include_once("footer.php");
    ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
