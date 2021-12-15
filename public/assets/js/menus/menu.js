document.addEventListener('DOMContentLoaded', function() {
    liEl = document.querySelectorAll('#nav-item');
    
    for (var i = 0; i < liEl.length; i++) {
        if (liEl[i].href == document.URL) {
            liEl[i].className += ' active'; 
            var parent = liEl[i].parentNode;
            parent.style.display = "block";
        }
    }

});


//Dropdown sidebar
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
            // dropdownContent.classList.remove("show-drop");
            // dropdownContent.classList.add("hidden-drop");
        } else {
            dropdownContent.style.display = "block";
            // dropdownContent.classList.remove("hidden-drop");
            // dropdownContent.classList.add("show-drop");

        }
    });
}