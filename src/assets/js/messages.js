
// todo: an error occurs if more than 1 of these is active at any time - fix that
function message(msg, bootstrap_class)
{
    messages = document.querySelector(".messages");
    messages.innerHTML = "<div id=\"message-alert\" class=\"" + bootstrap_class + " py-0 mb-0\" style=\"opacity: 1\">" + msg + "</div>";

    fade_effect = setInterval(function() {
        el = document.getElementById("message-alert");
        if (!el.style.opacity) {
            el.style.opacity = 1;
        }
        if (el.style.opacity > 0) {
            el.style.opacity -= 0.05;
        } else {
            clearInterval(fade_effect);
            el.remove();
        }
    }, 200);
}
