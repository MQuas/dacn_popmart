<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 style="color: rgb(217, 19, 19);" class="h3 mb-0 text-gray-800">DASHBOARD</h1>
            <p class="text-muted">Welcome to the Admin Panel. Here, you can track your website's statistics.</p>
        </div>
    </div>
    <div class="row">
        <!-- tong sp -->
        <div class="col-md-3 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng Sản Phẩm</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($totalProducts) ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- order completed -->
        <div class="col-md-3 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Đơn Hàng Hoàn Thành</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($completedOrders) ?></div>
                </div>
            </div>
        </div>
        <!-- user -->
        <div class="col-md-3 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Khách Hàng</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($totalCustomers) ?></div>
                </div>
            </div>
        </div>
        <!-- total -->
        <div class="col-md-3 mb-3">     
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Doanh Thu</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($totalRevenue) ?> VNĐ</div>
                </div>
            </div>
        </div>
    </div>
 <!-- cot (tinh) -->
 <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Biểu đồ cột - Sản phẩm bán chạy</h6>
        </div>
        <div class="card-body">
            <canvas id="barChart"></canvas>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Bar Chart
    var ctxBar = document.getElementById("barChart").getContext("2d");
    var barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ["#", "#", "#", "#", "#"],
            datasets: [{
                label: "Số lượng bán",
                data: [120, 90, 150, 80, 110],
                backgroundColor: [
                    "rgba(255, 99, 132, 0.7)",
                    "rgba(54, 162, 235, 0.7)",
                    "rgba(255, 206, 86, 0.7)",
                    "rgba(75, 192, 192, 0.7)",
                    "rgba(153, 102, 255, 0.7)"
                ],
                borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)"
                ],
                borderWidth: 1,
                borderRadius: 4,
                maxBarThickness: 50
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 20
                    },
                    grid: {
                        color: "rgba(200, 200, 200, 0.2)"
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

</script>
</div>
