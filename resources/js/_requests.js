export const requestPrograms = async (faculty_id) => {
    let response = { state: 500 };
    await fetch(`/config/programs?faculty_id=${faculty_id}`)
        .then(response => response.json())
        .then(data => {
            response = data;
        })
        .catch(error => response.error = error);

    return response;
}

export const requestParameterValues = async (parameter_id = '', parent_id = '') => {
    let response = { state: 500 };
    await fetch(`/getParameterValues?parameter_id=${parameter_id}&parent_id=${parent_id}`)
        .then(response => response.json())
        .then(data => {
            response = data;
        })
        .catch(error => response.error = error);

    return response;
}
