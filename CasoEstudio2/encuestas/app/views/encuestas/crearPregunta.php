<?php include 'app/views/layouts/header.php'; ?>

<style>
    body {
        background-color: #f8f9fa;
    }
    .form-container {
        max-width: 700px;
        margin: 0 auto;
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .pregunta-group {
        background: #eef6f3;
        border-radius: 8px;
        padding: 1rem;
        margin-top: 1rem;
        position: relative;
    }
    .remove-question {
        position: absolute;
        top: 0.6rem;
        right: 0.6rem;
        background: #dc3545;
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        line-height: 26px;
        text-align: center;
        cursor: pointer;
    }
</style>

<div class="container my-5">
    <div class="form-container">
        <h2 class="mb-4 text-success fw-bold">Crear Nueva Encuesta</h2>
        
        <form method="POST" action="/encuestas/encuestas/guardar" id="formEncuesta">
            
            <div class="mb-3">
                <label for="titulo" class="form-label fw-semibold">Título de la Encuesta</label>
                <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Ej: Opiniones sobre el servicio" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label fw-semibold">Descripción (opcional)</label>
                <textarea id="descripcion" name="descripcion" rows="3" class="form-control" placeholder="Breve descripción"></textarea>
            </div>

            <div id="preguntasContainer">
                <label class="form-label fw-semibold">Preguntas</label>
                <div class="pregunta-group">
                    <input type="text" name="preguntas[]" class="form-control" placeholder="Escribe la pregunta aquí" required>
                </div>
            </div>

            <button type="button" class="btn btn-outline-success mt-3" id="btnAddPregunta">Agregar otra pregunta</button>

            <button type="submit" class="btn btn-success w-100 mt-4 fw-bold">Guardar Encuesta</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('btnAddPregunta').addEventListener('click', () => {
        const container = document.getElementById('preguntasContainer');
        const newPregunta = document.createElement('div');
        newPregunta.classList.add('pregunta-group');
        newPregunta.innerHTML = `
            <input type="text" name="preguntas[]" class="form-control" placeholder="Escribe la pregunta aquí" required>
            <button type="button" class="remove-question">&times;</button>
        `;
        container.appendChild(newPregunta);

        newPregunta.querySelector('.remove-question').addEventListener('click', (e) => {
            e.target.parentElement.remove();
        });
    });
</script>

<?php include 'app/views/layouts/footer.php'; ?>
