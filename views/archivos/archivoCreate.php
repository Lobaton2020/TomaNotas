
<div class="container">
   <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-6 mar_b">
       <?php  require_once "views/template/dashboard/errorHandler.php"?>
        <div class="card  mb-4 ">
            <h4 class="card-header text-center">Sube tus Archivos</h4>
         <div class="mb5 card-body " >
              <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="c" value="archivo">
                <input type="hidden" name="m" value="cargarFiles">
                <div class="custom-file">
                  <input type="file" class="input-file btn btn-info btn-block" id="input-file" name="archivos[]" multiple>
                  <label for="input-file"><i class="fas fa-upload"></i> &nbsp;Elegir Archivos</label>
                  <small class="text-muted">Los archivos seleccionados no deben superar los 15 MB</small>
                </div>
                <div style="min-height:100px" class="my-3" id="files"></div>
                <div class="mt-6 mb-2 text-center">
                  <button type="submit" disabled id="boton_a" class="btn btn-info">Elegir Archivos</button>
                  <a href="?c=archivo">Ver Archivos</a>
                </div>
              </form>
          </div>
        </div> 
       </div>
       <div class="col-md-3 "></div>
   </div>
</div>