


let currStudent = document.getElementById("current_student");
let studentId = document.getElementById("student_id");
let schName = document.getElementById("sch_name");
let note = document.querySelector("#note");

let freshCandidate = document.getElementById("fresh_candidate");
let prevCandidateDetails = document.getElementById("prev_candidate_details");


currStudent.addEventListener('change', () => {
    if (currStudent.value == 1) {
        studentId.style.display = "flex";
        note.style.display = "flex";
        schName.style.display = "none";
        
    } else if(currStudent.value == 2){
        studentId.style.display = "flex";
        schName.style.display = "flex";
        note.style.display = "none";
    } else {
        studentId.style.display = "none";
        schName.style.display = "flex";
        note.style.display = "none";
    }

});

freshCandidate.addEventListener('change', () => {
    if (freshCandidate.value == 1) {
        prevCandidateDetails.style.display = "none";
    } else {
        prevCandidateDetails.style.display = "grid";
    }
});