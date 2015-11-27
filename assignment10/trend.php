<?php

include("top.php");
$hash = "";

if (isset($_POST["btnSubmit"])) {
$hash = htmlentities($_POST["lsthash"], ENT_QUOTES, "UTF-8");
$dataRecord[] = $hash;
}
?>

<form action="<?php print $phpSelf; ?>"
          method="post"
          id="frmRegister">
<?php
require_once('../bin/Database.php');
$dbUserName = get_current_user() . '_writer';
$whichPass = "w"; //flag for which one to use.
$dbName = strtoupper(get_current_user()) . '_FINAL';

$thisDatabase = new Database($dbUserName, $whichPass, $dbName);

// Step Two: code can be in initialize variables or where step four needs to be
$query = "SELECT pmkHash ";
$query .= "FROM tblInterest ";
$query .= "ORDER BY fldHashId";


// Step Three: code can be in initialize variables or where step four needs to be
// $buildings is an associative array
$buildings = $thisDatabase->select($query, "", 0, 1, 0, 0, false, false);






$message = '<label for="lsthash">Trend"';
$message .= '<select id="lsthash" ';
$message .= '        name="lsthash"';
$message .= '        tabindex="300" >';


?>
    <div id = "trend">
    <?php
// or you can print it out
print '<label for="lsthash">Trend ';
print '<select id="lsthash" ';
print '        name="lsthash"';
print '        tabindex="300" >';


foreach ($buildings as $row) {

print '<option ';

if ($hash == $row["pmkHash"])
print " selected='selected' ";

print 'value="' . $row["pmkHash"] . '">' . $row["pmkHash"];



print '</option>';
}







print '</select></label>';
?>
<fieldset class = "buttons">
<legend></legend>
<input type = "submit" id = "btnSubmit" name = "btnSubmit" value = "Register" tabindex = "900" class = "button">

</fieldset>
        
</div>
    <hr>
<?php
print '<table>';

$columns = 4;

//now print out each record

$query2 = 'select fldTitle, fldPost, fldTrendingValue, fldFirstName from tblPost inner join tblPerson on tblPost.pmkUsername = tblPerson.pmkId where fldTrendingValue = "'. $hash . '"';
//$info4 = $thisDatabaseReader->testquery($query2, "", 1, 0, 2, 0, false, false);
$info4 = $thisDatabaseReader->select($query2, "", 1, 0, 2, 0, false, false);

$highlight = 0; // used to highlight alternate rows

//print "<p>Total Records:".count($info4).'</p>';
// print '<p>SQL'.$query.'</p>';


foreach ($info4 as $rec) {

$highlight++;
if ($highlight % 2 != 0) {
$style = ' odd ';
} else {
$style = ' even ';
}


print '<tr class="' . $style . '">';

for ($i = 0;
$i < $columns;
$i++) {


print '<td>' . $rec[$i] . '</td>';

}

print '</tr>';

}

// all done
print '</table>';
print '</aside>';

print '</article>';
?>

        </form>



</article>

<?php include "footer.php"; ?>



</body>
</html>