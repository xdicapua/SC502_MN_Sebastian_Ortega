<?php include 'app/views/layouts/header.php'; ?>

<style>
  body {
    background: #e6f2f0;
    color: #034d40;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    padding: 2rem 0;
  }
  .container-results {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 8px 15px rgba(39, 181, 156, 0.25);
  }
  h2, h3 {
    font-weight: 900;
    color: #27b59c;
    margin-bottom: 1rem;
  }
  .total-respuestas {
    font-size: 1.3rem;
    margin-bottom: 2rem;
  }
  .pregunta-result {
    margin-bottom: 2rem;
  }
  .opcion {
    background: #d2f0e9;
    border-radius: 12px;
    padding: 0.8rem 1rem;
    margin: 0.4rem 0;
    font-weight: 700;
    display: flex;
    justify-content: space-between;
  }
</style>

<div class="container-results">
  <h2>Resultados Encuesta</h2>
  <h3><?= htmlspecialchars($encuesta['titulo']) ?></h3>

  <?php if ($totalRespuestas == 0): ?>
    <p>No hay respuestas para esta encuesta aún.</p>
    <a href="/encuestas/encuestas/eliminar/<?= $encuesta['id'] ?>" class="btn btn-delete" onclick="return confirm('¿Eliminar encuesta? Esta acción no se puede deshacer.')">Eliminar Encuesta</a>
  <?php else: ?>
    <div class="total-respuestas">
      Total de respuestas: <strong><?= $totalRespuestas ?></strong>
    </div>

    <?php if (!empty($resultadosPorPregunta) && is_array($resultadosPorPregunta)): ?>
      <?php foreach ($resultadosPorPregunta as $preguntaTexto => $opciones): ?>
        <div class="pregunta-result">
          <h4><?= htmlspecialchars($preguntaTexto) ?></h4>
          <?php foreach ($opciones as $opcionTexto => $cantidad): ?>
            <div class="opcion">
              <span><?= htmlspecialchars($opcionTexto) ?></span>
              <strong><?= $cantidad ?></strong>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No hay resultados disponibles para las preguntas.</p>
    <?php endif; ?>
  <?php endif; ?>
</div>

<?php include 'app/views/layouts/footer.php'; ?>
