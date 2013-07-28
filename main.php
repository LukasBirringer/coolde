<?php 
include "dbconfig.php";
$sql = "SELECT id, client, todo, who, status, kategorie, added FROM coold";
$res = mysql_query($sql);


function delete($id) { $result = mysql_query("DELETE FROM coold WHERE id = ".$id) or die ('Ungültige Abfrage: ' . mysql_error());

if($result) { $advice = "Eintrag erfolgreich gel&ouml;scht"; } 
else { $advice = "Fehler beim L&ouml;schen"; } 
return $advice; }

//DELETE
if(isset($_GET['deleteid'])){
$advice = delete($_GET['deleteid']);
header("location:main.php");
}

//UPDATE
if(isset($_POST['kundenname'])){
$id = $_POST["id"]; 
$kundenname = $_POST["kundenname"]; 
$todo = $_POST["todo"]; 
$who = $_POST["who"]; 
$status = $_POST["status"];
$result = mysql_query("UPDATE coold SET client='".$kundenname."', todo='".$todo."', who='".$who."', status='".$status."' WHERE ID = ".$id) or die (mysql_error());
header("location:main.php");
}

//INSERT
if(isset($_POST['kundennamenew'])){
$kundenname = $_POST["kundennamenew"]; 
$todo = $_POST["todonew"]; 
$who = $_POST["whonew"]; 
$status = $_POST["statusnew"];
$result = mysql_query("INSERT INTO coold (client, todo, who, status) VALUES('".$kundenname."','".$todo."','".$who."','".$status."')") or die (mysql_error());
header("location:main.php");
}
?>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/main.css">
 	<title>coold!</title>
 </head>
 <body>
 	<header><a href="logout.php">Logout</a></header>
    <div id="add">
        <form action="main.php" method="post">
                <input type="text" name="kundennamenew" placeholder="Kundenname">
                <input type="text" name="todonew" placeholder="Beschreibung">
                <select name="statusnew">
                    <option>Status</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
                <input type="text" name="whonew" placeholder="Zugeteilter">
                <input type="submit" value="Speichern">
                </form>
    </div>
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
                <form action="main.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                <input type="text" name="kundenname" placeholder="Kundenname">
                <input type="text" name="todo" placeholder="Beschreibung">
                <select name="status">
                    <option>Status</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select><?php echo $row['id'];?>
                <input type="text" name="who" placeholder="Zugeteilter">
                <input type="submit" value="Speichern">
                </form>
                <a href="main.php?deleteid=<?php echo $row['id'];?>" >delete</a>
            </div>
 		</div>
 		<?php } ?>
 	</div>
 	<script type="text/javascript">
        $(document).ready(function(){    
        	$(".button").hide();
            $(".editoverlay").hide();      

            $(".element").hover(function () {
                msg_id = $(this).attr("id");    
                $("#edit_" + msg_id + "").show(); 
            },function () {
                msg_id = $(this).attr("id");    
                $("#edit_" + msg_id + "").hide();
            });   	

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