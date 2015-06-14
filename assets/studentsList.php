<!DOCTYPE html>
<html>
<head>
    <title>Logged in: Profesor filani</title>

    <meta name="viewport" content="width = device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="fonts/fontawesome-webfont.ttf" rel="stylesheet">

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>

</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <span id="logo">UPT </span>MarksManager
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav pull-right">
                <li><a onclick="">Filtro rezultatet<span class="sr-only">(current)</span></a></li>
                <li><a href="#">Vlereso</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="well text-center" id="mainTitle"><h4>TITULL</h4></div>
    <div class="row">
        <div id="listaVleresoStudente" class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>Actions</th>
                        <th>Emer</th>
                        <th>Mbiemer</th>
                        <th>Grupi</th>
                        <th>Dega</th>
                        <th>Viti i fillimit</th>
                    </thead>
                    <tbody>
                    <?php ?>
                        <tr>
                            <form class="form-inline">
                                <td>
                                    <a href="#"><i class="fa fa-user-times fa-2x pull-left"></i></a>
                                    <a href="editStudent.php"><i class="fa fa-user fa-2x pull-right"></i></a>
                                </td>
                                <td>
                                    <h5>Mbiemri1</h5>
                                </td>
                                <td>
                                    <h5>Emri1</h5>
                                </td>
                                <td>
                                    <h5>Grupi1</h5>
                                </td>
                                <td>
                                    <h5>Dega1</h5>
                                </td>
                                <td>
                                    <h5>Viti i fillimit1</h5>
                                </td>
                            </form>
                        </tr>
                    <?php ?>
                    </tbody>
                    <tfoot>
                        <th>END</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
