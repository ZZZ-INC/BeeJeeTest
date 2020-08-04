 function isDefined(v) {
    return typeof v !== "undefined" && v !== null;
}
function strip_tags(s) {
    return s.replace(/(<([^>]+)>)/ig,"");
}
function ajax(url, queryString, onOK, onError) {
    let xhr = new XMLHttpRequest();
    queryString = 'ajax=1&' + queryString;
    xhr.open('POST', url + '?' + queryString);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            if (onOK) {
                onOK(xhr.response);
            }
        } else {
            if (onError) {
                onError(xhr)
            }
        }
    };
    xhr.send(encodeURI(queryString));
}
    taskTable = (new function() {
        let self = this;
        this.valueBeforeEdit = {};
        this.displayTaskTableAjax = function(page, sort, direction) {
            let tableContainer = document.querySelector('.task-table-container'),
                tableArea = tableContainer.querySelector('.table');
            page = isDefined(page) ? page : tableArea.getAttribute('data-page');
            sort = isDefined(sort) ? sort : tableArea.getAttribute('data-sort');
            direction = isDefined(direction) ? direction : tableArea.getAttribute('data-direction');
            ajax('/displayTaskTableAjax', `page=${page}&sort=${sort}&direction=${direction}`, function(response) {
                tableContainer.parentElement.innerHTML = response;
            }, function(response) {
                document.querySelector('.login-form__error').innerHTML = JSON.parse(response.responseText).join('<BR>')
            });
            event.preventDefault()
        };
        this.cellLeaveEdit = function(el) {
            let attrName = el.getAttribute('data-attr'),
                rowId = el.getAttribute('data-id'),
                value = (attrName !== 'status' ? el.innerHTML : el.value).trim();
            self.activeEdit = el;
            updateTaskField(rowId, attrName, value);
            event.preventDefault();
        }
        let updateTaskField = function(id, name, value) {
            if (value == self.valueBeforeEdit[id][name]) {
                return;
            }
            ajax('/updateTaskField', `id=${id}&name=${name}&value=${value}`, function(response) {
                setInfo(`Редактирование прошло успешно!`);
                setError(null)
                document.querySelector(`.table [data-attr="admin_edited"][data-id="${id}"]`).innerHTML = JSON.parse(response)['rowData']['admin_edited'] > 0 ? 'Да' : 'Нет';
            }, function(response) {
                if (name !== 'status') {
                    self.activeEdit.innerHTML = strip_tags(self.valueBeforeEdit[id][name]);
                }
                setError('<b>' + JSON.parse(response.responseText).join('<BR>'));
                setInfo(null)
            });
        }
        this.startEdit = function(el) {
            let id = el.getAttribute('data-id'),
                attr = el.getAttribute('data-attr');
            if (!isDefined(this.valueBeforeEdit[id])) {
                this.valueBeforeEdit[id] = {}
            }
            this.valueBeforeEdit[id][attr] = (attr !== 'status' ? el.innerHTML : el.value);
        }
        let setInfo = function(value) {
            document.querySelector('.task-table__info').innerHTML = value
        }
        let setError = function(value) {
            document.querySelector('.task-table__error').innerHTML = value
        }
    });
	 taskActions = (new function() {
        this.createTask = function() {
            let form = document.querySelector('.create-task-form')
            event.preventDefault()
            ajax('/createTask', 'name=' + form['name'].value + '&email=' + form['email'].value + '&text=' + form['text'].value, function(response) {
                setInfo('Задача успешно создана!');
                setError(null);
                for (let input of form.querySelectorAll('input,textarea')) {
                    input.value = null;
                }
                taskTable.displayTaskTableAjax();
            }, function(response) {
                setError(JSON.parse(response.responseText).join('<BR>'));
                setInfo(null);
            });
            let setInfo = function(value) {
                document.querySelector('.create-task-form__info').innerHTML = value
            }
            let setError = function(value) {
                document.querySelector('.create-task-form__error').innerHTML = value;
                setTimeout(function() {
                    document.querySelector('.create-task-form__error').innerHTML = ''
                }, 5000)
            }
        }
    });
	 function doLogin() {
        let setInfo = function(value) {
            document.querySelector('.login-form__info').innerHTML = value
        };
        let setError = function(value) {
            document.querySelector('.login-form__error').innerHTML = value
        };
        let form = document.querySelector('.login-form');
        ajax('/admin/login', 'name=' + form['name'].value + '&password=' + form['password'].value, function(response) {
            setInfo('Успешная авторизация! Сейчас вы перенаправитесь на необходимую страницу...');
            setError(null);
            setTimeout(function() {
                window.location.href = '/'
            }, 3000);
        }, function(response) {
            setError(JSON.parse(response.responseText).join('<BR>'));
            setInfo(null)
        });
        event.preventDefault()
    }
	