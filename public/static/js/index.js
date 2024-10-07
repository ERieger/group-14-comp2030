window.addEventListener("load", (event) => {
    console.log("Hello World!");
});

$.ajax({
    url: "/factory-dashboard/src/api/dashboard/fetch-logs.php",
    type: "GET",
    dataType: "json",
    data: {
        startTimestamp: "2024-04-01 00:00:00",
        endTimestamp: "2024-04-01 00:00:00"
    },
    success: (data) => {
        console.log(data);
    },
    error: (jqXHR, textStatus, errorThrown) => {
        console.error("AJAX Error: ", textStatus, errorThrown);
    }
});


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
            data: [
                [1, 34],
                [3, 38],
                [5, 40],
                [10, 35],
                [15, 37],
                [20, 40],
                [30, 25],
            ],
        },
    ],
};

let chart = new Chart(document.querySelector("#overall-production"), settings);
chart.render();
