(function (w, d) {
    var form = d.querySelector('.questionnaire-form'),
        fieldsList = form.querySelector('.questionnaire-form-fields'),
        addFieldButton = form.querySelector('#questionnaire-form-add-field-button');

    form.addEventListener('submit', function (e) {
        e.preventDefault(e);


    });

    addFieldButton.addEventListener('click', function () {
        var fieldName = prompt('Введите название поля'),
            fieldTypes = {
                1: 'text',
                2: 'date'
            },
            fieldTypeNames = {
                1: 'Текстовое поле',
                2: 'Дата'
            },
            fieldTemplate = function (id, name, type) {
                var field = document.createElement('tr');

                field.classList.add('questionnaire-form-field');
                field.innerHTML =
                    '<td><label for="field-'+ id +'">' + name + ':</label></td>' +
                    '<td><input id="field-'+ id +'" type="'+ type +'" ></td>';

               return field;
            };

        var fieldTypeMessage = 'Выберите тип поля (1-'+ Object.keys(fieldTypes).length +'):\n';
        for(var fieldTypeNamesKey in fieldTypeNames) {
            if(fieldTypeNames.hasOwnProperty(fieldTypeNamesKey)) {
                fieldTypeMessage += fieldTypeNamesKey + ') ' + fieldTypeNames[fieldTypeNamesKey] + '\n';
            }
        }

        var fieldType = parseInt(prompt(fieldTypeMessage));

        if(fieldName.length <= 0) {
            alert('Вы не указали название поля');
            return;
        }

        if(!fieldTypes.hasOwnProperty(fieldType)) {
            alert('Вы указали не существующий тип поля');
            return;
        }

        fetch('/api/v1/fields', {
            headers: { "Content-Type": "application/json; charset=utf-8" },
            method: 'POST',
            body: JSON.stringify({
                name: fieldName,
                type: fieldType
            })
        }).then(function (response) {
            response.json().then(function (data) {

            })
        })

        // TODO save and render new field


        // fieldsList.appendChild(fieldTemplate(field.id, field.name, field.type));
    })
})(window, document);