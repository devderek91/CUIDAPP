<?php
// politica-privacidad.php
// CUIDAPP — Política de Privacidad
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad — CUIDAPP</title>
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
        .tabla-tratamiento {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
            font-size: 0.9rem;
        }
        .tabla-tratamiento th, .tabla-tratamiento td {
            border: 1px solid #ddd;
            padding: 0.6rem 0.8rem;
            text-align: left;
            vertical-align: top;
        }
        .tabla-tratamiento th {
            background: #f5f5f5;
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

    <h1>Política de Privacidad</h1>
    <p class="legal-fecha">Última actualización: Mayo 2026</p>

    <p>
        En CUIDAPP nos tomamos muy en serio la privacidad de las personas que confían en nosotros sus datos. Esta política explica de forma clara y transparente qué datos recogemos, para qué los usamos y cuáles son tus derechos.
    </p>

    <h2>1. Responsable del tratamiento</h2>
    <p>
        <strong>Responsable:</strong> Derek Cuquerella Ureña<br>
        <strong>Ciudad:</strong> Barcelona, España<br>
        <strong>Email de contacto:</strong> <a href="mailto:derekcuquerellacuidapp@gmail.com">derekcuquerellacuidapp@gmail.com</a>
    </p>

    <h2>2. Datos que recogemos y finalidad</h2>

    <table class="tabla-tratamiento">
        <thead>
            <tr>
                <th>Datos recogidos</th>
                <th>Finalidad</th>
                <th>Base legal</th>
                <th>Tiempo de conservación</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nombre, email, tipo de usuario (familia / cuidadora)</td>
                <td>Gestión de la lista de espera de CUIDAPP antes del lanzamiento</td>
                <td>Consentimiento del interesado (art. 6.1.a RGPD)</td>
                <td>Hasta el lanzamiento de la plataforma, o hasta que el usuario solicite su eliminación</td>
            </tr>
            <tr>
                <td>Email (si aceptas comunicaciones)</td>
                <td>Envío de novedades y actualizaciones sobre CUIDAPP</td>
                <td>Consentimiento explícito (checkbox independiente)</td>
                <td>Hasta que el usuario retire el consentimiento</td>
            </tr>
            <tr>
                <td>Nombre, email, contraseña encriptada, ciudad, teléfono</td>
                <td>Creación y gestión de cuenta de usuario en la plataforma</td>
                <td>Ejecución de contrato (art. 6.1.b RGPD)</td>
                <td>Mientras la cuenta esté activa. Tras baja: 3 años por obligaciones legales</td>
            </tr>
        </tbody>
    </table>

    <h2>3. ¿Con quién compartimos tus datos?</h2>
    <p>
        No vendemos ni cedemos tus datos personales a terceros. Únicamente los compartimos con:
    </p>
    <ul>
        <li><strong>Proveedor de hosting:</strong> el servidor donde está alojada la web almacena los datos. Hemos firmado con ellos el correspondiente Contrato de Encargado de Tratamiento exigido por el RGPD.</li>
        <li><strong>Obligación legal:</strong> si una autoridad competente nos lo requiere mediante orden judicial o requerimiento legal.</li>
    </ul>

    <h2>4. Transferencias internacionales</h2>
    <p>
        No realizamos transferencias de datos fuera del Espacio Económico Europeo. Si esto cambiara en el futuro, lo comunicaremos y garantizaremos las salvaguardas adecuadas.
    </p>

    <h2>5. Tus derechos</h2>
    <p>
        De acuerdo con el RGPD y la LOPDGDD, tienes derecho a:
    </p>
    <ul>
        <li><strong>Acceso:</strong> saber qué datos tuyos tenemos.</li>
        <li><strong>Rectificación:</strong> corregir datos incorrectos o incompletos.</li>
        <li><strong>Supresión:</strong> pedirnos que borremos tus datos ("derecho al olvido").</li>
        <li><strong>Oposición:</strong> oponerte a que usemos tus datos para determinadas finalidades.</li>
        <li><strong>Limitación del tratamiento:</strong> pedirnos que suspendamos el uso de tus datos.</li>
        <li><strong>Portabilidad:</strong> recibir tus datos en un formato estructurado y legible por máquina.</li>
        <li><strong>Retirar el consentimiento</strong> en cualquier momento, sin que ello afecte a la licitud del tratamiento previo.</li>
    </ul>
    <p>
        Para ejercer cualquiera de estos derechos, escríbenos a <a href="mailto:derekcuquerellacuidapp@gmail.com">derekcuquerellacuidapp@gmail.com</a>. Responderemos en un plazo máximo de 30 días.
    </p>
    <p>
        Si consideras que tu solicitud no ha sido atendida correctamente, tienes derecho a presentar una reclamación ante la <strong>Agencia Española de Protección de Datos (AEPD)</strong>: <a href="https://www.aepd.es" target="_blank" rel="noopener">www.aepd.es</a>.
    </p>

    <h2>6. Seguridad de los datos</h2>
    <p>
        Aplicamos medidas técnicas y organizativas para proteger tus datos:
    </p>
    <ul>
        <li>Contraseñas almacenadas con cifrado bcrypt (nunca en texto plano).</li>
        <li>Protección contra inyección SQL mediante consultas preparadas (prepared statements).</li>
        <li>Comunicaciones cifradas mediante protocolo HTTPS.</li>
        <li>Acceso restringido a los datos únicamente al responsable del tratamiento.</li>
    </ul>

    <h2>7. Modificaciones de esta política</h2>
    <p>
        Podemos actualizar esta política para adaptarla a cambios legales o en el servicio. Te informaremos de cambios relevantes por email si estás suscrito a nuestras comunicaciones. La fecha de última actualización aparece al inicio de este documento.
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
