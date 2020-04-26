<table  class="table table-hover">
            <thead>

             <tr>
               <td>#</td>
               <td style="max-width:100px">Archivo</td>
               <td>Tamaño</td>
               <td>Rename</td>
              <?php if(isset($_SESSION["id_user"]) || !empty($_SESSION["id_user"])):?>
                <td class="eliminar_archivo" >Accion</td>
              <?php endif; ?>
            </tr>   
          </thead>
          <tbody class="table table-hover">
             <?php
             $i = 1;
             foreach( $response as $row): ?>
             <tr>
                 <input type="hidden" id="extencion<?php echo $row->id_archivo_PK;?>" value="<?php echo pathinfo($row->ruta,PATHINFO_EXTENSION); ?>">
                 <input type="hidden" id="nombre_archivo<?php echo $row->id_archivo_PK;?>" value="<?php echo pathinfo($row->ruta,PATHINFO_FILENAME); ?>">
                 <td> <span  data-toggle="tool" title=" <?php echo getDateTime($row->fecha_ingreso); ?>"><?php  echo $i++; ; ?></span></td>
                 <td><a href="?c=archivo&m=ver&id=<?php echo $row->id_archivo_PK;?>#iframe"><span data-toggle="tool" title=" <?php echo getDateTime($row->fecha_ingreso); ?>"><span id="basename<?php echo $row->id_archivo_PK; ?>"><?php echo pathinfo($row->ruta,PATHINFO_BASENAME); ?></span></span></a></td>
                 <td> <span class="small"><?php echo number_format($row->tamano, 3, '.', '') ." MB"; ?></span></td>
                 <td class="text-center"><a href="#" onclick="renameFile('<?php echo $row->id_archivo_PK;?>');" data-toggle="modal" data-target="#rename" class="text-dark"><i s class="far fa-edit"></i></a> </td>
                 <td class="eliminar_archivo" class="eliminar_archivo"><a href="?c=archivo&m=delete&id=<?php echo $row->id_archivo_PK; ?> "  onclick="if(!confirm('¿Seguro quieres eliminar este Archivo?')){ return false }" ><span class="text-danger">Delete</span></a></td>
            </tr>
             <?php endforeach;?>
          </tbody>
       </table>