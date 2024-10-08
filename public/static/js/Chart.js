class Chart {
    constructor(element, settings) {
        this.chartArea = this.makeCanvas(element);
        this.chartCtx = this.chartArea.getContext("2d");
        this.size = this.chartArea.getBoundingClientRect();

        this.settings = settings;

        this.xUpper = Infinity;
        this.xLower = -Infinity;
        this.yUpper = Infinity;
        this.yLower = -Infinity;

        this.xTickRange;
        this.yTickRange;
        this.adjustedXTick;
        this.adjustedYTick;

        this.xScale = 1;
        this.yScale = 1;

        this.adjustedXY = [];

        // console.log(this.settings);

        addEventListener("resize", (event) => {
            // console.log("Window resized!");
            this.chartArea.remove();
            this.chartArea = this.makeCanvas(element);
            this.chartCtx = this.chartArea.getContext("2d");
            this.size = this.chartArea.getBoundingClientRect();
            this.render();
        });
    }

    // Create a canvas to fit the size of parent container
    makeCanvas(element) {
        // Create canvas and get size of container
        let canvas = document.createElement("canvas");
        let size = element.getBoundingClientRect();
        /* Size variable in format:
        {
            width: x,
            height: y,
            top: z,
            bottom: a,
            left: b,
            right: c
        }*/
        // console.log(size);

        // Set size of canvas to be static, set unique id based on parent
        canvas.width = size.width;
        canvas.height = size.height;
        canvas.id = `${element.id}-chart`;

        element.appendChild(canvas);
        // console.log(canvas);
        return canvas;
    }

    // Round tick to an appropriate nice number
    roundTick(value) {
        let appropriateTicks = [
            100, 50, 25, 10, 5, 2, 1, 0.5, 0.2, 0.1, 0.05, 0.01,
        ]; // Defined appropriate ticks
        let current = appropriateTicks[0];

        appropriateTicks.forEach((tick) => {
            if (Math.abs(value - tick) < Math.abs(value - current)) {
                current = tick;
            } // If the difference between the value and tick is less than the current tick starting from 100 choose the closest tick
        });

        return current;
    }

    // Scale chart plot range
    scaleValues() {
        // Initialize to infinity to ensure all numbers are either larger or smaller.
        let xMax = -Infinity;
        let yMax = -Infinity;
        let xMin = Infinity;
        let yMin = Infinity;

        // Find the min/max values
        this.settings.series[0].data.forEach((point) => {
            xMax = Math.max(xMax, point[0]);
            xMin = Math.min(xMin, point[0]);
            yMax = Math.max(yMax, point[1]);
            yMin = Math.min(yMin, point[1]);
        });

        // Calculate range of dataset
        this.xRange = xMax - xMin;
        this.yRange = yMax - yMin;

        // Buffer points to minimise plotting over edge
        const buffer = 0.1;
        this.xRange *= 1 + buffer;
        this.yRange *= 1 + buffer;

        // Calculate rough tick value based on requested number of ticks
        this.xTickRange = this.xRange / this.settings.chart.xAxis.ticks;
        this.yTickRange = this.yRange / this.settings.chart.yAxis.ticks;

        // Round tick to a nice scale
        this.adjustedXTick = this.roundTick(this.xTickRange);
        this.adjustedYTick = this.roundTick(this.yTickRange);

        // Set lower and upper range
        this.xLower = xMin;
        this.xUpper = xMax;
        this.yLower = yMin;
        this.yUpper = yMax;

        // Debug message
//         console.log(`
// xLower: ${this.xLower}
// xUpper: ${this.xUpper}
// yLower: ${this.yLower}
// yUpper: ${this.yUpper}
// adjustedXTick: ${this.adjustedXTick}
// adjustedYTick: ${this.adjustedYTick}
// xRange: ${this.xRange}
// yRange: ${this.yRange}
//         `);
    }

    // Function to draw a point at arbitrary coordinate
    drawPoint(x, y, size, fill, stroke) {
        this.chartCtx.beginPath();
        this.chartCtx.arc(x, y, size, 0, 2 * Math.PI, true);
        this.chartCtx.fillStyle = typeof fill == undefined ? "grey" : fill;
        this.chartCtx.strokeStyle =
            typeof stroke == undefined ? "grey" : stroke;
        this.chartCtx.fill();
        this.chartCtx.stroke();
    }

    // Render line connecting all the points
    renderStepline(fill, stroke) {
        this.chartCtx.beginPath();
        this.chartCtx.moveTo(0, this.adjustedXY[0][1]);
        let prevCoordinate = this.adjustedXY[0];
        this.chartCtx.strokeStyle =
            typeof stroke == undefined ? "black" : stroke;

        this.adjustedXY.forEach((point) => {
            this.chartCtx.lineTo(point[0], prevCoordinate[1]);
            this.chartCtx.lineTo(point[0], point[1]);
            prevCoordinate = point;
        });

        this.chartCtx.lineTo(this.size.width, prevCoordinate[1]);
        this.chartCtx.lineTo(this.size.width, this.size.height);
        this.chartCtx.lineTo(0, this.size.height);
        this.chartCtx.lineTo(0, this.adjustedXY[0][1]);

        this.chartCtx.fillStyle = typeof fill == undefined ? "grey" : fill;
        this.chartCtx.closePath();
        this.chartCtx.stroke();
        this.chartCtx.fill();
    }

    // Main chart render function
    render() {
        // console.log("Rendering");
        // Clear canvas
        this.chartCtx.clearRect(0, 0, this.size.width, this.size.height);
        this.scaleValues(); // Calculate scaling values

        // Get data to local coordinate scale
        this.xScale = this.size.width / this.xRange;
        this.yScale = this.size.height / this.yRange;

        // Plot each data point
        this.settings.series[0].data.forEach((point) => {
            // Calculate X position: Scale point[0] to fit in canvas
            let xPos = (point[0] - this.xLower) * this.xScale;

            // Calculate Y position: Scale point[1] and invert Y axis for canvas
            let yPos =
                this.size.height - (point[1] - this.yLower) * this.yScale;

            // Store adjusted points
            this.adjustedXY.push([xPos, yPos]);

            // Log the positions to debug
            // console.log(xPos, yPos);
        });

        // Get line type
        switch (this.settings.chart.type) {
            case "stepline":
                this.renderStepline(
                    this.settings.chart.style.fill,
                    this.settings.chart.style.stroke
                );
                break;

            default:
                break;
        }

        // If points are to be rendered
        if (this.settings.chart.pointSize > 0) {
            this.adjustedXY.forEach((point) => {
                // Draw the point on the chart
                this.drawPoint(
                    point[0],
                    point[1],
                    this.settings.chart.pointSize,
                    this.settings.chart.style.stroke,
                    "white"
                );
            });
        }
    }
}
