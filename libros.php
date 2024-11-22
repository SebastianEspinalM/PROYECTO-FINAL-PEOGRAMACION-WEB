<?php 
    include_once("header.php");

   
    $host = 'sql101.infinityfree.com'; 
    $dbname = 'if0_37766404_dblibreria'; 
    $username = 'if0_37766404'; 
    $password = 'hZoT6mmiL4uhOhH'; 

    try {
        
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $sql = "SELECT titulos.id_titulo, titulos.titulo, titulos.tipo AS genero, autores.nombre AS nombre_autor
                FROM titulos
                LEFT JOIN titulo_autor ON titulos.id_titulo = titulo_autor.id_titulo
                LEFT JOIN autores ON titulo_autor.id_autor = autores.id_autor";
        $stmt = $pdo->query($sql);
    } catch (PDOException $e) {
        
        die("Error al conectar: " . $e->getMessage());
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .table th {
            text-align: center;
            background: linear-gradient(90deg, #6c63ff, #9c88ff); 
            color: white;
            font-weight: bold;
            padding: 12px;
        }
        .table td {
            text-align: center;
            padding: 10px;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2; 
        }
        .table tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body class="d-flex flex-column h-100 bg-light">
    <main class="flex-shrink-0">
        <section class="py-5">
            <div class="container px-5 mb-5">
                <div class="text-center mb-5">
                    <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Librería</span></h1>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-11 col-xl-9 col-xxl-8">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Autor</th>
                                    <th>Género</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($stmt->rowCount() > 0): ?>
                                    <?php while ($titulo = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($titulo['id_titulo']) ?></td>
                                            <td><?= htmlspecialchars($titulo['titulo']) ?></td>
                                            <td><?= htmlspecialchars($titulo['nombre_autor'] ?? 'Sin autor') ?></td>
                                            <td><?= htmlspecialchars($titulo['genero'] ?? 'Sin género') ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No se encontraron títulos disponibles.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include_once("footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
