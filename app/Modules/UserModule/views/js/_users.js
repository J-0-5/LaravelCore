export default class Users {
    initialize() {
        this.renderRequiredDocuments();
    }

    renderRequiredDocuments() {
        let container = document.getElementById('document-container');
        let select = document.getElementById('role-id');
        let role_data = document.getElementById('roles');
        if (container == null || select == null || role_data == null) {
            return;
        }
        let roles = JSON.parse(role_data.value);
        select.addEventListener('change', () => {
            let role_id = select.value;
            let role = roles.filter((element) => element.id == role_id)[0] ?? false;
            if (!role) {
                return;
            }
            let documents = role.documents ?? [];
            if (documents.length == 0) {
                return;
            }
            container.innerHTML = `
            <div class="col-12 col-md-12 my-2" style="border-bottom: solid 1px #eee;">
                <h6 class="mb-0">Documentos</h6>
            </div>
            `;
            documents.forEach(element => {
                let document_container = document.createElement('div');
                document_container.classList = 'form-group col-12';
                document_container.innerHTML = `
                <label class="form-control-label">${element.name}</label>
                <input type="file" name="${element.id}" class="form-control">
                `;
                container.appendChild(document_container);
            });
            container.classList = 'd-block';
        });
    }
}
