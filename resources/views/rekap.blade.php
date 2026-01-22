<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --main-bg: #1a1a1a;
            --card-bg: #2d2d2d;
            --text-primary: #ffffff;
            --text-secondary: #b3b3b3;
            --accent: #4a4a4a;
            --chart-1: #808080;
            --chart-2: #595959;
            --chart-3: #404040;
        }

        body {
            background-color: var(--main-bg);
            color: var(--text-primary);
        }

        .dashboard-card {
            background-color: var(--card-bg);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .welcome-banner {
            background: linear-gradient(45deg, var(--accent), var(--card-bg));
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .chart-container {
            height: 300px;
            margin-bottom: 20px;
        }

        .profile-section {
            background-color: var(--card-bg);
            border-radius: 15px;
            padding: 20px;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

        .comment-item {
            border-bottom: 1px solid var(--accent);
            padding: 10px 0;
        }

        .comment-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .trend-indicator {
            font-size: 0.8em;
            padding: 2px 5px;
            border-radius: 3px;
        }

        .trend-up {
            color: #00ff00;
        }

        .trend-down {
            color: #ff0000;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
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
                            <i class="bi bi-bar-chart-fill fs-1"></i>
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
                        <div class="stat-card">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>1,256</h3>
                                    <p class="text-secondary mb-0">New Followers</p>
                                </div>
                                <div class="trend-indicator trend-up">
                                    <i class="bi bi-arrow-up"></i> 0.3%
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>65.85%</h3>
                                    <p class="text-secondary mb-0">User Engagement</p>
                                </div>
                                <div class="trend-indicator trend-up">
                                    <i class="bi bi-arrow-up"></i> 0.1%
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>80K</h3>
                                    <p class="text-secondary mb-0">Likes</p>
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
        // Chart initialization
    //     const ctx = document.getElementById('socialChart').getContext('2d');
    //     new Chart(ctx, {
    //         type: 'bar',
    //         data: {
    //             labels: ['Mon 02', 'Tue 03', 'Wed 04', 'Thu 05', 'Fri 06', 'Sat 07', 'Sun 08'],
    //             datasets: [{
    //                 label: 'Reach',
    //                 data: [30000, 40000, 45000, 20000, 35000, 50000, 15000],
    //                 backgroundColor: 'rgba(128, 128, 128, 0.8)'
    //             }, {
    //                 label: 'Likes',
    //                 data: [20000, 30000, 35000, 15000, 30000, 40000, 10000],
    //                 backgroundColor: 'rgba(89, 89, 89, 0.8)'
    //             }, {
    //                 label: 'Comments',
    //                 data: [10000, 20000, 25000, 10000, 20000, 30000, 5000],
    //                 backgroundColor: 'rgba(64, 64, 64, 0.8)'
    //             }]
    //         },
    //         options: {
    //             responsive: true,
    //             maintainAspectRatio: false,
    //             scales: {
    //                 x: {
    //                     stacked: true,
    //                     grid: {
    //                         display: false,
    //                         color: 'rgba(255, 255, 255, 0.1)'
    //                     },
    //                     ticks: {
    //                         color: '#ffffff'
    //                     }
    //                 },
    //                 y: {
    //                     stacked: true,
    //                     grid: {
    //                         color: 'rgba(255, 255, 255, 0.1)'
    //                     },
    //                     ticks: {
    //                         color: '#ffffff'
    //                     }
    //                 }
    //             },
    //             plugins: {
    //                 legend: {
    //                     labels: {
    //                         color: '#ffffff'
    //                     }
    //                 }
    //             }
    //         }
    //     });

    //     // Add sample comments
    //     const commentList = document.querySelector('.comment-list');
    //     const comments = [
    //         { name: 'User 1', text: 'Great content!' },
    //         { name: 'User 2', text: 'Amazing work!' },
    //         { name: 'User 3', text: 'Keep it up!' }
    //     ];

    //     comments.forEach(comment => {
    //         const commentEl = document.createElement('div');
    //         commentEl.className = 'comment-item d-flex align-items-center py-2';
    //         commentEl.innerHTML = `
    //             <img src="/api/placeholder/40/40" alt="${comment.name}" class="comment-avatar me-3">
    //             <div>
    //                 <h6 class="mb-0">${comment.name}</h6>
    //                 <p class="mb-0 text-secondary">${comment.text}</p>
    //             </div>
    //         `;
    //         commentList.appendChild(commentEl);
    //     });
    
    // </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch('/api/chart-data') // Panggil API Laravel
                .then(response => response.json()) // Konversi ke JSON
                .then(data => {
                    let labels = data.map(item => `Day ${item.day}`);
                    let values = data.map(item => item.total_pendapatan);
        
                    // Render Chart
                    let ctx = document.getElementById('socialChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Pendapatan',
                                data: values,
                                borderColor: '#00ff00',
                                backgroundColor: 'rgba(0, 255, 0, 0.2)',
                                borderWidth: 2,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
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

