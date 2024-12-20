function is_doctor() {
    if (document.getElementById("user_type").innerHTML == 'doctor') {
        return true;
    }
    if (document.getElementById("user_type").innerHTML == 'patient') {
        return false;
    }
}


if (is_doctor()) {
    document.getElementById("my_patients").addEventListener("input", filter);
} else {
    document.getElementById("my_doctors").addEventListener("input", filter);
}

function filter() {
    let inputed_lastname = document.getElementById("last_name").value;
    let inputed_firstname = document.getElementById("first_name").value;
    console.log(inputed_lastname);
    console.log(inputed_firstname);

    let available_person = document.querySelectorAll(".my_poc_table");
    
    available_person.forEach(function (available_person) {
        var elems = available_person.querySelectorAll('[id^="my_poc_"]');
        //console.log(elems);

        console.log(elems[0].id.includes(inputed_lastname) || inputed_lastname == "");
        console.log(elems[1].id.includes(inputed_firstname) || inputed_firstname == "");

        var last_name = elems[0].id.split("_")[3];
        var first_name = elems[1].id.split("_")[3];

        if (last_name.toLowerCase().includes(inputed_lastname.toLowerCase()) || inputed_lastname == "") {
            if (first_name.toLowerCase().includes(inputed_firstname.toLowerCase()) || inputed_firstname == "") {
                available_person.removeAttribute("style");
                return;
            }
        }
        available_person.style.display = "none";
    });
}

function isEmpty(str) {
    return (!str || str.length === 0);
}