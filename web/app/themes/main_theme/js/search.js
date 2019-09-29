/**
 *  Handling for search
 */
var input = document.getElementById("input-search");
var icon = document.getElementById("cancel-icon");
var divContainer = document.getElementById("search-results");
var divData = document.getElementById("search-data");
var titleSearch = document.getElementById("type-results");
var urlAjax = document.getElementById("url-ajax").value;

function searchFunction() {
    if (input.value !== '') {
        icon.style.display = "block";
        jQuery.ajax({
            url: urlAjax,
            type: 'post',
            data: { action: 'search_fetch', query: input.value },
            success: function(data) {
                displayResults(data);
            }
        });

    } else {
        emptyInput();
    }
}
function emptyInput() {
    input.value = '';
    icon.style.display = "none";
    divContainer.style.display = "none";
    titleSearch.style.display = "none";
}

function removeAllChildsOfDivData() {
    var child = divData.lastElementChild;
    while (child) {
        divData.removeChild(child);
        child = divData.lastElementChild;
    }
}

function displayResults(data) {
    if (data !== null && data.length !== 0) {
        removeAllChildsOfDivData();
        titleSearch.style.display = "block";
        data.forEach(function (restaurant) {
            var a = document.createElement('a');
            a.setAttribute('href', restaurant.url);
            var p = document.createElement('p');
            p.textContent = restaurant.title;
            p.setAttribute('class', 'content-results');
            a.appendChild(p);
            divData.appendChild(a);
        });
        divContainer.style.display = "block";
    } else {
        divContainer.style.display = "none";
    }
}