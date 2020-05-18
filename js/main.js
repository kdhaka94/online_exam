const inputs = document.querySelectorAll(".input");


function addcl(){
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function remcl(){
    let parent = this.parentNode.parentNode;
    if(this.value === ""){
        parent.classList.remove("focus");
    }
}
$(document).ready(function () {

    $('.error').fadeIn().delay(5000).fadeOut();
    $('.info').fadeIn().delay(5000).fadeOut();
});


inputs.forEach(input => {
    input.addEventListener("focus", addcl);
    input.addEventListener("blur", remcl);
});





