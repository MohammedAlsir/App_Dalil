window.onload = function () {
    // console.log($active);
    // console.log($nonactive);

    var ctx = document.getElementById("myChart").getContext("2d");
    var ctx2 = document.getElementById("myChart2").getContext("2d");
    // var ctx3 = document.getElementById('myChart3').getContext('2d');

    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: "polarArea",

        // The data for our dataset
        data: {
            labels: $tablejs,

            datasets: [
                {
                    backgroundColor: [
                        "rgba(255, 99, 132)",
                        "rgba(54, 162, 235)",
                        "rgba(255, 206, 86)",
                        "rgba(75, 192, 192)",
                        "rgba(255, 54, 78)",
                        "rgba(40, 12, 60)",
                        "rgba(15, 87, 129)",
                        "rgba(11, 255, 4)",
                        "rgba(0, 197, 220)",
                        "rgba(153, 102, 255)",
                        "rgba(255, 159, 64)",
                    ],
                    borderColor: "rgb(0, 0,0, 0)",
                    data: $ordersjs,
                },
            ],
        },

        // Configuration options go here
        options: {},
    });

    // console.log($ok2);
    // console.log($no2);

    // console.log($process_js);
    var chart2 = new Chart(ctx2, {
        // The type of chart we want to create
        type: "doughnut",

        // The data for our dataset
        data: {
            labels: ["المبيعات", "التكاليف"],

            datasets: [
                {
                    backgroundColor: ["#1abb9c", "#e74c3c"],
                    borderColor: "rgb(0, 0,0, 0)",
                    data: [$sales, $costs],
                },
            ],
        },

        // Configuration options go here
        options: {},
    });
};
