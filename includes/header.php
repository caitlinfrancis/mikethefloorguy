<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Customer Job Management</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body style="padding-top: 60px;">            
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">

        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="coverpage.php">CUSTOMER<strong>MANAGEMENT</strong></strong>SYSTEM</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">
                
                <?php
                include('includes/errorreporting.php');
                
                if ( $_SESSION['loggedInUser'] ) { // if user is logged in
                ?>
                <ul class="nav navbar-nav">
                    <li><a href="customer.php">Customer Contact Information</a></li>
                    <li><a href="invoice.php">Quote/Invoice Information</a></li>
                    <li><a href="">Job Details</a></li>
                    <li><a href="add.php">Add Customer</a></li>
                    <li><a href="adduserdb.php">Add System User</a></li>
                    <li><a href="">Profitability</a></li>

                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <p class="navbar-text">Logged In  | <?php echo $_SESSION['loggedInUser']; ?></p>

                    <li><a href="logout.php">Log out</a>/li>
                </ul>
                <?php
                } else {
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Login</a></li>
                </ul>
                <?php
                }
                ?>

            </div>

        </div>

    </nav>
        
    <div class="container">