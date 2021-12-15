document.addEventListener('DOMContentLoaded', function() {
    $('#spinner').hide();
}, false);

const url = 'http://www.qualityct.space/';
var selectCliEL = document.querySelector("#id_client");
var tableEL = document.querySelector('#table_prod tbody');
var msg_erro = document.querySelector('#error');
selectCliEL.addEventListener('change', e => {



    //Primeiro criaremos a função que exibe a imagem em gif do loading
    function loading_show() {

        $('#row_table').fadeOut('fast', function() {
            $('#spinner').fadeIn('slow');
        });
    }

    //Agora é a vez de criar a função que esconde a imagem da gif de loading
    function loading_hide() {
        $('#spinner').fadeOut('fast', function() {
            $('#row_table').fadeIn('slow');
        });
    }

    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: url + 'listProducts/' +
            selectCliEL.options[selectCliEL.selectedIndex].value,
        beforeSend: function() {
            loading_show();
        },
        success: function(arrayJson) {
            emptyTable();
            loading_hide();
            if (arrayJson.id == 0)
                alert(arrayJson.msg);
            else {

                arrayJson.forEach((products) => {
                    let newRow = tableEL.insertRow(-1);
                    newRow.id = 'row' + products.product_id;
                    let newCell1 = newRow.insertCell(0);
                    let id = document.createTextNode(products.product_id);
                    let newCell2 = newRow.insertCell(1);
                    let descrip = document.createTextNode(products.product_desc);
                    let newCell3 = newRow.insertCell(2);
                    let leather = document.createTextNode(products.leather);
                    let newCell4 = newRow.insertCell(3);
                    let segment = document.createTextNode(products.segment);
                    let newCell5 = newRow.insertCell(4);
                    let actions = `<a href="${url}client/${products.client_id}/products/${products.product_id}/edit")"><i class="fas fa-pen"></i></a>
     
                    <button class="button-none" onclick="deleteProd(${products.product_id})"> <i class="fas fa-trash-alt"
                            style="color: red"></i></button>
                </form>`
                    newCell1.appendChild(id);
                    newCell2.appendChild(descrip);
                    newCell3.appendChild(leather);
                    newCell4.appendChild(segment);
                    newCell5.insertAdjacentHTML('afterbegin', actions);
                })
            }

        }
    });



    // var aj = new XMLHttpRequest();
    // aj.open('GET', url + 'listProducts/' +
    //     selectCliEL.options[selectCliEL.selectedIndex].value);


    // aj.onload = event => {
    //     arrayJson = JSON.parse(aj.responseText);
    //     arrayJson.forEach((products) => {
    //         let newRow = tableEL.insertRow(-1);
    //         let newCell1 = newRow.insertCell(0);
    //         let id = document.createTextNode(products.id);
    //         let newCell2 = newRow.insertCell(1);
    //         let descrip = document.createTextNode(products.description);
    //         let newCell3 = newRow.insertCell(2);
    //         let leather = document.createTextNode(products.id_leather_type);
    //         let newCell4 = newRow.insertCell(3);
    //         let segment = document.createTextNode(products.id_segment);
    //         newCell1.appendChild(id);
    //         newCell2.appendChild(descrip);
    //         newCell3.appendChild(leather);
    //         newCell4.appendChild(segment);
    //     });
    // }

    // aj.send();
})

function deleteProd(id) {
    if (confirm('Deseja realmente excluir?')) {
        $.ajax({
            url: '/productDel/' + id,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#row' + id).remove();
            }
        });
    }
}

function emptyTable() {
    $('#table_prod tbody tr').remove();
}