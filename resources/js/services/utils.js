import apiService from './apiService.js';
import L from 'leaflet';



const Utils = 
{
    map: null,
    visits: [],
    error: null,
    location: null,

    initMap() {
        this.map = L.map('map').setView([51.505, -0.09], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://bexsoluciones.com">BEX Soluciones - Busines Ecosystem Experiences SAS</a>'
        }).addTo(this.map);
    },

    fetchVisits() {
        apiService.getAllVisits()
        .then(response => {
            const { visits } = response.data;
            this.visits = visits;
            this.addMarkers();
        })
        .catch(error => {
            this.error = 'Error al obtener todos los registros de las visitas: ' + error;
        });
    },

    addMarkers() 
    {
        this.visits.forEach(visit => 
        {
            if (visit.latitude && visit.longitude) {
                const marker = L.marker([visit.latitude, visit.longitude]).addTo(this.map);
                marker._icon.classList.add("custom-marker");
                marker.bindPopup(`<b>${visit.name}</b><br>${visit.email}`);

                // Agregar evento de clic para mostrar información detallada
                marker.on('click', (e) => {
                    this.getNameUbication(e.latlng);
                });
            }
        });
    },

    getNameUbication(latlng)
    {
      fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latlng.lat}&lon=${latlng.lng}&format=json`)
      .then(response => response.json())
      .then(data => {
         this.location = data.display_name; 
      });
    }
};

export default Utils;
