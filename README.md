Here’s a **README.md** file template for your **Prayer Progress Tracker** project:

---

## **Prayer Progress Tracker**

### **Overview**
The Prayer Progress Tracker is a web application designed to help users log their daily prayers, visualize their progress through charts, and stay motivated on their spiritual journey. The tool is built using HTML, PHP, JavaScript, and Chart.js for dynamic charts, with a beautiful mosque-themed background.

---

### **Features**
- **Prayer Logging**: Users can log their prayers (e.g., Fajr, Dhuhr, Asr, Maghrib, Isha) with status (`Completed` or `Missed`).
- **Dynamic Chart**: Visualizes the user's prayer progress in a bar chart.
- **Language Support**: Supports both **English** and **Arabic** with a toggle switch.
- **Beautiful UI**: Features a mosque-themed background and clean, responsive design.

---

### **Technologies Used**
- **Frontend**:
  - HTML, CSS
  - JavaScript (Chart.js for charts)
- **Backend**:
  - PHP
  - MySQL (for storing prayer logs)
- **Version Control**:
  - Git & GitHub

---

### **Getting Started**
Follow these steps to set up the Prayer Progress Tracker on your local machine.

#### **1. Prerequisites**
- Install [XAMPP](https://www.apachefriends.org/index.html) or any other PHP server.
- Install [Git](https://git-scm.com/).
- Clone the repository.

#### **2. Clone Repository**
```bash
git clone git@github.com:abdulsalambarghouthi/prayer.git
cd prayer
```

#### **3. Database Setup**
- Create a database in MySQL (e.g., `prayer_tracker`).
- Run the following SQL query to create the required table:
  ```sql
  CREATE TABLE prayer_logs (
      id INT AUTO_INCREMENT PRIMARY KEY,
      prayer_type VARCHAR(20) NOT NULL,
      prayer_date DATE NOT NULL,
      status ENUM('completed', 'missed') NOT NULL,
      user_id INT NOT NULL
  );
  ```

#### **4. Configure the Application**
- Update your database credentials in the PHP files (`save_prayer.php`, `get_data.php`):
  ```php
  $host = "localhost";
  $user = "root";
  $password = "";
  $database = "prayer_tracker";
  ```

#### **5. Run the Application**
- Start your PHP server (e.g., using XAMPP).
- Open the application in your browser at `http://localhost/prayer`.

---

### **Usage**
1. **Log Prayers**:
   - Select the prayer type, date, and status, then click "Log Prayer."
2. **View Progress**:
   - The chart dynamically updates to display the progress of completed prayers.
3. **Switch Language**:
   - Use the dropdown to toggle between **English** and **Arabic**.

---

### **Screenshots**
![image](https://github.com/user-attachments/assets/d6a49f4f-6136-41a6-bbb5-88914aa2171e)


---

### **Future Enhancements**
- Add user authentication for personalized prayer tracking.
- Enable reminders for upcoming prayer times.
- Add mobile-friendly notifications (e.g., SMS, email).
- Expand language support.

---

### **Contributing**
Contributions are welcome! To contribute:
1. Fork the repository.
2. Create a new branch:
   ```bash
   git checkout -b feature-name
   ```
3. Make your changes and commit them:
   ```bash
   git commit -m "Add feature-name"
   ```
4. Push to your fork and submit a pull request.



---
