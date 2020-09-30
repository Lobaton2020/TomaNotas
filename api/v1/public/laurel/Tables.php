<?php
class Tables
{

    public function getDataNewTableUser($data)
    {
        $column = [];
        $column["iduser"] = $data->{"id_usuario_PK"};
        $column["idrol"] = $data->{"id_rol_FK"};
        $column["name"] = $data->{"nombre"};
        $column["lastname"] = $data->{"apellido"};
        $column["email"] = $data->{"correo"};
        $column["nickname"] = $data->{"nickname"};
        $column["password"] = $data->{"clave"};
        $column["image"] = null;
        $column["email_verify_date"] = null;
        $column["remember_token"] = null;
        $column["recovery_pass_token"] = null;
        $column["status"] = $data->{"estado"};
        $column["create_date"] = $data->{"fecha_ingreso"};
        return $column;
    }
    public function getDataNewTableLink($data)
    {
        $column = [];
        $column["idlink"] = $data->{"id_link_PK"};
        $column["iduser"] = $data->{"id_usuario_FK"};
        $column["idcategory"] = 1;
        $column["title"] = $data->{"titulo"};
        $column["important"] = null;
        $column["url"] = $data->{"url_link"};
        $column["create_datetime"] = $data->{"fecha_ingreso"};
        return $column;
    }
}
