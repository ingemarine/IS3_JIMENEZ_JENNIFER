import L from 'leaflet';

// Inicializar el mapa centrado en Guatemala
const map = L.map('map', {
    center: [14.71889, -90.64417], // Coordenadas de inicio del mapa
    zoom: 7,
    layers: []
});

// Añadir capa de OpenStreetMap
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Crear grupo de capas para los marcadores
const markerLayer = L.layerGroup();

// Definir el ícono personalizado
const icon = L.icon({
    iconUrl: './images/cit.png', // Asegúrate de que la ruta sea correcta
    iconSize: [40, 40]
});

// Array con las coordenadas de los marcadores
const coordinates = [
    [14.71889, -90.64417],  // Punto 1
    [14.64072, -90.51323],  // Punto 2
    [14.97222, -89.53056],  // Punto 3
    [14.83472, -91.51806],  // Punto 4
    [15.72778, -88.59444]   // Punto 5
];

// Añadir un marcador para cada coordenada con el ícono personalizado
coordinates.forEach(coord => {
    L.marker(coord, { icon: icon }).addTo(markerLayer);
});

// Añadir la capa de marcadores al mapa
markerLayer.addTo(map);

// Dibujar una línea que conecte todas las coordenadas
const polyline = L.polyline(coordinates, { color: 'blue' }).addTo(map);

// Ajustar la vista del mapa para que incluya todos los puntos
map.fitBounds(polyline.getBounds());
