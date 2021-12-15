function emptySelect() {
    var selectProdEl = document.querySelector('select#id_product');
    var length = selectProdEl.options.length;
    for (i = length - 1; i >= 0; i--) {
        selectProdEl.options[i] = null;
    }
}

function loadProducts() {

    var selectCliEl = document.querySelector('select#id_client');
    var selectProdEl = document.querySelector('select#id_product');
    const op_number = document.querySelector('#op_number');
    if (op_number.value === "" || op_number.value === null)
        selectProdEl.disabled = true;
    else
        selectProdEl.disabled = false;
    selectCliEl.addEventListener('change', (e) => {

        var aj = new XMLHttpRequest();
        aj.open('GET', 'http://www.qualityct.space/products/' + selectCliEl.options[selectCliEl.selectedIndex].value);
        aj.onload = event => {

            if (selectProdEl.options.length > 1)
                emptySelect();


            option = new Option('--- Selecione ---', '');
            selectProdEl.options[0] = option;
            var arrayJson = JSON.parse(aj.responseText);
            arrayJson.forEach((products) => {
                option = new Option(products.description, products.id);
                selectProdEl.options[selectProdEl.options.length] = option;
            });

            selectProdEl.disabled = false;



        }
        aj.send();
    });
}


    
    
    function sampleExist() {
    
    var op_number = document.querySelector('#op_number');
    op_number.addEventListener("blur", (e) => {
        var aj = new XMLHttpRequest();
   aj.open('GET', 'http://www.qualityct.space/exists/sample/'  + op_number.value);

        aj.onload = event => {
            if (aj.responseText == 'true') {
                alert('Amostra já cadastrada');
                document.location.reload();
            }
        }
        aj.send();
    });
}




loadProducts();
sampleExist();