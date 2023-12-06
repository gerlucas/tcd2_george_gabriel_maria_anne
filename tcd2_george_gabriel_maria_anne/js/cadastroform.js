function mostrarInput() {
    var select = document.getElementById("tipo_venda");
    var checkboxDiv = document.getElementById("checkboxDiv");

    if (select.value === "carteira") {
        esconderCheckboxCliente(); 
        checkboxDiv.style.display = "block";
    } else {
        exibirCheckboxCliente();  
        checkboxDiv.style.display = "none";
    }
}

function mostrarInputDebito() {
    var select = document.getElementById("tipo_pagamento");
    var checkboxDiv = document.getElementById("checkboxDiv");

    if (select.value === "parcial") {
        checkboxDiv.style.display = "block";
    } else {
        checkboxDiv.style.display = "none";
    }
}

function mostrarCheckbox() {
    var select = document.getElementById("perfil");
    var checkboxDiv = document.getElementById("checkboxDiv");

    if (select.value === "Cliente") {
        checkboxDiv.style.display = "block";
    } else {
        checkboxDiv.style.display = "none";
    }
}

function mostrarCheckboxCliente() {
    var checkbox = document.getElementById("com_cliente");
    var checkboxDiv = document.getElementById("checkboxDiv");

    if (checkbox.checked) {
        checkboxDiv.style.display = "block";
    } else {
        checkboxDiv.style.display = "none";
    }
}

function esconderCheckboxCliente() {
    var checkboxLabel = document.querySelector("label[for='com_cliente']");
    var checkbox = document.getElementById("com_cliente");

    checkbox.style.display = "none";
    checkboxLabel.style.display = "none";
}

function exibirCheckboxCliente() {
    var checkboxLabel = document.querySelector("label[for='com_cliente']");
    var checkbox = document.getElementById("com_cliente");

    checkbox.style.display = "inline-block";  
    checkboxLabel.style.display = "inline-block"; 
}
