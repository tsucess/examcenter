const form = document.querySelector(".edit-form form.dashboard"),
saveBtn = document.querySelector(".edit-form form #save");
const cancelBtn = document.querySelector('#cancel');
const modalInactive = document.querySelector('#modal-edit-inactive1');
const modal = document.querySelector('#modal-edit');
const editBtn = document.querySelector('#user .btn-edit');
let errorText = document.querySelector(".error-txt");

form.onsubmit = (e) =>{
    e.preventDefault(); //preventing from from submitting
}

// Modal Control 
cancelBtn.onclick = () => {
    modal.classList.remove("active2");
    modalInactive.classList.remove("active2");
}

// form Id's
let id = document.querySelector('#userid');
let prev_avatar = document.querySelector('#prevavatar');
let prev_psword = document.querySelector('#prevpassword');
let fname = document.querySelector('#userfname');
let lname = document.querySelector('#userlname');
let pnumber = document.querySelector('#pno');
let dob = document.querySelector('#dobs');
let gender = document.querySelector('#gend');
let country = document.querySelector('#country');
let prev_nric = document.querySelector('#nricpassport');

editBtn.onclick = () => {

    let user_id = editBtn.getAttribute('id');

    // console.log(user_id);
    let xhr = new XMLHttpRequest();
    let url = "../php/fetch-edit-profile.php?id=" + user_id;

    xhr.open('GET', url, true)
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                modal.classList.add("active2");
                modalInactive.classList.add("active2");
                try {
                    let datas = JSON.parse(data);
                    id.value = datas.id;
                    prev_avatar.value = datas.avatar;
                    prev_psword.value = datas.password;
                    fname.value = datas.firstname;
                    lname.value = datas.lastname;
                    pnumber.value = datas.passport_no;
                    gender.value = datas.gender;
                    country.value = datas.nationality;
                    prev_nric.value = datas.passport;
                    dob.value = datas.dob;

                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
    xhr.send();
}



saveBtn.onclick = () =>{
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/edit-account-logic.php", true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                
                if (data === "success") {
                    location.href = "../admin/index.php";
                    modal.classList.remove("active2");
                    modalInactive.classList.remove("active2");
                    // message.textContent = "Profile Edited Successfully";
                    errorText.textContent = "Profile Edited successfully"; 
                    errorText.classList.add("matched");
                    errorText.style.display = "block";
                } else{
                    console.log(data);
                    errorText.textContent = "Unable to Edit Profile"; 
                    errorText.classList.remove("matched");
                    errorText.style.display = "block";  
                }
            }
        }
    }
    let formData =  new FormData(form); //creating new formData object
    xhr.send(formData); //sending the form data to php
}