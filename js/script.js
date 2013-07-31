$(document).ready(function() {
                //hide addForm, editForm, editButton
                $(".form").hide();
                $(".addclform").hide();
                $(".addclform-coop").hide();
                $(".edit").hide();
                $(".fertig").hide();
                $(".fertig-coop").hide();

                //show addForm
                $(".addcl").click(function(){

                    $(".addclform").slideDown();
                });
                $(".addcl-coop").click(function(){

                    $(".addclform-coop").slideDown();
                });

                //show editButton
                $(".item").hover(function () {
                    msg_id = $(this).attr("id");    
                    $("#edit_" + msg_id + "").fadeIn(); 
                },function () {
                    msg_id = $(this).attr("id");    
                    $("#edit_" + msg_id + "").fadeOut();
                });     

                //show editForm
                function hoverlink (){
                    linkid = $(this).attr("id");    
                    $("#over_" + linkid + "").fadeIn(); 
                }
                $(".edit").click(hoverlink); 
                });

                //hide editForm
                $(".icon-remove").click(function(){

                    $(".form").fadeOut();
                });

                //hide addForm
                $("#remove-addform").click(function(){

                    $(".addclform").slideUp();
                }); 
                $("#remove-addform-coop").click(function(){

                    $(".addclform-coop").slideUp();
                }); 

                //show Fertige
                $("#showfertig").click(function(){

                    $(".fertig").slideDown();
                    $("#showfertig").slideUp();
                }); 
                $("#showfertig-coop").click(function(){

                    $(".fertig-coop").slideDown();
                    $("#showfertig-coop").slideUp();
                }); 