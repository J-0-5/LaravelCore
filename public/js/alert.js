function confirmDelete(param) {
    let token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    swal({
        title: "¿Estás seguro?",
        text: "Recuerda que al eliminar esto borrarás todos sus registros",
        icon: "warning",
        buttons: {
            cancel: "Cancelar",
            confirm: "Confirmar",
        },
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: param,
                type: "DELETE",
            });
            location.reload();
            swal("¡Eliminación exitosa!", {
                icon: "success",
            });
        }
    });
}
async function deleteResource(url, reload = false, row_id) {
    let result = await confirmation();
    if (result) {
        let req = await fetch(url, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN":
                    document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content") ?? "",
                Accept: "application/json",
            },
        }).then((response) => response.json());
        if (req.state != 200) {
            error("Error al eliminar");
            return false;
        }
        await correct(req.message ?? "¡Eliminado!");
        if (reload) {
            window.location.reload();
        }
        if (row_id !== "null") {
            table_row_id = document.getElementById(row_id);
            table_row_id?.remove();
        }
        return true;
    }
}

function confirmation(
    title = "¿Estás seguro?",
    text = "Al eliminar esto se borrarán todos los registros.",
    icon = "info"
) {
    return swal({
        title: title,
        text: text,
        icon: icon,
        buttons: {
            cancel: "Cancelar",
            confirm: "Confirmar",
        },
    });
}

function success(action = "realizar esta operación", message = "") {
    return swal({
        icon: "success",
        title: "Éxito al " + action,
        text: message ? message : "",
        timer: 2300,
    });
}
function error(message) {
    return swal({
        icon: "error",
        title: message,
    });
}

// function errorFac(message = "!Acción denegada!", text = "Asegúrese de no haber ningún programa.") {
//     return swal({
//         icon: "error",
//         title: message,
//         text: text,
//     });
// }

function correct(message) {
    return swal({
        icon: "success",
        title: message,
    });
}

function porDespacharPackagingAlert() {
    return swal("Seleccione el estado de la orden?", {
        buttons: {
            delivery: {
                text: "Entrega!",
                value: 3,
            },
            pickup: {
                text: "Recogida!",
                value: 7,
            },
            cancel: "Cancelar",
        },
    });
}

function formatAMPM(data) {
    let date = new Date("2022/03/18 " + data);
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? "pm" : "am";
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? "0" + minutes : minutes;
    var strTime = hours + ":" + minutes + " " + ampm;
    return strTime;
}

//Scripts_laboratory

function enviarFormulario(url) {
    let urlta = url;
    swal({
        title: "¿Estás seguro?",
        text: "Al eliminar esto se borrarán todos los registros.",
        icon: "info",
        buttons: {
            cancel: "Cancelar",
            confirm: "Confirmar",
        },
    }).then((willDelete) => {
        if (willDelete) {
            document.forms["removeItem"].action = urlta;

            document.forms["removeItem"].submit();
        }
    });
}

async function getFaculty(id_row) {
    let faculty_id = id_row;
    console.log(faculty_id);

    let select = document.getElementById("program_main");
    /* let select_second = document.getElementById("program_second"); */

    select.innerHTML = `<option selected disabled>Seleccione un programa</option>`;
    /* select_second.innerHTML = `<option selected disabled>Seleccione un programa</option>`; */

    let req = await fetch(`/get-programs?faculties=${faculty_id}`);
    let res = await req.json();
    let programs = res;
    console.log(programs);

    if (programs == null) {
        return;
    }
    for (let index = 0; index < programs.length; index++) {
        $("#program_main").append(
            `<option value="${programs[index].id}">${programs[index].name}</option>`
        );
        /* $('#program_second').append(`<option value="${programs[index].id}">${programs[index].name}</option>`);  */
    }
}

async function imageUrlToBase64(url) {
    const data = await fetch(url)
    const blob = await data.blob();
    const reader = new FileReader();
    reader.readAsDataURL(blob);
    reader.onload = () => {
        const base64data = reader.result;
        return base64data
    }
}

function reloadPage(s) {
    setTimeout(function () {
        location.reload();
    }, parseFloat(s) * 1000);
}

function sendInput(text = 'Ingrese campo', url) {


    swal({
        text: text,
        content: "input",
        button: {
          text: "Enviar",
          closeModal: false,
        },
      })
      .then(name => {
        if (!name) throw null;
        let formData = new FormData();
        formData.append('data', name);
        const fetchOptions = {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN":
                    document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content") ?? "",
                Accept: "application/json",
            },
            body: formData,
        };
        return fetch(`${url}`, fetchOptions);
      })
      .then(results => {
        return results.json();
      })
      .then(response => {
        if (response.state != 200) {
          return swal(response.message);
        }
        correct(response.message);
        location.reload();
      })
      .catch(err => {
        if (err) {
          swal("Oh noes!", "The AJAX request failed!", "error");
        } else {
          swal.stopLoading();
          swal.close();
        }
      });
}


//End Scripts_laboratory
