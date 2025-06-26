document.addEventListener('DOMContentLoaded', function () {
    console.log('Página cargada');
    precargarEstudiantes();
    cargarTabla();
});

function precargarEstudiantes() {
    if (!localStorage.getItem('estudiantes')) {
        const estudiantesIniciales = [
            { nombre: 'Maria', apellidos: 'Mora Perez', nota: 90 },
            { nombre: 'Pedro', apellidos: 'Sibaja Lopez', nota: 60 },
            { nombre: 'Marco', apellidos: 'Rojas Castro', nota: 78 }
        ];
        localStorage.setItem('estudiantes', JSON.stringify(estudiantesIniciales));
    }
}

function cargarTabla() {
    const estudiantes = JSON.parse(localStorage.getItem('estudiantes')) || [];
    const tbody = document.getElementById('tabla_estudiantes');
    tbody.innerHTML = '';
    estudiantes.forEach(est => {
        let color = '';
        if (est.nota >= 80) color = 'style="color:green;font-weight:bold"';
        else if (est.nota < 65) color = 'style="color:red;font-weight:bold"';
        tbody.innerHTML += `
            <tr>
                <td>${est.nombre}</td>
                <td>${est.apellidos}</td>
                <td ${color}>${est.nota}</td>
            </tr>
        `;
    });
    cargarResumen(estudiantes);
}

function cargarResumen(estudiantes) {
    let resumenDiv = document.getElementById("resumen_estudiantes");
    if (!resumenDiv) {
        resumenDiv = document.createElement("div");
        resumenDiv.id = "resumen_estudiantes";
        document.querySelector(".table").after(resumenDiv);
    }
    if (estudiantes.length === 0) {
        resumenDiv.innerHTML = "";
        return;
    }
    const mayor = estudiantes.reduce((a, b) => a.nota > b.nota ? a : b);
    const menor = estudiantes.reduce((a, b) => a.nota < b.nota ? a : b);
    const promedio = (estudiantes.reduce((sum, e) => sum + e.nota, 0) / estudiantes.length).toFixed(2);
    resumenDiv.innerHTML = `
        <div class="mt-3">
        Estudiante con mayor nota: ${mayor.nombre} ${mayor.apellidos} (${mayor.nota})<br>
        Promedio de notas: ${promedio}<br>
        Nota más baja: ${menor.nota}
        </div>
    `;
}

document.getElementById("btn_agregar_estudiante").addEventListener("click", function () {
    const nombre = document.getElementById("nombre").value.trim();
    const apellidos = document.getElementById("apellidos").value.trim();
    const nota = parseInt(document.getElementById("nota").value);

    if (!nombre || !apellidos || isNaN(nota) || nota < 0 || nota > 100) {
        alert("Llene todos los campos, y lla NOTA debe ser entre 0-100");
        return;
    }

    let estudiantes = JSON.parse(localStorage.getItem('estudiantes')) || [];
    estudiantes.push({ nombre, apellidos, nota });
    localStorage.setItem('estudiantes', JSON.stringify(estudiantes));
    cargarTabla();
    document.getElementById("nombre").value = "";
    document.getElementById("apellidos").value = "";
    document.getElementById("nota").value = "";
});

