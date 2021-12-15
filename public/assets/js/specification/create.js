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
    selectProdEl.disabled = true;

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


function emptyTable() {
    var table = document.querySelector('tbody#tableExperiments');
    var rows = table.rows.length;
    for (i = rows; i >= 0; i--) {
        var row = table.insertRow(i);
        table.deleteRow(row.parentNode.parentNode.rowIndex);
    }

}

function loadExperiments() {
    var table = document.querySelector('tbody#tableExperiments');
    var rows = table.rows.length;
    var selectProdEl = document.querySelector('select#id_product');

    selectProdEl.addEventListener('change', (e) => {
        var aj = new XMLHttpRequest();
        aj.open('GET', 'http://www.qualityct.space/load/experiments/' + selectProdEl.options[selectProdEl.selectedIndex].value);
        aj.onload = event => {

            var arrayJson = JSON.parse(aj.responseText);

            if (table.rows.length > 0)
                emptyTable();

            loadMeasures((uni) => {

                arrayJson.forEach((experiment) => {
                    var row = table.insertRow(rows);
                    var cel0 = row.insertCell(0);
                    var cel1 = row.insertCell(1);
                    var cel2 = row.insertCell(2);
                    var cel3 = row.insertCell(3);
                    cel0.innerHTML = experiment.id;
                    cel1.innerHTML = experiment.name;
                    cel2.innerHTML = `<input type="text" placeholder="Ex: >125" class="form-control" name="min_value[]">`;
                    cel3.innerHTML = uni;

                });
            });
        }
        aj.send();

    });


}

function loadMeasures(callback) {
    var selUni = ``;
    var aj = new XMLHttpRequest();
    aj.open('GET', 'http://www.qualityct.space/loadMeasures');

    aj.onload = event => {
        arrayJson = JSON.parse(aj.responseText)

        selUni += `<select name="uni[]" id="uni[]" class="form-control">`;

        selUni += ` <option value="">--- Selecione ---</option>`;

        arrayJson.forEach((measure) => {
            selUni += ` <option value="${measure.id}">${measure.uni}</option>`;
        })

        selUni += ` </select>`;
        return callback(selUni);
    }

    aj.send();



}

loadProducts();
loadExperiments();