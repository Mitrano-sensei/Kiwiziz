
//dom ready
document.addEventListener('DOMContentLoaded', function () {

    var save_button = document.getElementsByClassName('button')[0];

    console.log('save button');

    save_button.addEventListener('click', function () {
        // get all inputs of the page
        var inputs = document.getElementsByTagName('input');

        // Construct a json object with all the inputs values
        var json = {};

        for (let i = 0; i < inputs.length; i++) {
            if(inputs[i] === undefined) continue;

            if (inputs[i].type === 'checkbox') {
                json[inputs[i].name] = inputs[i].checked;
                continue;
            }

            if (inputs[i].type === 'radio') {
                json[inputs[i].name] = inputs[i].checked;
                continue;
            }

            if (inputs[i].type === 'text') {
                json[inputs[i].name] = inputs[i].value;
                continue;
            }

            if (inputs[i].type === 'file') {
                // get the file name and store it in the json object
                var file = inputs[i].files[0];
                if (file === undefined) continue;
                json[inputs[i].name] = file.name;

                // send the file to the server
                var formData = new FormData();
                formData.append('file', file);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/upload', true);
                xhr.send(formData);

                continue;
            }
        }

        // Send the json object to the server
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/save/quiz', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        console.log(JSON.stringify(json));
        xhr.send(JSON.stringify(json));

        // Get the response from the server
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        }

    });


});