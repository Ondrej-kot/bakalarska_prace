<!DOCTYPE html>
<?php require('propojeni_databaze_local.php');
session_start();
$_SESSION['time'] = time();?>
<html>
    <head>
        <title>PEF - Elektornické dokumenty </title>
        <link rel="stylesheet" href="opakovani_rocniku_style.css">
        <meta charset="UTF-8">
        <meta name="keywords" content="Provozně ekonomická fakulta, ČZU, uznávání žádostí, elektronické dokumenty, schvalování, uznání předmětu, opakování ročníku">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Systém pro uznávání elektronických žádostí Provozně ekonomické fakulty">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <link rel="shortcut icon" href="obrazky/favicon.ico" type="image/x-icon">
        <meta name="author" content="Ondřej Kotyk">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <main id="maincontent">
            <div>
                <div id="signpost">
                    <div>
                        <div id="form">
                            <h1><b>ŽÁDOST O OPAKOVÁNÍ ROČNÍKU</b></h1>
                            <form method="POST" action="generovani_opakovani.php">
                                <table style="width:100%">
                                    <tr>
                                        <td style="width:35%"></td>
                                        <td style="width:30%">
                                            <div id="year">
                                                <h4><b>Opakovaný ročník:</b></h4>
                                                <select name="rocnik">
                                                    <option value="první">1.Ročník</option>
                                                    <option value="druhý">2.Ročník</option>
                                                    <option value="třetí">3.Ročník</option>
                                                    <option value="čtvrtý">4.Ročník</option>
                                                    <option value="pátý">5.Ročník</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td style="padding-left:15%;" id="preview">
                                            <span>
                                                <h4>Náhled dokumentu</h4>
                                                <img src="./img/nahled_opakovani.jpg" width="150px" height="170px" alt="document_preview"/>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                                <table id="tabulka">
                                    <th>
                                        <h3 style="color:#bf0d0d"><b>Nesplněné předměty:</b></h3>
                                    </th>
                                    <th style="width:35%"></th>
                                    <th>
                                        <h3 style="color:#bf0d0d"><b>Splněné předměty:</b></h3>
                                    </th>
                                    <th style="width:35%"></th>
                                    <?php for ($x = 1; $x <= 11; $x++) { ?>                                                 
                                    <tr class="next <?php if($x > 5){echo 'hidden"';} ?>">
                                            <td>
                                                <h4><b>Kód předmětu:</b></h4>
                                                <input type="text" id="<?php echo "code$x" ?>" placeholder="Např. EXE05Z" name="<?php echo "kod_predmetu$x" ?>" value="">
                                            </td>
                                            <td>
                                                <h4><b>Název předmětu:</b></h4>
                                                <input type="text" id="<?php echo "search$x" ?>" placeholder="Název předmětu" name="<?php echo "nazev_predmetu$x" ?>">
                                                <div class="displaj" id="<?php echo "display$x" ?>"></div>
                                            </td>
                                            <?php $g = $x + 12; ?>
                                            <td>
                                                <h4><b>Kód předmětu:</b></h4>
                                                <input type="text" id="<?php echo "code$g" ?>" placeholder="Např. EXE05Z" name="<?php echo "kod_predmetu$g" ?>" value="">
                                            </td>
                                            <td>
                                                <h4><b>Název předmětu:</b></h4>
                                                <input type="text" id="<?php echo "search$g" ?>" placeholder="Název předmětu" name="<?php echo "nazev_predmetu$g" ?>">
                                                <div class="displaj" id="<?php echo "display$g" ?>"></div>
                                            </td>
                                        </tr>
                                    <?php } ?> 
                                </table>
                                <div id="add_subjects" onclick="myFunction();"><img id="nextbtn" src="./img/plus.png" width="40px" height="40px" alt="addsubjects"/><p>Přidat další předměty</p></div>
                               <input type="submit" value="Odeslat žádost">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function myFunction() {
                 $("tr").removeClass('hidden');
                 document.getElementById("add_subjects").style.display = "none";
                }
                /*AJAX --------------------------------------------------------*/
<?php for ($x = 0; $x <= 30; $x++) { ?>
                    function fill<?php echo $x; ?>(Value) {
                        //Assigning value to "search" div in "search.php" file.
                        $('#search<?php echo $x; ?>').val(Value);
                        $('#<?php echo $x; ?>').val(Value);
                        //Hiding "display" div in "search.php" file.
                        $('#display<?php echo $x; ?>').hide();
                    }
                    function fillCode<?php echo $x; ?>(Value) {
                        //Assigning value to "search" div in "search.php" file.
                        $('#code<?php echo $x; ?>').val(Value);
                    }

<?php } ?>

<?php for ($y = 0; $y <= 30; $y++) { ?>
                    $(document).ready(function () {
                        //On pressing a key on "Search box" in "search.php" file. This function will be called.
                        $("#search<?php echo $y; ?>").keyup(function () {
                            //Assigning search box value to javascript variable named as "name".
                            var name = $('#search<?php echo $y; ?>').val();
                            //Validating, if "name" is empty.
                            if (name == "") {
                                //Assigning empty value to "display" div in "search.php" file.
                                $("#display<?php echo $y; ?>").html("");
                            }
                            //If name is not empty.
                            else {
                                //AJAX is called.
                                $.ajax({
                                    //AJAX type is "Post".
                                    type: "POST",
                                    //Data will be sent to "ajax.php".
                                    url: "ajax.php",
                                    //Data, that will be sent to "ajax.php".
                                    data: {
                                        //Assigning value of "name" into "search" variable.
                                        search<?php echo $y; ?>: name
                                    },
                                    //If result found, this funtion will be called.
                                    success: function (html) {
                                        //Assigning result to "display" div in "search.php" file.
                                        $("#display<?php echo $y; ?>").html(html).show();
                                    }
                                });
                            }
                        });
                    });
<?php } ?>

            </script>

            <div style="position:absolute;display:none;">
                <!--WZ-REKLAMA-1.0-->
            </div>

        </main>
        <?php include 'footer.php'; ?>
    </body>
</html>
