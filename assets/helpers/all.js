const toFirstUpperCarse = (string) => {
    return string.charAt(0).toUpperCase() + string.slice(1);
};

const renderTableEmptyMessage = (element, message, cols) => {
    element.innerHTML = `
         <tr>
            <td colspan="${cols}"><div class="text-center text-muted mx-auto">${message}</div></td>
        </tr>`;
};

const errorSwal = () => {
    Swal.fire(
        'Oops..!',
        'Algo salio mal, Vuelve a intentarlo!.',
        'error'
    )
};

const showModal = (element = ".modal") => {
    $(element).modal("show");
};
const hideModal = (element = ".modal") => {
    $(element).modal("hide");
};

const formatDate = (dateFormat, type = "datetime") => {
    let date, time, year, month, day
    months = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    if (type == "datetime") {
        [date, time] = dateFormat.split(" ");
    } else {
        date = dateFormat;
    }
    [year, month, day] = date.split("-")
    return `${months[month - 1]} ${day} del ${year}`;

};