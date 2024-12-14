document.getElementById("date_my_appointments").addEventListener("input", filter);
document.getElementById("doctor_my_appointments").addEventListener("input", filter);
document.getElementById("expertise_my_appointments").addEventListener("input", filter);
document.getElementById("location_my_appointments").addEventListener("input", filter);

function filter() {


    let inputed_date = document.getElementById("date_my_appointments").value;
    let inputed_doctor = document.getElementById("doctor_my_appointments").value;
    let inputed_expertise = document.getElementById("expertise_my_appointments").value;
    let inputed_location = document.getElementById("location_my_appointments").value;


    if (!isEmpty(inputed_date)) {
        inputed_date = convertDateFormat(inputed_date);
    }

    if (inputed_doctor != "default") {
        inputed_doctor = inputed_doctor.split("_")[1];
    }

    if (inputed_expertise != "default") {
        inputed_expertise = inputed_expertise.split("_")[1];
    }

    if (inputed_location != "default") {
        inputed_location = inputed_location.split("_")[1];
    }

    function isEmpty(str) {
        return (!str || str.length === 0);
    }

    function convertDateFormat(dateString) {
        const [year, month, day] = dateString.split("-");
        return `${day}/${month}/${year}`;
    }


    let appointments = document.querySelectorAll('[id^="table_my_appointments_"]');
    console.log(appointments);

    appointments.forEach(function (appointments) {
        let elems = appointments.querySelectorAll('[id^="my_appointments_"]');

        if (elems[0].id.includes(inputed_date) || isEmpty(inputed_date)) {
            if (elems[3].id.includes(inputed_doctor) || inputed_doctor == "default") {
                if (elems[6].id.includes(inputed_expertise) || inputed_expertise == "default") {
                    if (elems[5].id.includes(inputed_location) || inputed_location == "default") {
                        appointments.removeAttribute("style");
                        return;
                    }
                }
            }
        }
        appointments.style.display ="none";
    });
}