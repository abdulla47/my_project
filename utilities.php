<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/7/2020
 * Time: 6:59 PM
 */


function check_empty_fields($required_fields_array){
    //hii array ina store error
    $form_errors=array();

    //loop kwa ajili ya kujzifatch error zote
    foreach ($required_fields_array as $name_of_fields){
        if(!isset($_POST[$name_of_fields])||$_POST[$name_of_fields]==null){
            $form_errors[]=$name_of_fields."jaza field zote tafadhali";
        }
    }
    return $form_errors;
}


function show_errors($form_errors_array){
    $errors = "<p><ul style='color: red;'>";

    //loop through error array and display all items in a list
    foreach($form_errors_array as $the_error){
        $errors .= "<li> {$the_error} </li>";
    }
    $errors .= "</ul></p>";
    return $errors;
}















?>