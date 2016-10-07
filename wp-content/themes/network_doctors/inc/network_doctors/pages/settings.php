<?php 
    if(isset($_POST["rm_save_config_global"])):
        /* GLOBAL */
        update_option('rm_global_title_header',$_POST["rm_global_title_header"]);
        update_option('rm_global_text_head',$_POST["rm_global_text_head"]);
        update_option('rm_global_head_logo',$_POST["rm_global_head_logo"]);
        update_option('rm_global_head_image',$_POST["rm_global_head_image"]);
        update_option('rm_global_text_body',$_POST["rm_global_text_body"]);
        update_option('rm_global_text_specialty',$_POST["rm_global_text_specialty"]);
        update_option('rm_global_text_location',$_POST["rm_global_text_location"]);
        update_option('rm_global_text_clinic',$_POST["rm_global_text_clinic"]);
        update_option('rm_global_text_doctor',$_POST["rm_global_text_doctor"]);
    endif;

    if(isset($_POST["rm_save_config_plus"])):
        /* PLUS */
        update_option('rm_plus_title_header',$_POST["rm_plus_title_header"]);
        update_option('rm_plus_text_head',$_POST["rm_plus_text_head"]);
        update_option('rm_plus_head_logo',$_POST["rm_plus_head_logo"]);
        update_option('rm_plus_head_image',$_POST["rm_plus_head_image"]);
        update_option('rm_plus_text_body',$_POST["rm_plus_text_body"]);
        update_option('rm_plus_text_specialty',$_POST["rm_plus_text_specialty"]);
        update_option('rm_plus_text_location',$_POST["rm_plus_text_location"]);
        update_option('rm_plus_text_clinic',$_POST["rm_plus_text_clinic"]);
        update_option('rm_plus_text_doctor',$_POST["rm_plus_text_doctor"]);
    endif;  

    if(isset($_POST["rm_save_config_home"])):
        update_option('rm_home_description',$_POST["rm_home_description"]);
        update_option('rm_text_home_global',$_POST["rm_text_home_global"]);
        update_option('rm_text_home_plus',$_POST["rm_text_home_plus"]);
    endif;  
?>

<br/>

<div id="tabs">
    <ul>
        <li><a href="#tabs-1"><?php _e("RED MÉDICA MAPFRE GLOBAL","network_doctors");?></a></li>
        <li><a href="#tabs-2"><?php _e("RED MÉDICA MAPFRE GLOBAL PLUS","network_doctors");?></a></li>
        <li><a href="#tabs-3"><?php _e("HOME","network_doctors");?></a></li>
    </ul>

    <div id="tabs-1">
        <form method="post" action="">
            <h1><?php _e("CONFIGURACIONES DE RED DE MÉDICOS GLOBAL","network_doctors");?></h1>
            <br/>
            
            <input type="hidden" name="rm_save_config_global" />

             <p>
                <label><?php _e("Título Head","network_doctors");?></label>
                <br />
                <input type="text" name="rm_global_title_header" value="<?php echo esc_attr(get_option('rm_global_title_header')); ?>" class="regular-text" />
             </p>
             <p>
                <label><?php _e("Texto head","network_doctors");?></label>
                <br />
                <textarea name="rm_global_text_head" cols="70" rows="5"><?php echo esc_attr(get_option('rm_global_text_head')); ?></textarea>
             </p>
             <p>
                <label><?php _e("Logo Head","network_doctors");?></label>
                <br />
                <input type="text" name="rm_global_head_logo" value="<?php echo esc_attr( get_option('rm_global_head_logo')); ?>" class="regular-text"/>
             </p>
             <p>
                <label><?php _e("Imagen Head","network_doctors");?></label>
                <br />
                <input type="text" name="rm_global_head_image" value="<?php echo esc_attr( get_option('rm_global_head_image') ); ?>" class="regular-text"/>
             </p>
              <p>
                <label><?php _e("Texto Body","network_doctors");?></label>
                <br />
                <textarea name="rm_global_text_body" cols="70" rows="5"><?php echo esc_attr(get_option('rm_global_text_body')); ?></textarea>
             </p>
             <p>
                <label><?php _e("Texto médico primario","network_doctors");?></label>
                <br />
                <textarea name="rm_global_text_specialty" cols="70" rows="5"><?php echo esc_attr(get_option('rm_global_text_specialty'));?></textarea>
             </p>
             <p>
                <label><?php _e("Texto localización","network_doctors");?></label>
                <br />
                <textarea name="rm_global_text_location" cols="70" rows="5"><?php echo esc_attr(get_option('rm_global_text_location'));?></textarea>
             </p>
             <p>
                <label><?php _e("Texto Hospital/Clínica","network_doctors");?></label>
                <br />
                <textarea name="rm_global_text_clinic" cols="70" rows="5"><?php echo esc_attr(get_option('rm_global_text_clinic'));?></textarea>
             </p>
             <p>
                <label><?php _e("Texto Nombre/Doctor","network_doctors");?></label>
                <br />
                <textarea name="rm_global_text_doctor" cols="70" rows="5"><?php echo esc_attr(get_option('rm_global_text_doctor'));?></textarea>
             </p>
             <p>
                <input type="submit" value="<?php _e("Guardar","network_doctors");?>" />
             </p>
        </form>
    </div>

    <div id="tabs-2">
        <form method="post" action="">
            <h1><?php _e("CONFIGURACIONES DE RED DE MÉDICOS PLUS","network_doctors");?></h1>
            <br/>
            
            <input type="hidden" name="rm_save_config_plus" />

            <p>
                <label><?php _e("Título Head","network_doctors");?></label>
                <br />
                <input type="text" name="rm_plus_title_header" value="<?php echo esc_attr(get_option('rm_plus_title_header')); ?>" class="regular-text" />
            </p>
            <p>
                <label><?php _e("Texto head","network_doctors");?></label>
                <br />
                <textarea name="rm_plus_text_head" cols="70" rows="5"><?php echo esc_attr(get_option('rm_plus_text_head')); ?></textarea>
            </p>
            <p>
                <label><?php _e("Logo Head","network_doctors");?></label>
                <br />
                <input type="text" name="rm_plus_head_logo" value="<?php echo esc_attr( get_option('rm_plus_head_logo')); ?>" class="regular-text"/>
            </p>
            <p>
                <label><?php _e("Imagen Head","network_doctors");?></label>
                <br />
                <input type="text" name="rm_plus_head_image" value="<?php echo esc_attr( get_option('rm_plus_head_image') ); ?>" class="regular-text"/>
            </p>
            <p>
                <label><?php _e("Texto Body","network_doctors");?></label>
                <br />
                <textarea name="rm_plus_text_body" cols="70" rows="5"><?php echo esc_attr(get_option('rm_plus_text_body')); ?></textarea>
            </p>
            <p>
                <label><?php _e("Texto especialidad","network_doctors");?></label>
                <br />
                <textarea name="rm_plus_text_specialty" cols="70" rows="5"><?php echo esc_attr(get_option('rm_plus_text_specialty'));?></textarea>
            </p>
            <p>
                <label><?php _e("Texto localización","network_doctors");?></label>
                <br />
                <textarea name="rm_plus_text_location" cols="70" rows="5"><?php echo esc_attr(get_option('rm_plus_text_location'));?></textarea>
            </p>
            <p>
                <label><?php _e("Texto Hospital/Clínica","network_doctors");?></label>
                <br />
                <textarea name="rm_plus_text_clinic" cols="70" rows="5"><?php echo esc_attr(get_option('rm_plus_text_clinic'));?></textarea>
            </p>
            <p>
                <label><?php _e("Texto Nombre/Doctor","network_doctors");?></label>
                <br />
                <textarea name="rm_plus_text_doctor" cols="70" rows="5"><?php echo esc_attr(get_option('rm_plus_text_doctor'));?></textarea>
            </p>
            <p>
                <input type="submit" value="<?php _e("Guardar","network_doctors");?>" />
            </p>
        </form>
    </div>

    <div id="tabs-3">
        <form method="post" action="">
            <h1><?php _e("CONFIGURACIONES DEL HOME","network_doctors");?></h1>
            <br/>
            
            <input type="hidden" name="rm_save_config_home" />

            <p>
                <label><?php _e("Introducción del home","network_doctors");?></label>
                <br />
                <textarea name="rm_home_description" cols="70" rows="5"><?php echo esc_attr(get_option('rm_home_description')); ?></textarea>
            </p>
            <p>
                <label><?php _e("Texto de red médica Global","network_doctors");?></label>
                <br />
                <textarea name="rm_text_home_global" cols="70" rows="5"><?php echo esc_attr(get_option('rm_text_home_global')); ?></textarea>
            </p>
            <p>
                <label><?php _e("Texto de red médica Plus","network_doctors");?></label>
                <br />
                <textarea name="rm_text_home_plus" cols="70" rows="5"><?php echo esc_attr(get_option('rm_text_home_plus')); ?></textarea>
            </p>
            <p>
                <input type="submit" value="<?php _e("Guardar","network_doctors");?>" />
            </p>
        </form>
    </div>
</div>


