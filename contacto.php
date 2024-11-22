<?php
include_once("header.php");

$mensajeConfirmacion = ""; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        
        $host = 'sql101.infinityfree.com'; 
        $dbname = 'if0_37766404_dblibreria'; 
        $username = 'if0_37766404'; 
        $password = 'hZoT6mmiL4uhOhH'; 

        
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $nombre = htmlspecialchars($_POST["nombre"]);
        $correo = htmlspecialchars($_POST["correo"]);
        $asunto = htmlspecialchars($_POST["asunto"]);
        $comentario = htmlspecialchars($_POST["mensaje"]);

        
        $sql = "INSERT INTO contacto (nombre, correo, asunto, comentario, fecha) 
                VALUES (:nombre, :correo, :asunto, :comentario, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':asunto' => $asunto,
            ':comentario' => $comentario
        ]);

        
        $mensajeConfirmacion = "<div style='background-color: #dff0d8; color: #3c763d; padding: 10px 15px; border-radius: 4px; font-weight: bold; margin-top: 10px;'>{$nombre}, tu mensaje ha sido enviado satisfactoriamente.</div>";
    } catch (PDOException $e) {
        
        $mensajeConfirmacion = "<div style='background-color: #f2dede; color: #a94442; padding: 10px 15px; border-radius: 4px; font-weight: bold; margin-top: 10px;'>Hubo un error al guardar los datos: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column">
    <main class="flex-shrink-0">
        <section class="py-5">
            <div class="container px-5">
                <div class="bg-light rounded-4 py-5 px-4 px-md-5">
                    <div class="text-center mb-5">
                        <h1 class="fw-bolder">Contáctanos</h1>
                        <p class="lead fw-normal text-muted mb-0">¡Dinos qué piensas!</p>
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <form id="contactForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Escribe tu nombre..." required />
                                    <label for="nombre">Nombre</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="correo" name="correo" type="email" placeholder="nombre@ejemplo.com" required />
                                    <label for="correo">Correo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="asunto" name="asunto" type="text" placeholder="Asunto..." required />
                                    <label for="asunto">Asunto</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="mensaje" name="mensaje" placeholder="Escribe tu comentario..." style="height: 10rem" required></textarea>
                                    <label for="mensaje">Comentario</label>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Enviar</button>
                                </div>

                               
                                <?php echo $mensajeConfirmacion; ?>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include_once("footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
