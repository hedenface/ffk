
document.addEventListener("DOMContentLoaded", function(e) {
    const cols = document.querySelectorAll(".col");
    const cards = document.querySelectorAll(".card");

    cols.forEach(col => {
        col.addEventListener("dragenter", drag_enter);
        col.addEventListener("dragover", drag_over);
        col.addEventListener("dragleave", drag_leave);
        col.addEventListener("drop", drop);
    });

    cards.forEach(card => {
        card.addEventListener("dragstart", drag_start);
    });
});


function get_parent_col(target)
{
    classes = Array.from(target.classList);

    while (classes.indexOf("col") == -1) {
        target = target.parentNode;
        classes = Array.from(target.classList)
    }

    return target;
}


function drag_start(e)
{
    e.dataTransfer.setData("text/plain", e.target.id);
}


function drag_enter(e)
{
    e.preventDefault();
    const target = get_parent_col(e.target);
    target.classList.add("drag-over");
}


function drag_over(e)
{
    e.preventDefault();
    const target = get_parent_col(e.target);
    target.classList.add("drag-over");
}


function drag_leave(e)
{
    const target = get_parent_col(e.target);
    target.classList.remove("drag-over");
}


function drop(e)
{
    const id = e.dataTransfer.getData("text/plain");
    const card = document.getElementById(id);
    const target = get_parent_col(e.target);

    target.classList.remove("drag-over");
    target.appendChild(card);
}
