<?php 
if( !$_SESSION['loggedInUser'] ) {
    
header("Location: index.php");
}


include('includes/connection.php');


$columns = array('customer_fname','customer_lname','customer_email','customer_phonenum','customer_company','street_address','city','state','zip');
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';



$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
$add_class = ' class="highlight"';
?>