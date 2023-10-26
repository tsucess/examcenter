<?php
require "../config/database.php";
require "../php/all-filter-func.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates Data</title>
</head>
<body> 
    
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <section class="all_data">
        <form action="" enctype="multipart/form-data">
            <div class="all_report">
                <div class="control">
                    <div class="form_control">
                        <select name="filter" id="filter">
                            <option value="" disabled hidden selected>FILTER</option>
                            <option value="default">ALL</option>
                            <option value="year">YEAR ONLY</option>
                            <option value="yearsession">YEAR AND SESSION</option>
                        </select>
                    </div>
                </div>
                <div class="control">
                    <div class="form_control">
                        <select name="year" id="years">
                            <option disabled hidden selected>YEAR</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2020">2020</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
                        </select>
                    </div>
                    <div class="form_control">
                        <select name="session" id="sessions">
                            <option disabled hidden selected>SESSION</option>
                            <option value="1">MAY/JUNE</option>
                            <option value="0">OCT/NOV</option>
                        </select>
                    </div>
                    <div class="form_control">
                        <select name="student" id="students">
                            <option disabled hidden selected>STUDENTS</option>
                            <?php

                            $usersOption = getAllData();

                            if ($usersOption) {
                                foreach ($usersOption as $users) {
                            ?>
                                    <option value="<?= $users['student_id'] ?>"><?= "{$users['firstname']} {$users['lastname']}" ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="">No Student Registered</option>
                            <?php
                            }
    
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <main>
       
            <h2>Candidates Data</h2>
            <div class="table-responsive ">
                <table class="table table-bordered border-primary w-50" id="table_body">
                </table>
            </div>
        </main>
    </section>
    
    <script src="../js/filter.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>


