<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>wDiscovery</title>


    <?php $this->load->view('include/headerTop') ?>


    <style type="text/css">
        /*Whole Project*/
        body {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 1.625;
            /*font-weight: bold;*/
        }

        /*Login Screen*/
        .divContent {
            width: 25%;
            margin-top: 100px;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: white;
            border-radius: 10px;

        }

        #imageLogo {
            text-align: center;
        }

        /*  */

        /* */
        /* */
        /* */

        #cellContent {
            border: 1px solid gray;
            width: 50%;
            height: 150px;
            background-color: white;
        }

        #cellStatus {
            height: 100%;
            width: 20px;
            background-color: green;
            float: left;
        }

        #cellTitle {
            /*float: left;*/
        }

        #cellCenterContent {
            padding-left: 40px;
        }

        #tableContent {
            width: 60%;
            margin: 0 auto;
            height: 120px;
            border-spacing: 20px;
            border-collapse: separate;
        }

        #tableCell {

            height: 100%;
            border: 1px solid gray;
            box-shadow: 5px 5px 10px 1px #BCBCBC;
        }

        #cellRightContent {
            width: 150px;
            height: 100%;
            /*background-color: yellow;*/
            float: right;
        }

        #cellLabelContent {
            font-size: 14px;
            font-weight: bold;
        }

        #cellLabelTitle {
            font-size: 12px;
        }

        #cellLabelMainTitle {
            font-size: 18px;
            font-weight: bold;
        }

        .divOrdenacao {
            /*background-color: red;*/
        }

        .dropdown-toggle {
            font-size: 12px;
        }

        .dropdown-item {
            font-size: 12px;
        }

        .divStatus {
            font-size: 5px;
        }

        .spanTitleLegenda {
            font-size: 10px;
        }

        a:link#aSortingTable {
            text-decoration: none;
            color: gray;
        }

        a:visited#aSortingTable {
            text-decoration: none;
            color: gray;
        }

        a:hover#aSortingTable {
            text-decoration: none;
            color: gray;
        }

        a:active#aSortingTable {
            text-decoration: none;
            color: gray;
        }

        a:link#aWithoutFormation {
            text-decoration: none;
            color: black;
        }

        a:visited#aWithoutFormation {
            text-decoration: none;
            color: black;
        }

        a:hover#aWithoutFormation {
            text-decoration: none;
            color: black;
        }

        a:active#aWithoutFormation {
            text-decoration: none;
            color: black;
        }

        body {
            background-image: url("<?php echo base_url('assets/img/wallpaper.jpg') ?>");
        }
    </style>


</head>

<body>
    <div class="container-fluid divContent">
        <div class="row">
            <div class="col">

                <div id="imageLogo">

                    <img src="<?php echo base_url('assets/img/newLogo.png') ?>">

                </div>
                <br /><br />
                <div class="row justify-content-center">
                    <div class="col-11">
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" placeholder="Digite o e-mail" name="LOGIN">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-11">
                        <div class="form-group">
                            <input type="password" class="form-control" id="pwd" placeholder="Digite a senha" name="SENHA">
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-11">
                        <button id="submitForm" class="btn btn-primary float-right">Entrar</button>
                        <br />
                    </div>

                </div>

            </div>
        </div>
    </div>

    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalLoginIncorreto') ?>


    <script>
        removeSpinner();

        $('#submitForm').click(function() {
            var login = $('#email').val();
            var pwd = $('#pwd').val();

            $.ajax({
                url: "<?php echo base_url(); ?>login/performLogin",
                dataType: 'json',
                type: 'POST',
                data: {
                    login: login,
                    pwd: pwd
                },
                success: function(data) {
                    if (data.statusCode == 404) {
                        $("#modalLoginIncorreto").modal("show");
                    } else {
                        window.open('<?php echo base_url("home") ?>', '_self');
                    }

                },
                error: function(x) {
                    console.log(x.responseText);
                }

            });


        });
    </script>
</body>

</html> 