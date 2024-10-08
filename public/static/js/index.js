window.addEventListener("load", (event) => {
    console.log("Hello World!");
});

$.ajax({
    url: "/factory-dashboard/src/api/dashboard/fetch-logs.php",
    type: "GET",
    dataType: "json",
    data: {
        startTimestamp: "2024-04-01 00:00:00",
        endTimestamp: "2024-04-01 10:30:00",
        machine: "3D Printer",
    },
    success: (data) => {
        console.log(data);
        updatePage(data);
    },
    error: (jqXHR, textStatus, errorThrown) => {
        console.error("AJAX Error: ", textStatus, errorThrown);
    },
});

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

function updatePage(logs) {
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
    let statusGraphs = [
        "production",
        "power_consumption",
        "speed",
        "humidity",
        "temperature",
    ];

    statusGraphs.forEach((graph) => {
        console.log(graph);
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

        console.log(settings);

        let chart = new Chart($(`#${graph}`)[0], settings);
        chart.render();
    });
}
