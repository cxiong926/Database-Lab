<?php


/* TODO: INSERT more books  */



require_once('Template.php');
require_once("DB.class.php");

$db = new DB();

if (!$db->getConnStatus()) {
  print "An error has occurred with connection\n";
  exit;
}

$page = new Template('Lab 3'); // Automatically sets title

$page->addHeadElement('<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>');
$page->addHeadElement('<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>');
$page->addHeadElement('<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>');

$page->addHeadElement('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">');

$page->finalizeTopSection(); // Closes head section
$page->finalizeBottomSection(); // bottom section used for javascript (probably not needed)

$query = "SELECT * FROM bookinfo";

$result = $db->dbCall($query);
if (!$result) {
	//use friendly error messaging, not this:
	print "Error: " . var_dump($db->getDBError());
} 
else {
	//do something useful with the returnedvalue rather than var_dump
	//var_dump($result);

	print $page->getTopSection();


	print '<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">';
	print '<span class="navbar-brand mb-0 h1">Database Lab</span>';
	print '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
	print '<span class="navbar-toggler-icon"></span>';
	print '</button>';
	print '</nav>';


	print '<div class="container wrapper">';
	print '<h1>Query Results</h1>';

	print '<table class="table">';
	print '<thead>';
	print '<tr>';
	print '<th scope="col">ID</th>';
	print '<th scope="col">Time</th>';
	print '<th scope="col">Title</th>';
	print '<th scope="col">ISBN</th>';
	print '<th scope="col">Author</th>';
	print '<th scope="col">Status</th>';
	print '</tr>';
	print '</thead>';
	print '<tbody>';

		foreach ($result as $returnedvalue){
			print '<tr>';
			print '<td>' . $returnedvalue['id'] . '</td>';
			print '<td>' . $returnedvalue['inserttime'] . '</td>';
			print '<td>' . $returnedvalue['booktitle'] . '</td>';
			print '<td>' . $returnedvalue['isbn'] . '</td>';
			print '<td>' . $returnedvalue['author'] . '</td>';
			print '<td>' . $returnedvalue['status'] . '</td>';
			print '</tr>';  
		}

/* print '<td>' . $result[0]["id"] . '</td>';
print '<td>' . $result[0]["inserttime"] . '</td>';
print '<td>' . $result[0]["booktitle"] . '</td>';
print '<td>' . $result[0]["isbn"] . '</td>';
print '<td>' . $result[0]["author"] . '</td>';
print '<td>' . $result[0]["status"] . '</td>';
print '</tr>';  */


	//Reset result when done with it to prevent interfering with later calls.
	$result = false;
}

print '</tbody>';
print '</table>';
print '</div>';

print $page->getBottomSection(); // closes the html

?>