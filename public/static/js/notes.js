function editNote(note) {
    let noteData = {
        job: $(`#${note}-job`).attr("data-attr"),
        target: $(`#${note}-employee`).attr("data-attr"),
        noteContent: $(`#${note}-note-content`).attr("data-attr"),
    };

    console.log(noteData);
    $("#edit-note-form").attr(
        "action",
        "/factory-dashboard/src/api/dashboard/update-note.php"
    );
    $("#target-job").val(noteData.job);
    $("#target-select").val(noteData.target);
    $("#note-content").val(noteData.noteContent);
    $("#note-id").val(note);
    $("#edit-note-form-container").removeClass("hidden");
}

function addNote() {
    $("#edit-note-form").attr(
        "action",
        "/factory-dashboard/src/api/dashboard/create-note.php"
    );
    $("#target-job").val(-999);
    $("#target-select").val(-999);
    $("#note-content").val("");
    $("#note-id").val(-999);
    $("#edit-note-form-container").removeClass("hidden");
}

function deleteNote(note) {
    $.post(
        "/factory-dashboard/src/api/dashboard/delete-note.php",
        `note_id=${note}`,
        () => {
            console.log(`Successfully Deleted Note: ${note}`);
            location.reload();
        }
    );
}
