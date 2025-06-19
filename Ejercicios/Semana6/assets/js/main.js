document.addEventListener("DOMContentLoaded", function () {
    console.log("El DOM ha sido cargado completamente");
    cargarTarjetas();


});

const tarjetas = [
    {
        titulo: "Titulo 1",
        descripcion: "Descripcion 1Some quick example text to build on the card title and make up the bulk of the card’s content.",
        boton: "Button text",
        imagen: "https://raulperez.tieneblog.net/wp-content/uploads/2015/09/tux.jpg"
    },
    {
        titulo: "Titulo 2",
        descripcion: "Descripcion 2Some quick example text to build on the card title and make up the bulk of the card’s content.",
        boton: "Button text",
        imagen: "https://raulperez.tieneblog.net/wp-content/uploads/2015/09/tux.jpg"
    }, {
        titulo: "Titulo 3",
        descripcion: "Descripcion 3Some quick example text to build on the card title and make up the bulk of the card’s content.",
        boton: "Button text",
        imagen: "https://raulperez.tieneblog.net/wp-content/uploads/2015/09/tux.jpg"
    }

];

const cargarTarjetas = () => {
    console.log("Cargando tarjetas...");
    const tarjetas_section = document.querySelector('#tarjetas_section');
    console.log(tarjetas_section);

    tarjetas_section.innerHTML = '';

    let content = '';
    tarjetas.forEach(tarjeta => {
        console.log(tarjeta);

        const {imagen, titulo, descripcion, boton} = tarjeta;

        content += `<div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img src="${imagen}" class="card-img-top"
                        alt="...">
                    <div class="card-body">
                        <h5 class="card-title">${titulo}</h5>
                        <p class="card-text">${descripcion}</p>
                        <a href="#" class="btn btn-primary">${boton}</a>
                    </div>
                </div>
            </div>`
    })

  //  tarjetas_section.append(content);
  //  console.log("Tarjetas cargadas correctamente");

    tarjetas_section.innerHTML = content;
}