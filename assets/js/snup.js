  //Toggle Password Visibility
  document.addEventListener("DOMContentLoaded", function(){
    const passField = document.getElementById("password");
    const togglePass = document.getElementById("togglePass");

    if(passField && togglePass){
        togglePass.addEventListener("click", () => {
            const isPass = passField.type === "password";
            passField.type = isPass ? "text" : "password";

            if(isPass){
                togglePass.classList.remove("bx-show");
                togglePass.classList.add("bx-hide");
            }else{
                togglePass.classList.remove("bx-hide");
                togglePass.classList.add("bx-show");
            }
        });
    }else{
        console.error("Password Field or Toggle Button not found");
    }
  })