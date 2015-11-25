 Code for Poets

<?php
/* %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
 * the purpose of this page is to display a list of poets, admin can edit
 * 
 * Written By: Gretchen Girdzis ggirdzis@uvm.edu
 */
// %^%^%^^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
require_once('../bin/Database.php');

$dbUserName = get_current_user() . '_writer';
$whichPass = "w"; //flag for which one to use.
$dbName = strtoupper(get_current_user()) . '_FINAL';

$thisDatabase = new Database($dbUserName, $whichPass, $dbName);





$admin = true;


include "top.php";

print "<article>";
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// prepare the sql statement
$orderBy = "ORDER BY pmkUsername";

$query = "SELECT pmkUsername, fldTitle, fldPost ";
$query .= "FROM tblPerson inner join tblPost on tblPerson.pmkId = tblPost.pmkUsername " . $orderBy;

if ($debug)
    print "<p>sql " . $query;


$post = $thisDatabase->select($query, "", 0, 1, 0, 0, false, false);
$info2 = $thisDatabase->testquery($query, "", 0, 1, 0, 0, false, false);

if ($debug) {
    print "<pre>";
    print_r($post);
    print "</pre>";
}

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// print out the results
print "<ol>\n";

foreach ($post as $onePost) {

    print "<li>";
    if ($admin) {
        print '<a href="update.php?id=' . $onePost["pmkUsername"] . '">[Edit]</a>';
        print '<a href="delete.php?id=' . $onePost["pmkUsername"] . '">[Delete]</a>';
        
    }
    print $onePost['fldTitle'] . " " . $onePost['fldPost']  ."</li>\n";
}
print "</ol>\n";
print "</article>";
include "footer.php";


