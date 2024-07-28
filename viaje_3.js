//RESPUESTA NÚMERO 1
// Simulated data for destinations and travel packages
const travelPackages = [
    { destination: 'Paris', date: '2024-07-01', offer: '20% de descuento', available: true },
    { destination: 'New York', date: '2024-07-15', offer: '15% de descuento', available: false },
    { destination: 'Tokyo', date: '2024-08-01', offer: '10% de descuento', available: true },
    { destination: 'Sydney', date: '2024-08-10', offer: '25% de descuento', available: true },
    { destination: 'Santiago', date: '2024-10-15', offer: '15% de descuento', available: true }
];

function search() {
    const destinationInput = document.getElementById('destination').value.toLowerCase();
    const travelDateInput = document.getElementById('travel-date').value;
    const resultsContainer = document.getElementById('results-container');

    // Limpiar historial
    resultsContainer.innerHTML = '';

    // Filtrar paquete de viaje basado en
    const filteredPackages = travelPackages.filter(pkg => {
        const destinationMatch = pkg.destination.toLowerCase().includes(destinationInput);
        const dateMatch = pkg.date === travelDateInput || travelDateInput === '';
        return destinationMatch && dateMatch;
    });

    // Display filtered results
    if (filteredPackages.length > 0) {
        filteredPackages.forEach(pkg => {
            const resultItem = document.createElement('div');
            resultItem.className = 'result-item';
            resultItem.innerHTML = `
                <h3>Destino: ${pkg.destination}</h3>
                <p>Fecha: ${pkg.date}</p>
                <p>Oferta: ${pkg.offer}</p>
                <p>Disponibilidad: ${pkg.available ? 'Disponible' : 'No disponible'}</p>
            `;
            resultsContainer.appendChild(resultItem);
        });
    } else {
        resultsContainer.innerHTML = '<p>No se encontraron resultados.</p>';
    }
}

// Definición del objeto para representar un paquete turístico
class PaqueteTuristico {
    constructor(destino, fecha, oferta, disponible) {
        this.destino = destino;
        this.fecha = fecha;
        this.oferta = oferta;
        this.disponible = disponible;
    }

    // Método para obtener la información del paquete en formato HTML
    getInfoHTML() {
        return `
            <div class="paquete-turistico">
                <h3>Destino: ${this.destino}</h3>
                <p>Fecha: ${this.fecha}</p>
                <p>Oferta: ${this.oferta}</p>
                <p>Disponibilidad: ${this.disponible ? 'Disponible' : 'No disponible'}</p>
            </div>
        `;
    }
}

// Lista de paquetes turísticos simulados
const paquetes = [
    new PaqueteTuristico('Paris', '2024-07-01', '20% de descuento', true),
    new PaqueteTuristico('New York', '2024-07-15', '15% de descuento', false),
    new PaqueteTuristico('Tokyo', '2024-08-01', '10% de descuento', true),
    new PaqueteTuristico('Sydney', '2024-08-10', '25% de descuento', true),
    new PaqueteTuristico('Santiago', '2024-10-15', '15% de descuento', true)
];

// Función para mostrar los paquetes turísticos en la página
function mostrarPaquetes() {
    const resultsContainer = document.getElementById('results-container');
    resultsContainer.innerHTML = ''; // Limpiar resultados anteriores
    
    paquetes.forEach(paquete => {
        const paqueteHTML = paquete.getInfoHTML();
        resultsContainer.innerHTML += paqueteHTML;
    });
}

// Llamar a la función para mostrar los paquetes al cargar la página
document.addEventListener('DOMContentLoaded', mostrarPaquetes);

// Función para mostrar una notificación instantánea
function mostrarNotificacion(mensaje, tipo) {
    const notificacion = document.createElement('div');
    notificacion.className = `notificacion ${tipo}`;
    notificacion.textContent = mensaje;

    const body = document.querySelector('body');
    body.appendChild(notificacion);

    // Eliminar la notificación después de 5 segundos
    setTimeout(() => {
        notificacion.remove();
    }, 5000);
}

// Ejemplo de uso: Mostrar notificación de oferta especial
const ofertaEspecial = "¡Oferta especial! Paris con 20% de descuento";
mostrarNotificacion(ofertaEspecial, 'oferta');

// Ejemplo de uso: Mostrar notificación de disponibilidad actualizada
const disponibilidadActualizada = "¡Nuevos paquetes disponibles en Tokyo!";
mostrarNotificacion(disponibilidadActualizada, 'disponible');