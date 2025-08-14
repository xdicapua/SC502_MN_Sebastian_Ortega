<?php include 'app/views/layouts/header.php'; ?>
<div class="container my-5">
    <div class="row">
        <!-- Columna izquierda: botón -->
        <div class="col-md-3 mb-4">
            <a href="/encuestas/encuestas/crearPregunta" class="btn btn-success btn-create">➕ Crear Nueva Encuesta</a>
        </div>

        <!-- Columna derecha: encuestas -->
        <div class="col-md-9">
            
            <!-- Mis Encuestas -->
            <h2 class="section-title">Mis Encuestas</h2>
            <?php if (empty($misEncuestas)): ?>
                <div class="alert alert-info">No has creado ninguna encuesta aún.</div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($misEncuestas as $e): ?>
                        <div class="col-md-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold"><?= htmlspecialchars($e['titulo']) ?></h5>
                                    <p class="card-text text-muted flex-grow-1"><?= nl2br(htmlspecialchars($e['descripcion'] ?? 'Sin descripción')) ?></p>
                                    <div class="d-flex gap-2 mt-3">
                                        <a href="/encuestas/encuestas/verRespuestas/<?= $e['id'] ?>" class="btn btn-success btn-sm">📊 Resultados</a>
                                        <a href="/encuestas/encuestas/eliminar/<?= $e['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar encuesta? Esta acción no se puede deshacer.')">🗑 Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Encuestas Disponibles -->
            <h2 class="section-title mt-5">Encuestas Disponibles para Responder</h2>
            <?php if (empty($otrasEncuestas)): ?>
                <div class="alert alert-secondary">No hay encuestas para responder en este momento.</div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($otrasEncuestas as $e): ?>
                        <div class="col-md-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold"><?= htmlspecialchars($e['titulo']) ?></h5>
                                    <p class="card-text text-muted flex-grow-1"><?= nl2br(htmlspecialchars($e['descripcion'] ?? 'Sin descripción')) ?></p>
                                    <a href="/encuestas/encuestas/responderP/<?= $e['id'] ?>" class="btn btn-primary btn-sm mt-3">✅ Responder</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php include 'app/views/layouts/footer.php'; ?>
