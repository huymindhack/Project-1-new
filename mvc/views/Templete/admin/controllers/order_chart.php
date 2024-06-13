<?php include 'header_chart.php'; ?>

<h1 class="mb-4">Orders by Month</h1>
<canvas id="ordersChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ordersChart').getContext('2d');
    const ordersData = <?php echo json_encode($ordersByMonth); ?>;

    const labels = ordersData.map(order => order.month);
    const data = ordersData.map(order => parseFloat(order.total_revenue));

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Revenue',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php include 'footer_chart.php'; ?>