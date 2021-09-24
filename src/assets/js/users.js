
document.addEventListener("DOMContentLoaded", function(e) {
    const edit_users = document.querySelectorAll('.edit-user');

    edit_users.forEach(link => {
        link.addEventListener("click", edit_user_click);
    });
});


function update_modal_save()
{
    const save_button = document.getElementById("main-modal-save");
    save_button.addEventListener("click", save_user);
}


function edit_user_click(e)
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

                modal_title.innerHTML = e.target.getAttribute("data-title");
                modal_content.innerHTML = http_request.responseText;

                update_modal_save(save_user);

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


function save_user(e)
{
    const uid      = document.getElementById("user_id").value;
    const username = document.getElementById("username").value;
    const pw       = document.getElementById("pw").value;
    const enabled  = document.getElementById("enabled").value;
    const admin    = document.getElementById("admin").value;

    http_request = new XMLHttpRequest();
    http_request.onreadystatechange = function() {
        if (http_request.readyState == XMLHttpRequest.DONE) {
            if (http_request.status == 200) {
                if (http_request.responseText == "success") {
                    message(username + " saved successfully!", "alert alert-success");
                } else {
                    message(username + " save failed!", "alert alert-danger");
                }
            } else {
                const modal = document.getElementById("main-modal");
                const modal_content = modal.querySelector("#main-modal-content");

                modal_content.innerHTML = "<div class=\"alert alert-danger\">There was an error loading \"" + url + "\"</div>";
            }
        }
    }

    const params = new URLSearchParams({
        update:   1,
        uid:      uid,
        username: username,
        pw:       pw,
        enabled:  enabled,
        admin:    admin,
    });

    http_request.open("POST", "user.php");
    http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http_request.send(params.toString());
}
