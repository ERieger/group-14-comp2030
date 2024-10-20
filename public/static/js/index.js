window.addEventListener("load", (event) => {
    console.log("Hello World!");
    fetchOverviewData();
    fetchMachineData();

    job = sessionStorage.getItem("job");
    if (job !== null) {
        renderTasks();
    }
});

function renderTasks() {
    $.ajax({
        url: "/factory-dashboard/src/api/dashboard/fetch-job.php",
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

let job;
let machine = "3D Printer";
let start = "2024-04-13 02:30:00";
let end = "2024-04-13 21:00:00";

$("#filter-form").submit(function (e) {
    e.preventDefault();
    machine = $("#machine-select").val();
    start = $("#start").val();
    end = $("#end").val();

    $("canvas").remove();
    // $("#logs-table tr").not(":first").remove();
    $(".paging-nav").remove();
    $("#machine-name").text(`Machine Status: ${machine}`);

    $("#logs-table").remove();
    $("#logs-table-container").append(`
    <table id="logs-table" class="table">
        <tr class="text-toupper">
            <th>Timestamp</th>
            <th>Name</th>
            <th>Status</th>
            <th>Error Code</th>
            <th>Maintenance</th>
            <th>Production</th>
            <th>Vibration</th>
            <th>Humidity</th>
            <th>Power</th>
            <th>Speed</th>
        </tr>
    </table>`);

    fetchOverviewData();
    fetchMachineData();
});

function fetchMachineData() {
    console.log("Requesting Machine Data", {
        startTimestamp: start,
        endTimestamp: end,
        machine: machine,
    });
    $.ajax({
        url: "/factory-dashboard/src/api/dashboard/fetch-logs.php",
        type: "GET",
        dataType: "json",
        data: {
            startTimestamp: start,
            endTimestamp: end,
            machine: machine,
        },
        success: (data) => {
            console.log("Received Machine Data: ", data);
            updateMachine(data);
        },
        error: (jqXHR, textStatus, errorThrown) => {
            console.error("AJAX Error: ", textStatus, errorThrown);
        },
    });
}

function fetchOverviewData() {
    console.log("Requesting Overview Data: ", {
        startTimestamp: start,
        endTimestamp: end,
        machine: "*",
    });
    $.ajax({
        url: "/factory-dashboard/src/api/dashboard/fetch-logs.php",
        type: "GET",
        dataType: "json",
        data: {
            startTimestamp: start,
            endTimestamp: end,
            machine: "*",
        },
        success: (data) => {
            console.log("Retrieved Overview Data: ", data);
            updateOverview(data);
        },
        error: (jqXHR, textStatus, errorThrown) => {
            console.error("AJAX Error: ", textStatus, errorThrown);
        },
    });
}

function formatDataSeries(logs) {
    let data = {
        humidity: [],
        power_consumption: [],
        pressure: [],
        production: [],
        speed: [],
        temperature: [],
        vibration: [],
    };

    logs.forEach((log) => {
        let tSEpoch = new Date(log.timestamp);
        data.humidity.push([tSEpoch, log.humidity]);
        data.power_consumption.push([tSEpoch, log.power_consumption]);
        data.pressure.push([tSEpoch, log.pressure]);
        data.production.push([tSEpoch, log.production]);
        data.speed.push([tSEpoch, log.speed]);
        data.temperature.push([tSEpoch, log.temperature]);
        data.vibration.push([tSEpoch, log.vibration]);
    });

    return data;
}

function summariseSeries(data) {
    let total = 0;
    let items = 0;
    let summarised = [];

    data.sort((a, b) => new Date(a[0]) - new Date(b[0]));

    for (let i = 0; i < data.length; i++) {
        const currentVal = parseFloat(data[i][1]);

        if (i > 0 && Date.parse(data[i][0]) === Date.parse(data[i - 1][0])) {
            total += currentVal;
            items++;
        } else {
            if (i > 0) {
                summarised.push([
                    new Date(data[i - 1][0]),
                    (total / items).toFixed(2),
                ]);
            }
            total = currentVal;
            items = 1;
        }
    }

    if (items > 0) {
        summarised.push([
            new Date(data[data.length - 1][0]),
            (total / items).toFixed(2),
        ]);
    }

    return summarised;
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
            </tr>
        `);
    });
}

function updateOverview(logs) {
    let data = formatDataSeries(logs);
    let dataTemp = {
        humidity: summariseSeries(data.humidity),
        power_consumption: summariseSeries(data.power_consumption),
        pressure: summariseSeries(data.pressure),
        production: summariseSeries(data.production),
        speed: summariseSeries(data.speed),
        temperature: summariseSeries(data.temperature),
        vibration: summariseSeries(data.vibration),
    };

    // console.log(dataTemp);

    data = dataTemp;

    let statusGraphs = [
        "production",
        "power_consumption",
        "speed",
        "humidity",
        "temperature",
    ];

    statusGraphs.forEach((graph) => {
        // console.log(graph);
        let settings = {
            chart: {
                type: "stepline", // Line, Stepline, Smooth Line
                style: {
                    fill: "#007bff48", // --primary-50p
                    stroke: "#007bff", // --primary
                },
                pointSize: 3,
                xAxis: {
                    scale: "none",
                    ticks: 10,
                },
                yAxis: {
                    scale: "none",
                    ticks: 10,
                },
            },
            stroke: {
                curve: "smooth",
            },
            series: [
                {
                    data: data[graph],
                },
            ],
        };

        // console.log(settings);

        let chart = new Chart($(`#${graph}`)[0], settings);
        chart.render();
    });
}

function updateMachine(logs) {
    $("#machine-name").text(`Machine Status: ${machine}`);

    logs.forEach((log) => {
        $("#logs-table tr:last").after(`
        <tr>
            <td>${log.timestamp}</td>
            <td>${log.machine_name}</td>
            <td>${log.status}</td>
            <td>${log.error_code}</td>
            <td>${log.maintenance_log}</td>
            <td>${log.production}%</td>
            <td>${log.vibration} g</td>
            <td>${log.humidity}%</td>
            <td>${log.power_consumption} W</td>
            <td>${log.speed} RPM</td>
        </tr>
        `);
    });

    $("#logs-table").paging({ limit: 7 });

    let data = formatDataSeries(logs);
    let machineGraphs = [
        "production",
        "power_consumption",
        "speed",
        "humidity",
        "temperature",
    ];

    machineGraphs.forEach((graph) => {
        // console.log(graph);
        let settings = {
            chart: {
                type: "stepline", // Line, Stepline, Smooth Line
                style: {
                    fill: "#007bff48", // --primary-50p
                    stroke: "#007bff", // --primary
                },
                pointSize: 3,
                xAxis: {
                    scale: "none",
                    ticks: 10,
                },
                yAxis: {
                    scale: "none",
                    ticks: 10,
                },
            },
            stroke: {
                curve: "smooth",
            },
            series: [
                {
                    data: data[graph],
                },
            ],
        };

        // console.log(settings);

        let chart = new Chart($(`#m-${graph}`)[0], settings);
        chart.render();
    });
}
