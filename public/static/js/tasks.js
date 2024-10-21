window.addEventListener("load", (event) => {
    job = sessionStorage.getItem("job");
    if (job !== null) {
        $("#task-box").children().remove();
        renderTasks();
    }
});

function renderTasks() {
    $.ajax({
        url: "api/dashboard/fetch-job.php",
        type: "GET",
        dataType: "json",
        data: {
            job: job,
        },
        success: (data) => {
            console.log("Received Job: ", data);
            updateTask(data);
        },
        error: (jqXHR, textStatus, errorThrown) => {
            console.error("AJAX Error: ", textStatus, errorThrown);
        },
    });
}

function updateTask(data) {
    $("#task-box").children().remove();

    $("#task-box").append(`
    <table id="parts-table" class="table table-100">
        <tr class="text-toupper">
            <th>Item</th>
            <th>Quantity</th>
            <th>Assigned Machine</th>
            <th>Progress</th>
            <th>Actions</th>
        </tr>
        <tbody>
        </tbody>
    </table>`);

    data.parts.forEach((part) => {
        $("#parts-table tbody:last").append(`
            <tr>
                <td>${part.item}</td>
                <td>${part.qty}</td>
                <td>${part.machine_name}</td>
                <td>${part.progress} of ${part.qty}</td>
                <td><button onclick="updateTotal('inc', ${part.part_id})">Add Unit</button><button onclick="updateTotal('dec', ${part.part_id})">Remove Unit</button></td>
            </tr>
        `);
    });
}

function updateTotal(action, part) {
    $.post(
        "api/dashboard/update-part.php",
        {
            action: action,
            part: part,
        },
        (update) => {
            // console.log(update);
            location.reload();
        }
    );
}

function activateTask(job) {
    sessionStorage.setItem("job", job);
    window.location.href = "dashboard.php";
}
