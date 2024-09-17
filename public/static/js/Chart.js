class Chart {
    constructor(element, settings) {
        this.element = element;
        this.size = element.getBoundingClientRect();
        /* In format:
        {
            width: x,
            height: y,
            top: z,
            bottom: a,
            left: b,
            right: c
        }*/
        this.settings = settings;
        this.xScale = 1;
        this.yScale = 1;
        this.xUpper = Infinity;
        this.xLower = -Infinity;
        this.yUpper = Infinity;
        this.yLower = -Infinity;

        console.log(this.settings);
    }

    roundTick(value) {
        let appropriateTicks = [1, 2, 5, 10, 25, 50, 100];
        let current = appropriateTicks[0];

        appropriateTicks.forEach((tick) => {
            if (Math.abs(value - tick) < Math.abs(value - current)) {
                current = tick;
            }
        });

        return current;
    }

    scaleValues() {
        // https://www.baeldung.com/cs/choosing-linear-scale-y-axis
        let xMax = -Infinity;
        let yMax = -Infinity;
        let xMin = Infinity;
        let yMin = Infinity;
        let xRange = 0;
        let yRange = 0;

        if (this.settings.chart.type == "line") {
            for (let i = 0; i < this.settings.series[0].data.length; i++) {
                if (this.settings.series[0].data[i][0] > xMax) {
                    xMax = this.settings.series[0].data[i][0];
                }

                if (this.settings.series[0].data[i][0] < xMin) {
                    xMin = this.settings.series[0].data[i][0];
                }

                if (this.settings.series[0].data[i][1] > yMax) {
                    yMax = this.settings.series[0].data[i][1];
                }

                if (this.settings.series[0].data[i][1] < yMin) {
                    yMin = this.settings.series[0].data[i][1];
                }
            }
        }

        xRange = xMax - xMin;
        yRange = yMax - yMin;

        let xTickRange = xRange / this.settings.chart.xAxis.ticks;
        let yTickRange = yRange / this.settings.chart.yAxis.ticks;

        let adjustedXTick = this.roundTick(xTickRange);
        let adjustedYTick = this.roundTick(yTickRange);

        this.xScale = adjustedXTick;
        this.yScale = adjustedYTick;
        this.xLower = adjustedXTick * Math.ceil(xMin / adjustedXTick);
        this.yLower = adjustedYTick * Math.ceil(yMin / adjustedYTick);
        this.xUpper = adjustedXTick * Math.ceil(1 + xMax / adjustedXTick);
        this.yUpper = adjustedYTick * Math.ceil(1 + yMax / adjustedYTick);

        console.log(this.xScale, this.yScale, this.xLower, this.xUpper, this.yLower, this.yUpper);
    }

    render() {
        this.scaleValues();
        console.log("a");
    }
}
