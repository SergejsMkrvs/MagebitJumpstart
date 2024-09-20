/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit
 * @license   MIT
 */
function subtract() {
    document.getElementById("qty").value = Math.max(1, +document.getElementById("qty").value - 1);
}

function add() {
    document.getElementById("qty").value = Math.min(+document.getElementById("qty").max, +document.getElementById("qty").value + 1);
}

