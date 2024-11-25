<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prayer Progress Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://deih43ym53wif.cloudfront.net/blue-mosque-glorius-sunset-istanbul-sultan-ahmed-turkey-shutterstock_174067919.jpg_1404e76369.jpg') no-repeat center center fixed;
            background-size: cover;
            position: relative;
            z-index: 0;
            opacity: 5.5;
        }

        /* Overlay for opacity effect */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.5);
            /* White overlay with 50% opacity */
            z-index: -1;
            /* Place behind content */
        }


        body.ar {
            direction: rtl;
            text-align: right;
        }

        h1,
        h2 {
            text-align: center;
            color: #1d3557;
        }

        form {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            max-width: 800px;
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: inline-block;
            color: #4a4a4a;
        }

        select,
        input,
        button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .success-message {
            text-align: center;
            margin: 10px 0;
            display: none;
        }

        .container {
            margin-top: 20px;
        }

        .language-selector {
            display: flex;
            justify-content: flex-end;
            padding: 10px 20px;
        }

        .language-selector select {
            padding: 5px 10px;
            border-radius: 5px;
        }

        canvas#prayerChart {
            background: rgba(255, 255, 255, 0.8);
            /* White with 80% opacity */
            border-radius: 8px;
            /* Smooth corners */
            padding: 20px;
            /* Optional padding */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            /* Light shadow for better visibility */
        }
        #chart-title {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="en">
    <!-- Language Selector -->
    <div class="language-selector">
        <select id="language" onchange="switchLanguage()" style="width:100px">
            <option value="en" selected>English</option>
            <option value="ar">العربية</option>
        </select>
    </div>

    <header>
        <h1 id="header-title">Prayer Progress Tracker</h1>
    </header>

    <!-- Success Message -->
    <p class="success-message" id="successMessage">Prayer log saved successfully!</p>

    <!-- Form to Log Prayer -->
    <div class="container">
        <form id="prayerForm">
            <label for="prayer_type" id="prayer-label">Prayer:</label>
            <select name="prayer_type" id="prayer_type" required>
                <option value="Fajr">الفجر</option>
                <option value="Dhuhr">الظهر</option>
                <option value="Asr">العصر</option>
                <option value="Maghrib">المغرب</option>
                <option value="Isha">العشاء</option>
            </select>

            <label for="prayer_date" id="date-label">Date:</label>
            <input type="date" name="prayer_date" id="prayer_date" required style="width:780px">

            <label for="status" id="status-label">Status:</label>
            <select name="status" id="status" required>
                <option value="completed">Completed</option>
                <option value="missed">Missed</option>
            </select>

            <button type="submit" id="submit-button">Log Prayer</button>
        </form>
    </div>

    <!-- Chart for Progress -->
    <div class="container">
        <h2 id="chart-title">Your Prayer Progress</h2>
        <canvas id="prayerChart" width="300" height="100"></canvas>
    </div>

    <script>
        // Language Data
        const translations = {
            en: {
                headerTitle: "Prayer Progress Tracker",
                successMessage: "Prayer log saved successfully!",
                prayerLabel: "Prayer:",
                dateLabel: "Date:",
                statusLabel: "Status:",
                statusOptions: { completed: "Completed", missed: "Missed" },
                submitButton: "Log Prayer",
                chartTitle: "Your Prayer Progress"
            },
            ar: {
                headerTitle: "متتبع تقدم الصلاة",
                successMessage: "تم تسجيل الصلاة بنجاح!",
                prayerLabel: "الصلاة:",
                dateLabel: "التاريخ:",
                statusLabel: "الحالة:",
                statusOptions: { completed: "مكتملة", missed: "فائتة" },
                submitButton: "سجل الصلاة",
                chartTitle: "تقدم صلاتك"
            }
        };

        // Switch Language
        function switchLanguage() {
            const language = document.getElementById("language").value;
            document.body.className = language;

            // Apply Translations
            const t = translations[language];
            document.getElementById("header-title").textContent = t.headerTitle;
            document.getElementById("successMessage").textContent = t.successMessage;
            document.getElementById("prayer-label").textContent = t.prayerLabel;
            document.getElementById("date-label").textContent = t.dateLabel;
            document.getElementById("status-label").textContent = t.statusLabel;
            document.getElementById("submit-button").textContent = t.submitButton;
            document.getElementById("chart-title").textContent = t.chartTitle;

            // Update Status Options
            const statusOptions = document.getElementById("status").options;
            statusOptions[0].textContent = t.statusOptions.completed;
            statusOptions[1].textContent = t.statusOptions.missed;
        }

        // Show Success Message
        function showSuccessMessage() {
            const messageElement = document.getElementById("successMessage");
            messageElement.style.display = "block";
            setTimeout(() => {
                messageElement.style.display = "none";
            }, 3000);
        }

        // Load Chart Data
        function loadChart() {
            fetch("get_data.php")
                .then((response) => response.json())
                .then((data) => {
                    const labels = data.map((item) => item.prayer_type);
                    const counts = data.map((item) => item.count);

                    // Create Chart
                    const ctx = document.getElementById("prayerChart").getContext("2d");
                    new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: translations[document.getElementById("language").value].chartTitle,
                                data: counts,
                                backgroundColor: "rgba(139, 69, 19, 0.8)", // SaddleBrown with 80% opacity
                                borderColor: "rgba(139, 69, 19, 1)", // Solid SaddleBrown

                                borderWidth: 2, // Border width
                            }],
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                },
                            },
                        },
                    });
                });
        }


        // Handle Form Submission
        const form = document.getElementById("prayerForm");
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            const formData = new FormData(form);
            fetch("save_prayer.php", { method: "POST", body: formData })
                .then(() => {
                    showSuccessMessage();
                    loadChart();
                    form.reset();
                });
        });
        window.onload = function () {
            const dateInput = document.getElementById('prayer_date');
            const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
            dateInput.value = today;
        };
        // Initial Chart Load
        loadChart();
        switchLanguage();
    </script>
</body>

</html>