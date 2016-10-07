jQuery(document).ready(function($){
    
    /*
     * Accordeon
     */
    $(".network-doctors-menu li .slideudown").click(function(){
        $(this).next(".network-doctors-content").slideToggle();
        $(this).parent().siblings("li").children(".network-doctors-content").slideUp();
    });
    
    /*
     * Show clinics
     */
    $(".category-rdm h2").click(function(){
        $(this).next("div").slideToggle();
        $(this).parent("div").siblings(".category-rdm").children("div").slideUp();
    });
    
    /*
     * Edit
     */
    $("#datatable").on("click",".button-edit-red-medicos",function(){
        var obj     = $(this),
            id      = obj.attr("id"),
            id      = id.split("-"),
            id      = id[1],
            entity  = $("#entity_type").val(),
            network = $("#network_id").val(),
            page    = '';

            if(network == 1){
                page = 'rm-global';
            }
            else{
                page = 'rm-plus';
            }
            
            switch(entity) {
                case "specialty":
                    location.href = "?page="+page+"&edit&id="+id+"&entity="+entity+"";
                    break;
                case "location":
                    location.href = "?page="+page+"&tab=2&edit&id="+id+"&entity="+entity+"";
                    break;
                case "clinic":
                    location.href = "?page="+page+"&tab=3&edit&id="+id+"&entity="+entity+"";
                    break; 
                case "doctor":
                    location.href = "?page="+page+"&tab=4&edit&id="+id+"&entity="+entity+"";
                    break;     
            }
    });
    
    /*
     * Delete
     */
    $("#datatable").on("click",".button-delete-red-medicos",function(){
        var answer = confirm("¿Está seguro de eliminar este elemento?");
        
        if(answer){
            var obj     = $(this),
                id      = obj.attr("id"),
                id      = id.split("-"),
                id      = id[1],
                entity  = $("#entity_type").val(),
                network = $("#network_id").val(),
                page    = '';

                if(network){
                    page = 'rm-global';
                }
                else{
                    page = 'rm-plus';
                }
                
                switch(entity) {
                    case "specialty":
                        location.href = "?page="+page+"&delete&id="+id+"&entity="+entity+"";
                        break;
                    case "location":
                        location.href = "?page="+page+"&tab=2&delete&id="+id+"&entity="+entity+"";
                        break;
                    case "clinic":
                        location.href = "?page="+page+"&tab=3&delete&id="+id+"&entity="+entity+"";
                        break; 
                    case "doctor":
                        location.href = "?page="+page+"&tab=4&delete&id="+id+"&entity="+entity+"";
                        break;     
                }
        }   
    });
    

    /*
     * Tabs
     */
    $("#tabs").tabs();
    
});
