const inputCPF = document.querySelector(".cpf")
const inputTelefone = document.querySelector(".telefone")
const inputNome = document.querySelector(".nome")
const inputEmail = document.querySelector(".email")

inputCPF.addEventListener("input", (e) => {

    let valor = e.target.value 
    valor = valor.replace(/\D/g, "")

    valor = valor.substring(0,11)
    valor = valor.replace(/(\d{3})(\d)/, "$1.$2")
    valor = valor.replace(/(\d{3})(\d)/, "$1.$2")
    valor = valor.replace(/(\d{3})(\d{2})/, "$1-$2")
    e.target.value = valor

});

inputTelefone.addEventListener("input", (e) => {
    let valor = e.target.value
    valor = valor.replace(/\D/g, "") 
    valor.substring(0,11)
    valor = valor.replace(/^(\d{2})(\d{5})/, "($1) $2")
    valor = valor.replace(/(\d)(\d{4})$/, "$1-$2")
    e.target.value = valor


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

