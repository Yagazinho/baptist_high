const toggleButton = document.querySelector("#darkToggle");
const sections = document.querySelectorAll("section");
toggleButton.addEventListener("click", () => {
sections.forEach(section => {
if(section.classList.contains("dark-mode")){
    //switch to light mode
    section.classList.remove("dark-mode");
} else{
    // switch to dark mode
    section.classList.add("dark-mode");
}
});


//update toggle button
if(toggleButton.classList.contains("bi-moon")){
toggleButton.classList.remove("bi-moon");
toggleButton.classList.add("bi-sun");
}else{
toggleButton.classList.remove("bi-sun");
toggleButton.classList.add("bi-moon");
}
})


const toggle = document.getElementById("themeToggle");
const header = document.querySelector(".header");

toggle.addEventListener("click", () => {
    const isDarkMode = document.body.classList.toggle('dark-mode');

    if(isDarkMode){
        header.classList.add("dark-mode")
    }else{
        header.classList.remove("dark-mode")
    }

});