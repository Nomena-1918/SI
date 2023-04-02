<?php
// security
defined('BASEPATH') OR exit('No direct script access allowed');
// --- 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/style_acc.css") ; ?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/tableau.css"); ?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/bootstrap/css/bootstrap.min.css");?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/fonts/fontawesome-free-6.3.0-web/css/all.css") ; ?>">
    <title>Code Journal</title>
</head>
<body>

    <nav class="navbar_perso">
        <a href="" class="logo"><img src="<?php echo site_url(""); ?>" alt="LOGO"></a>
        <div class="nav-links">
            <ul>
                <li class="activ"><a href="<?php echo site_url("Redir?var="); ?>"><i class="fas fa-home-lg-alt"></i> Acceuil</a></li>
                <li><a href="<?php echo site_url("Redir?var=load_jrn"); ?>"><i class="fa fa-list-alt"></i> Code journal</a></li>
                <li><a href="<?php echo site_url("Redir?var=load_compta"); ?>"><i class="fa fa-exchange"></i> Plan Comptable</a></li>
                <li><a href="<?php echo site_url("Redir?var=load_tier"); ?>"><i class="fa fa-add"></i> Plan Compte des Tiers</a></li>
                <li><a href="#"><i class="fa fa-sign-out"></i> Sign-out</a></li>         
            </ul>
        </div>
        <div class="menu-hamburger">
            <p>Menu</p>
            <img src="<?php echo site_url("assets/fonts/icon/menu_FILL0_wght400_GRAD0_opsz48.svg"); ?>" alt="">
        </div>
    </nav>

    <header>
    </header>


    <div class="main-table">

        <div class="contain-table">
        <h1 class="title"><center>Les codes Journaux</center></h1>
            <table border="1">
                <tr>
                    <th class="titre">Code</th>
                    <th class="titre"><center>Intitulé du Journaux</center></th>
                </tr>
            </table>
            <table class="table_to_update" id="my_update_table">

                <?php foreach ($code_jrn as $code){ ?>
                <tr id="<?php echo $code['id']; ?>">
                    <td class="component" id="tooltip" data-target="code_jrn">
                        <span  id="code_jrn"><a href=""><?php echo $code['code']; ?></a></span>
                    </td>
                    <td class="component" data-target="intitule">
                        <!-- data-role is to acces in jquery -->
                        <span  id="intitule_value"><a href="#?par=<?php echo $code['id']; ?>" id="open-popup" data-role="update" data-id="<?php echo $code['id']; ?>"><?php echo $code['intitule']; ?></a></span>
                    </td>
                </tr>
                <?php } ?>

            </table>
        </div>
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">open modal</button>
    </div>

    <div class="popup_container">

        <div class="popup">
            <button class="close-btn" onclick=>&times;</button>
            <!-- Modal -->
            <div id="myModal" class="" role="dialog"> 
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Journal :</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Code</label>
                            <input type="text" id="codejrn" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Libele</label>
                            <input type="text" id="intitule" class="form-control">
                        </div>
                        <input type="hidden" id="userId" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
                        <button type="button" id="ajout" class="btn btn-default" data-dismiss="modal">AJout</button>
                    </div>
                    </div>

                </div>
            </div>

        </div>
        
    </div>
    
    

</body>
    <script src="<?php echo site_url("assets/js/popup.js")?>"></script>
    <script src="<?php echo site_url("assets/js/jquery.min.js")?>"></script>
    <script>
        const menuHamburger = document.querySelector(".menu-hamburger");
        const navLinks = document.querySelector(".nav-links");

        menuHamburger.addEventListener("click", ()=>{
            navLinks.classList.toggle("mobile-menu")
        })

        $(document).ready(function(){
            $(document).on("click", "a[data-role=update]",function(){
                var id = $(this).data('id')
                var the_code = $('#' + id + ' #code_jrn a').text()
                var the_title = $('#' + id + ' #intitule_value a').text()
                $('#codejrn').val(the_code)
                $('#intitule').val(the_title)
                console.log(the_code);
                console.log(the_title);
                $('#userId').val(id)
                // var the_code = $('#' + id).children('td[data-target=code_jrn]').text()
                // var the_title = $('#' + id).children('td[data-target=intitule]').text()
            })
        })

        // update --------------------------------------
        $('#save').click(function(){
            var id = $('#userId').val()
            var the_code = $('#codejrn').val()
            var the_title = $('#intitule').val()

            $.ajax({
                url:'<?php echo site_url(); ?>InsertionCI/updatejrn',
                method:'post',
                data:{id : id, code : the_code, intitule : the_title},
                success: function(response){
                    console.log(response);
                    $('#' + id + ' #code_jrn a').text(the_code)
                    $('#' + id + ' #intitule_value a').text(the_title)
                    document.body.classList.remove("active-popup")
                    // $('#' + id).children('td[data-target=code_jrn]').text(the_code)
                    // $('#' + id).children('td[data-target=intitule]').text(the_title)
                }
            })
        })

        // xxxx -------------------------------------- 
        // insert -------------------------------------- 
        function readForm(){
            var formData = {}
            formData["codejrn"] = document.getElementById("codejrn").value
            formData["intitule"] = document.getElementById("intitule").value
            return formData
        }

        function insertnewRow(newData){
            var table = document.getElementById("my_update_table")
            var newRow = table.insertRow(table.length)

            newRow.id = "new id"

            cell1 = newRow.insertCell(0)
            cell1.innerHTML = newData.codejrn
            cell2 = newRow.insertCell(1)
            cell2.innerHTML = newData.intitule

        }

        $('#ajout').click(function(){
            var the_code = $('#codejrn').val()                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   n      
            var the_title = $('#intitule').val()
            var data = readForm()
            insertnewRow(data)

            $.ajax({
                url:'<?php echo site_url();?>InsertionCI/insertionjrn',
                method:'post',
                // dataType: "json",
                data:{code : the_code, intitule : the_title},
                success:function(response){
                    var data_json = jQuery.parseJSON(response)
                    alert(data_json.id)
                }
            })
        })
        // xxxx --------------------------------------

    </script>
</html>