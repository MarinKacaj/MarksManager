<?php ?>
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
                <span style="color: #269abc;">UPT </span>MarksManager
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav pull-right">
                <li><a href="">Menu1<span class="sr-only">(current)</span></a></li>
                <li><a href="">Menu2</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="well text-center" id="mainTitle"><h4>TITULL</h4></div>
    <form id="kerkoStudentetSezon" class="form-horizontal">
        <div class="well col-sm-4 col-sm-offset-4">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="">Emer</label>
                <h5 class="col-sm-8">
                    Emri-real
                </h5>
                <label class="col-sm-2"><a data-toggle="collapse" href="#collapseEmer" aria-expanded="false" aria-controls="collapseEmer"><i class="fa fa-edit"></i></a></label>
                <div id="collapseEmer" class="col-sm-10 col-sm-offset-2 collapse">
                    <input type="text" class="form-control" placeholder="Emer">
                </div>
            </div>
            <button type="submit" id="execKerkoStudentet" class="btn btn-primary pull-right">PUSH</button>
        </div>
    </form>
</div>
</body>
</html>
