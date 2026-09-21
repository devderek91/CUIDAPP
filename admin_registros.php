<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CUIDAPP — Panel de registros</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  :root {
    --bg:      #0F0D0C;
    --surface: #1A1714;
    --border:  #2E2825;
    --cream:   #FAF7F2;
    --sand:    #8B7B70;
    --blush:   #D4A5A0;
    --terrace: #C49A95;
    --sage:    #7A9E8E;
    --padre:   #7A9E8E;
    --cuid:    #D4A5A0;
    --radius:  12px;
  }
  body {
    background: var(--bg);
    color: var(--cream);
    font-family: 'DM Sans', sans-serif;
    min-height: 100vh;
    padding: 2rem 1.5rem 4rem;
  }

  /* HEADER */
  .admin-header {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 2.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--border);
  }
  .admin-header h1 {
    font-family: 'Fraunces', serif;
    font-weight: 300;
    font-size: 1.8rem;
  }
  .admin-header h1 span { color: var(--terrace); font-style: italic; }
  .admin-header small { color: var(--sand); font-size: 0.8rem; }

  /* STATS ROW */
  .stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 1rem;
    margin-bottom: 2.5rem;
  }
  .stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.2rem 1.4rem;
  }
  .stat-card .num {
    font-family: 'Fraunces', serif;
    font-size: 2.2rem;
    font-weight: 300;
    line-height: 1;
    margin-bottom: 0.3rem;
  }
  .stat-card .lbl { font-size: 0.75rem; color: var(--sand); letter-spacing: 0.06em; text-transform: uppercase; }
  .stat-card.total .num  { color: var(--cream); }
  .stat-card.padres .num { color: var(--padre); }
  .stat-card.cuids .num  { color: var(--cuid); }
  .stat-card.semana .num { color: var(--terrace); }

  /* FILTROS */
  .filtros {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
    align-items: center;
  }
  .filtros select, .filtros input {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 8px;
    color: var(--cream);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.85rem;
    padding: 0.5rem 0.85rem;
    outline: none;
    cursor: pointer;
  }
  .filtros select:focus, .filtros input:focus {
    border-color: var(--terrace);
  }
  .filtros label { font-size: 0.8rem; color: var(--sand); }

  /* TIMELINE DE SEMANAS */
  .semana-bloque {
    margin-bottom: 2rem;
  }
  .semana-titulo {
    font-family: 'Fraunces', serif;
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--sand);
    margin-bottom: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }
  .semana-titulo::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--border);
  }
  .semana-badge {
    background: var(--terrace);
    color: var(--bg);
    font-size: 0.68rem;
    font-weight: 700;
    padding: 0.2rem 0.55rem;
    border-radius: 100px;
    letter-spacing: 0.05em;
  }

  /* TABLA */
  .tabla-wrap {
    overflow-x: auto;
    border-radius: var(--radius);
    border: 1px solid var(--border);
  }
  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
  }
  thead th {
    background: var(--surface);
    padding: 0.75rem 1rem;
    text-align: left;
    font-weight: 500;
    color: var(--sand);
    font-size: 0.72rem;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    white-space: nowrap;
    border-bottom: 1px solid var(--border);
  }
  tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background 0.1s;
  }
  tbody tr:last-child { border-bottom: none; }
  tbody tr:hover { background: rgba(255,255,255,0.03); }
  td {
    padding: 0.8rem 1rem;
    color: var(--cream);
    vertical-align: middle;
    white-space: nowrap;
  }
  td.wrap { white-space: normal; max-width: 220px; }

  .badge-tipo {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.25rem 0.65rem;
    border-radius: 100px;
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.04em;
    text-transform: uppercase;
  }
  .badge-padre   { background: rgba(122,158,142,0.18); color: var(--padre); }
  .badge-cuidadora { background: rgba(212,165,160,0.18); color: var(--cuid); }

  .sin-datos {
    text-align: center;
    padding: 3rem;
    color: var(--sand);
    font-size: 0.9rem;
  }

  /* PAGINACIÓN */
  .paginacion {
    display: flex;
    justify-content: flex-end;
    gap: 0.5rem;
    margin-top: 1.5rem;
    flex-wrap: wrap;
  }
  .paginacion a {
    padding: 0.4rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 0.8rem;
    color: var(--sand);
    text-decoration: none;
    transition: border-color 0.15s, color 0.15s;
  }
  .paginacion a:hover, .paginacion a.activa {
    border-color: var(--terrace);
    color: var(--cream);
  }
</style>
</head>
<body>
<?php
// ── PROTECCIÓN MÍNIMA: contraseña por GET (para local).
// En producción usa sesiones o .htaccess.
$ADMIN_PASS = 'cuidapp2024';  // ← cambia esto
if (($_GET['pass'] ?? '') !== $ADMIN_PASS) {
    http_response_code(401);
    echo '<div style="padding:3rem;text-align:center;font-family:sans-serif;color:#aaa;">
            Acceso denegado. Añade ?pass=TU_CLAVE a la URL.
          </div>';
    exit;
}

require_once __DIR__ . '/config/db.php';
$pdo = getDB();

// ── FILTROS ──────────────────────────────────────────────────────────────────
$filtro_tipo   = $_GET['tipo']   ?? 'todos';
$filtro_semana = $_GET['semana'] ?? 'todas';
$pagina        = max(1, (int)($_GET['p'] ?? 1));
$por_pagina    = 20;
$offset        = ($pagina - 1) * $por_pagina;

// ── ESTADÍSTICAS GLOBALES ────────────────────────────────────────────────────
$total   = (int)$pdo->query("SELECT COUNT(*) FROM registros WHERE activo=1")->fetchColumn();
$padres  = (int)$pdo->query("SELECT COUNT(*) FROM registros WHERE tipo='padre' AND activo=1")->fetchColumn();
$cuids   = (int)$pdo->query("SELECT COUNT(*) FROM registros WHERE tipo='cuidadora' AND activo=1")->fetchColumn();

$semana_actual = (int)date('W');
$este_anyo     = (int)date('Y');
$esta_semana   = (int)$pdo->query(
    "SELECT COUNT(*) FROM registros
     WHERE semana=$semana_actual AND anyo=$este_anyo AND activo=1"
)->fetchColumn();

// ── LISTADO DE SEMANAS DISPONIBLES ───────────────────────────────────────────
$semanas_raw = $pdo->query(
    "SELECT DISTINCT semana, anyo,
            MIN(fecha_registro) as inicio_semana,
            COUNT(*) as cnt
     FROM registros WHERE activo=1
     GROUP BY semana, anyo
     ORDER BY anyo DESC, semana DESC"
)->fetchAll();

// ── QUERY PRINCIPAL ──────────────────────────────────────────────────────────
$where = ["activo = 1"];
$params = [];

if ($filtro_tipo !== 'todos') {
    $where[]  = "tipo = :tipo";
    $params[':tipo'] = $filtro_tipo;
}
if ($filtro_semana !== 'todas') {
    [$sw, $sy] = explode('-', $filtro_semana . '-' . $este_anyo);
    $where[]  = "semana = :semana AND anyo = :anyo";
    $params[':semana'] = (int)$sw;
    $params[':anyo']   = (int)($sy ?? $este_anyo);
}

$whereSQL = implode(' AND ', $where);

$total_filtrado = (int)$pdo->prepare("SELECT COUNT(*) FROM registros WHERE $whereSQL")
    ->execute($params) ? (function() use ($pdo, $whereSQL, $params) {
        $s = $pdo->prepare("SELECT COUNT(*) FROM registros WHERE $whereSQL");
        $s->execute($params);
        return (int)$s->fetchColumn();
    })() : 0;

$stmt = $pdo->prepare(
    "SELECT * FROM registros WHERE $whereSQL
     ORDER BY fecha_registro DESC
     LIMIT :limit OFFSET :offset"
);
foreach ($params as $k => $v) $stmt->bindValue($k, $v);
$stmt->bindValue(':limit',  $por_pagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset,     PDO::PARAM_INT);
$stmt->execute();
$registros = $stmt->fetchAll();

// Agrupar por semana
$por_semana = [];
foreach ($registros as $r) {
    $key = $r['anyo'] . '-' . str_pad($r['semana'], 2, '0', STR_PAD_LEFT);
    $por_semana[$key][] = $r;
}
krsort($por_semana);

$total_paginas = (int)ceil($total_filtrado / $por_pagina);

// Helper URL
function urlFiltro(array $cambios = []): string {
    $params = array_merge($_GET, $cambios);
    return '?' . http_build_query($params);
}
?>

<div class="admin-header">
  <h1>CUIDAPP <span>— Registros</span></h1>
  <small>Panel actualizado en tiempo real · <?= date('d/m/Y H:i') ?></small>
</div>

<!-- STATS -->
<div class="stats">
  <div class="stat-card total">
    <div class="num"><?= $total ?></div>
    <div class="lbl">Total registros</div>
  </div>
  <div class="stat-card padres">
    <div class="num"><?= $padres ?></div>
    <div class="lbl">Familias</div>
  </div>
  <div class="stat-card cuids">
    <div class="num"><?= $cuids ?></div>
    <div class="lbl">Cuidadoras</div>
  </div>
  <div class="stat-card semana">
    <div class="num"><?= $esta_semana ?></div>
    <div class="lbl">Esta semana</div>
  </div>
</div>

<!-- FILTROS -->
<div class="filtros">
  <label>Tipo:</label>
  <select onchange="location.href=this.dataset.base + '&tipo=' + this.value"
          data-base="<?= htmlspecialchars(urlFiltro(['tipo'=>'__SKIP__','p'=>1])) ?>">
    <option value="todos"     <?= $filtro_tipo==='todos'     ?'selected':'' ?>>Todos</option>
    <option value="padre"     <?= $filtro_tipo==='padre'     ?'selected':'' ?>>Familias</option>
    <option value="cuidadora" <?= $filtro_tipo==='cuidadora' ?'selected':'' ?>>Cuidadoras</option>
  </select>

  <label>Semana:</label>
  <select onchange="location.href=this.dataset.base + '&semana=' + this.value"
          data-base="<?= htmlspecialchars(urlFiltro(['semana'=>'__SKIP__','p'=>1])) ?>">
    <option value="todas" <?= $filtro_semana==='todas'?'selected':'' ?>>Todas</option>
    <?php foreach ($semanas_raw as $s):
      $key = $s['anyo'] . '-' . $s['semana'];
      $label = 'Semana ' . $s['semana'] . ' · ' . date('d M', strtotime($s['inicio_semana'])) . ' (' . $s['cnt'] . ')';
    ?>
    <option value="<?= htmlspecialchars($key) ?>" <?= $filtro_semana===$key?'selected':'' ?>>
      <?= htmlspecialchars($label) ?>
    </option>
    <?php endforeach; ?>
  </select>
</div>

<!-- TABLA POR SEMANAS -->
<?php if (empty($registros)): ?>
  <div class="sin-datos">No hay registros con los filtros seleccionados.</div>
<?php else: ?>
  <?php foreach ($por_semana as $semana_key => $filas): ?>
    <?php
      [$sy, $sw] = explode('-', $semana_key);
      $cnt_padres = count(array_filter($filas, fn($r) => $r['tipo']==='padre'));
      $cnt_cuids  = count(array_filter($filas, fn($r) => $r['tipo']==='cuidadora'));
    ?>
    <div class="semana-bloque">
      <div class="semana-titulo">
        Semana <?= (int)$sw ?> — <?= $sy ?>
        <span class="semana-badge"><?= count($filas) ?> registros</span>
        <span style="font-size:0.72rem;color:var(--padre);font-weight:400;font-family:'DM Sans',sans-serif;">
          <?= $cnt_padres ?> familias
        </span>
        <span style="font-size:0.72rem;color:var(--cuid);font-weight:400;font-family:'DM Sans',sans-serif;">
          <?= $cnt_cuids ?> cuidadoras
        </span>
      </div>
      <div class="tabla-wrap">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Tipo</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Ciudad</th>
              <th>Detalle</th>
              <th>Fecha</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($filas as $r): ?>
            <tr>
              <td style="color:var(--sand)"><?= $r['id'] ?></td>
              <td>
                <?php if ($r['tipo']==='padre'): ?>
                  <span class="badge-tipo badge-padre">👨‍👧 Familia</span>
                <?php else: ?>
                  <span class="badge-tipo badge-cuidadora">🤝 Cuidadora</span>
                <?php endif; ?>
              </td>
              <td><strong><?= htmlspecialchars($r['nombre'].' '.$r['apellidos']) ?></strong></td>
              <td style="color:var(--sand)"><?= htmlspecialchars($r['email']) ?></td>
              <td><?= htmlspecialchars($r['telefono']) ?></td>
              <td><?= htmlspecialchars($r['ciudad']) ?></td>
              <td class="wrap" style="color:var(--sand);font-size:0.78rem;">
                <?php if ($r['tipo']==='padre'): ?>
                  <?= $r['num_hijos'] ? $r['num_hijos'].' hijo(s)' : '' ?>
                  <?= $r['edades_hijos'] ? ' · edades: '.$r['edades_hijos'] : '' ?>
                  <?= $r['necesidad'] ? '<br>'.htmlspecialchars(mb_substr($r['necesidad'],0,60)).'…' : '' ?>
                <?php else: ?>
                  <?= $r['experiencia'] !== null ? $r['experiencia'].' años exp.' : '' ?>
                  <?= $r['disponibilidad'] ? ' · '.str_replace('_',' ',$r['disponibilidad']) : '' ?>
                  <?= $r['tiene_referencias'] ? ' · ✓ Referencias' : '' ?>
                <?php endif; ?>
              </td>
              <td style="color:var(--sand);font-size:0.78rem;">
                <?= date('d/m H:i', strtotime($r['fecha_registro'])) ?>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php endforeach; ?>

  <!-- PAGINACIÓN -->
  <?php if ($total_paginas > 1): ?>
  <div class="paginacion">
    <?php if ($pagina > 1): ?>
      <a href="<?= htmlspecialchars(urlFiltro(['p' => $pagina-1])) ?>">← Anterior</a>
    <?php endif; ?>
    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
      <a href="<?= htmlspecialchars(urlFiltro(['p' => $i])) ?>"
         class="<?= $i === $pagina ? 'activa' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>
    <?php if ($pagina < $total_paginas): ?>
      <a href="<?= htmlspecialchars(urlFiltro(['p' => $pagina+1])) ?>">Siguiente →</a>
    <?php endif; ?>
  </div>
  <?php endif; ?>
<?php endif; ?>

</body>
</html>