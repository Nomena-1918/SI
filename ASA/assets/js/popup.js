var btnEl = document.querySelectorAll("#open-popup")
var btnClose  = document.querySelector(".popup .close-btn")

// action
for(i = 0; i < btnEl.length; i++) {
    btnEl[i].addEventListener("click", addClasses_fun);
}
btnClose.addEventListener("click", remove_popup)
// ---
// function
function addClasses_fun(){
    document.body.classList.add("active-popup");
}
function remove_popup(){
    document.body.classList.remove("active-popup");
}

// function readForm(){
//     var formData = {}
//     formData["codejrn"] = document.getElementById("codejrn").value
//     formData["intitule"] = document.getElementById("intitule").value
//     return formData
//     // `${site_url()}InsertionCI/updatejrn`
// }

// function insertnewRow(newData){
//     var table = document.getElementById("my_update_table")
//     var newRow = table.insertRow(table.length)

//     newRow.id = "new id"

//     cell1 = newRow.insertCell(0)
//     cell1.innerHTML = newData.codejrn
//     cell2 = newRow.insertCell(1)
//     cell2.innerHTML = newData.intitule

// }