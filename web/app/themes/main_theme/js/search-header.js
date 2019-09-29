/**
 *  Handling for search in header
 */
var input = document.getElementById("input-search-header");
var divContainer = document.getElementById("search-results-header");
var divData = document.getElementById("search-data-header");
var titleSearch = document.getElementById("type-results-header");
var urlAjax = document.getElementById("url-ajax").value;

function searchFunction() {
    if (input.value !== '') {
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