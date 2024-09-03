import { Dropdown } from "bootstrap";
import Chart from "chart.js/auto";

const canvas = document.getElementById('chartVentas');
const ctx = canvas.getContext('2d');
const btnActualizar = document.getElementById('actualizar');

const data = {
    labels: [],
    datasets: [{
        label: 'Envios por usuario',
        data: [],
        borderWidth: 5,
        backgroundColor: []
    }]
};

const chartClientes = new Chart(ctx, {
    type: 'bar',
    data: data,
});

const getEstadisticas = async () => {
    const url = `/IS3_JIMENEZ_JENNIFER/API/detalle/estadisticas`
    const config = { method: "GET" }
    const response = await fetch(url, config);
    const data = await response.json()

    console.log(data)

    if(data){
        if(chartClientes.data.datasets[0]) {
            chartClientes.data.labels = []; 
            chartClientes.data.datasets[0].data = []; 
            chartClientes.data.datasets[0].backgroundColor = []; 

            data.forEach(r => {
                chartClientes.data.labels.push(r.us_nombre); 
                chartClientes.data.datasets[0].data.push(r.cantidad_productos);
                chartClientes.data.datasets[0].backgroundColor.push(generateRandomColor());
            });
        }
    }

    chartClientes.update();
}

const generateRandomColor = () => {
    const r = Math.floor(Math.random() * 256); 
    const g = Math.floor(Math.random() * 256); 
    const b = Math.floor(Math.random() * 256); 

    const rgbColor = `rgb(${r}, ${g}, ${b})`;
    return rgbColor;
}

btnActualizar.addEventListener('click', getEstadisticas);
