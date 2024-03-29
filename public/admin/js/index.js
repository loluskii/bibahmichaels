$(function () {
  Jknob();
  $(".progress .progress-bar").progressbar({ display_text: "none" });
  var dataStackedBar = {
    labels: ["Q1", "Q2", "Q3", "Q4", "Q5"],
    series: [
      [2350, 3205, 4520, 2351, 5632],
      [2541, 2583, 1592, 2674, 2323],
      [1212, 5214, 2325, 4235, 2519],
    ],
  };
  new Chartist.Bar("#chart-top-products", dataStackedBar, {
    height: "250px",
    stackBars: true,
    axisX: { showGrid: false },
    axisY: {
      labelInterpolationFnc: function (value) {
        return value / 1000 + "k";
      },
    },
    plugins: [
      Chartist.plugins.tooltip({ appendToBody: true }),
      Chartist.plugins.legend({
        legendNames: ["Mobile", "Laptop", "Computer"],
      }),
    ],
  }).on("draw", function (data) {
    if (data.type === "bar") {
      data.element.attr({ style: "stroke-width: 40px" });
    }
  });
  toastr.options.closeButton = true;
  toastr.options.positionClass = "toast-top-right";
  toastr.options.showDuration = 1000;
  toastr["info"]("Hello, welcome to Lucid, a unique admin Template.");
});
function Jknob() {
  $(".knob").knob({
    draw: function () {
      if (this.$.data("skin") == "tron") {
        var a = this.angle(this.cv),
          sa = this.startAngle,
          sat = this.startAngle,
          ea,
          eat = sat + a,
          r = true;
        this.g.lineWidth = this.lineWidth;
        this.o.cursor && (sat = eat - 0.3) && (eat = eat + 0.3);
        if (this.o.displayPrevious) {
          ea = this.startAngle + this.angle(this.value);
          this.o.cursor && (sa = ea - 0.3) && (ea = ea + 0.3);
          this.g.beginPath();
          this.g.strokeStyle = this.previousColor;
          this.g.arc(
            this.xy,
            this.xy,
            this.radius - this.lineWidth,
            sa,
            ea,
            false
          );
          this.g.stroke();
        }
        this.g.beginPath();
        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
        this.g.arc(
          this.xy,
          this.xy,
          this.radius - this.lineWidth,
          sat,
          eat,
          false
        );
        this.g.stroke();
        this.g.lineWidth = 2;
        this.g.beginPath();
        this.g.strokeStyle = this.o.fgColor;
        this.g.arc(
          this.xy,
          this.xy,
          this.radius - this.lineWidth + 1 + (this.lineWidth * 2) / 3,
          0,
          2 * Math.PI,
          false
        );
        this.g.stroke();
        return false;
      }
    },
  });
}
