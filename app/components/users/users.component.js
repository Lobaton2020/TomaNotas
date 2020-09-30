import UserService from "../../services/user.service.js";
import RolService from "../../services/rol.service.js";

(function(window, document) {
    "use strict"
    document.addEventListener("DOMContentLoaded", (e) => {
        window.laurel.component('user', {
            create: async function(form) {
                try {
                    laurel.renderLoader(true);

                    if (await UserService.create(new FormData(form))) {
                        laurel.getComponent().list();
                        Swal.fire("Bien!", "Accion ejecutada correctamente.", "success");
                        form.reset();
                        form.classList.remove("was-validated");
                        hideModal();
                    } else {
                        errorSwal();
                    }
                    laurel.renderLoader(false);

                } catch (err) {
                    console.error(err)
                }
            },
            rols: async function() {
                try {
                    let res = await RolService.list();
                    if (res.status == 200) {
                        return res.data;
                    } else {
                        return [];
                    }
                } catch (err) {
                    console.error(err)
                }
            },
            get: async function(id) {
                try {
                    let res = await UserService.get(id);
                    if (res.status == 200) {
                        return res.data;
                    } else {
                        return [];
                    }
                } catch (err) {
                    console.error(err)
                }
            },
            list: async function(page = 1) {
                try {
                    laurel.renderLoader(true);

                    let res = await UserService.list(page);
                    if (res.status == 200) {
                        renderUsers(res.data);
                        renderPaginate(res);
                    } else {
                        renderUsers([]);
                    }
                    laurel.renderLoader(false);

                } catch (err) {
                    console.error(err)
                }
            },
            disable: async function(id) {
                try {

                    let result = await Swal.fire({
                        title: '¿Estas seguro?',
                        // text: "Esta acción no se podrá revertir!",
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonText: "Cancelar",
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Inactivar!'
                    })
                    if (result.value) {
                        laurel.renderLoader(true);
                        let data = new FormData();
                        data.append("id", id);
                        result = await UserService.disable(data);
                        if (result.status == 200) {
                            laurel.getComponent().list();
                            Swal.fire(
                                'Inactivado!',
                                'El usuario ha sido inactivado.',
                                'success'
                            )
                        } else {
                            errorSwal();
                        }
                    }
                    laurel.renderLoader(false);

                } catch (err) {
                    console.error(err)
                }
            },
            enable: async function(id) {
                try {
                    let result = await Swal.fire({
                        title: '¿Estas seguro?',
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonText: "Cancelar",
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Si, activar!',
                        cancelButtonColor: '#d33'
                    })
                    if (result.value) {
                        laurel.renderLoader(true);
                        let data = new FormData();
                        data.append("id", id);
                        result = await UserService.enable(data);
                        if (result.status == 200) {
                            Swal.fire(
                                'Activado!',
                                'El usuario ha sido activado.',
                                'success'
                            )
                            laurel.getComponent().list();
                        } else {
                            errorSwal();
                        }
                    }
                    laurel.renderLoader(false);

                } catch (err) {
                    console.error(err)
                }
            }
        });
    });
})(window, document);