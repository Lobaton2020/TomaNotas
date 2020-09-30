const handlerDetailUser = e => {
    e.preventDefault();
    let classes = e.currentTarget.parentNode.classList;
    classes.add("show")

};
const handlerDisableUser = e => {
    e.preventDefault();
    laurel.getComponent().disable(e.currentTarget.id)
};
const handlerEnableUser = e => {
    e.preventDefault();
    laurel.getComponent().enable(e.currentTarget.id)
};
const handlerEditUser = async(e) => {
    e.preventDefault();
    laurel.renderLoader(true);

    let form = document.querySelector("#save-user"),
        user, rols;
    if (form.classList.contains("was-validated")) {
        form.classList.remove("was-validated")
    }
    user = await laurel.getComponent().get(e.currentTarget.id);
    // user = user.data
    rols = await laurel.getComponent().rols();
    renderRolsUser(rols);
    [...form.idrol].forEach((elem) => {
        if (elem.value == user.idrol) {
            elem.checked = true;
        }
    })
    form.name.value = user.name;
    form.lastname.value = user.lastname;
    form.email.value = user.email;
    form.nickname.value = user.nickname;
    console.log(user, rols)
        // document.querySelector(".modal-name").value = "Juan andres"

    laurel.renderLoader(false);
    $(".modal").modal("show");
};
const validateRol = (value) => {
    let rol = document.querySelector("#validate-rol");
    if (value === "") {
        rol.classList.remove("d-none");
    } else {
        rol.classList.add("d-none");
    }
};
const handlerValidateRol = (e) => {
    validateRol(e.currentTarget.value);
};
const handlerSaveUser = e => {
    e.preventDefault();
    validateRol(e.currentTarget.idrol.value);
    [...e.currentTarget.idrol].forEach((elem) => {
        elem.addEventListener("change", handlerValidateRol);

    })
    if (e.currentTarget.idrol.value != "" &&
        e.currentTarget.name.value != "" &&
        e.currentTarget.lastname.value != "" &&
        e.currentTarget.email.value != "" &&
        e.currentTarget.nickname.value != "" &&
        e.currentTarget.password.value != "") {
        laurel.getComponent().create(e.currentTarget);
    }

};
const renderRolsUser = (rols) => {
    let render = document.querySelector("#render-rols"),
        template = document.querySelector("#user-rol"),
        fragment = document.createDocumentFragment(),
        clon, close, create;
    render.innerHTML = "";
    rols.forEach((register) => {
        let { idrol, name } = register;
        clon = template.content.cloneNode(true);
        clon.querySelector(".idrol").value = idrol;
        clon.querySelector(".name").textContent = name;
        fragment.appendChild(clon);
    })
    render.appendChild(fragment);
    if (!rols.length) {
        renderTableEmptyMessage(render, "No hay roles.", 8)
    }
};
const handlerAddUser = async e => {
    e.preventDefault();
    laurel.renderLoader(true);
    let rols,
        formSave = document.getElementById("save-user");
    formSave.reset();
    rols = await laurel.getComponent().rols()
    renderRolsUser(rols);
    formSave.addEventListener("submit", handlerSaveUser);
    laurel.renderLoader(false);
    $(".modal").modal("show");
}
const renderUsers = (data) => {
    let tbody = document.querySelector("#tbody"),
        template = document.querySelector("#template"),
        fragment = document.createDocumentFragment(),
        clon, elemStatus, edit, disable;
    // tbody.innerHTML = "";
    data.forEach((register, i) => {
        let { iduser, name, lastname, email, nickname, rol, status, create_date } = register;
        clon = template.content.cloneNode(true);
        elemStatus = clon.querySelector(".status");
        detail = clon.querySelector(".detail");
        edit = clon.querySelector(".edit");
        disable = clon.querySelector(".disable");
        edit.id = iduser;
        disable.id = iduser;
        clon.querySelector(".id").textContent = iduser;
        clon.querySelector(".name").textContent = `${name} ${lastname}`;
        clon.querySelector(".email").textContent = email;
        clon.querySelector(".nickname").textContent = nickname;
        clon.querySelector(".rol").textContent = toFirstUpperCarse(rol.name);
        if (parseInt(status) == 1) {
            elemStatus.classList.add("badge-success");
            elemStatus.innerHTML = "Activo";
            disable.addEventListener("click", handlerDisableUser);
            disable.textContent = "Inactivar";
        } else {
            elemStatus.classList.add("badge-danger");
            elemStatus.innerHTML = "Inactivo";
            disable.textContent = "Activar";
            disable.addEventListener("click", handlerEnableUser);
        }
        clon.querySelector(".create_date").textContent = formatDate(create_date);
        edit.addEventListener("click", handlerEditUser);
        detail.addEventListener("click", handlerDetailUser);
        fragment.appendChild(clon);
    });
    document.querySelector(".add-user").addEventListener("click", handlerAddUser)
    tbody.appendChild(fragment);
    if (!data.length) {
        renderTableEmptyMessage(tbody, "Parece que no hay usuarios registrados.", 8)
    }
};
const handlerMovePage = (e) => {
    e.preventDefault();
    laurel.getComponent().list(e.currentTarget.dataset.page)
};
// const handlerPrevPage = (e) => {
//     e.preventDefault();
//     laurel.getComponent().list(e.currentTarget.dataset.page)
// };
// const handlerCurrentPage = (e) => {
//     e.preventDefault();
//     laurel.getComponent().list(e.currentTarget.dataset.page)
// };
const prevNextPaginate = (ul, li, a, page, current, type) => {
    li = document.createElement("li");
    li.classList.add("page-item");
    a = document.createElement("a");
    a.classList.add("page-link")
    a.dataset.page = page;
    a.textContent = page,
        a.addEventListener("click", handlerMovePage)
    li.appendChild(a);
    if (type == "prev") {
        ul.insertBefore(li, current.parentNode);

    } else if (type == "final") {
        ul.insertBefore(li, current.parentNode.nextSibling.nextSibling);
    } else {
        ul.insertBefore(li, current.parentNode.nextSibling);
    }
}


// const renderPaginate = (data) => {
//     let { prev_url, next_url, current_page, total, count } = data;
//     let render = document.querySelector("#render-pagination"),
//         template = document.querySelector("#template-pagination"),
//         clon = template.content.cloneNode(true),
//         prev = clon.querySelector(".prev-page"),
//         next = clon.querySelector(".next-page"),
//         current = clon.querySelector(".current-page"),
//         ul = clon.querySelector(".pagination"),
//         content = clon.querySelector("#content-paginate"),
//         li, a;
//     current.addEventListener("click", handlerMovePage)
//     current.textContent = current_page;
//     current.dataset.page = current_page;
//     if (prev_url) {
//         prev.dataset.page = current_page - 1;
//         prev.addEventListener("click", handlerMovePage)
//         prev.parentNode.classList.remove("disabled");
//         if (1 < current_page - 1) {
//             [current_page - 2, current_page - 1].forEach((pagePrev) => {
//                 prevNextPaginate(ul, li, a, pagePrev, current, "prev");
//             })
//         }
//     } else {
//         prev.parentNode.classList.add("disabled");
//     }
//     if (next_url) {
//         if (current_page > 1 && total > total - 1 && current_page != total - 1 && current_page != total - 2 && current_page != total - 3) {
//             prevNextPaginate(ul, li, a, total - 1, current, "final");
//         }
//         next.dataset.page = current_page + 1;
//         next.addEventListener("click", handlerMovePage)
//         next.parentNode.classList.remove("disabled");
//         if (total > current_page + 1) {
//             [current_page + 2, current_page + 1].forEach((pageNext) => {
//                 prevNextPaginate(ul, li, a, pageNext, current, "next");
//             })
//         }
//     } else {
//         next.parentNode.classList.add("disabled");
//     }
//     content.textContent = `${current_page} - ${total} de ${count} registros`;
//     render.innerHTML = "";
//     render.appendChild(clon);
// };

const handlerScrollPaginate = (e) => {
    let { prev_url, next_url, current_page, total, count } = data;
    let { scrollTop, clientHeight, scrollHeight } = document.documentElement;
    if (scrollTop + clientHeight + 100 >= scrollHeight) {
        if (next_url != false) {
            delete window.data;
            laurel.getComponent().list(current_page + 1);
            window.removeEventListener("scroll", handlerScrollPaginate);
        }
        console.log("Wey Ya")
    }
    console.log(scrollTop, clientHeight, scrollHeight)
};
const renderPaginate = (data) => {
    window.data = data;
    window.addEventListener("scroll", handlerScrollPaginate);
};