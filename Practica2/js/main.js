document.addEventListener('DOMContentLoaded', function () {
  console.log('Página cargada');

  // Ejercicio 1
  const btnCalcular = document.getElementById('btnCalcular');
  btnCalcular.addEventListener('click', calcularDeducciones);

  // Ejercicio 2
  const btnCambiar = document.getElementById('btnCambiar');
  btnCambiar.addEventListener('click', cambiarParrafo);

  // Ejercicio 3
  const btnEdad = document.getElementById('btnEdad');
  btnEdad.addEventListener('click', verificarEdad);

  // Ejercicio 4
  mostrarEstudiantes();
});

// Ejercicio 1
const calcularDeducciones = () => {
  const salario = parseFloat(document.getElementById('salario').value);
  if (isNaN(salario) || salario <= 0) {
    alert('Ingrese un salario válido');
    return;
  }

  const cargasSociales = salario * 0.1067;
  let impuestoRenta = 0;

  if (salario > 941000) {
    impuestoRenta = (salario - 941000) * 0.15;
  } else if (salario > 564000) {
    impuestoRenta = (salario - 564000) * 0.10;
  }

  const salarioNeto = salario - cargasSociales - impuestoRenta;

  document.getElementById('cargasSociales').innerHTML = `Cargas Sociales: ₡${cargasSociales.toFixed(2)}`;
  document.getElementById('impuestoRenta').innerHTML = `Impuesto Renta: ₡${impuestoRenta.toFixed(2)}`;
  document.getElementById('salarioNeto').innerHTML = `Salario Neto: ₡${salarioNeto.toFixed(2)}`;
};

// Ejercicio 2
const cambiarParrafo = () => {
  document.getElementById('parrafo').innerHTML = 'Texto cambiado';
};

// Ejercicio 3
const verificarEdad = () => {
  const edad = parseInt(document.getElementById('edad').value);
  const mensaje = (edad >= 18)
    ? 'Eres mayor de edad.'
    : 'Eres menor de edad.';
  document.getElementById('mensajeEdad').innerHTML = mensaje;
};

// Ejercicio 4
const mostrarEstudiantes = () => {
  const estudiantes = [
    { nombre: 'Ruben', apellido: 'Valverde', nota: 23 },
    { nombre: 'Sebastian', apellido: 'Ortega', nota: 79 },
    { nombre: 'Jahir', apellido: 'Cruz', nota: 78 },
    { nombre: 'Valeria', apellido: 'Calvo', nota: 99 }
  ];

  let lista = '';
  let sumaNotas = 0;

  estudiantes.forEach(est => {
    lista += `<p>${est.nombre} ${est.apellido}</p>`;
    sumaNotas += est.nota;
  });

  const promedio = sumaNotas / estudiantes.length;
  lista += `<p><strong>Promedio: ${promedio.toFixed(2)}</strong></p>`;

  document.getElementById('listaEstudiantes').innerHTML = lista;
};
