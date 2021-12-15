var selectTypeEL = document.querySelector('#id_leather_type');
var inputNormEl = document.querySelector('#name');
var selectExpEL = document.querySelector('#id_experiment');

if (inputNormEl.value === null || inputNormEl.value === "")
    selectExpEL.disabled = true;
else
    selectExpEL.disabled = false;

selectTypeEL.addEventListener('change', e => {

    var aj = new XMLHttpRequest();
    aj.open('GET', 'http://www.qualityct.space/norm/load/experiments/' + selectTypeEL.options[selectTypeEL.selectedIndex].value);
    aj.onload = event => {

        if (selectExpEL.length > 1)
            emptySelect();

        option = new Option('--- Selecione ---', '');
        selectExpEL.options[0] = option;
        var arrayJson = JSON.parse(aj.responseText);
        arrayJson.forEach((experiments) => {
            option = new Option(experiments.name, experiments.id);
            selectExpEL.options[selectExpEL.options.length] = option;

        })


        selectExpEL.disabled = false;
    }
    aj.send();
})


function emptySelect() {
    var selectExpEL = document.querySelector('#id_experiment');
    var length = selectExpEL.options.length;
    for (i = length - 1; i >= 0; i--) {
        selectExpEL.options[i] = null;
    }
}