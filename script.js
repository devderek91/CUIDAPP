console.log("Hola desde JavaScript");
let nombre = "María";
let edad = 28;
let disponible = true;
let precio = 10;

console.log(nombre);
console.log(edad);
console.log(disponible);
console.log(precio);
let precioHora = 10;
let horas = 4;
let total = precioHora * horas;
console.log("El total es: " + total + "€");
function calcularPrecio(horas, suplemento) {
    let precioHora = 10;
    let subtotal = precioHora * horas;
    let total = subtotal + suplemento;
    return total;
}

console.log(calcularPrecio(2, 0));   // 20€ — 2 horas sin suplemento
console.log(calcularPrecio(4, 5));   // 45€ — 4 horas con suplemento 5€
console.log(calcularPrecio(3, 10));  // 40€ — 3 horas con suplemento 10€
let canguros = ["María", "Laura", "Ana", "Carmen"];

console.log(canguros[0]); // María — el primero siempre es 0
console.log(canguros[1]); // Laura
console.log(canguros.length); // 4 — cuántos hay en total
let listaCanguros = ["María", "Laura", "Ana", "Carmen"];

for (let i = 0; i < listaCanguros.length; i++) {
    console.log("Canguro disponible: " + listaCanguros[i]);
}
function actualizarPrecio() {
    let horas = document.getElementById("horas").value;
    let total = horas * 10;
    document.getElementById("precioTotal").innerHTML = total + "€";
}
function actualizarSuplemento() {
    let suplemento = document.getElementById("radio").value;
    document.getElementById("suplemento").innerHTML = suplemento + "€";
}
function actualizarTotal() {
    let horas = document.getElementById("horas").value;
    let suplemento = parseInt(document.getElementById("radioReserva").value);
    let total = (horas * 10) + suplemento;
    document.getElementById("precioTotal").innerHTML = total + "€";
}
function cambiarEstado() {
    let estado = document.getElementById("estadoTexto");
    if (estado.innerHTML.includes("Disponible")) {
        estado.innerHTML = "🔴 No disponible";
        estado.style.color = "red";
    } else {
        estado.innerHTML = "🟢 Disponible ahora";
        estado.style.color = "var(--color-principal)";
    }
}
function validarRegistro() {
    let nombre = document.getElementById("nombre").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    if (nombre === "") {
        alert("Por favor introduce tu nombre");
    } else if (email === "") {
        alert("Por favor introduce tu email");
    } else if (password.length < 8) {
        alert("La contraseña debe tener mínimo 8 caracteres");
    } else {
        alert("¡Registro completado! Bienvenido/a a CUIDAPP");
    }
}let segundosRestantes = 900; // 15 minutos = 900 segundos

function iniciarTimer() {
    let intervalo = setInterval(function() {
        segundosRestantes--;
        
        let minutos = Math.floor(segundosRestantes / 60);
        let segundos = segundosRestantes % 60;
        
        if (segundos < 10) {
            segundos = "0" + segundos;
        }
        
        document.getElementById("timer").innerHTML = minutos + ":" + segundos;
        
        if (segundosRestantes <= 0) {
            clearInterval(intervalo);
            document.getElementById("timer").innerHTML = "00:00";
            alert("Tiempo agotado — la reserva ha sido cancelada automáticamente");
        }
    }, 1000);
}

if (document.getElementById("timer")) {
    iniciarTimer();
}

function enviarMensaje() {
    let mensaje = document.getElementById("inputMensaje").value;
    
    if (mensaje === "") {
        return;
    }
    
    let div = document.createElement("div");
    div.className = "chat-mensaje chat-padre";
    div.innerHTML = "<p><strong>Tú</strong> — ahora</p><p>" + mensaje + "</p>";
    
    document.getElementById("mensajes").appendChild(div);
    document.getElementById("inputMensaje").value = "";
}

if (document.getElementById("inputMensaje")) {
    document.getElementById("inputMensaje").addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            enviarMensaje();
        }
    });
}