const parserJson = (json) => JSON.parse(json)
const updateProjectParser = (json) => updateProject(parserJson(json))

function updateProject({ id, descripcion, name, status }) {
    $("#update-create-project").val("update")
    $("#id_project").val(id)
    $("#name").val(name)
    $("#descripcion").val(atob(descripcion))
    $("#status_project").val(status).closest('.form-group').removeClass("d-none");
    $("#titulo-model").val("Editar Proyecto")

}
