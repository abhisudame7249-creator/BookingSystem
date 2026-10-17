# 🇮🇳 WanderBharat - Travel Booking Web Application (PHP, MySQL, HTML, CSS, JS)

A modern, full-featured **Indian Travel Booking Web Platform** built with **PHP, MySQL, HTML5, CSS3, and JavaScript**. Every single travel package features **3 distinct, fully customized plans** (Explorer, Comfort, and Royal Maharaja VIP), accompanied by high-resolution location photography, day-by-day itineraries, interactive price calculations, checkout, printable electronic travel vouchers, and a customer booking management portal connected to MySQL.

---

## 🗄️ MySQL Database Backend Connected

The backend is connected to MySQL with:
- **Host**: `localhost` (Port: `3306`)
- **Username**: `root`
- **Password**: `Abhi7249@1`
- **Database**: `travel_booking`

> **Automatic Setup**: The system includes an auto-installer in `includes/db.php`. As soon as the website loads, it automatically creates the database, creates the tables (`bookings`, `inquiries`), and seeds sample data. A standalone [`database.sql`](database.sql) file is also provided.

---

## ⚡ How to Run the Project

### Method 1: Using VS Code Task
In VS Code, press:
👉 **`Ctrl + Shift + B`**

### Method 2: In Terminal / PowerShell
```powershell
C:\xampp\php\php.exe -S localhost:8000
```
Then open: **`http://localhost:8000`**

### Method 3: 1-Click Batch Runner
Double-click: **`start-server.bat`**

### Method 4: Via XAMPP Apache
Start Apache in XAMPP and visit: **`http://localhost/TravelBooking`**

---

## 🗺️ Included Indian Destinations & 3 Plans (INR / ₹)

| Destination | Category | Duration | 🎒 Explorer Plan | 🌟 Comfort Plan | 👑 Royal Maharaja VIP |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Kashmir Paradise** (Srinagar, Gulmarg, Dal Lake) | Himalayas & Snow | 6 Days / 5 Nights | **₹14,999** | **₹24,999** | **₹49,999** |
| **Goa Coastal Bliss** (Beaches & Catamaran Cruise) | Beach & Coastal | 5 Days / 4 Nights | **₹9,999** | **₹18,499** | **₹39,999** |
| **Kerala Backwaters & Munnar** (Houseboat & Hills) | Backwaters & Hills | 6 Days / 5 Nights | **₹13,499** | **₹22,999** | **₹44,999** |
| **Royal Rajasthan** (Jaipur, Udaipur, Thar Desert) | Royal Heritage | 7 Days / 6 Nights | **₹16,999** | **₹28,999** | **₹59,999** |
| **Himachal Peaks** (Shimla, Manali & Solang) | Himalayas & Snow | 6 Days / 5 Nights | **₹12,499** | **₹21,999** | **₹42,999** |
| **Spiritual India** (Varanasi & Ayodhya Ram Mandir) | Spiritual & Holy | 4 Days / 3 Nights | **₹8,999** | **₹15,999** | **₹32,999** |

---

## 📁 Project Structure

```
TravelBooking/
├── index.php                 # Homepage (Hero search, 3-plan matrix, featured packages, testimonials)
├── packages.php              # Full travel catalog with live search & multi-criteria filters
├── package-details.php       # Deep-dive package page, photo mosaic, 3-plan switcher & live calculator
├── booking.php               # Checkout page, traveler details, add-on selection & Indian payments (UPI, Cards, Netbanking)
├── confirmation.php          # Booking confirmation & printable electronic boarding voucher with barcode
├── my-bookings.php           # Customer bookings dashboard (view vouchers & cancel bookings)
├── contact.php               # Contact & custom itinerary inquiry form with FAQs (saves to MySQL)
├── database.sql              # MySQL database schema & sample data in INR
├── start-server.bat          # 1-Click batch server runner (auto-detects PHP)
├── start-server.ps1          # PowerShell server runner
├── .vscode/tasks.json        # VS Code 1-click launch task
├── includes/
│   ├── header.php            # Universal responsive navbar with dynamic bookings counter badge
│   ├── footer.php            # Universal footer with links, trust badges & copyright
│   ├── db.php                # MySQL PDO connection & automatic database installer
│   ├── data.php              # Centralized data: 6 Indian destinations, 3 plans each, photos & itineraries
│   └── functions.php         # Helpers for MySQL CRUD, formatting, sanitizing & querying
├── css/
│   └── style.css             # Custom modern responsive CSS with variables, flexbox, grid & print styles
├── js/
│   └── main.js               # Client-side JavaScript (live price calculator, filters, gallery switcher)
├── data/
│   └── bookings.json         # Backup JSON storage for offline/fallback use
└── README.md                 # Complete documentation
```
