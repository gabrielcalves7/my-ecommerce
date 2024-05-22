function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const output = document.getElementById('imagePreview');
        output.src = reader.result;
        if (output.classList.contains('hidden')) {
            output.classList.remove('hidden')
        }
    };
    reader.readAsDataURL(event.target.files[0]);
}

function changePage(element) {
    const queryParams = new URLSearchParams(window.location.search);
    console.log(queryParams.has(element.name))
    queryParams.set(element.name,element.value)
    const url = new URL(window.location);

// Set query parameters
    url.searchParams.set(element.name,element.value);

// Update the URL in the browser without reloading the page
    window.history.pushState({}, '', url);
    window.location.reload()
}

function setOrderBy(model, field, order){
    const url = new URL(window.location);

    url.searchParams.set(model+"Search[order]",field);
    url.searchParams.set(model+"Search[asc]",order);
    window.history.pushState({}, '', url);
    console.log(window.location)
}

function buildSearchQueryString(field,value){

    return `&${field}=${value}`;
}