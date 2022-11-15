export const changeImgHandler = (ImgInput, imgTag) => {
    if (ImgInput == null || ImgInput == null) {
        return;
    }

    ImgInput.onchange = function () {
        if (ImgInput.files && ImgInput.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                imgTag.setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(ImgInput.files[0]);
        }
    }
};

export const selectHandler = (element, data, clear = true, select_option = true, selected = false) => {
    clear && (element.innerHTML = select_option ? `<option selected disabled value="">Seleccione</option>` : '');
    data.map(item => {
        let option = document.createElement("option");
        option.text = item.name;
        option.value = item.id;
        selected == item.id && (option.selected = true);
        element.appendChild(option);
    });
};

export const getRequest = async (url, data = null, headers = null) => {
    let response = { state: 500 };
    if (data != null) {
        url = window.location.origin + '/' + url;
        url = new URL(url);
        let params = new URLSearchParams(data);
        url.search = params;
    }
    await fetch(url)
        .then(response => response.json())
        .then(data => {
            response = data;
        })
        .catch(error => response.error = error);

    return response;
};

export const postRequest = async (url, body = JSON.stringify({}), headers = {}) => {
    let response = { state: 500 };
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    headers["X-CSRF-TOKEN"] = token;
    const fetchOptions = {
        method: "POST",
        headers,
        body,
    };
    
    await fetch(url, fetchOptions)
        .then(response => response.json())
        .then(data => {
            response = data;
        })
        .catch(error => response.error = error);
        
    return response;
};
