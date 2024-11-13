// Función para obtener datos de la API y mostrarlos en la tabla
async function cargarUsuarios() {
    try {
        // Llama a la API para obtener los usuarios
        const respuesta = await fetch('ruta_a_tu_api/ApiUser.php'); // Cambia 'ruta_a_tu_api' por la ruta real
        const usuarios = await respuesta.json();

        // Selecciona el cuerpo de la tabla
        const tbody = document.getElementById('tablaUsuarios').getElementsByTagName('tbody')[0];

        // Recorre los usuarios y agrega filas a la tabla
        usuarios.forEach(usuario => {
            const fila = document.createElement('tr');
            
            // Crea celdas para cada campo de usuario
            fila.innerHTML = `
                <td>${usuario.id}</td>
                <td>${usuario.nombre}</td>
                <td>${usuario.correo}</td>
                <td>${usuario.direccion}</td>
                <td>${usuario.monedero}</td>
                <td>${usuario.rol}</td>
                <td><img src="data:image/jpeg;base64,${usuario.foto}" alt="Foto de ${usuario.nombre}" width="50"></td>
            `;
            
            // Añade la fila al cuerpo de la tabla
            tbody.appendChild(fila);
        });
    } catch (error) {
        console.error("Error al cargar usuarios:", error);
    }
}

// Carga los usuarios cuando se carga la página
document.addEventListener('DOMContentLoaded', cargarUsuarios);
