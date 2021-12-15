// // document.addEventListener('DOMContentLoaded', function () {
// //     $('#spinner').hide();
// // }, false);

// function loadValues() {

//     var selectSpecEl = document.querySelector('select#specif');
//     if (selectSpecEl != null || selectSpecEl != "") {
//         selectSpecEl.addEventListener('change', (e) => {
//             var norms_name = document.querySelectorAll('td#norm');
//             var min_value = document.querySelectorAll('td#min_value');
//             var uni = document.querySelectorAll('td#uni');
//             var op_number = document.querySelector('td#op').textContent;

//             // norms_name.forEach((norms)=>{
//             //     alert(norms.textContent);
//             //     norms.innerHTML = "Esp. cliente";
//             // })

//             var op = selectSpecEl.options[selectSpecEl.selectedIndex].value;


//             var url_send;
//             //     var aj = new XMLHttpRequest();
//             switch (op) {
//                 // 0 é norma
//                 case '0':

//                     // aj.open('GET','http://localhost:8000/search/norm/'+ op_number);
//                     url_send = 'http://www.qualityct.space/search/norm/' + op_number;
//                     break;

//                     // 1 esp. cliente
//                 case '1':

//                     //  aj.open('GET','http://localhost:8000/search/specifications/'+ op_number);
//                     url_send = 'http://www.qualityct.space/search/specifications/' + op_number;
//                     break;
//             }

//             //Primeiro criaremos a função que exibe a imagem em gif do loading
//             function loading_show() {
//                 $('#table').fadeOut('slow', function() {
//                     $('#spinner').fadeIn('slow');
//                 });
//             }

//             //Agora é a vez de criar a função que esconde a imagem da gif de loading
//             function loading_hide() {
//                 $('#spinner').fadeOut('slow', function() {
//                     $('#table').fadeIn('slow');
//                 });
//             }

//             $.ajax({
//                 type: 'GET',
//                 dataType: 'json',
//                 url: url_send,
//                 beforeSend: function() {
//                     loading_show();

//                 },
//                 success: function(arrayJson) {
//                     //  var arrayJson = JSON.parse(retorno);
//                     loading_hide();
//                     for (var i = 0; i < arrayJson.length; i++) {
//                         norms_name[i].innerHTML = (op == '0' ? arrayJson[i].name : 'Esp. Cliente');
//                         min_value[i].innerHTML = arrayJson[i].min_value;
//                         uni[i].innerHTML = arrayJson[i].uni;
//                     }
//                 }
//             });

//             // aj.onload = event =>{
//             //     var arrayJson = JSON.parse(aj.responseText);

//             //     for(var i = 0 ; i < arrayJson.length; i++){
//             //         norms_name[i].innerHTML = (op == '0' ? arrayJson[i].name : 'Esp. Cliente');
//             //         min_value[i].innerHTML =   arrayJson[i].min_value;
//             //         uni[i].innerHTML =  arrayJson[i].uni;
//             //     }
//             // }

//             // aj.send();
//         });
//     }

// }

// loadValues();