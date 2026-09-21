<?php
// politica-cookies.php
// CUIDAPP — Política de Cookies
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Cookies — CUIDAPP</title>
    <link rel="stylesheet" href="../estilos.css">
    <style>
        .legal-container {
            max-width: 760px;
            margin: 2rem auto;
            padding: 2rem 1.5rem;
        }
        .legal-container h1 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        .legal-container h2 {
            font-size: 1.1rem;
            margin-top: 2rem;
            margin-bottom: 0.5rem;
        }
        .legal-container p, .legal-container li {
            line-height: 1.7;
            margin-bottom: 0.75rem;
            color: #444;
        }
        .legal-container ul {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }
        .legal-fecha {
            font-size: 0.85rem;
            color: #888;
            margin-bottom: 2rem;
        }
        .tabla-cookies {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
            font-size: 0.9rem;
        }
        .tabla-cookies th, .tabla-cookies td {
            border: 1px solid #ddd;
            padding: 0.6rem 0.8rem;
            text-align: left;
            vertical-align: top;
        }
        .tabla-cookies th {
            background: #f5f5f5;
            font-weight: 600;
        }
        .badge-tecnica {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }
    </style>
</head>
<body>

<header>
    <h1>CUIDAPP</h1>
    <nav>
        <a href="index.php">Inicio</a>
    </nav>
</header>

<main class="legal-container">

    <h1>Política de Cookies</h1>
    <p class="legal-fecha">Última actualización: Mayo 2026</p>

    <h2>1. ¿Qué son las cookies?</h2>
    <p>
        Las cookies son pequeños archivos de texto que un sitio web guarda en tu navegador cuando lo visitas. Sirven para que la web recuerde información sobre tu visita, como si has iniciado sesión o tus preferencias de idioma.
    </p>

    <h2>2. Cookies que utiliza CUIDAPP</h2>
    <p>
        CUIDAPP únicamente utiliza <strong>cookies técnicas estrictamente necesarias</strong> para el funcionamiento del servicio. No utilizamos cookies de seguimiento, publicidad ni analítica de terceros.
    </p>

    <table class="tabla-cookies">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Finalidad</th>
                <th>Duración</th>
                <th>Origen</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>PHPSESSID</code></td>
                <td><span class="badge-tecnica">Técnica</span></td>
                <td>Mantiene la sesión del usuario activa mientras navega por la plataforma. Sin ella, el login no funciona.</td>
                <td>Sesión (se elimina al cerrar el navegador)</td>
                <td>CUIDAPP (propia)</td>
            </tr>
        </tbody>
    </table>

    <h2>3. ¿Necesito dar consentimiento?</h2>
    <p>
        Las cookies técnicas estrictamente necesarias <strong>no requieren tu consentimiento</strong> según el artículo 22.2 de la LSSI-CE, ya que son indispensables para que el servicio funcione. Sin embargo, te informamos de su existencia para cumplir con el principio de transparencia del RGPD.
    </p>

    <h2>4. Cómo desactivar o eliminar cookies</h2>
    <p>
        Puedes configurar tu navegador para bloquear o eliminar cookies en cualquier momento. Ten en cuenta que si bloqueas la cookie de sesión (<code>PHPSESSID</code>), no podrás iniciar sesión en la plataforma.
    </p>
    <p>Instrucciones según navegador:</p>
    <ul>
        <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener">Google Chrome</a></li>
        <li><a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-sitios-web-rastrear-preferencias" target="_blank" rel="noopener">Mozilla Firefox</a></li>
        <li><a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank" rel="noopener">Safari</a></li>
        <li><a href="https://support.microsoft.com/es-es/microsoft-edge/eliminar-las-cookies-en-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener">Microsoft Edge</a></li>
    </ul>

    <h2>5. Actualizaciones de esta política</h2>
    <p>
        Si en el futuro CUIDAPP incorpora cookies analíticas (como Google Analytics) o de otro tipo, actualizaremos esta política e informaremos a los usuarios, solicitando el consentimiento necesario en cada caso.
    </p>

    <h2>6. Contacto</h2>
    <p>
        Para cualquier consulta sobre el uso de cookies, puedes escribirnos a <a href="mailto:derekcuquerellacuidapp@gmail.com">derekcuquerellacuidapp@gmail.com</a>.
    </p>

</main>

<footer>
    <p>
        <a href="aviso-legal.php">Aviso Legal</a> |
        <a href="politica-privacidad.php">Política de Privacidad</a> |
        <a href="politica-cookies.php">Política de Cookies</a>
    </p>
    <p>CUIDAPP © 2026 — Barcelona</p>
</footer>

</body>
</html>
