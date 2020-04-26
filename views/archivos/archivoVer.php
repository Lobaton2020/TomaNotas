
     <div id="iframe" class="row" >
          <div class="col-md-1 col-sm-12 ver_file" id="input-file" >
            <span><a href="?c=archivo&m=index" class="border-bottom border-dark" >Ir Atrás</a></span><span class="logo_peque"> | </span>
            <span><a href="<?php echo $response->ruta ?>" class="border-bottom border-dark" download="<?php echo basename($response->ruta); ?>" >Descargar</a>
            <?php if(isset($_SESSION["id_user"]) && !empty($_SESSION["id_user"])){?>
            <span class="logo_peque">  | </span>
            <span><a href="#" data-toggle="modal" data-target="#compartir_archivo" class="border-bottom border-dark" >Compartir</a></span>
            <?php } ?>
          </div>
          <div class="col-md-10 col-sm-12 ">
          <div class="ver_file">
              <?php error_reporting(0); switch(pathinfo($response->ruta,PATHINFO_EXTENSION)): 
                    case "pdf":


              ?>
                <div class="logo_peque text-danger mx-2 "><br>&bull; Deber descargar el archivo PDF, para poder previsualizarlo.</div>
                 <div style="height:610px" class="embed-responsive embed-responsive-21by9  mb-5">
                   <iframe  class="embed-responsive-item"   src="<?php echo $response->ruta; ?>"  allowfullscreen></iframe>
                 </div>
                <?php break; 
                      case "jpg":
                      case "jpeg":
                      case "png":
                      case "svg":
                      case "gif":
                       $e="aa";
                ?>
                  <div class="mx-auto" style="max-width:470px;">
                    ​<picture>
                      <source srcset="<?php echo $response->ruta; ?>" type="image/svg+xml">
                      <img src="<?php echo $response->ruta; ?>" class="img-fluid img-thumbnail mb-3" alt="<?php echo basename($response->ruta); ?>">
                    </picture>
                    </div> 
               <?php 
                 break;
               ?>
                  <?php break; 
                      case "avi":
                      case "mp4":
                      case "mpej":
                      case "mwv":

                ?>
                   <div class="embed-responsive embed-responsive-16by9 mb-3 video_peque">
                       <iframe class="embed-responsive-item" src="<?php echo $response->ruta; ?>"></iframe>
                   </div>
               <?php 
                 break;
               ?>
                <?php break; 
                      case "mp3":
                      case "wma":
                      case "wav":
                      case "m4a":
                      case "m4b":
                      case "m4p":
                      case "m4r":
                      case "acc":
                        $a = "";
                ?>
                <div class="my-4" align="center">
                   <audio controls style="width:100%">
                       <source src="<?php echo $response->ruta;?>" type="<?php echo 'audio/'.pathinfo($response->ruta,PATHINFO_EXTENSION); ?>">
                    </audio>
                 </div>
                   
               <?php 
                 break;
                 case "doc":
                 case "docx":
                 case "xlsx":
                 case "pptx":
                 case "sql": 
                 case "rar": 
                 case "zip": 
                 case "rar4": 
                 case "html":                       
                 case "php":
                  $a="";
                 ?>
                <div class="text-danger mx-2 "><br>&bull; Debes descargar el archivo para poder visualizarlo.</div>
                <?php break;
                 case "txt":                       
                 case "css":
                 case "js":
                ?>
                <div style="height:610px" class="embed-responsive embed-responsive-21by9 border  mb-5">
                   <iframe  class="embed-responsive-item"   src="<?php echo $response->ruta; ?>"  allowfullscreen></iframe>
                 </div>
             
               <?php break;
                  default;
                $a="";
                ?>
                <div class="text-danger mx-2 "><br>&bull; Debes descargar el archivo para poder visualizarlo.</div>

              <?php endswitch;?>
          </div>
          </div>
         <div class="col-md-1 col-sm-12"></div>
     </div>


<!-- Modal -->
<div class="modal fade" id="compartir_archivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Escoje al usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Debes escojer al usuario con quien deseas compartir el archivo.</p>
        <form method="post" id="share_file">
           <input type="hidden" name="c" value="archivo">
           <input type="hidden" name="m" value="compartir_file">
           <input type="hidden" name="id_file" value="<?php echo $_REQUEST["id"]; ?>">
           <input type="hidden" name="id_user_entrega" value="<?php echo $_SESSION["id_user"]; ?>">
           
        <select class="form-control" name="id_user_recibe" required id="">
         <option value="" selected disabled>-- Selecciona un usuario --</option>

         <?php foreach($this->admin->getall_user() as $user):?>
         <?php if($user->estado == 1 && $user->id_usuario_PK != $_SESSION["id_user"]){?>
           
          <option value="<?php echo $user->id_usuario_PK; ?>"><?php echo $user->nickname; ?></option>
         <?php } endforeach; ?>

        </select>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" form="share_file" class="btn btn-primary">Compartir!</button>
      </div>
    </div>
  </div>
</div>