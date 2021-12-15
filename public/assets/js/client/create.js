document.addEventListener('DOMContentLoaded', function() {
    $('#CNPJ').mask('00.000.000/0000-00', { reverse: true });
    $('#CEP').mask('00000-000');
    $('#phone').mask('00000-0000');
});

const cep = document.querySelector('#CEP');

const showData = (result) => {
    for (const campo in result) {
        if (document.querySelector("#" + campo)) {
            document.querySelector("#" + campo).value = result[campo];
        }
    }
}
cep.addEventListener("blur", (e) => {
    let search = cep.value.replace("-", "");
    const options = { method: 'GET', mode: 'cors', cache: 'default' };
    fetch(`https://viacep.com.br/ws/${search}/json/`, options).then(response => {
        response.json().then(data => showData(data));
    }).catch(e => console.log('Deu Erro: ' + e, message))
})