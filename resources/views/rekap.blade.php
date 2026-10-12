<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        /* Palet dari gambar dashboard terakhir. Tanpa gradien. */
        :root {
            --bg: #D8F0FA;
            --surface: #FFFFFF;
            --panel: #F5F5F7;
            --ink: #111111;
            --ink-2: #3A3A3C;
            --muted: #8E8E93;
            --line: #ECECEF;
            --lav: #EDE8FC;
            --peach: #FCEEEE;
            --sky: #E4F5FC;
            --grey: #F0F0F2;
            --coral: #E5484D;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg);
            color: var(--ink);
            padding: 16px;
        }

        .dashboard-card {
            background-color: var(--surface);
            border-radius: 28px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 10px 30px rgba(17, 17, 17, 0.06);
        }

        /* Banner navy, gaya kartu gelap di contoh */
        .welcome-banner {
            background: var(--ink);
            color: #FFFFFF;
            border-radius: 28px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .welcome-banner h2 {
            color: #FFFFFF;
            font-weight: 600;
        }

        .welcome-banner p {
            color: rgba(255, 255, 255, 0.7);
        }

        .stat-card {
            border-radius: 24px;
            padding: 20px;
            margin-bottom: 16px;
            color: var(--ink);
        }

        .stat-card h3 {
            color: var(--ink);
            font-weight: 600;
        }

        .stat-card p {
            color: var(--ink-2);
        }

        .stat-card--lav { background: var(--lav); }
        .stat-card--peach { background: var(--peach); }
        .stat-card--sky { background: var(--sky); }

        .chart-container {
            height: 300px;
            margin-bottom: 20px;
        }

        .profile-section {
            background-color: var(--surface);
            border-radius: 28px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(17, 17, 17, 0.06);
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

        .trend-indicator {
            font-size: 0.8em;
            padding: 3px 10px;
            border-radius: 999px;
            font-weight: 500;
            background: #FFFFFF;
        }

        .trend-up {
            color: var(--ink);
        }

        .trend-down {
            color: var(--coral);
        }

        .btn-outline-light {
            --bs-btn-color: var(--ink);
            --bs-btn-border-color: var(--ink);
            --bs-btn-hover-color: #FFFFFF;
            --bs-btn-hover-bg: var(--ink);
            --bs-btn-hover-border-color: var(--ink);
            --bs-btn-active-bg: var(--ink);
            --bs-btn-active-border-color: var(--ink);
        }

        h3, h4, h5 {
            color: var(--ink);
            font-weight: 600;
        }

        .text-secondary {
            color: var(--muted) !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-md-9">
                <!-- Welcome Banner -->
                <div class="welcome-banner">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h2>Welcome back, User!</h2>
                            <p class="mb-0">Performance improved by 80% this week</p>
                        </div>
                        <div>
                            <i class="bi bi-bar-chart fs-1"></i>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between mb-4">
                        <h4>December 2023</h4>
                        <div class="btn-group">
                            <button class="btn btn-outline-light btn-sm">This week</button>
                            <button class="btn btn-outline-light btn-sm">This month</button>
                            <button class="btn btn-outline-light btn-sm">3 months</button>
                        </div>
                    </div>
                    <canvas id="socialChart" class="chart-container"></canvas>
                </div>

                <!-- Stats Cards -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="stat-card stat-card--lav">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>1,256</h3>
                                    <p class="mb-0">New Followers</p>
                                </div>
                                <div class="trend-indicator trend-up">
                                    <i class="bi bi-arrow-up"></i> 0.3%
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card stat-card--peach">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>65.85%</h3>
                                    <p class="mb-0">User Engagement</p>
                                </div>
                                <div class="trend-indicator trend-up">
                                    <i class="bi bi-arrow-up"></i> 0.1%
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card stat-card--sky">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>80K</h3>
                                    <p class="mb-0">Likes</p>
                                </div>
                                <div class="trend-indicator trend-down">
                                    <i class="bi bi-arrow-down"></i> 0.6%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="col-md-3">
                <div class="profile-section">
                    <div class="text-center mb-4">
                        <img src="/api/placeholder/100/100" alt="Profile" class="profile-img mb-3">
                        <h4>User Name</h4>
                        <p class="text-secondary">Location</p>
                        <div class="row text-center">
                            <div class="col">
                                <h5>5.3M</h5>
                                <p class="text-secondary">Followers</p>
                            </div>
                            <div class="col">
                                <h5>1200</h5>
                                <p class="text-secondary">Posts</p>
                            </div>
                            <div class="col">
                                <h5>800K</h5>
                                <p class="text-secondary">Likes</p>
                            </div>
                        </div>
                    </div>
                    <h5>Recent Comments</h5>
                    <div class="comment-list">
                        <!-- Comment items will be dynamically added here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch('/api/chart-data') // Panggil API Laravel
                .then(response => response.json()) // Konversi ke JSON
                .then(data => {
                    let labels = data.map(item => `Day ${item.day}`);
                    let values = data.map(item => item.total_pendapatan);

                    // Render Chart (bar solid, tanpa area gradien)
                    let ctx = document.getElementById('socialChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Pendapatan',
                                data: values,
                                backgroundColor: '#111111',
                                borderRadius: 8,
                                borderSkipped: false
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: { color: '#ECECEF' }
                                },
                                x: {
                                    grid: { display: false }
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });
        </script>

</body>
</html>
