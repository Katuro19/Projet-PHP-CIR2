document.addEventListener("DOMContentLoaded", function() {
    if (!is_doctor()) {
        filter();
        filter_doctors();
        document.getElementById("selected_available_doctor").addEventListener("change", filter);
        document.getElementById("selected_available_location").addEventListener("change", filter);
        document.getElementById("selected_available_expertise").addEventListener("change", filter_doctors);
    }
});

function filter_doctors(){
    let inputed_expertise = document.getElementById("selected_available_expertise").value;
    if(inputed_expertise != "default"){
        inputed_expertise = inputed_expertise.split("_")[1];
    }

    let available_doctors = document.querySelectorAll('[value^="doctor_"]');

    available_doctors.forEach(doctor => {
        let associated_expertise = doctor.value.split("_")[2];
         if(inputed_expertise == associated_expertise){
            doctor.removeAttribute("style");
         } else {
            doctor.style.display = "none";
         }
    });
}


function filter() {
    let inputed_doctor = document.getElementById("selected_available_doctor").value;
    let inputed_location = document.getElementById("selected_available_location").value;

    if (inputed_location != "default") {
        inputed_location = inputed_location.split("_")[1];
    }

    if (inputed_doctor != "default") {
        inputed_doctor = inputed_doctor.split("_")[1];
    }

    let available_appointment_time_slot = document.querySelectorAll('[id^="appointment_"]');

    available_appointment_time_slot.forEach(slot => {

        let classList = slot.className.split("-");
        let doctor_id = classList.find(cls => cls.startsWith("doctor_"))?.split("_")[1];
        let location_id = classList.find(cls => cls.startsWith("location_"))?.split("_")[1];

        // if (inputed_location === "default" || inputed_location === "default") {
        //     slot.style.display = "none";
        // }
        if (doctor_id === inputed_doctor && location_id === inputed_location) {
            slot.removeAttribute("style");
        } else {
            slot.style.display = "none";
        }
    });
}

function is_doctor() {
    if (document.getElementById("user_type").innerHTML == 'doctor') {
        return true;
    }
    if (document.getElementById("user_type").innerHTML == 'patient') {
        return false;
    }
}