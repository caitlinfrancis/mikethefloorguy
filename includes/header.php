
    <head>

    <html>
<head>
<title>...</title>
<style type="text/css">
table {
margin: 1px;
}

th {
font-family: Arial, Helvetica, sans-serif;
font-size: 1.2em;
background: #666;
color: #FFF;
padding: 2px 6px;
border-collapse: separate;
border: 1px solid #000;
}

td {
font-family: Arial, Helvetica, sans-serif;
font-size: 1em;
border: 1px solid #DDD;
}
</style>
</head>
<body>




    <title><?php echo TITLE; ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Customer Job Management</title>

  
        <script type="text/javascript">   
                    window.onload = function() {

                    jQuery('#customer_fname','customer_lname',).attr('maxlength','2');
                        }
                    </script> 


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

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
                <a class="navbar-brand" >CUSTOMER<strong>MANAGEMENT</strong></strong>SYSTEM</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">
                
                <?php
                include('includes/errorreporting.php');
                
                if ( $_SESSION['loggedInUser'] ) { // if user is logged in
                ?>
                <ul class="nav navbar-nav">
                    <li><a href="add_invoice.php">Add Invoice &nbsp;</a></li>
                    <li><a href="invoice.php">Review and Edit Invoice Information &nbsp;</a></li>
                    <li><a href="">Profitability Reports</a></li>
                    <li><a href="customer.php">Customer Contact Information&nbsp;</a></li>
                    <li><a href="add.php">Add Customer&nbsp;</a></li>
                    <li><a href="adduserdb.php">Add System User&nbsp;</a></li>


                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <p class="navbar-text">Logged In: <?php echo $_SESSION['loggedInUser']; ?></p>

                    <li><a href="logout.php">| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Log out</a></li>
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


    </body>
</html>