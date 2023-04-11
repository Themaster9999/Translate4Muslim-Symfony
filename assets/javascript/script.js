// Create global variables
var sign = null;
var new_user = null;
var current_user = null;
var sign_in_div = null;
var sign_in_form_div = null;
var sign_up_form_div = null;
var isExpanded = false;
var tole = "210px";

// Main Function
window.onload = function () {
	
   sign = document.getElementById("sign-in");
   new_user = document.getElementById("new_user_span");
   current_user = document.getElementById("current_user_span");
   sign_in_div = document.getElementById("sign-in_area_div");
   sign_in_form_div = document.getElementById("sign_in_div_id");
   sign_up_form_div = document.getElementById("sign_up_div_id");

   
   function divHeightChange()
   {
	   	if (isExpanded) {
			sign_in_div.style.height = "0";
			sign_in_div.style.border = "0px solid grey";
			isExpanded = false;
		} else {
			sign_in_div.style.height = tole;
			sign_in_div.style.border = "1px solid grey";
			isExpanded = true;
		}
   }
   
   sign.addEventListener('click', function() {
	   divHeightChange();
   });
   
   new_user.addEventListener('click', function() {
		sign_in_form_div.style.display = "none";
		sign_up_form_div.style.display = "block";
		tole = "270px";
		isExpanded = false;
		divHeightChange();
   });
   
   current_user.addEventListener('click', function() {
		sign_up_form_div.style.display = "none";
		sign_in_form_div.style.display = "block";
		tole = "210px";
		isExpanded = false;
		divHeightChange();
   });
};

// Add a click event listener to the text element
