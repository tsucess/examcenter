// const modalInactive = document.querySelector('#modal-edit-inactive4');
const modalEdit = document.querySelector('#modal-edit-form4');
const subeditForm = document.querySelector("form#edit-document-form");
const canceleditBtn = document.querySelector('#cancel-edit-form');
const editBtn = document.querySelectorAll('.edit-document-btn');
const updateBtn = document.querySelector("form#edit-document-form #update-form");
// let errorText = document.querySelector(".error-txt");


// form Id's
let id  = document.querySelector('#edit_id');
let doc = document.querySelector('#form_thumbnail');
let receiver = document.querySelector('#students');
let form_title  = document.querySelector('#form_title');



subeditForm.onsubmit = (e) => {
    e.preventDefault(); //preventing from from submitting
}

// Modal Control 
canceleditBtn.onclick = () => {
    modalEdit.classList.remove("active2");
    modalInactive.classList.remove("active2");
}



editBtn.forEach( item => {
    item.onclick = () => {
        let form_id = item.getAttribute('id');

        // console.log(form_id);
        let xhr = new XMLHttpRequest();
        let url = "../php/fetch-edit-form.php?id="+form_id;

        xhr.open('GET', url, true)
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                        modalEdit.classList.add("active2");
                        modalInactive.classList.add("active2");
                        try {
                            let datas = JSON.parse(data);

                            id.value = datas.id;
                            form_title.value = datas.title;
                            doc.value = datas.document;
                            receiver.value = datas.receiver;
                            
                        } catch (error) {
                            console.log(error);
                        }
                      
                        
                }
            }
        }
        xhr.send();

    }
});



updateBtn.onclick = () => {
    
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/edit-form-logic.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                
                if (data === "success") {
                    modalEdit.classList.remove("active2");
                    modalInactive.classList.remove("active2");
                    location.href = "../admin/forms.php";
                    errorText.textContent = "form edited successfully"; 
                    errorText.classList.add("matched");
                    errorText.style.display = "block";
                } else {
                    console.log(data);
                    errorText.classList.remove("matched");
                    errorText.textContent = "Editing failed"; 
                    errorText.style.display = "block";

                }
                
            }
        }
    }
    let formData = new FormData(subeditForm); //creating new formData object
    xhr.send(formData);
}

