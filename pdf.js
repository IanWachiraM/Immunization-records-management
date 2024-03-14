
 function checkStatus() {
    var newPatient = document.getElementById("new_patient");
    var existingPatient = document.getElementById("existing_patient");
            
        if (newPatient.checked) {
            window.location.href ="childdetails.html";
        } else if (existingPatient.checked) {
            window.location.href ="dashboard.html";
        } else {
            alert("No option has been selected");
        }
    }
            