<?php 
class Form{
    
    /*
     * Return data in form control checkbox
     */
    public function checkboxs($data,$name,$selecteds = Array()){
        if(!$data){
            return __("No hay datos","network_doctors");
        }
        else{
            foreach ($data as $key => $value) {
                $checked = "";
                for ($i=0;$i<count($selecteds);$i++) {
                    if(empty($checked)){
                        $checked = ($value->id == end($selecteds[$i]))?"checked":"";
                    }
                }
                
                $html    .="<p><input type='checkbox' value='".$value->id."' name='".$name."[]' ".$checked."/> <label>".$value->name."</label></p>"; 
            }
            return $html;
        }
    }
    
    /*
     * Return data in categories
     */
    public function categories($category,$tabledb,$name,$selecteds = Array(),$network){
       
        if(!$category){
            return __("No hay datos","network_doctors");
        }
        else{
            $html .='';

            foreach ($category as $key => $value) {
                global $wpdb;

                $clinics = $wpdb->get_results(
                    "select * from ".$wpdb->prefix."clinic where active = 1 and network = ".$network." and location =".$value->id."", 
                    OBJECT 
                );
                
                $html .= '<div class="category-rdm">';
                $html .= '<h2>'.$value->name.'</h2>';
                $html .= '<div>';
                
                foreach ($clinics as $key_cli => $value_cli) {
                    $checked = "";
                    
                    for ($i=0;$i<count($selecteds);$i++) {
                        if(empty($checked)){
                            $checked = ($value_cli->id == end($selecteds[$i]))?"checked":"";
                        }
                    }
                    
                    $html .= "<p><input type='checkbox' value='".$value_cli->id."' name='".$name."[]' ".$checked."/> <label>".$value_cli->name."</label></p>";
                }
                
                $html .= '</div>';
                $html .= '</div>';
            }
            return $html;
        }
    }
    
    /*
     * Return data in select control
     */
    public function select($data,$name,$selection = ""){
        if(!$data){
            return __("No hay datos","network_doctors");
        }
        else{
            $html .= "<select name='".$name."'>";
            foreach ($data as $key => $value) {
                $selected   = ($value->id == $selection)?"selected":"";
                $html      .="<option value='".$value->id."' ".$selected.">".$value->name."</option>"; 
            }
            $html .= "</select>";
            return $html;
        }
    }
    
}
?>