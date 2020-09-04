<?php
require('Database.php');
$db = new Database();

if (isset($_POST['action']) && $_POST['action'] == 'view') {
    
    $data = $db->read();
    $mainArr = array();

    foreach ($data as $key => $value) {
       $subArr = array();
    
       $editBtn = "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#staticBackdrop' ><i class='fa fa-pencil' aria-hidden='true'></i></button>";
       $delBtn = "<a href='action.php?action=destroy&id=$value->id' class='btn btn-danger btn-sm' ><i class='fa fa-trash' aria-hidden='true'></i></a>";

       $subArr[] = $value->id;
       $subArr[] = $value->fname;
       $subArr[] = $value->lname;
       $subArr[] = $value->created_at;
       $subArr[] = $editBtn.' '.$delBtn;

       $mainArr[] = $subArr;

    }
    $output = array(
        "draw"                =>     intval($_POST["draw"]),
        "recordsTotal"        =>     $db->get_all_data(),
        "recordsFiltered"     =>     $db->get_all_data(),
        "data"                =>     $mainArr
   );

    echo json_encode($output);
}

if (isset($_GET['action']) && $_GET['action'] == 'destroy') {

    $id = $_GET['id'];
    $db->destroy($id);
    header('Location: http://localhost/proj_oop/');
}

if (isset($_POST['action']) && $_POST['action'] == 'insert') {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    $db->adduser($fname, $lname);
    header('Location: http://localhost/proj_oop/');
}