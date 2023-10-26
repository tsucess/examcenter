<?php


function connect()
{
    // connect to the database;
    $dbconnect =  new mysqli("localhost", 'success', 'Taofeeq1993@', 'exam_website');

    if (mysqli_error($dbconnect)) {
        die(mysqli_error($dbconnect));
    } else {
        return $dbconnect;
    }
}



if (isset($_POST['filtervalue'])) {
    $filtervalue = $_POST['filtervalue'];
    $filter = $_POST['filters'];
    if ($filter === "all") {
        $subjects = getAllData();
        echo json_encode($subjects);
    } else if ($filter === "year") {

        $subjects = getDataByYear($filtervalue);
        echo json_encode($subjects);
    } else if ($filter === "yearsession") {
        $filteryearvalue = $_POST['filteryearvalue'];
        $subjects = getYearSession($filtervalue, $filteryearvalue);
        echo json_encode($subjects);
    }
}

if (isset($_POST['studId'])) {
    $studentdata = getStudentData($_POST['studId']);
    echo json_encode($studentdata);
}


function getAllData()
{
    $dbconnect = connect();

    //fetch all forms from database
    $query = "SELECT rs.*, u.*  FROM registered_subjects rs, users u WHERE student_id=u.id AND payment_status = 'success'";
    $users = mysqli_query($dbconnect, $query);

    if (mysqli_num_rows($users) > 0) {
        while ($user = mysqli_fetch_assoc($users)) {
            $userss[] = $user;
        }
        return $userss;
    } else {
        return "success";
    }
}

function getAllFormData($userId)
{
    $dbconnect = connect();

    //fetch all forms from database
    $query = "SELECT * FROM users WHERE id = '$userId' ";
    $users = mysqli_query($dbconnect, $query);

    if (mysqli_num_rows($users) > 0) {
        while ($user = mysqli_fetch_assoc($users)) {
            $userss[] = $user;
        }
        return $userss;
    } else {
        return "success";
    }
}

function getAllStudData()
{
    $dbconnect = connect();

    //fetch all forms from database
    $query = "SELECT *  FROM users";
    $users = mysqli_query($dbconnect, $query);

    if (mysqli_num_rows($users) > 0) {
        while ($user = mysqli_fetch_assoc($users)) {
            $userss[] = $user;
        }
        return $userss;
    } else {
        return "success";
    }
}


function getDataByYear($filtervalue)
{
    $dbconnect = connect();
    //fetch all forms from database
    $query = "SELECT rs.*, u.*  FROM registered_subjects rs, users u WHERE student_id=u.id AND year = '$filtervalue' AND payment_status = 'success'";
    $users = mysqli_query($dbconnect, $query);

    if (mysqli_num_rows($users) > 0) {
        while ($user = mysqli_fetch_assoc($users)) {
            $userss[] = $user;
        }
        return $userss;
    } else {
        return "success";
    }
}


function getYearSession($filter, $filteryear)
{
    $dbconnect = connect();
    //fetch all forms from database
    $query = "SELECT rs.*, u.*  FROM registered_subjects rs, users u WHERE student_id=u.id AND year = $filteryear AND session = '$filter' AND payment_status = 'success' ";
    $users = mysqli_query($dbconnect, $query);

    if (mysqli_num_rows($users) > 0) {
        while ($user = mysqli_fetch_assoc($users)) {
            $userss[] = $user;
        }
        return $userss;
    } else {
        return "success";
    }
}


function getStudentData($studentId)
{
    $dbconnect = connect();
    //fetch all forms from database
    $query = "SELECT rs.*, u.*  FROM registered_subjects rs, users u WHERE student_id=u.id AND student_id = '$studentId'";
    $users = mysqli_query($dbconnect, $query);

    if (mysqli_num_rows($users) > 0) {
        // while ($user = mysqli_fetch_assoc($users)) {
            $user = mysqli_fetch_assoc($users);
            $userss[] = $user;
        // }
        return $userss;
    } else {
        return "success";
    }
}
