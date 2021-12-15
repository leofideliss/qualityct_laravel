const url = 'http://www.qualityct.space/';

var op_number = document.querySelector('#op_number').textContent;
var ckExpEl = document.querySelectorAll('#experiments');
var aj = new XMLHttpRequest();

aj.open('GET', url + 'experiments/expSelected/' + op_number);
aj.onload = event => {
    var arrayJson = JSON.parse(aj.responseText);
    // arrayJson.experiments.forEach((experiments) => {
    //     console.log(experiments.name);
    // })
    for (const [key_selected, value_selected] of Object.entries(arrayJson.exp_selected)) {

        for (const [key, value] of Object.entries(arrayJson.experiments)) {
            if (arrayJson.exp_selected[key_selected] != null) {
                if (value_selected.id == value.id)
                    ckExpEl[key].checked = true;
            }
        }
    };

}
aj.send();