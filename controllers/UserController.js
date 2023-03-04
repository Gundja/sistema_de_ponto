class UserController {
    constructor(formIdCreate, formIdUpdate, tableId) {
        this.formEl = document.getElementById(formIdCreate); // element form
        this.formUpdateEl = document.getElementById(formIdUpdate); // element form Update
        this.tableEl = document.getElementById(tableId); // element table 

        this.onSubmit();
        this.onEdit();
        this.selectAll();
    } // constructor

    onEdit() {
        document.querySelector('#box-user-update .btn-cancel').addEventListener('click', e => {
            this.showPanelCreate();
        });

        this.formUpdateEl.addEventListener('submit', event => {

            event.preventDefault();

            let btn = this.formUpdateEl.querySelector('[type=submit]');

            btn.disabled = true;

            let values = this.getValues(this.formUpdateEl);

            let index = this.formUpdateEl.dataset.trIndex;

            let tr = this.tableEl.rows[index];

            let userOld = JSON.parse(tr.dataset.user);

            let result = Object.assign({}, userOld, values);

            this.getPhoto(this.formUpdateEl).then(
                (content) => {
                    if (!values.photo) {
                        result._photo = userOld._photo;
                    } else {
                        result._photo = content;
                    }

                    let user = new User();

                    user.loadFromJSON(result);

                    user.save();

                    this.getTr(user, tr);

                    this.updateCount();

                    this.formUpdateEl.reset(); // resetar o formulário 

                    btn.disabled = false;

                    this.showPanelCreate();
                },
                (e) => {
                    console.error(e);
                });
        });
    } // onEdit

    onSubmit() {
        // metod p/ enviar formulario

        this.formEl.addEventListener('submit', event => {

            event.preventDefault();

            let btn = this.formEl.querySelector('[type=submit]');

            btn.disabled = true; // desabilitar o botão

            let values = this.getValues(this.formEl);

            if (!values) return false;

            this.getPhoto(this.formEl).then(
                (content) => {
                    values.photo = content; // conteudo do arquivo photo
                    values.save();
                    this.addLine(values);
                    this.formEl.reset(); // resetar o formulário 
                    btn.disabled = false;
                },
                (e) => {
                    console.error(e); // 
                });
        });
    } // onSubmit

    getPhoto(formEl) {

        return new Promise((resolve, reject) => {
            let fileReader = new FileReader();

            let elements = [...formEl.elements].filter(item => {
                if (item.name === 'photo') {
                    return item;
                }
            });

            let file = elements[0].files[0];

            fileReader.onload = () => {
                resolve(fileReader.result);
            };

            fileReader.onerror = (e) => {
                reject(e);
            };

            if (file) {
                fileReader.readAsDataURL(file);
            } else {
                resolve('dist/img/padrao-avatar.png');
            }
        });


    } // getPhoto

    getValues(formEl) {
        let user = {};
        let isValid = true;

        [...formEl.elements].forEach(function (field) {

            if (['name', 'email', 'password'].indexOf(field.name) > -1 && !field.name) {
                field.parentElement.classList.add('has-error');
                isValid = false;
            }

            if (field.name == 'gender') {

                if (field.checked) {
                    user[field.name] = field.value;
                }

            } else if (field.name == 'admin') {
                user[field.name] = field.checked;

            } else {
                user[field.name] = field.value;
            }

        });

        if (!isValid) {
            return false;
        }

        return new User(user.name, user.gender, user.birth, user.country, user.email, user.password, user.photo, user.admin);

    } // getValues

    selectAll() {
        let users = User.getUsersStorage();

        users.forEach(dataUser => {
            let user = new User();
            user.loadFromJSON(dataUser);
            this.addLine(user);
        });

    } // selectAll

    addLine(dataUser) {

        let tr = this.getTr(dataUser);

        this.tableEl.appendChild(tr);

        this.updateCount();
    } // addLine (add um nova linha tr na tabela)

    getTr(dataUser, tr = null) {

        if (tr === null) tr = document.createElement('tr');

        tr.dataset.user = JSON.stringify(dataUser);

        tr.innerHTML = `
              <td>
              <img src="${dataUser.photo}" alt="User Image" class="img-circle img-sm"></td>
              <td>${dataUser.name}</td>
              <td>${dataUser.email}</td>
              <td>${(dataUser.admin) ? 'Sim' : 'Não'}</td>
              <td>${Utils.dateFormat(dataUser.register)}</td>
              <td>
                  <button type="button" class="btn btn-primary btn-edit btn-xs btn-flat">Editar</button>
                  <button type="button" class="btn btn-danger btn-delete btn-xs btn-flat">Excluir</button>
              </td>
        `;

        this.addEventsTr(tr);

        return tr;

    } // get Tr

    addEventsTr(tr) {

        tr.querySelector('.btn-delete').addEventListener('click', e => {
            if (confirm('Deseja realemente excluir esse usuário?')) {

                let user = new User();

                user.loadFromJSON(JSON.parse(tr.dataset.user));

                user.delete();

                tr.remove();

                this.updateCount();
            }
        });

        tr.querySelector('.btn-edit').addEventListener('click', e => {
            let json = JSON.parse(tr.dataset.user);

            this.formUpdateEl.dataset.trIndex = tr.sectionRowIndex; // amarazenar o indice do usuário

            for (let name in json) {
                let field = this.formUpdateEl.querySelector("[name=" + name.replace('_', '') + "]");

                if (field) {
                    switch (field.type) {
                        case 'file':
                            continue;
                            break;
                        case 'radio':
                            this.field = this.formUpdateEl.querySelector("[name=" + name.replace('_', '') + "][value=" + json[name] + "]");
                            //print(field.checked);
                            field.checked = true;
                            break;
                        case 'checkbox':
                            field.checked = json[name];
                            break;
                    }
                    field.value = json[name];
                }
            }
            this.formUpdateEl.querySelector('.photo').src = json._photo;
            this.showPanelUpdate();
        });
    } // addEventsTr

    showPanelCreate() {
        // mostrar painel de criar usuários
        document.querySelector('#box-user-create').style.display = "block";
        document.querySelector('#box-user-update').style.display = "none";
    }

    showPanelUpdate() {
        // mostrar painel de editar usuarios
        document.querySelector('#box-user-create').style.display = "none";
        document.querySelector('#box-user-update').style.display = "block";
    }

    updateCount() {
        let numberUsers = 0;
        let numberAdmin = 0;

        [...this.tableEl.children].forEach(tr => {
            numberUsers++;

            let user = JSON.parse(tr.dataset.user);

            if (user._admin) numberAdmin++;

        });
        document.querySelector('#number-users').innerHTML = numberUsers;
        document.querySelector('#number-users-admin').innerHTML = numberAdmin;
    } // update count
} // class UserController