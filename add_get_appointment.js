if (!is_doctor()) {
    console.log("oui");
    document.getElementById("available_doctors").addEventListener("input", filter());
    document.getElementById("available_locations").addEventListener("input", filter());

}




function filter() {
    console.log("hope");
    let available_appointment_time_slot = document.getElementById("patient_available_appointments").value;
    let inputed_doctor = document.getElementById("selected_available_doctor").value;
    let inputed_location = document.getElementById("selected_available_location").value;

    console.log(inputed_doctor);
    console.log(available_appointment_time_slot);
    console.log(inputed_location);

}

function is_doctor() {
    if (document.getElementById("user_type").innerHTML == 'doctor') {
        return true;
    }
    if (document.getElementById("user_type").innerHTML == 'patient') {
        return false;
    }
}