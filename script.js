const inputCPF = document.querySelector(".cpf")
const inputTelefone = document.querySelector(".telefone")
const inputNome = document.querySelector(".nome")
const inputEmail = document.querySelector(".email")

inputCPF.addEventListener("input", (e) => {

    e.target.value = e.target.value.replace(/[^0-9\.-]/g, "")

    const apagando = ((e.inputType == "deleteContentBackward") || (e.inputType == "deleteContentForward"))
    if (!apagando) {
        if (e.target.value.length == 3 || e.target.value.length == 7) {
            e.target.value = e.target.value + '.'
        }
        if (e.target.value.length == 11) {

            e.target.value = e.target.value + '-'
        }


    }

});

inputTelefone.addEventListener("input", (e) => {
    e.target.value = e.target.value.replace(/[^0-9\(\)\- ]/g, "")

    const apagando = ((e.inputType == "deleteContentBackward") || (e.inputType == "deleteContentForward"))
    if (!apagando) {

        if (e.target.value.length == 1) {
            e.target.value = `(${e.target.value}`
        }
        if (e.target.value.length == 3) {
            e.target.value = e.target.value + ')'
        }
        if (e.target.value.length == 4) {
            e.target.value = e.target.value + ' '
        }
        if (e.target.value.length == 5) {
            e.target.value = e.target.value + '9'
        }
        if (e.target.value.length == 10) {

            e.target.value = e.target.value + '-'
        } if (e.target.value > 10) { e.target.value = e.target.value }
    }


})

inputNome.addEventListener("input", (e) => {

    if (e.target.value.length == 1) {

        if (e.target.value == (" ")) {
            console.log("oi");

            e.target.value = ""
        }
    }
    if (e.target.value.length != 1) {

        if (e.target.value.includes("  ")) {
            console.log("é");

            e.target.value = e.target.value.slice(0, -1)
        }
    }
})

inputEmail.addEventListener("input", (e) => {


    if (e.target.value.includes(" ")) {
        console.log("é");

        e.target.value = e.target.value.slice(0, -1)
    }

})
inputTelefone.addEventListener("keydown", (e) => {
    if (e.code == "Space" || e.code == "Minus" || e.key == "(" || e.key == ")") {
        e.preventDefault()
    }
})




inputCPF.addEventListener("keydown", (e) => {
    if (e.key == "-" || e.key == ".") {
        e.preventDefault()
    }
})