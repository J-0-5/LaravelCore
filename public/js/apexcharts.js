document.addEventListener("DOMContentLoaded", function () {
    let palette1 = ["#EE4057", "#4B57A1", "#7121FF", "#359FAF"];
    let palette2 = ["#0F2B54", "#DB7500", "#A9DEFD", "#3BDCC2"];
    // The global window.Apex variable below can be used to set common options for all charts on the page
    Apex = {};

    var chart1 = {
        series: [
            {
                name: "Desktops",
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148],
            },
        ],
        chart: {
            height: 350,
            width: 650,
            type: "line",
            zoom: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
        },
        title: {
            text: "Información",
            align: "left",
            style: {
                fontSize: "20px",
                fontWeight: "bold",
            },
        },
        grid: {
            show: false,
        },
        markers: {
            size: 6,
            strokeColors: "#FFFFFF",
            strokeWidth: 2,
            strokeOpacity: 0.9,
            strokeDashArray: 0,
            fillOpacity: 0,
            shape: "circle",
            radius: 2,
            offsetX: 0,
            offsetY: 0,
        },
        xaxis: {
            categories: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
            ],
        },
    };

    var chart2 = {
        series: [
            {
                data: [44, 55, 41, 64, 22, 43, 21],
            },
            {
                data: [53, 32, 33, 52, 13, 44, 32],
            },
        ],
        chart: {
            type: "bar",
            height: 350,
            width: '350px',
            toolbar: {
                show: false,
            },
        },

        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 5,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 1,
            colors: ["#fff"],
        },
        grid: {
            show: true,
            xaxis: {
                lines: {
                    show: true,
                },
            },
            yaxis: {
                lines: {
                    show: false,
                },
            },
            column: {
                colors: undefined,
                opacity: 0.5,
            },
        },
        tooltip: {
            shared: true,
            intersect: false,
        },
        xaxis: {
            categories: [2001, 2002, 2003, 2004, 2005, 2006, 2007],
        },
        colors: palette1,
    };

    var chart3 = {
        series: [
            {
                name: "Solicitudes",
                data: [44, 55, 41, 64, 22, 43, 21],
            },
            {
                name: "Contratos",
                data: [53, 32, 33, 52, 13, 44, 32],
            },
            {
                name: "Pagos",
                data: [40, 50, 15, 45, 20, 33, 26],
            },
            {
                // name: "Desktops",
                data: [35, 47, 43, 25, 19, 41, 39],
            },
        ],
        chart: {
            height: 350,
            width: 650,
            type: "line",
            zoom: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
        },
        // title: {
        //     text: "Información",
        //     align: "left",
        //     style: {
        //         fontSize: "20px",
        //         fontWeight: "bold",
        //     },
        // },
        grid: {
            show: false,
        },
        markers: {
            size: 6,
            strokeColors: "#FFFFFF",
            strokeWidth: 2,
            strokeOpacity: 0.9,
            strokeDashArray: 0,
            fillOpacity: 0,
            shape: "circle",
            radius: 2,
            offsetX: 0,
            offsetY: 0,
        },
        xaxis: {
            categories: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
            ],
        },
    };

    var chart4 = {
        series: [
            {
                name: "Pagos solicitados",
                data: [44, 55, 41, 64, 22, 43, 21],
            },
            {
                name: "Pagos pendientes",
                data: [53, 32, 33, 52, 13, 44, 32],
            },
            {
                name: "Pagos realizados",
                data: [41, 25, 39, 54, 18, 48, 42],
            },
        ],
        chart: {
            type: "bar",
            height: 350,
            width: '350px',
            toolbar: {
                show: false,
            },
        },

        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 5,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 1,
            colors: ["#fff"],
        },
        grid: {
            show: true,
            xaxis: {
                lines: {
                    show: true,
                },
            },
            yaxis: {
                lines: {
                    show: false,
                },
            },
            column: {
                colors: undefined,
                opacity: 0.5,
            },
        },
        tooltip: {
            shared: true,
            intersect: false,
        },
        xaxis: {
            categories: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
            ],
        },
        colors: palette1,
    };



    var gp1 = new ApexCharts(document.querySelector(".firstChart"), chart1);
    var gp2 = new ApexCharts(document.querySelector(".secondChart"), chart2);
    var gp3 = new ApexCharts(document.querySelector(".thirdChart"), chart3);
    var gp4 = new ApexCharts(document.querySelector(".fourthChart"), chart4);


    var arrcharts = [gp1, gp2, gp3, gp4];
    arrcharts.forEach((element) => {
        if (element.el != null) {
            element.render();
        }
    });
});
