import { Dropdown } from "bootstrap";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";



const Buscar = async () => {
    const url = '/IS3_JIMENEZ_JENNIFER/API/envios/buscar';

    const config = {
        method: 'GET'
    };

    const respuesta = await fetch(url, config);
    const datos = await respuesta.json();
    datatable.clear().draw();

    if (datos) {
        datatable.rows.add(datos).draw();
    }
    console.log(datos)
};

const datatable = new DataTable('#envios', {
    data: null,
    language: lenguaje,
    columns: [
        {
            title: 'No.',
            data: null, // No se necesita data para esta columna
            width: '%',
            render: (data, type, row, meta) => {
                return meta.row + 1;
            }
        },
        {
            title: 'Nombre del Cliente',
            data: 'us_nombre'
        },
        
        {
            title: 'Fecha',
            data: 'envio_fecha'
        },
        {
            title: 'Origen',
            data: 'origen_id'
        },
        {
            title: 'Destino',
            data: 'destino_id'
        }
    ]
});
btnActualizar.addEventListener('click', Buscar);