<?php

include_once 'php_action/db_connect.php';

if(isset($_post["export"])):
{
/* vars for export */
// database record to be exported
/* vars for export */
// database record to be exported
$db_record = 'XXX_TABLE_NAME_XXX';
// optional where query
$where = 'WHERE 1 ORDER BY 1';
// filename for export
$csv_filename = 'db_export_'.$db_record.'_'.date('Y-m-d').'.csv';
// database variables
//$hostname = "XXX_HOSTNAME_XXX";
//$user = "XXX_USER_XXX";
//$password = "XXX_PASS_XXX";
//$database = "XXX_DATABASE_XXX";
//$port = 3306;



// create empty variable to be filled with export data
$csv_export = '';


$sql = "select * from cliente";
$query = mysqli_query($connect, $sql);
$field = mysqli_field_count($connect);
// query to get data from database


// create line with field names
for($i = 0; $i < $field; $i++) {
    $csv_export.= mysqli_fetch_field_direct($query, $i)->name.';';
}

// newline (seems to work both on Linux & Windows servers)
$csv_export.= '';

// loop through database query and fill export variable
while($row = mysqli_fetch_array($query)) {
    // create line with field values
    for($i = 0; $i < $field; $i++) {
        $csv_export.= '"'.$row[mysqli_fetch_field_direct($query, $i)->name].'";';
    }
    $csv_export.= '';
}

// Export the data and prompt a csv file for download
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);
}
endif;
?>