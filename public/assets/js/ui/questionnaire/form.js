(function (w, d) {
    var form = d.querySelector('.questionnaire-form'),
        formInfoBlock = d.querySelector('.questionnaire-form-info'),
        fieldsList = form.querySelector('.questionnaire-form-fields'),
        addFieldButton = form.querySelector('#questionnaire-form-add-field-button');

    console.log(form);

    form.addEventListener('submit', function (e) {
        var postData = {fields: {}},
            formFields = fieldsList.querySelectorAll('.questionnaire-form-field');

        e.preventDefault(e);

        formFields.forEach(function (field) {
            var field_id = field.getAttribute('data-id'),
                input = field.querySelector('#field-' + field_id);

            postData.fields[field_id] = input.value;
        });

        fetch('/api/v1/questionnaires', {
            headers: { "Content-Type": "application/json; charset=utf-8" },
            method: 'POST',
            body: JSON.stringify(postData)
        }).then(function (response) {
            response.json().then(function (data) {
                if(data.hasOwnProperty('id')) {
                    formInfoBlock.innerHTML = '<a href="/questionnaire?id=' + data.id + '">Анкета</a> успешно отправлена.'
                    // form.reset();
                } else {
                    alert('Что-то пошло не так, попробуйте еще раз.')
                }
            })
        })
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
                field.setAttribute('data-id', id);
                field.innerHTML =
                    '<td><label for="field-'+ id +'">' + name + ':</label></td>' +
                    '<td><input id="field-'+ id +'" name="fields[' + id + ']" type="'+ type +'" ></td>';

               return field;
            };

        if(!fieldName || fieldName.length <= 0) {
            alert('Вы не указали название поля');
            return;
        }

        var fieldTypeMessage = 'Выберите тип поля (1-'+ Object.keys(fieldTypes).length +'):\n';
        for(var fieldTypeNamesKey in fieldTypeNames) {
            if(fieldTypeNames.hasOwnProperty(fieldTypeNamesKey)) {
                fieldTypeMessage += fieldTypeNamesKey + ') ' + fieldTypeNames[fieldTypeNamesKey] + '\n';
            }
        }

        var fieldType = parseInt(prompt(fieldTypeMessage));

        if(!fieldType || !fieldTypes.hasOwnProperty(fieldType)) {
            alert('Вы указали не существующий тип поля');
            return;
        }

        fetch('/api/v1/fields', {
            headers: { "Content-Type": "application/json; charset=utf-8" },
            method: 'POST',
            body: JSON.stringify({
                name: fieldName,
                type: fieldTypes[fieldType]
            })
        }).then(function (response) {
            response.json().then(function (data) {
                if(data.hasOwnProperty('id')) {
                    fieldsList.appendChild(fieldTemplate(data.id, fieldName, fieldType));
                } else {
                    alert('Что-то пошло не так, попробуйте добавить поле еще раз.')
                }
            })
        })
    })
})(window, document);