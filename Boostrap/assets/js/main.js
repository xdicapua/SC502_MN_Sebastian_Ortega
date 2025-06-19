document.addEventListener('DOMContentLoaded', function () {
    console.log('Mi funcion anonima');

    const btn = document.querySelector('#button');
    console.log(btn);

    btn.addEventListener('click', accion);
});

const accion = () => {
    console.log('Presionando un boton ...!')
}

// const miFuncionConst = (param) => {
//     console.log('Se ejecuto mi funcion Const')
// }

// document.addEventListener('DOMContentLoaded' , function(){

//     console.log('Mi funcion anonima');

// });

// document.addEventListener('DOMContentLoaded' , miFuncion);

// document.addEventListener('DOMContentLoaded' , miFuncionConst);


// function miFuncion() {
//     console.log('Se ejecuto mi funcion');
// }

