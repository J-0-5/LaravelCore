const translated_actions = {
    all: "Todo",
    index: "Inicio",
    create: "Vista crear",
    store: "Crear",
    show: "Detalle",
    destroy: "Eliminar",
    delete: "Eliminar",
    update: "Actualizar",
    edit: "Vista editar",
    assign: "Asignar",
    import: "Importar",
    export: "Exportar",
    record: "Historial",
};

const requestPermissions = async (url) => {
    let response = { state: 500 };
    let token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    await fetch(url, {
        method: "GET",
        headers: {
            "X-CSRF-TOKEN": token,
        },
    })
        .then((response) => response.json())
        .then((data) => {
            response = data;
        })
        .catch(function (e) {
            console.log(e);
        });

    return response;
};

const requestRoleDocuments = async (url) => {
    let response = {
        state: 500,
    };
    await fetch("/getParameterValues?reference=role_documents")
        .then((response) => response.json())
        .then((data) => {
            response = data;
        })
        .catch((e) => console.log(e));
    return response;
}
export default class Permissions {
    initialize() {
        this.loadPermissions();
        this.loadDocuments();
        this.roleData();
    }

    loadPermissions() {
        let configurationBtnRole =
            document.getElementsByClassName("configuration-role-btn");
        let configurationBtnUser =
            document.getElementsByClassName("configuration-user-btn");
        let permitsLbl = document.getElementById("permits-label");
        if (configurationBtnRole == null || configurationBtnUser == null) {
            return;
        }
        const permission = (data) => {
            let modules = data.modules;
            let actions = data.actions;
            let permissions = data.permissions;

            let cardBody = document.getElementById("card-body");
            cardBody.innerHTML = ``;
            [].forEach.call(modules, (module) => {
                let module_actions = module?.actions?.split(",") ?? [];
                let module_permissions = permissions.find(
                    (element) => element.module_id == module.id
                );
                let allowed_actions =
                    module_permissions?.actions?.split(",") ?? [];

                let mainContainer = document.createElement("div");
                mainContainer.className = "row";

                let nameContainer = document.createElement("div");
                nameContainer.className = "col-3 align-self-center";
                nameContainer.innerHTML = `<h6 class="mb-0 text-muted font-weight-bold">${module.name}</h6>`;
                mainContainer.appendChild(nameContainer);

                let checkContainer = document.createElement("div");
                checkContainer.className = "col-9 align-self-center border-bottom my-5";
                checkContainer.innerHTML = `<div class="checkbox-inline"></div>`;

                [].forEach.call(actions, (action) => {
                    const action_found = module_actions.find(
                        (element) => element == action.id
                    );
                    const permission_found = allowed_actions.find(
                        (element) => element == action.id
                    );

                    let label = document.createElement("label");
                    label.className =
                        "checkbox col-3 text-uppercase font-weight-bold mx-4";
                    label.style = `
                        font-size: 0.8571em;
                        margin-bottom: 5px;
                        color: #9A9A9A;
                    `;

                    label.innerHTML = `
                    <input class="" type="checkbox" value="${action.id}"
                     name="${module.reference}[]" ${!action_found && "disabled"
                        }

                     ${permission_found && "checked"}
                    > <span></span>${!action_found ? '<s>' : ''} ${translated_actions[action.name]}${!action_found ? '</s>' : ''}

                    `;
                    checkContainer.childNodes[0].appendChild(label);
                });

                mainContainer.appendChild(checkContainer);

                cardBody.appendChild(mainContainer);

                let submitBtn = document.getElementById("submit-btn");
                submitBtn.className = `btn btn-primary btn-sm d-block`;
            });

        }
        [].forEach.call(configurationBtnRole, function (btn) {
            btn.addEventListener("click", async () => {
                let row = btn.parentNode.parentNode;

                let role_id = row.id;
                let associate = row.getAttribute("associate")

                permitsLbl.innerText = `Permisos - ${row.getAttribute(
                    "attribute-name"
                )}`;

                let form = document.getElementById("permits-form");
                form.setAttribute("action", `/permisos/${role_id}?associate_to=${associate}`);

                let url = `/permisos/getPermissions/${associate}/${role_id}`;
                let response = await requestPermissions(url);
                if (response.state != 200) {
                    return;
                }

                let data = response.data;

                permission(data)

            });
        });

        [].forEach.call(configurationBtnUser, function (btn) {
            btn.addEventListener("click", async () => {
                let row = btn.parentNode.parentNode;

                let user_id = row.id;
                let associate = row.getAttribute("associate")

                permitsLbl.innerText = `Permisos - ${row.getAttribute(
                    "attribute-name"
                )}`;

                let form = document.getElementById("permits-form");
                form.setAttribute("action", `/permisos/${user_id}?associate_to=${associate}`);

                let url = `/permisos/getPermissions/${associate}/${user_id}`;
                let response = await requestPermissions(url);
                if (response.state != 200) {
                    return;
                }

                let data = response.data;
                permission(data)
            });
        });
    }


    loadDocuments(){
        let configurationBtnRole =
        document.getElementsByClassName("configuration-role-btn");
        let permitsLbl = document.getElementById("documents-label");
        if (configurationBtnRole == null) {
            return;
        }

        [].forEach.call(configurationBtnRole, function (btn) {
            btn.addEventListener("click", async () => {
                let row = btn.parentNode.parentNode;

                let role_id = row.id;
                permitsLbl.innerText = `Documentos - ${row.getAttribute(
                    "attribute-name"
                )}`;

                let form = document.getElementById("documents-form");
                form.setAttribute("action", `/roles/${role_id}`);

                let response = await requestRoleDocuments();
                if (response.state != 200) {
                    return;
                }
                let data = response.data;

                let cardBody = document.getElementById("card-body-documents");
                cardBody.innerHTML = ``;

                let mainContainer = document.createElement("div");
                mainContainer.className = "row";

                let checkContainer = document.createElement("div");
                checkContainer.className = "col-12 align-self-center border-bottom my-5";
                checkContainer.innerHTML = `<div class="checkbox-inline"></div>`;

                [].forEach.call(data, (data) => {


                    let label = document.createElement("label");
                    label.className =
                        "checkbox col-3 text-uppercase font-weight-bold mx-4";
                    label.style = `
                        font-size: 0.8571em;
                        margin-bottom: 5px;
                        color: #9A9A9A;
                    `;

                    label.innerHTML = `
                    <input class="" type="checkbox" value="${data.id}"
                     name="documents[]"
                    > <span></span> ${data.name}

                    `;
                    checkContainer.childNodes[0].appendChild(label);
                });

                mainContainer.appendChild(checkContainer);
                cardBody.appendChild(mainContainer);

                let submitBtn = document.getElementById("submit-btn-documents");
                submitBtn.className = `btn btn-primary btn-sm d-block`;
            });
        });
    }

    roleData() {
        let editButtons = document.getElementsByName("btnEditRole");
        if (editButtons == null) {
            return;
        }
        [].forEach.call(editButtons, (item) => {
            item.addEventListener("click", async () => {
                let role_id = item["id"].split("-")[1];
                let response = await this.requestRoleData(role_id);
                if (response.state != 200) {
                    alert("Error inesperado.");

                    return;
                }
                let data = response.data;
                let name = document.getElementById("name_edit");
                name.value = data.name;
                let state = document.getElementById("state_edit");
                [].forEach.call(state, (opt) => {
                    opt.value == data.state ? (opt.selected = true) : "";
                });
                let form = document.getElementById("formUpdateRole");
                form.setAttribute("action", "roles/" + data.id);
            });
        });
    }

    async requestRoleData(id) {
        let response = {
            state: 500,
        };
        await fetch("/roles/" + id + "/edit")
            .then((response) => response.json())
            .then((data) => {
                response = data;
            })
            .catch((e) => console.log(e));
        return response;
    }


}
