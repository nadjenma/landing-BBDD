<?php
$home = preg_replace('/\s+/', ' ', trim($_GET["home"] ?? ""));
$destination = preg_replace('/\s+/', ' ', trim($_GET["destination"] ?? ""));
$startDate = trim($_GET["startDate"] ?? "");
$endDate = trim($_GET["endDate"] ?? "");
$discount = preg_replace('/\s+/', ' ', trim($_GET["discount"] ?? ""));

$error = "";

function fechaValida($fecha)
{
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
        return false;
    }

    $partes = explode("-", $fecha);
    return checkdate((int) $partes[1], (int) $partes[2], (int) $partes[0]);
}

if (!fechaValida($startDate) || !fechaValida($endDate)) {
    $error = "Escribe fechas válidas.";
} elseif ($endDate < $startDate) {
    $error = "La fecha de vuelta no puede ser anterior a la fecha de ida.";
}
?>
<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Busqueda</title>
    <link rel='stylesheet' href='styles.css'>

</head>

<body id="searchResults">
    <header id="menu">
        <a id="menuLogo" href="index.html" class="outlined hoverOutlined">
            <img class="icon" src="icons/airplane-plane-svgrepo-com.svg" alt="">
            <strong>FLYBY</strong>
        </a>
        <nav>
            <ul id="menuOptions">
                <li><a class="outlined hoverOutlined" href="#section2">DESTINOS</a></li>
                <li><a class="outlined hoverOutlined" href="#section5">SOBRE NOSOTROS</a></li>
                <li><a class="outlined hoverOutlined" href="#section5">CONTACTO</a></li>
                <li><button>¡PLANEA UN VIAJE!</button></li>
            </ul>
        </nav>
    </header>
    <main class="searchPage">
        <?php if ($error !== ""): ?>
            <div class="searchError">
                <h1>Error</h1>
                <p><?php echo htmlspecialchars($error, ENT_QUOTES, "UTF-8"); ?></p>
            </div>
        <?php else: ?>
            <section class="searchSummary" aria-label="Resumen de búsqueda">
                <div>
                    <span>Inicio</span>
                    <strong><?php echo htmlspecialchars($home, ENT_QUOTES, "UTF-8"); ?></strong>
                </div>
                <div>
                    <span>Destino</span>
                    <strong><?php echo htmlspecialchars($destination, ENT_QUOTES, "UTF-8"); ?></strong>
                </div>
                <div>
                    <span>Ida</span>
                    <strong><?php echo htmlspecialchars($startDate, ENT_QUOTES, "UTF-8"); ?></strong>
                </div>
                <div>
                    <span>Vuelta</span>
                    <strong><?php echo htmlspecialchars($endDate, ENT_QUOTES, "UTF-8"); ?></strong>
                </div>
                <?php if (!empty($discount)): ?>
                    <div>
                        <span>Descuento</span>
                        <strong><?php echo htmlspecialchars($discount, ENT_QUOTES, "UTF-8"); ?></strong>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </main>
</body>

</html>