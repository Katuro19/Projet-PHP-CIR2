if (is_doctor()) {
    document.getElementById("patient_my_past_appointments").addEventListener("input", filter);
} else {
    document.getElementById("doctor_my_past_appointments").addEventListener("input", filter);
}

document.getElementById("expertise_my_past_appointments").addEventListener("input", filter);
document.getElementById("location_my_past_appointments").addEventListener("input", filter);

function filter() {

    let inputed_user;
    if (is_doctor()) {
        inputed_user = document.getElementById("patient_my_past_appointments").value;
    } else {
        inputed_user = document.getElementById("doctor_my_past_appointments").value;
    }
    let inputed_expertise = document.getElementById("expertise_my_past_appointments").value;
    let inputed_location = document.getElementById("location_my_past_appointments").value;

    if (inputed_user != "default") {
        inputed_user = inputed_user.split("_")[1];
    }

    if (inputed_expertise != "default") {
        inputed_expertise = inputed_expertise.split("_")[1];
    }

    if (inputed_location != "default") {
        inputed_location = inputed_location.split("_")[1];
    }

    let appointments = document.querySelectorAll('[id^="table_my_past_appointments_"]');

    appointments.forEach(function (appointments) {
        let elems = appointments.querySelectorAll('[id^="my_past_appointments_"]');
        if (elems[3].id.includes(inputed_user) || inputed_user == "default") {
            if (elems[5].id.includes(inputed_expertise) || inputed_expertise == "default") {
                if (elems[4].id.includes(inputed_location) || inputed_location == "default") {
                    appointments.removeAttribute("style");
                    return;
                }
            }
        }
        appointments.style.display = "none";
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