function fetchCities ()
{
    $.ajax({

        url: '/cities',
    }).done(response => {

        $.each(response, function(key, value){

            $('.selectpicker').append(
                "<option data-subtext='" + value.province + "'value='" + value.city +","+ 
                value.province + "'>"+ value.city + "</option>"
            );

        });

    }); 
}


function Searches (myObject,body)
{   
    $.ajax(myObject).done(response => {
        
        body.html(response);
    });
}

function filterStoreProduct(request,url)
{
    $.ajax({ method:'POST', url:url, data:{ request:request, _token:_token } })
    .done( response => {

        $('.product-table').html(response);
    });
}

function bargainAjax(myObject, condition)
{
    $.ajax(myObject).done(response => {
        if ( user === "Seller") {

            $('#seller-panel').html(result);
        } 
        else {
            
            $('#buyer-panel').html(result);
        }
    });
}

function filterProdHaggler(data,url) {
    
    $.ajax({
        method: "POST",
        url: url,
        data:data
    }).done(function (result) {

        $('#filter').html(result);
    });
}

function demandAjax(data) {

    $.ajax({
        method: "POST",
        url: "/get-supply-demand",
        data: data
    }).done(function(result){

        var demandLabel = [];
        var demandData = [];
        var name = "";

        $.each(result, function(key, value){

            demandLabel.push(value.product_id);
            demandData.push(value.order_price);
            name = value.product_name;
        });

        demand(demandLabel,demandData,name);
    });
}

function storeDemand(data) {
    
    $.ajax({
        method: "POST",
        url: "/get-store-demand",
        data: data
    }).done(function(result){

        var demandLabel = [];
        var demandData = [];
        var name = "";

        $.each(result, function(key, value){

            demandLabel.push(value.date);
            demandData.push(value.demand);
            name = "Store demand";
        });

        demand(demandLabel,demandData,name);
    });
}

function supplyAjax(data) {

    $.ajax({
        method: "POST",
        url: "/get-demand-supply",
        data: data
    }).done(function(result){

        var supplyLabel = [];
        var supplyData = [];
        var name = "";

        $.each(result, function(key, value){

            supplyLabel.push(value.stock_quantity);
            supplyData.push(value.product_regular_price);
            name = value.product_name;
        });

        supply(supplyLabel,supplyData,name);

    });
}

function storeSupply(data) {
    
        $.ajax({
            method: "POST",
            url: "/get-store-supply",
            data: data
        }).done(function(result){
    
            var supplyLabel = [];
            var supplyData = [];
            var name = "";
    
            $.each(result, function(key, value){
    
                supplyLabel.push(value.date);
                supplyData.push(value.supply);
                name = "Store Supply";
            });
    
            supply(supplyLabel,supplyData,name);
    
        });
    }
//ajax function for pagination
function filterSearch(data, url) {

    $.ajax({
        method: "POST",
        url: url,
        data: data
    }).done(function (result) {

        $('#filter').html(result);
    });
}

function datatable(data, url) {

    $.ajax({
        url: url
    }).done(function (result) {

        console.log(result);

        $('.product-table').html(result);

        location.hash = data;
    });
}

// index store pie chart

function indexSPC() {


    $.ajax({
        method: 'POST',
        url: '/pie/category-bought',
        data: { _token: _token }
    }).done( result => {
        
        var labels = [];
        var colors = [];
        var datas = [];

        for(var i in result)
        {   
            labels.push(result[i].category_name);
            colors.push(result[i].color);
            datas.push(result[i].qty);
        }

        new Chart(document.getElementById("pie-chart"), {
            type: 'pie',
            data: {
              labels: labels,
              datasets: [{
                label: "Type of product you bought",
                backgroundColor: colors,
                data: datas
              }]
            },
            options: {
              title: {
                display: true,
                text: 'Product Category you buy'
              }
            }
        });

    });

}

//index store bar chart
function indexSBC() {

    $.ajax({
        url: "/analytics/sales-data",
        data: {_token:_token},
        method: "POST"
    }).done(function(result){

        var name = [];
        var number = [];

        for(var i in result)
        {   
            name.push(result[i].date);
            number.push(result[i].sales);
        }

        new Chart(document.getElementById("sale-chart"), {
            type: 'bar',
            data: {
                labels: name,
                datasets: [
                    {
                        label: "Product Sales",
                        backgroundColor: ["#AB2A2F","#AB2A2F","#AB2A2F","#AB2A2F","#AB2A2F"],
                        data: number
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: ''
                }
            }
        });
    });
}

//demand
function demand(label, data, name) {
	new Chart(document.getElementById("demand-chart"), {
      type: 'line',
      data: {
        labels: label,
        datasets: [{
            data: data,
            label: "Demand",
            borderColor: "#AB2A2F",
            fill: false
        }]
      },
      options: {
        title: {
          display: true,
          text: name+'(Y = price , X = demand)'
        },
      }
    });
}

function demandDamit() {
    new Chart(document.getElementById("demand-chart"), {
      type: 'line',
      data: {
        labels: [10,15,30],
        datasets: [{
            data: [1000,800,750],
            label: "Demand",
            borderColor: "#AB2A2F",
            fill: false
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Demand to this product (Y = price , X = demand)'
        },
      }
    });
}

//supply
function supply(label, data, name) {
    new Chart(document.getElementById("supply-chart"), {
      type: 'line',
      data: {
        labels: label,
        datasets: [{
            data: data,
            label: "Supply",
            borderColor: "#AB2A2F",
            fill: false
        }]
      },
      options: {
        title: {
          display: true,
          text: name+' (Y = price , X = quantity supply)'
        },
      }
    });
}

//index store line chart
function indexSLC() {
	var ctx = document.getElementById("indexSLChart").getContext('2d');
	var myChart = new Chart(ctx, {
    type: 'line',
    data: {

        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: 'Sales',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
	});
}