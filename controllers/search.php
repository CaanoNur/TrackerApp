<?php
require_once "../model/model.php";
require_once "common.php";

if (isset($_POST['search'])) {
    // Get the search term
    $search_term = $_POST['search_term'];
    // Execute the query
    $data = search_projects("SELECT * FROM projects WHERE title LIKE '%$search_term%'");
  }


require "../views/search.php";

?>