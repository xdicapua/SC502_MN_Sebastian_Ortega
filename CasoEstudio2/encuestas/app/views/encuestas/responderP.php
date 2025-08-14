<?php include 'app/views/layouts/header.php'; ?>

<style>
    body {
        background-color: #f8f9fa;
        color: #034d40;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 2rem 0;
    }

    .form-container {
        max-width: 700px;
        margin: 0 auto;
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    h2 {
        font-size: 2rem;
        font-weight: 900;
        color: #27b59c;
        margin-bottom: 1rem;
        border-bottom: 2px solid #2fc4b2;
        padding-bottom: 0.5rem;
    }

    h4 {
        color: #166050;
        margin-bottom: 1rem;
    }

    label {
        font-weight: 600;
        color: #034d40;
        display: block;
        margin-bottom: 0.5rem;
    }

    select {
        width: 100%;
        padding: 0.6rem;
        font-size: 1rem;
        border-radius: 8px;
        border: 1.5px solid #2fc4b2;
        background: #f9fdfc;
    }

    button.submit-btn {
        background: linear-gradient(45deg, #2fc4b2, #27b59c);
        color: white;
        border: none;
        font-weight: 700;
        font-size: 1.1rem;
        border-radius: 60px;
        padding: 1rem;
        margin-top: 2rem;
        cursor: pointer;
        width: 100%;
        transition: background 0.3s ease;
    }

    button.submit-btn:hover {
        background: linear-gradient(45deg, #1d7e71, #166050);
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }
</style>

<div class="container my-5">
    <div class="form-container">
        <h2>Responder Encuesta</h2>
        <h4><?= htmlspecialchars($encuesta['titulo']) ?></h4>
        <p><?= nl2br(htmlspecialchars($encuesta['descripcion'])) ?></p>

        <form method="POST" action="/encuestas/encuestas/guardarRespuestas">
            <input type="hidden" name="id_encuesta" value="<?= $encuesta['id'] ?>">

            <?php foreach ($preguntas as $pregunta): ?>
                <div class="mb-4">
                    <label for="pregunta_<?= $pregunta['id'] ?>">
                        <?= htmlspecialchars($pregunta['texto_pregunta']) ?>
                    </label>
                    <select id="pregunta_<?= $pregunta['id'] ?>" name="respuestas[<?= $pregunta['id'] ?>]" required>
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="1">1 - Muy en desacuerdo</option>
                        <option value="2">2 - En desacuerdo</option>
                        <option value="3">3 - Neutral</option>
                        <option value="4">4 - De acuerdo</option>
                        <option value="5">5 - Muy de acuerdo</option>
                    </select>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="submit-btn">Enviar Respuestas</button>
        </form>
    </div>
</div>

<?php include 'app/views/layouts/footer.php'; ?>
