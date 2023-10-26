const couponform = document.querySelector("form.coupon");
const applyBtn = document.querySelector("#apply_coupon");
let input = document.querySelector(".reg_form");
// let errorText = document.querySelector(".error-txt");


couponform.onsubmit = (e) => {
    e.preventDefault(); //preventing from from submitting
}


applyBtn.onclick = () => {
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/coupon-logic.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                
                if (data === "success") {
                    window.location.reload();
                    console.log(data);
                    errorText.textContent = "Enjoy a Discount from each Course you registered"; 
                    errorText.classList.add("matched");
                    errorText.style.display = "block";
                    input.value = "";
                   
                } else {
                    console.log(data);
                    errorText.classList.remove("matched");
                    errorText.textContent = data; 
                    errorText.textContent = "Coupon Code Expired";
                    errorText.style.display = "block";
                    input.value = "";

                }
            }
        }
    }
    let formData = new FormData(couponform); //creating new formData object
    xhr.send(formData); //sending the form data to php
}