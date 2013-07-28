<?php 
include "dbconfig.php";
            mysql_connect($host,$user,$password) OR die("Unable to connect to the database");
            mysql_select_db($db) OR die("can not select the database $db");
            

 $sql = "SELECT id, client, todo, who, status, kategorie, added FROM coold";
            $res = mysql_query($sql);
?>
 <html>
 <head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
 	<title>coold!</title>
 </head>
 <body>
 	<header></header>
 	<div id="list">
 		<?php 
 		while($row = mysql_fetch_array($res)){
 		 ?>
 		<div class="element" id="<?php echo $row['id']; ?>">
 			<?php echo "<td>". $row['client'] . "</td>"; ?>
 			<?php echo "<td>". $row['todo'] . "</td>"; ?>
 			<?php echo "<td>". $row['status'] . "</td>"; ?>
 			<?php echo "<td>". $row['who'] . "</td>"; ?>

 			<p class="button" id="edit_<?php echo $row['id']; ?>" href="">
              LÖSCHEN</p>
            <div class="editoverlay" id="over_edit_<?php echo $row['id']; ?>" href="" >
                <p class="close">x</p>
                <input type="text" placeholder="Kundenname">
                <input type="text" placeholder="Beschreibung">
                <select>
                    <option>Status</option>
                    <option>Rot</option>
                </select>
                <input type="text" placeholder="Zugeteilter">
            </div>
 		</div>
 		<?php } ?>
 	</div>
 	<script type="text/javascript">
        

        $(document).ready(function(){    
        	$(".button").hide();
            $(".editoverlay").hide();      

            $(".element").hover(
              function () {
                 msg_id = $(this).attr("id");    
                    $("#edit_" + msg_id + "").show(); 
              },
              function () {
                 msg_id = $(this).attr("id");    
                    $("#edit_" + msg_id + "").hide();
              }
            );
        	

             function hoverlink (){
                   
                    linkid = $(this).attr("id");    
                    $("#over_" + linkid + "").show(); 
            }
            $(".button").click(hoverlink);
            $(".close").click(function(){
            $(".editoverlay").hide(); 
                
            });
           
        });
    </script>
 </body>
 </html>