import { BCardBody } from "bootstrap-vue";
import { async } from "q";
import Parameters from "../../../ParametersModule/views/js/_parameters";

export default class Config {
    initialize() {
        this.initial();
    }

    initial() {
        let renderAData;
        var elementFaculty = document.querySelectorAll("#fact>tr");
        let tbody = document.querySelector("#showProgram");
        let elemento = document.getElementById("showProgram");

        elementFaculty.forEach((element, index) => {
            if (index < 1) {
                // Trae por defecto los primeros registros tomando el id de la primer facultad
                getPrograms(element.id);
            }

            element.addEventListener("click", function () {
                while (elemento.firstChild) {
                    elemento.removeChild(elemento.firstChild);
                }
                getPrograms(this.id);
            });
        });
        async function getPrograms(id) {
            // renderAData = [];
            await fetch("config/programs/" + id)
                .then((response) => response.json())
                .then((json) => (renderAData = json.data));
            // console.log(renderAData);
            renderAData.forEach((element) => {
                tbody.innerHTML += `<tr>
                                        <td>
                                            ${element.name}
                                        </td>
                                        <td>
                                            <a href="#"><img src="/img/icon/${element.active ? `statusok.png` : `statusbad.png`}" class="icon-table" alt=""></a>
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal"
                                            data-target="#modalEditProgram" class="showEditProgram mr-2" id="${element.id}"><img src="/img/icon/edit.png" class="icon-table" alt="" data-tooltip title="Editar"></a>

                                            <a href="#" class="deleteItem title-view" data-id="${element.id}" data-tooltip title="Eliminar">
                                            <img src="/img/icon/delete.png" class="icon-table alt=""></a>
                                        </td>
                                    </tr>`;
                // ruta del index en delete
            });


            let btnID = document.querySelectorAll('.showEditProgram');
            btnID.forEach(element => {
                element.addEventListener('click', editForm);
            });
            let btnEditForm = document.querySelectorAll('.showEditFaculty');
            btnEditForm.forEach(element => {
                element.addEventListener('click', editFormFac);
            });
            let btnDelete = document.querySelectorAll('.deleteItem');
            btnDelete.forEach(element => {
                element.addEventListener('click', deleteForm);
            });
            let btnDeleteFac = document.querySelectorAll('#fact>tr>td>.deleteFac');
            btnDeleteFac.forEach(element => {
                element.addEventListener('click', deleteFormFac);
            });
            let updateProg = document.querySelectorAll('.showEditProgram');
            updateProg.forEach(element => {
                element.addEventListener('click', subFormProg);
            });

            let updateFac = document.querySelectorAll('.showEditFaculty');
            updateFac.forEach(element => {
                element.addEventListener('click', subFormFac);
            });
        }

        // create program

        let btnsub = document.querySelector("#modalCreateProgram");
        if (btnsub != null) {
            btnsub.addEventListener("submit", formSubmit);
        }


        function formSubmit() {
            document.getElementById("modalCreateProgram").style.display = 'none';
            // const dataProg = document.querySelector('#modalCreateProgram');
            // const ranking = dataProg.getAttribute("data-backdrop");
            // dataProg.setAttribute("data-backdrop", "false");
            // console.log(dataProg);
        }
        // console.log(btnsub);
        let CreateProg = document.querySelector("#modalCreateProgram .formsub");
        if (CreateProg != null) {
            CreateProg.addEventListener("submit", handleFormSubmit);
        }

        async function handleFormSubmit(event) {
            event.preventDefault();
            const form = event.currentTarget;
            // console.log(form);
            const url = form.action;
            try {
                const formData = new FormData(form);
                //Cambiar por id de parámetro correcto
                // formData.append('parameter_id', 11);
                const responseData = await postFormDataAsJson({ url, formData, });
            } catch (error) {
                console.error(error);
            }
            form.reset();
        }

        async function postFormDataAsJson({ url, formData }) {
            const plainFormData = Object.fromEntries(formData.entries());
            const formDataJsonString = JSON.stringify(plainFormData);
            while (elemento.firstChild) {
                elemento.removeChild(elemento.firstChild);
            }
            getPrograms(parseInt(plainFormData.parent_id));
            const fetchOptions = {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: formDataJsonString,
            };
            const response = await fetch(url, fetchOptions);

            if (!response.ok) {
                const errorMessage = await response.text();
                throw new Error(errorMessage);
            }
            return response.json();
        }


        //create faculty

        let CreateFac = document.querySelector("#modalCreateFaculty .formsub");
        if (CreateFac != null) {
            CreateFac.addEventListener("submit", handleFormSubmitFac);
        }

        async function handleFormSubmitFac(event) {

            event.preventDefault();
            const form = event.currentTarget;
            const url = form.action;
            // console.log(form);

            try {
                const formData = new FormData(form);
                //Cambiar por id de parámetro correcto
                // formData.append('parameter_id', 11);
                const responseData = await storeParameterValue({ url, formData, });
                location.reload();
                //console.log({ responseData });
            } catch (error) {
                console.error(error);
            }
        }

        async function storeParameterValue({ url, formData }) {
            const plainFormData = Object.fromEntries(formData.entries());
            const formDataJsonString = JSON.stringify(plainFormData);
            // console.log(plainFormData);
            while (elemento.firstChild) {
                elemento.removeChild(elemento.firstChild);
            }
            getPrograms(parseInt(plainFormData.parent_id));


            // document.body.classList.remove('show-modal');
            const fetchOptions = {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: formDataJsonString,
            };
            const response = await fetch(url, fetchOptions);

            if (!response.ok) {
                const errorMessage = await response.text();
                throw new Error(errorMessage);
            }
            return response.json();
        }



        // edit program
        async function editForm() {
            let idProg = this.id;
            let res;
            let ediProg = document.querySelector("#modalEditProgram .formsub");

            const response = await fetch(`/config/programs/${idProg}/edit`)
                .then((response) => response.json())
                .then((json) => (res = json.data));
            let slc = ediProg.querySelector('#frmPrograms')
            slc.value = response.parent_id;

            let name = ediProg.querySelector('input#name')
            name.value = response.name;

            let desc = ediProg.querySelector('textarea')
            desc.value = response.description;

            let state = ediProg.querySelector('input.progState')
            if (response.state == 1) {
                state.setAttribute('checked', '');
            }

            ediProg.setAttribute('proid', idProg);

        }

        // edit faculty
        async function editFormFac() {
            let idFac = this.dataset.idedit
            let res;
            let editFac = document.querySelector("#modalEditFaculty .formsub");
            const response = await fetch(`/config/programs/${idFac}/edit`)
                .then((response) => response.json())
                .then((json) => (res = json.data));

            let name = editFac.querySelector('input#name')
            name.value = response.name;

            let desc = editFac.querySelector('textarea')
            desc.value = response.description;

            let state = editFac.querySelector('input.progState')
            // state.value = response.state;
            if (response.state == 1) {
                state.setAttribute('checked', '');
            }
        }

        // delete program
        async function deleteForm() {
            let dlt = this.dataset.id
            deleteResource('/config/programs/' + dlt, true);
        }

        // delete faculty
        async function deleteFormFac() {
            let dltFac = this.dataset.id;
            let arrExt;
            await fetch("config/programs/" + dltFac)
                .then((response) => response.json())
                .then((json) => (arrExt = json.data));
            // console.log(arrExt);
            if (arrExt.length == 0) {
                deleteResource('/config/faculty/' + dltFac, true);
            } else {
                // alert();
                return swal({
                    icon: "error",
                    title: "!Acción denegada!",
                    text: "Asegúrese de no haber ningún programa.",
                });
            }
        }

        // update program
        async function subFormProg() {
            let idProg = this.id;
            let sub = document.querySelector("#modalEditProgram .formsub");
            if (sub != null) {
                sub.addEventListener("submit", handleFormSubmit);
            }


            async function handleFormSubmit(event) {
                event.preventDefault();
                const form = event.currentTarget;
                const url = '/config/programs/' + idProg;
                // console.log(url);

                try {
                    const formData = new FormData(form);
                    const responseData = await putFormDataAsJson({ url, formData, });
                    location.reload();
                    // console.log({ responseData });
                } catch (error) {
                    console.error(error);
                }
            }

        }

        async function putFormDataAsJson({ url, formData }) {
            const plainFormData = Object.fromEntries(formData.entries());
            const formDataJsonString = JSON.stringify(plainFormData);
            const fetchOptions = {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: formDataJsonString,
            };
            const response = await fetch(url, fetchOptions);

            if (!response.ok) {
                const errorMessage = await response.text();
                throw new Error(errorMessage);
            }
            return response.json();
        }

        // update faculty
        async function subFormFac() {
            let idFac = this.dataset.idedit;
            let sub = document.querySelector("#modalEditFaculty .formsub");
            if (sub != null) {
                sub.addEventListener("submit", handleFormSubmit);
            }


            async function handleFormSubmit(event) {
                event.preventDefault();
                const form = event.currentTarget;
                const url = '/config/faculty/' + idFac;
                //console.log(url);

                try {
                    const formData = new FormData(form);
                    const responseData = await putFormDataAsJsonFac({ url, formData, });
                    location.reload();
                    //console.log({ responseData });
                } catch (error) {
                    console.error(error);
                }
            }

        }

        async function putFormDataAsJsonFac({ url, formData }) {
            const plainFormData = Object.fromEntries(formData.entries());
            const formDataJsonString = JSON.stringify(plainFormData);
            const fetchOptions = {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: formDataJsonString,
            };
            const response = await fetch(url, fetchOptions);

            if (!response.ok) {
                const errorMessage = await response.text();
                throw new Error(errorMessage);
            }
            return response.json();
        }

    }

}


