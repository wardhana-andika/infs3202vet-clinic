
/* start of own functions */

/* hide/show divs in faqs.html and services.html */
/* show 1 div is achieved by hiding all, then show 1*/

/* runs when services.html loads*/
window.onload = function(){
	hideallservices();
	document.getElementById("consult").style.display = "block";
}

function hideallservices(){
	document.getElementById("consult").style.display = "none";
	document.getElementById("behaviour").style.display = "none";
	document.getElementById("diet").style.display = "none";
	document.getElementById("surgery").style.display = "none";
}

function unfocusall(){
	document.getElementById("option1").className = "list-group-item";
	document.getElementById("option2").className = "list-group-item";
	document.getElementById("option3").className = "list-group-item";
	document.getElementById("option4").className = "list-group-item";
}

/*  services.html local links */
function clickconsult() {
	hideallservices();
	document.getElementById("consult").style.display = "block";
	unfocusall();
	document.getElementById("option1").className = "list-group-item active";
	
}

function clickbehaviour() {
	hideallservices();
	document.getElementById("behaviour").style.display = "block";
	unfocusall();
	document.getElementById("option2").className = "list-group-item active";
}

function clickdiet() {
	hideallservices();
	document.getElementById("diet").style.display = "block";
	unfocusall();
	document.getElementById("option3").className = "list-group-item active";
}

function clicksurgery() {
	hideallservices();
	document.getElementById("surgery").style.display = "block";
	unfocusall();
	document.getElementById("option4").className = "list-group-item active";
}


/* the following two functions are partially own work */
/* regex courtesy of stackoverflow.com by user Fabian http://stackoverflow.com/questions/2507030/email-validation-using-jquery */

/* validates forms by checking if essential fields are empty, then checks email address format */
/* validates enquiry form */
function validateForm1() {
    var x = document.forms["enquiry"]["name"].value;
	var y = document.forms["enquiry"]["email"].value;
	var z = document.forms["enquiry"]["message"].value;
    if (x == null || x == "" || y == null || y == "" || z == null || z == "") {
        alert("Name, Email, and Enquiry message cannot be empty");
        return false; 
    }
	
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (regex.test(y))  
	  {  
		return true;
	  }  
		alert("You have entered an invalid email address.")  
		return false;
}

/* validates booking form */
function validateForm2() {
    var x = document.forms["login-form"]["email"].value;
	var y = document.forms["login-form"]["password"].value;
    if (x == null || x == "" || y == null || y == "") {
        document.getElementById("error-msg").innerHTML = "Email and password field cannot be empty";
        return false;
    }
	
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (regex.test(z))  
	  {  
		return true;
	  }  
		document.getElementById("error-msg").innerHTML = "You have entered an invalid email address"
		alert("You have entered an invalid email address.")  
		return false;
}


/*  google maps javascript source: https://developers.google.com/maps/documentation/javascript/ */
function initialize() {
  var myLatlng = new google.maps.LatLng(-27.570617,153.060514);
  var mapOptions = {
    zoom: 15,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hello World!'
  });
}


google.maps.event.addDomListener(window, 'load', initialize);

