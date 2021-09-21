console.log("OK Testing!")
myNotes()
function func() {
    var txt = document.getElementById('noteTxt')
    var notes = localStorage.getItem("notes")
    var notesObj = []
    if (notes == null) {
        notesObj = []
    }
    else {
        notesObj = JSON.parse(notes)
    }
    if (txt.value == "") {

    }
    else {
        notesObj.push(txt.value)
        localStorage.setItem('notes', JSON.stringify(notesObj))
        txt.value = ""
        myNotes()
    }
}
function myNotes() {
    var notes = localStorage.getItem("notes")
    var notesObj = []
    if (notes == null) {
        notesObj = []
    }
    else {
        notesObj = JSON.parse(notes)
    }
    let note = ""
    notesObj.forEach(function (e, index) {
        note += `<div class="mx-2 my-2 card" style="width: 18rem;">
        <div class="card-body">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Note ${index + 1}</label>
                <p class="card-text">${e}</p>
            </div>
            <button id="${index}" class="btn btn-primary" onclick="removeNote(this.id)">Remove</button>
        </div>
    </div>`
    })
    var noteE = document.getElementById('notes')
    if (notesObj.length != 0) {
        noteE.innerHTML = note
    }
    else {
        noteE.innerHTML = "You haven't added any notes! Try using Add a note..."
    }
}

function removeNote(index){
    var notesObj=[]
    console.log(notesObj instanceof Array)
    if (notes == null) {
        notesObj = []
    }
    else {
        notesObj = notes
        notesObj=Object.values(notesObj)
        // console.log(notesObj instanceof Array)
    }
    notesObj.splice(index,1)
    localStorage.setItem('notes', JSON.stringify(notesObj))
    myNotes()
}
// var btn=document.getElementById('okBtn')
// btn.addEventListener('click',function(e){
//     var txt=document.getElementById('noteTxt')
//     var notes=localStorage.getItem("notes")
//     if(notes==null){
//         notesObj=[]
//     }
//     else{
//         notesObj=JSON.parse(notes)
//     }
//     notesObj.push(txt.value)
//     localStorage.setItem('notes',JSON.stringify(notesObj))
//     txt.value=""
// })