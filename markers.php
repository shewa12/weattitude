<?php


// Start XML file, create parent node
$doc = domxml_new_doc("1.0");
$node = $doc->create_element("markers");
$parnode = $doc->append_child($node);

// Opens a connection to a MySQL server
$con=mysqli_connect ('localhost', "root","","dashboard");
if (!$con) {
  die('Not connected : ' . mysqli_error($con));
}


// Select all the rows in the markers table
$query = "SELECT * FROM locations";
$result = mysqli_query($con,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($con));
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  $node = $doc->create_element("marker");
  $newnode = $parnode->append_child($node);

  $newnode->set_attribute("id", $row['id']);
  $newnode->set_attribute("name", $row['location_name']);
  $newnode->set_attribute("address", $row['location_level']);
  $newnode->set_attribute("lat", $row['lat']);
  $newnode->set_attribute("lng", $row['lng']);
  $newnode->set_attribute("type", $row['parent_name']);
}

$xmlfile = $doc->dump_mem();
echo $xmlfile;

?>