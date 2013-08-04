<?php 
include "dbconfig.php";
$sql = "SELECT id, client, todo, who, status, kategorie, added FROM coold";
$res = mysql_query($sql);

//DELETE
function delete($id) { $result = mysql_query("DELETE FROM coold WHERE id = ".$id) or die ('Ungültige Abfrage: ' . mysql_error());
if($result) { $advice = "Eintrag erfolgreich gel&ouml;scht"; } 
else { $advice = "Fehler beim L&ouml;schen"; } 
return $advice; }
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
$kategorie = $_POST["kategorie"];
$result = mysql_query("INSERT INTO coold (client, todo, who, status, kategorie) VALUES('".$kundenname."','".$todo."','".$who."','".$status."','".$kategorie."')") or die (mysql_error());
header("location:main.php");
}
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <title>
            co-op design // todo
        </title>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,700,200' rel='stylesheet' type='text/css'>
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
        
    </head>
    <body>
        <header class="wrapper">
            <a href="main.php"><img src="images/logo-coop.png" alt="co-op design" /></a><h1>Arbeitet, Brüder!</h1>
            <div class="logout">
                <a href="logout.php"><i class="icon-off"></i><span>Logout</span></a>
            </div>
        </header>
        <div style="width: 960px; height: auto; margin: auto;">
            <section class="wrapper" id="kunden-todos">
                <header>
                    <h2>Kunden ToDo's</h2>
                    <a href="#" class="addcl"><i class="icon-plus"></i><span>ToDo hinzufügen</span></a>
                </header>
                <article class="addclform">
                        <form action="main.php" method="post" name="addclrform">
                            <div class="forml">
                                <div class="row">
                                    <input type="text" name="kundennamenew" placeholder="Kundenname eintragen..." />
                                    <input type="text" name="todonew" placeholder="Todo eintragen..." />
                                    <input type="hidden" name="kategorie" value="1">
                                </div>          
                                <div class="row">
                                    <div class="select">            
                                        <select name="statusnew">
                                            <option>Status auswählen</option>
                                            <option value="3">in Vorbereitung</option>
                                            <option value="2">in Umsetzung</option>
                                            <option value="1">abgeschlossen</option>
                                        </select>
                                    </div>                              
                                    <input type="text" name="whonew" class="editor" placeholder="Bearbeiter..." />
                                </div>                          
                            </div>
                            <div class="formr">
                                <i class="icon-remove" id="remove-addform"></i>
                                <!--<input type="submit"  value="speichern">-->
                                <a href="#" onclick="document.forms['addclrform'].submit()" class="submit"><i class="icon-save"></i><span>ToDo speichern</span></a>
                            </div>
                        </form>
                </article>
                <?php 

                while($row = mysql_fetch_array($res)){
                    if ($row['kategorie'] == 1 && $row['status'] != 1) {
                
                ?>
                <article class="item" id="<?php echo $row['id']; ?>">
                    <div class="content">
                        <div class="iteml">
                            <h3><?php  echo $row['client']; ?></h3>
                            <span class="edit" id="edit_<?php echo $row['id']; ?>">
                                <i class="icon-pencil"></i>
                            </span>
                            <br/>
                            <p><?php echo $row['todo']; ?></p>
                        </div>
                        <div class="itemr">
                            <p><i class="icon-calendar"></i>
                                <span class="added">hinzugefügt am: 28.07.2013</span>
                            </p>
                            <p><i class="icon-male"></i>
                                <span class="added">Bearbeiter: <?php echo $row['who']; ?></span>
                            </p>
                        </div>
                    </div>                  
                    
                    <article class="form" id="over_edit_<?php echo $row['id']; ?>">
                        <form action="main.php" method="post" name="editclform">
                            <div class="forml">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                    <input type="text" name="kundenname" value="<?php echo $row['client']; ?>" />
                                    <input type="text" name="todo" value="<?php echo $row['todo']; ?>" />
                                </div>          
                                <div class="row">
                                    <div class="select">            
                                        <select name="status">
                                            <option>Status auswählen</option>
                                            <option value="3">in Vorbereitung</option>
                                            <option value="2">in Umsetzung</option>
                                            <option value="1">abgeschlossen</option>
                                        </select>
                                    </div>                              
                                    <input type="text" name="who" class="editor" value="<?php echo $row['who']; ?>" />
                                </div> 
                            </div>
                            <div class="formr">
                                <i class="icon-remove"></i>
                                <!--<input type="submit" class="addcl" value="ToDo speichern">-->
                                <a href="#" onclick="document.forms['editclform'].submit()" class="submit"><i class="icon-save"></i><span>ToDo speichern</span></a>
                            </div>
                        </form>
                        <a href="main.php?deleteid=<?php echo $row['id'];?>" class="delete"><i class="icon-trash"></i><span>ToDo löschen</span></a>
                    </article>
                    <div class="status<?php echo $row['status'];?>">
                        
                    </div>
                </article>
                <?php }} ?>

                <div id="showfertig">            
                    <p>zeige abgeschlossene Aufgaben</p>
                </div>


                <?php 
                         mysql_data_seek($res, 0);
                        while($rowf = mysql_fetch_array($res)){
                        if ($rowf['kategorie'] == 1 && $rowf['status'] == 1) {
                    ?>

                <div class="fertig">
                    <article class="item" id="<?php echo $rowf['id']; ?>">
                    <div class="content">
                        <div class="iteml">
                            <h3><?php  echo $rowf['client']; ?></h3>
                            <span class="edit" id="edit_<?php echo $rowf['id']; ?>">
                                <i class="icon-pencil"></i>
                            </span>
                            <br/>
                            <p><?php echo $rowf['todo']; ?></p>
                        </div>
                        <div class="itemr">
                            <p><i class="icon-calendar"></i>
                                <span class="added">hinzugefügt am: 28.07.2013</span>
                            </p>
                            <p><i class="icon-male"></i>
                                <span class="added">Bearbeiter: <?php echo $rowf['who']; ?></span>
                            </p>
                        </div>
                    </div>                  
                    
                    
                    <div class="status<?php echo $rowf['status'];?>">
                        
                    </div>
                </article>             
                </div>

                <?php }} ?>
            </section>
            <section class="wrapper" id="coop-todos">
                <header class="coop">
                    <h2>co-op ToDo's</h2>
                    <a href="#" class="addcl-coop"><i class="icon-plus"></i><span>ToDo hinzufügen</span></a>
                </header>
                <article class="addclform-coop">
                        <form action="main.php" method="post" name="addcoop">
                            <div class="forml">
                                <div class="row">
                                    <input type="hidden" name="kundennamenew" value="co-op design" />
                                    <input type="text" name="todonew" placeholder="Todo eintragen..." />
                                    <input type="text" name="whonew" placeholder="Bearbeiter..." />
                                    <input type="hidden" name="kategorie" value="2">
                                </div>          
                                <div class="row">
                                    <div class="select">            
                                        <select name="statusnew">
                                            <option>Status auswählen</option>
                                            <option value="3">in Vorbereitung</option>
                                            <option value="2">in Umsetzung</option>
                                            <option value="1">abgeschlossen</option>
                                        </select>
                                    </div>                              
                                    
                                </div>                          
                            </div>
                            <div class="formr">
                                <i class="icon-remove" id="remove-addform-coop"></i>
                                <!--<input type="submit" value="speichern">-->
                                <a href="#" onclick="document.forms['addcoop'].submit()" class="submit"><i class="icon-save"></i><span>ToDo speichern</span></a>-->
                            </div>
                        </form>
                </article>
                <?php 
                mysql_data_seek($res, 0);
                while($rowc = mysql_fetch_array($res)){
                     if ($rowc['kategorie'] == 2 && $rowc['status'] != 1) {
                ?>
                <article class="item" id="<?php echo $rowc['id']; ?>">
                    <div class="content">
                        <div class="iteml">
                            <h3><?php echo $rowc['client']; ?></h3>
                            <span class="edit" id="edit_<?php echo $rowc['id']; ?>">
                                <i class="icon-pencil"></i>
                            </span>
                            <br/>
                            <p><?php echo $rowc['todo']; ?></p>
                        </div>
                        <div class="itemr">
                            <p><i class="icon-calendar"></i>
                                <span class="added">hinzugefügt am: 28.07.2013</span>
                            </p>
                            <p><i class="icon-male"></i>
                                <span class="added">Bearbeiter: <?php echo $rowc['who']; ?></span>
                            </p>
                        </div>
                    </div>                  
                    
                    <article class="form" id="over_edit_<?php echo $rowc['id']; ?>">
                        <form action="main.php" method="post" name="editcpform">
                            <div class="forml">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?php echo $rowc['id'];?>">
                                    <input type="text" name="kundenname" value="<?php echo $rowc['client']; ?>" />
                                    <input type="text" name="todo" placeholder="<?php echo $rowc['todo']; ?>" />
                                </div>          
                                <div class="row">
                                    <div class="select">            
                                        <select name="status">
                                            <option>Status auswählen</option>
                                            <option value="3">in Vorbereitung</option>
                                            <option value="2">in Umsetzung</option>
                                            <option value="1">abgeschlossen</option>
                                        </select>
                                    </div>                              
                                    <input type="text" name="who" class="editor" value="<?php echo $rowc['who']; ?>" />
                                </div>                          
                            </div>
                            <div class="formr">
                                <i class="icon-remove"></i>
                                <!--<input type="submit" value="speichern">-->
                                <a href="#" onclick="document.forms['editcpform'].submit()" class="submit"><i class="icon-save"></i><span>ToDo speichern</span></a>
                            </div>
                        </form>
                        <a href="main.php?deleteid=<?php echo $rowc['id'];?>" class="delete"><i class="icon-trash"></i><span>ToDo löschen</span></a>

                    </article>
                    <div class="status<?php echo $rowc['status'];?>">
                        
                    </div>
                </article>
                <?php }} ?>
               
               <div id="showfertig-coop">            
                    <p>zeige abgeschlossene Aufgaben</p>
                </div>


                <?php 
                         mysql_data_seek($res, 0);
                        while($rowcf = mysql_fetch_array($res)){
                        if ($rowcf['kategorie'] == 2 && $rowcf['status'] == 1) {
                    ?>

                <div class="fertig-coop">
                    <article class="item" id="<?php echo $rowcf['id']; ?>">
                    <div class="content">
                        <div class="iteml">
                            <h3><?php echo $rowcf['client']; ?></h3>
                            <span class="edit" id="edit_<?php echo $rowcf['id']; ?>">
                                <i class="icon-pencil"></i>
                            </span>
                            <br/>
                            <p><?php echo $rowcf['todo']; ?></p>
                        </div>
                        <div class="itemr">
                            <p><i class="icon-calendar"></i>
                                <span class="added">hinzugefügt am: 28.07.2013</span>
                            </p>
                            <p><i class="icon-male"></i>
                                <span class="added">Bearbeiter: <?php echo $rowf['who']; ?></span>
                            </p>
                        </div>
                    </div>                  
                    
                    
                    <div class="status<?php echo $rowcf['status'];?>">
                        
                    </div>
                </article>             
                </div>

                <?php }} ?>
            </section>
        </div>
        <script type="text/javascript">
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
        </script>
    </body>
</html>