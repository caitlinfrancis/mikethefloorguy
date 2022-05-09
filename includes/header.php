<head>
<html>
<script type="text/javascript"
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        // javascript & jquery code

    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
 
    $(window).on("load resize", function() {
    if (this.matchMedia("(min-width: 768px)").matches) {
        $dropdown.hover(
        function() {
            const $this = $(this);
            $this.addClass(showClass);
            $this.find($dropdownToggle).attr("aria-expanded", "true");
            $this.find($dropdownMenu).addClass(showClass);
        },
        function() {
            const $this = $(this);
            $this.removeClass(showClass);
            $this.find($dropdownToggle).attr("aria-expanded", "false");
            $this.find($dropdownMenu).removeClass(showClass);
        });
            } else {
                $dropdown.off("mouseenter mouseleave");
            }
    });
});
</script>

<head> 
<style type="text/css">
table {
margin: 1px;
}

th {
font-family: Arial, Helvetica, sans-serif;
font-size: 1.2em;
background: #666;
color: #FFFFFF;
padding: 2px 6px;
border-collapse: separate;
border: 1px solid #000;
}

td {
font-family: Arial, Helvetica, sans-serif;
font-size: 1em;
border: 1px solid #DDD;
}

.navbar .nav-item:not(:last-child) {
  margin-right: 35px;
}
 
.dropdown-toggle::after {
   transition: transform 0.15s linear; 
}
 
.show.dropdown .dropdown-toggle::after {
  transform: translateY(3px);
}
.dropdown-menu {
  margin-top: 0;
}

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
}
input[type=number] {
    -moz-appearance:textfield;
}

</style>
</head>
<body>

        <title>Customer Job Management</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    </head>
    
    <body style="padding-top: 80px;">            
    <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-inverse">
        
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                </button>
                <a class="navbar-brand">CUSTOMER<strong>MANAGEMENT</strong></strong>SYSTEM</a>
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                <?php
                include('includes/errorreporting.php');
                
                if ( $_SESSION['loggedInUser'] ) { // if user is logged in
                ?>
                <ul class="nav navbar-nav ml-auto">

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Invoices
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <a class="dropdown-item" href="add_invoice.php">Add Invoice</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="invoice.php">View & Edit Invoices</a>
                        <div class="dropdown-divider"></div>
                    </div>
                    </li>
                    
                    
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Customers
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                    <a class="dropdown-item" href="add.php">Add Customer</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="customer.php">View & Edit Customers</a>
                        <div class="dropdown-divider"></div>
                    </div>
                    </li>
                    
                    <li><a href="">Profitability Reports&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                    <li><a href="adduserdb.php">Add System User&nbsp;</a></li>
                    <li><a href="states.php">Add System User&nbsp;</a></li>

                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <p class="navbar-text">Logged In: <?php echo $_SESSION['loggedInUser']; ?></p>

                    <li><a href="logout.php">| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Log out</a></li>
                </ul>
                <?php
                } else {
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="login.php">Login</a></li>
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