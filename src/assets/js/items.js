
document.addEventListener("DOMContentLoaded", function(e) {
    const new_items = document.querySelectorAll('.new-item');

    new_items.forEach(link => {
        link.addEventListener("click", new_item_click);
    });
});


function new_item_click(e)
{
    e.preventDefault();

    const url = e.target;

    const modal = document.getElementById("main-modal");
    const modal_content = modal.querySelector("#main-modal-content");
    const modal_title = modal.querySelector("#main-modal-title");

    http_request = new XMLHttpRequest();
    http_request.onreadystatechange = function() {
        if (http_request.readyState == XMLHttpRequest.DONE) {
            if (http_request.status == 200) {

                // todo: set the title appropriately if there is a default_new_item for the user, or the boards_users pref
                modal_title.innerHTML = e.target.getAttribute("data-title");
                modal_content.innerHTML = http_request.responseText;

                // if we are adding or updating a thing
                // we need to update the change listener
                if (url.toString().endsWith("thing.php")) {
                    const type_selector = document.getElementById("type-selector");
                    type_selector.addEventListener("change", type_selector_change);
                }

                const bs_modal = new bootstrap.Modal(modal);
                bs_modal.toggle();
            } else {
                modal_content.innerHTML = "<div class=\"alert alert-danger\">There was an error loading \"" + url + "\"</div>";
            }
        }
    }

    http_request.open("GET", url);
    http_request.send();
}


function type_selector_change(e)
{
    const modal = document.getElementById("main-modal");
    const modal_content = modal.querySelector("#main-modal-content");
    const modal_title = modal.querySelector("#main-modal-title");

    http_request = new XMLHttpRequest();
    http_request.onreadystatechange = function() {
        if (http_request.readyState == XMLHttpRequest.DONE) {
            if (http_request.status == 200) {
                modal_content.innerHTML = http_request.responseText;
                modal_title.innerHTML = "New " + e.target.options[e.target.options.selectedIndex].innerHTML;

                const type_selector = document.getElementById("type-selector");
                type_selector.addEventListener("change", type_selector_change);
            } else {
                modal_content.innerHTML = "<div class=\"alert alert-danger\">There was an error loading \"thing.php\"</div>";
            }
        }
    }

    http_request.open("POST", "thing.php");
    http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http_request.send("t=" + e.target.options[e.target.options.selectedIndex].value);
}
