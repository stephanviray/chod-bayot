const inputs = document.querySelectorAll(".contact-input");
const toggleBtn = document.querySelector(".theme-toggle");
const allElements = document.querySelectorAll("*");

toggleBtn.addEventListener("click", () => {
  document.body.classList.toggle("dark");

  allElements.forEach(el => {
    el.classList.add("transition");
    setTimeout(() => {
      el.classList.remove("transition");
    }, 1000);
  });
});

inputs.forEach(input => {
  input.addEventListener("focus", () => {
  	input.parentNode.classList.add("focus");

  	// will change font-size for the input label 
  	input.parentNode.classList.add("not-empty");
  });
  input.addEventListener("blur", () => {
  	// will remove font-size for the input label 
  	if(input.value == "") {
  	  input.parentNode.classList.remove("not-empty");
  	}
  	input.parentNode.classList.remove("focus");
  });
});

// TODO: add theme toggle
