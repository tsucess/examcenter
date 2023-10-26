const chargesForm = document.querySelector("form#charges-form");
const chargesBtn = document.querySelector("form#charges-form #charges-btn");
let errorText = document.querySelector(".error-txt");



chargesForm.onsubmit = (e) => {
    e.preventDefault(); //preventing from from submitting
}

chargesBtn.onclick = () => {
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/charges-logic.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                // console.log(data);
                if (data === "success") {
                    location.href = "../admin/manage-charges.php";
                    errorText.textContent = "Charges/Coupon Code Successfully created"; 
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
    let formData = new FormData(chargesForm); //creating new formData object
    xhr.send(formData); //sending the form data to php
}

