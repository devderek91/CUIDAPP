<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CUIDAPP — Únete a la lista</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,700;1,300&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --cream:   #FAF7F2;
    --sand:    #E8DDD0;
    --blush:   #D4A5A0;
    --terrace: #8B6F6A;
    --deep:    #2E1F1A;
    --sage:    #7A9E8E;
    --sage-light: #B8D4CB;
    --white:   #FFFFFF;
    --error:   #C0392B;
    --radius:  16px;
  }

  html { scroll-behavior: smooth; }

  body {
    background: var(--cream);
    color: var(--deep);
    font-family: 'DM Sans', sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2rem 1rem 4rem;
  }

  /* ── HERO ── */
  .hero {
    text-align: center;
    max-width: 560px;
    margin-bottom: 3rem;
    padding-top: 1rem;
  }
  .hero-badge {
    display: inline-block;
    background: var(--sage-light);
    color: var(--deep);
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    padding: 0.35rem 1rem;
    border-radius: 100px;
    margin-bottom: 1.4rem;
  }
  .hero h1 {
    font-family: 'Fraunces', serif;
    font-size: clamp(2.2rem, 5vw, 3.2rem);
    font-weight: 300;
    line-height: 1.15;
    color: var(--deep);
    margin-bottom: 1rem;
  }
  .hero h1 em {
    font-style: italic;
    color: var(--terrace);
  }
  .hero p {
    font-size: 1rem;
    color: var(--terrace);
    line-height: 1.65;
    max-width: 420px;
    margin: 0 auto;
  }

  /* ── CARD ── */
  .card {
    background: var(--white);
    border-radius: var(--radius);
    box-shadow: 0 8px 40px rgba(46,31,26,0.08), 0 2px 8px rgba(46,31,26,0.04);
    padding: 2.5rem 2rem;
    width: 100%;
    max-width: 540px;
  }

  /* ── TIPO SELECTOR ── */
  .tipo-selector {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
    margin-bottom: 2rem;
  }
  .tipo-btn {
    position: relative;
    cursor: pointer;
  }
  .tipo-btn input[type="radio"] {
    position: absolute; opacity: 0; width: 0; height: 0;
  }
  .tipo-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    padding: 1.2rem 1rem;
    border: 2px solid var(--sand);
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
    user-select: none;
  }
  .tipo-label .icon {
    font-size: 1.8rem;
    line-height: 1;
  }
  .tipo-label .label-text {
    font-size: 0.85rem;
    font-weight: 500;
    color: var(--terrace);
    transition: color 0.2s;
  }
  .tipo-label .label-sub {
    font-size: 0.72rem;
    color: #aaa;
    text-align: center;
    line-height: 1.3;
  }
  .tipo-btn input:checked + .tipo-label {
    border-color: var(--terrace);
    background: linear-gradient(135deg, #FAF0EE 0%, #FDF8F6 100%);
    box-shadow: 0 4px 16px rgba(139,111,106,0.15);
  }
  .tipo-btn input:checked + .tipo-label .label-text {
    color: var(--deep);
    font-weight: 700;
  }

  /* ── SECCIÓN DIVIDIDA ── */
  .section-title {
    font-family: 'Fraunces', serif;
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--terrace);
    margin: 1.8rem 0 1rem;
    display: flex;
    align-items: center;
    gap: 0.6rem;
  }
  .section-title::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--sand);
  }

  /* ── CAMPOS ── */
  .field-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.875rem;
  }
  @media (max-width: 440px) { .field-row { grid-template-columns: 1fr; } }

  .field {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
    margin-bottom: 0.875rem;
  }
  .field label {
    font-size: 0.78rem;
    font-weight: 500;
    color: var(--terrace);
    letter-spacing: 0.04em;
  }
  .field input,
  .field select,
  .field textarea {
    border: 1.5px solid var(--sand);
    border-radius: 10px;
    padding: 0.65rem 0.9rem;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.9rem;
    color: var(--deep);
    background: var(--cream);
    transition: border-color 0.18s, box-shadow 0.18s;
    outline: none;
    width: 100%;
  }
  .field input:focus,
  .field select:focus,
  .field textarea:focus {
    border-color: var(--terrace);
    box-shadow: 0 0 0 3px rgba(139,111,106,0.12);
    background: var(--white);
  }
  .field textarea { resize: vertical; min-height: 80px; }

  /* ── CAMPOS ESPECÍFICOS CON TRANSICIÓN ── */
  .campos-especificos {
    overflow: hidden;
    transition: max-height 0.4s ease, opacity 0.3s ease;
    max-height: 0;
    opacity: 0;
  }
  .campos-especificos.visible {
    max-height: 600px;
    opacity: 1;
  }

  /* ── CHECKBOX ── */
  .check-field {
    display: flex;
    align-items: center;
    gap: 0.65rem;
    margin-bottom: 0.875rem;
    cursor: pointer;
  }
  .check-field input[type="checkbox"] {
    width: 18px; height: 18px;
    accent-color: var(--sage);
    cursor: pointer;
    flex-shrink: 0;
  }
  .check-field span {
    font-size: 0.85rem;
    color: var(--terrace);
    line-height: 1.4;
  }

  /* ── BOTÓN SUBMIT ── */
  .btn-submit {
    width: 100%;
    padding: 1rem;
    background: var(--deep);
    color: var(--cream);
    border: none;
    border-radius: 12px;
    font-family: 'DM Sans', sans-serif;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    margin-top: 1.5rem;
    transition: background 0.2s, transform 0.15s;
    position: relative;
    overflow: hidden;
  }
  .btn-submit:hover { background: var(--terrace); }
  .btn-submit:active { transform: scale(0.98); }
  .btn-submit:disabled { background: var(--sand); color: #aaa; cursor: not-allowed; }

  /* ── MENSAJES ── */
  .feedback {
    display: none;
    margin-top: 1.2rem;
    padding: 1rem 1.2rem;
    border-radius: 10px;
    font-size: 0.88rem;
    line-height: 1.5;
  }
  .feedback.success {
    display: block;
    background: #EBF6F1;
    border: 1px solid #A8D8C0;
    color: #1E6645;
  }
  .feedback.error {
    display: block;
    background: #FDECEA;
    border: 1px solid #F5BFBB;
    color: var(--error);
  }

  /* ── FOOTER ── */
  .privacy-note {
    margin-top: 1.2rem;
    font-size: 0.72rem;
    color: #bbb;
    text-align: center;
    line-height: 1.5;
  }
</style>
</head>
<body>

<div class="hero">
  <span class="hero-badge">Lista de espera — Lanzamiento próximo</span>
  <h1>Cuidado de calidad,<br><em>familias tranquilas</em></h1>
  <p>Únete a la lista y sé de las primeras familias y cuidadoras en acceder a CUIDAPP cuando abramos puertas.</p>
</div>

<div class="card">

  <!-- SELECTOR TIPO -->
  <div class="tipo-selector">
    <label class="tipo-btn">
      <input type="radio" name="tipo_visual" value="padre" id="radio-padre">
      <div class="tipo-label">
        <span class="icon">👨‍👧</span>
        <span class="label-text">Soy padre/madre</span>
        <span class="label-sub">Busco cuidadora<br>para mis hijos</span>
      </div>
    </label>
    <label class="tipo-btn">
      <input type="radio" name="tipo_visual" value="cuidadora" id="radio-cuidadora">
      <div class="tipo-label">
        <span class="icon">🤝</span>
        <span class="label-text">Soy cuidadora</span>
        <span class="label-sub">Quiero trabajar<br>con familias</span>
      </div>
    </label>
  </div>

  <!-- FORMULARIO -->
  <form id="form-registro" novalidate>
    <input type="hidden" name="tipo" id="campo-tipo" value="">

    <span class="section-title">Datos personales</span>

    <div class="field-row">
      <div class="field">
        <label for="nombre">Nombre *</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ana" required>
      </div>
      <div class="field">
        <label for="apellidos">Apellidos *</label>
        <input type="text" name="apellidos" id="apellidos" placeholder="García López" required>
      </div>
    </div>

    <div class="field">
      <label for="email">Email *</label>
      <input type="email" name="email" id="email" placeholder="ana@ejemplo.com" required>
    </div>

    <div class="field-row">
      <div class="field">
        <label for="telefono">Teléfono *</label>
        <input type="tel" name="telefono" id="telefono" placeholder="612 345 678" required>
      </div>
      <div class="field">
        <label for="ciudad">Ciudad *</label>
        <input type="text" name="ciudad" id="ciudad" placeholder="Barcelona" required>
      </div>
    </div>

    <!-- CAMPOS PADRE -->
    <div class="campos-especificos" id="campos-padre">
      <span class="section-title">Sobre tu familia</span>
      <div class="field-row">
        <div class="field">
          <label for="num_hijos">Número de hijos *</label>
          <input type="number" name="num_hijos" id="num_hijos" min="1" max="10" placeholder="2">
        </div>
        <div class="field">
          <label for="edades_hijos">Edades (ej: 3, 6)</label>
          <input type="text" name="edades_hijos" id="edades_hijos" placeholder="3, 6">
        </div>
      </div>
      <div class="field">
        <label for="necesidad">¿Qué tipo de cuidado necesitas?</label>
        <textarea name="necesidad" id="necesidad" placeholder="Tardes entre semana, horario de 16h a 20h..."></textarea>
      </div>
    </div>

    <!-- CAMPOS CUIDADORA -->
    <div class="campos-especificos" id="campos-cuidadora">
      <span class="section-title">Tu experiencia</span>
      <div class="field-row">
        <div class="field">
          <label for="experiencia">Años de experiencia *</label>
          <input type="number" name="experiencia" id="experiencia" min="0" max="50" placeholder="3">
        </div>
        <div class="field">
          <label for="disponibilidad">Disponibilidad *</label>
          <select name="disponibilidad" id="disponibilidad">
            <option value="" disabled selected>Selecciona…</option>
            <option value="parcial">Parcial (mañanas/tardes)</option>
            <option value="completa">Jornada completa</option>
            <option value="fines_semana">Fines de semana</option>
          </select>
        </div>
      </div>
      <label class="check-field">
        <input type="checkbox" name="tiene_referencias" id="tiene_referencias">
        <span>Tengo referencias de familias anteriores</span>
      </label>
    </div>
<!-- CHECKBOXES LEGALES -->
    <div style="margin-top: 1.5rem; display: flex; flex-direction: column; gap: 0.75rem;">
      
      <label class="check-field" id="check-privacidad-label">
        <input type="checkbox" name="acepta_privacidad" id="acepta_privacidad" required>
        <span>
          He leído y acepto la 
          <a href="politica-privacidad.php" target="_blank" 
             style="color: var(--terrace); text-decoration: underline;">
            Política de Privacidad
          </a> *
        </span>
      </label>

      <label class="check-field">
        <input type="checkbox" name="acepta_comunicaciones" id="acepta_comunicaciones">
        <span>Quiero recibir novedades sobre el lanzamiento de CUIDAPP</span>
      </label>

    </div>
    <button type="submit" class="btn-submit" id="btn-enviar" disabled>
      Apúntame a la lista
    </button>

    <div class="feedback" id="feedback"></div>

    <p class="privacy-note">
      Tus datos serán tratados por Derek Cuquerella Ureña para gestionar la lista de espera de CUIDAPP.<br>
      Puedes ejercer tus derechos de acceso, rectificación y supresión escribiendo a 
      derekcuquerellacuidapp@gmail.com
    </p>
  </form>
</div>

<script>
(function () {
  const radioP    = document.getElementById('radio-padre');
  const radioC    = document.getElementById('radio-cuidadora');
  const campoTipo = document.getElementById('campo-tipo');
  const btnEnviar = document.getElementById('btn-enviar');
  const feedback  = document.getElementById('feedback');
  const form      = document.getElementById('form-registro');

  const panelPadre     = document.getElementById('campos-padre');
  const panelCuidadora = document.getElementById('campos-cuidadora');

  // Activar/desactivar campos requeridos por panel
  function setRequired(panel, active) {
    panel.querySelectorAll('[required]').forEach(el => {
      active ? el.setAttribute('required', '') : el.removeAttribute('required');
    });
    // select de disponibilidad
    const sel = panel.querySelector('select');
    if (sel) active ? sel.setAttribute('required','') : sel.removeAttribute('required');
  }

  function mostrarPanel(tipo) {
    campoTipo.value = tipo;
    btnEnviar.disabled = false;
    btnEnviar.textContent = tipo === 'padre'
      ? '✓ Apúntame como familia'
      : '✓ Apúntame como cuidadora';

    if (tipo === 'padre') {
      panelPadre.classList.add('visible');
      panelCuidadora.classList.remove('visible');
      setRequired(panelPadre, true);
      setRequired(panelCuidadora, false);
    } else {
      panelCuidadora.classList.add('visible');
      panelPadre.classList.remove('visible');
      setRequired(panelCuidadora, true);
      setRequired(panelPadre, false);
    }
  }

  radioP.addEventListener('change', () => mostrarPanel('padre'));
  radioC.addEventListener('change', () => mostrarPanel('cuidadora'));

  // Submit vía fetch (sin recarga de página)
  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    feedback.className = 'feedback';
    feedback.textContent = '';

    const tipo = campoTipo.value;
    if (!tipo) {
      mostrarFeedback('error', 'Selecciona si eres padre/madre o cuidadora.');
      return;
    }
const privacidad = document.getElementById('acepta_privacidad');
    if (!privacidad.checked) {
      mostrarFeedback('error', 'Debes aceptar la Política de Privacidad para continuar.');
      return;
    }
    btnEnviar.disabled = true;
    btnEnviar.textContent = 'Enviando…';

    try {
      const datos = new FormData(form);
      const res   = await fetch('procesar_registro.php', { method: 'POST', body: datos });
      const json  = await res.json();

      if (json.ok) {
        mostrarFeedback('success', '🎉 ' + json.mensaje);
        form.reset();
        panelPadre.classList.remove('visible');
        panelCuidadora.classList.remove('visible');
        campoTipo.value = '';
        btnEnviar.disabled = true;
        btnEnviar.textContent = 'Apúntame a la lista';
        radioP.checked = false;
        radioC.checked = false;
      } else {
        const msg = json.errores
          ? json.errores.join('<br>')
          : (json.error || 'Algo fue mal. Inténtalo de nuevo.');
        mostrarFeedback('error', msg);
        btnEnviar.disabled = false;
        btnEnviar.textContent = tipo === 'padre'
          ? '✓ Apúntame como familia'
          : '✓ Apúntame como cuidadora';
      }
    } catch (err) {
      mostrarFeedback('error', 'Error de conexión. Revisa tu red e inténtalo de nuevo.');
      btnEnviar.disabled = false;
    }
  });

  function mostrarFeedback(tipo, html) {
    feedback.className = 'feedback ' + tipo;
    feedback.innerHTML = html;
    feedback.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }
})();
</script>
</body>
</html>