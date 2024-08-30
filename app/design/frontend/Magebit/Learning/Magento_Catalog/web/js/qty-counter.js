
function subtract() {
    document.getElementById("qty").value = Math.max(1, +document.getElementById("qty").value - 1);
}

function add() {
    document.getElementById("qty").value = Math.min(+document.getElementById("qty").max, +document.getElementById("qty").value + 1);
}

