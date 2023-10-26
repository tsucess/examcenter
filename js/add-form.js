const formEdit = document.querySelector(".add-document-form form");
const modalInactive = document.querySelector('#modal-edit-inactive4');
const modalAdd = document.querySelector('#modal-add-form4');
// const modalAddStudent = document.querySelector('#modal-add-form5');
const dashboard = document.querySelector('.dashboard');
const cancelBtn = document.querySelector('#cancel-form');
const uploadBtn = document.querySelector(".add-document-form form #save-form");
// const uploadBtnStudent = document.querySelector(".add-document-form form #save-form-student");
const addBtn = document.querySelector("#add-form");
// const addBtnStudent = document.querySelector("#add-form-student");






formEdit.onsubmit = (e) => {
    e.preventDefault(); //preventing from from submitting
}



// Modal Control 
cancelBtn.onclick = () => {
    modalAdd.classList.remove("active2");
    modalInactive.classList.remove("active2");
}

addBtn.onclick = () => {
    modalAdd.classList.add("active2");
    modalInactive.classList.add("active2");
}

// addBtnStudent.onclick = () => {
//     modalAddStudent.classList.add("active2");
//     modalInactive.classList.add("active2");
// }




uploadBtn.onclick = () => {
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/add-form-logic.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                
                if (data === "success") {
                    location.href = "../admin/forms.php";
                    modalAdd.classList.remove("active2");
                    modalInactive.classList.remove("active2");
                    errorText.textContent = "Form added successfully"; 
                    errorText.classList.add("matched");
                    errorText.style.display = "block";
                } else {
                    console.log(data);
                    errorText.classList.remove("matched");
                    errorText.textContent = data; 
                    errorText.style.display = "block";

                }
            }
        }
    }
    let formData = new FormData(formEdit); //creating new formData object
    xhr.send(formData); //sending the form data to php
}

// uploadBtnStudent.onclick = () => {
//     // let's start Ajax 
//     let xhr = new XMLHttpRequest(); //creating XML object
//     xhr.open("POST", "../php/add-form-logic.php", true);
//     xhr.onload = () => {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 let data = xhr.response;
                
//                 if (data === "success") {
//                     location.href = "../admin/forms.php";
//                     modalAddStudent.classList.remove("active2");
//                     modalInactive.classList.remove("active2");
//                     errorText.textContent = "Form added successfully"; 
//                     errorText.classList.add("matched");
//                     errorText.style.display = "block";
//                 } else {
//                     console.log(data);
//                     errorText.classList.remove("matched");
//                     errorText.textContent = data; 
//                     errorText.style.display = "block";

//                 }
//             }
//         }
//     }
//     let formData = new FormData(formEdit); //creating new formData object
//     xhr.send(formData); //sending the form data to php
// }


