window.addEventListener("load", function () {

    rellenarPedidos();
    
    const ctx = document.getElementById('myChart');

    function rellenarPedidos() {
        fetch("Api/ApiPedido.php", { method: "GET" })
            .then(response => response.json())
            .then(datos => {
                let labels = [];
        let data = [];
        datos.forEach(item => {
            labels.push(item.nombre);
            data.push(item.cantidad);
        })
    

    ctx.grafico = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Unidades vendidas',
                data: data,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
        }
    });
    window.setInterval(function(){
        traerVentas().then(datos=>{
            let labels = [];
            let data = [];
            datos.forEach(item => {
            labels.push(item.nombre);
            data.push(item.cantidad);
            });
            ctx.grafico.data.labels = labels;
            ctx.grafico.data.datasets[0].data = data;
            ctx.grafico.update('active');
            ctx.grafico.render();
        })
    },2000)



            })
            
    }

})