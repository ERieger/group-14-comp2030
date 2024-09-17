window.addEventListener("load", (event) => {
    console.log("Hello World!");
});

let settings = {
    chart: {
        type: "line",
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
                [3, 54],
                [5, 23],
                [15, 43],
            ],
        },
    ],
};

let chart = new Chart(document.querySelector("#overall-production"), settings);
chart.render();
