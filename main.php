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
            theme
        </title>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,700,200' rel='stylesheet' type='text/css'>
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
    </head>
    <body>
        <header class="wrapper">
            <img src="images/logo-coop.png" alt="co-op design" /><h1>Arbeitet, Brüder!</h1>
            <div class="logout">
                <a href="logout.php"><i class="icon-off"></i><span>Logout</span></a>
            </div>
        </header>
        <section class="wrapper" id="kunden-todos">
            <header>
                <h2>Kunden ToDo's</h2>
                <a href="#" class="addcl"><i class="icon-plus"></i><span>ToDo hinzufügen</span></a>
            </header>
            <article class="addclform">
                    <form action="main.php" method="post">
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
                                        <option value="1">in Vorbereitung</option>
                                        <option value="2">in Umsetzung</option>
                                        <option value="3">abgeschlossen</option>
                                    </select>
                                </div>                              
                                <input type="text" name="whonew" class="editor" placeholder="Bearbeiter..." />
                            </div>                          
                        </div>
                        <div class="formr">
                            <i class="icon-remove" id="remove-addform"></i>
                            <input type="submit" value="speichern">
                            <!--<a href="#" class="submit"><i class="icon-save"></i><span>ToDo speichern</span></a>-->
                        </div>
                    </form>
            </article>
            <?php 

            while($row = mysql_fetch_array($res)){
                if ($row['kategorie'] == 1) {
            
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
                    <form action="main.php" method="post">
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
                                        <option value="1">in Vorbereitung</option>
                                        <option value="2">in Umsetzung</option>
                                        <option value="3">abgeschlossen</option>
                                    </select>
                                </div>                              
                                <input type="text" name="who" class="editor" value="<?php echo $row['who']; ?>" />
                            </div>                          
                        </div>
                        <div class="formr">
                            <i class="icon-remove"></i>
                            <input type="submit" value="speichern">
                            <!--<a href="#" class="submit"><i class="icon-save"></i><span>ToDo speichern</span></a>-->
                        </div>
                    </form>
                    <a href="main.php?deleteid=<?php echo $row['id'];?>" >delete</a>
                </article>
                <div class="status<?php echo $row['status'];?>">
                    
                </div>
            </article>
            <?php }} ?>
           

        </section>
        <section class="wrapper" id="coop-todos">
            <header>
                <h2>co-op ToDo's</h2>
                <a href="#" class="addcl-coop"><i class="icon-plus"></i><span>ToDo hinzufügen</span></a>
            </header>
            <article class="addclform-coop">
                    <form action="main.php" method="post">
                        <div class="forml">
                            <div class="row">
                                <input type="text" name="kundennamenew" placeholder="Kundenname eintragen..." />
                                <input type="text" name="todonew" placeholder="Todo eintragen..." />
                                <input type="hidden" name="kategorie" value="2">
                            </div>          
                            <div class="row">
                                <div class="select">            
                                    <select name="statusnew">
                                        <option>Status auswählen</option>
                                        <option value="1">in Vorbereitung</option>
                                        <option value="2">in Umsetzung</option>
                                        <option value="3">abgeschlossen</option>
                                    </select>
                                </div>                              
                                <input type="text" name="whonew" class="editor" placeholder="Bearbeiter..." />
                            </div>                          
                        </div>
                        <div class="formr">
                            <i class="icon-remove" id="remove-addform-coop"></i>
                            <input type="submit" value="speichern">
                            <!--<a href="#" class="submit"><i class="icon-save"></i><span>ToDo speichern</span></a>-->
                        </div>
                    </form>
            </article>
            <?php 
            mysql_data_seek($res, 0);
            while($rowc = mysql_fetch_array($res)){
                if ($rowc['kategorie'] == 2) {
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
                    <form action="main.php" method="post">
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
                                        <option value="1">in Vorbereitung</option>
                                        <option value="2">in Umsetzung</option>
                                        <option value="3">abgeschlossen</option>
                                    </select>
                                </div>                              
                                <input type="text" name="who" class="editor" value="<?php echo $rowc['who']; ?>" />
                            </div>                          
                        </div>
                        <div class="formr">
                            <i class="icon-remove"></i>
                            <input type="submit" value="speichern">
                            <!--<a href="#" class="submit"><i class="icon-save"></i><span>ToDo speichern</span></a>-->
                        </div>
                    </form>
                    <a href="main.php?deleteid=<?php echo $row['id'];?>" >delete</a>
                </article>
                <div class="status<?php echo $rowc['status'];?>">
                    
                </div>
            </article>
            <?php }} ?>
           

        </section>
        <script type="text/javascript">
            $(document).ready(function() {
                //hide addForm, editForm, editButton
                $(".form").hide();
                $(".addclform").hide();
                $(".addclform-coop").hide();
                $(".edit").hide();

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
        </script>
    </body>
</html>