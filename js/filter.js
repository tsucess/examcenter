let filter = document.getElementById("filter");
let year = document.getElementById("years");
let session = document.getElementById("sessions");

let tBody = document.getElementById("table_body");
let optionTag = document.getElementById("students");

filter.addEventListener('change', () => {

    if (filter.value == 'default') {
        session.style.display = "none";
        year.style.display = "none";
        All();
    } else if (filter.value == 'year') {
        year.style.display = "flex";
        session.style.display = "none";
        year.addEventListener('change', yearOnly);


    } else if (filter.value == 'yearsession') {
        year.style.display = "flex";
        session.style.display = "flex";
        session.addEventListener('change', yearSession);

    } else {
        session.style.display = "none";
        year.style.display = "none";

    }

    optionTag.addEventListener('change', studentData);

});


function All() {
    let filters = 'all';
    let filterValue = filter.value;
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (this.readyState == 4 & this.status == 200) {
            if (xhr.status == 200) {
                let datas = JSON.parse(xhr.response);
                let data = datas;
                let output = "";
                console.log(datas);
 
                if (datas != "success") {
                    console.log(data);
                    output += `<option disabled hidden selected>STUDENTS</option>`;
                    for (let item of data) {
                        output += `
                        <option value="${item.id}">${item.firstname} ${item.lastname} ${item.id}</option>
                        `;
                    }
                } else {
                    output += `
                        <option value="">No Student Registered</option>
                        `;

                }
                optionTag.innerHTML = output;

            }
        }
    }


    xhr.open('POST', "./php/all-filter-func.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('filtervalue=' + filterValue + '&filters=' + filters);
}

function yearOnly() {
    let filters = 'year';
    let filterValue = year.value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', "../php/all-filter-func.php", true);
    xhr.onload = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                let datas = JSON.parse(xhr.response);
                let data = datas;
                let output = "";
                console.log(datas);

                if (datas != "success") {
                    console.log(data);
                    output += `<option disabled hidden selected>STUDENTS</option>`;
                    for (let item of data) {

                        output += `
                        <option value="${item.student_id}">${item.firstname} ${item.lastname} ${item.id}</option>
                        `;
                    }
                } else {
                    output += `
                        <option value="">No Student Registered</option>
                        `;

                }
                optionTag.innerHTML = output;

            }

        }
    }

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('filtervalue=' + filterValue + '&filters=' + filters);
}


function yearSession() {
    let filters = 'yearsession';
    let filterYearValue = year.value;
    let filterValue = session.value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', "../php/all-filter-func.php", true);
    xhr.onload = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                let datas = JSON.parse(xhr.response);
                let data = datas;
                let output = "";
                console.log(datas);

                if (datas != "success") {
                    console.log(data);
                    output += `<option disabled hidden selected>STUDENTS</option>`;
                    for (let item of data) {

                        output += `
                        <option value="${item.student_id}">${item.firstname} ${item.lastname} ${item.id}</option>
                        `;
                    }
                } else {
                    output += `
                        <option value="">No Student Registered</option>
                        `;

                }
                optionTag.innerHTML = output;

            }


        }
    }

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('filtervalue=' + filterValue + '&filteryearvalue=' + filterYearValue + '&filters=' + filters);
}


function studentData() {
    let studentId = optionTag.value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', "../php/all-filter-func.php", true);
    xhr.onload = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                let datas = JSON.parse(xhr.response);
                let data = datas;
                let output = "";

                if (datas != "success") {

                    for (let item of data) {
                        output += `
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Student Data</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr>
                                    <th scope="row">Photo:</th>
                                    <td><div id="std_passport"><img src="../img/avatar/${item.avatar}" alt="Profile Image"></div></td>
                                </tr>
                                <tr>
                                    <th scope="row">Full Name:</th>
                                    <td>${item.firstname} ${item.lastname}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Date of Birth:</th>
                                    <td>${item.dob}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Gender:</th>
                                    <td>${item.gender == 1 ? 'MALE' : 'FEMALE'}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Passport: </th>
                                    <td><div id="std_passport"><img src="../img/passport/${item.passport}" alt="Profile Image"></div></td>
                                </tr>
                                <tr>
                                    <th scope="row">NIRC/Passport Number: </th>
                                    <td>${item.passport_no}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nationality</th>
                                    <td>${item.nationality}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Student Email</th>
                                    <td>${item.email}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Student Number</th>
                                    <td>${item.student_phone_no}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Parent Email</th>
                                    <td>${item.parent_email}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Students Number</th>
                                    <td>${item.parent_phone_no}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Subjects</th>
                                    <td>${item.subject}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Year</th>
                                    <td>${item.year}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Previous candidate no</th>
                                    <td>${item.prev_candidate_no}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Previous center no</th>
                                    <td>${item.prev_center_no}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Payment Status</th>
                                    <td>${item.payment_status}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Session</th>
                                    <td>${item.session == 1 ? 'MAY/JUNE' : 'OCT/NOV'}</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td><a href="invoice.php?id=${item.student_id}&page=all" class="btn btn-success">Print Invoice</a> </td>
                                </tr>

                            </tbody>
                        `;
                    }
                } else {
                    output += `
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan= "2">No Result Found</td>
                        </tr>
                    </tbody>
                    `;

                }
                tBody.innerHTML = output;
            }

        }
    }

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('studId=' + studentId);
}