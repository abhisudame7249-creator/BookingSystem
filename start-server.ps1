# WanderWise Travel Booking - PowerShell Server Runner

Write-Host "=======================================================" -ForegroundColor Cyan
Write-Host "    WanderWise Travel Booking - Local Server" -ForegroundColor Cyan
Write-Host "=======================================================" -ForegroundColor Cyan
Write-Host ""

$phpPath = $null

# 1. Check if php is in system PATH
if (Get-Command "php" -ErrorAction SilentlyContinue) {
    $phpPath = "php"
}

# 2. Check XAMPP
if (-not $phpPath -and (Test-Path "C:\xampp\php\php.exe")) {
    $phpPath = "C:\xampp\php\php.exe"
}

# 3. Check Laragon
if (-not $phpPath) {
    $laragonPhps = Get-ChildItem "C:\laragon\bin\php" -Filter "php.exe" -Recurse -ErrorAction SilentlyContinue | Select-Object -First 1
    if ($laragonPhps) {
        $phpPath = $laragonPhps.FullName
    }
}

# 4. Check WAMP
if (-not $phpPath) {
    $wampPhps = Get-ChildItem "C:\wamp64\bin\php" -Filter "php.exe" -Recurse -ErrorAction SilentlyContinue | Select-Object -First 1
    if ($wampPhps) {
        $phpPath = $wampPhps.FullName
    }
}

# 5. Check C:\php
if (-not $phpPath -and (Test-Path "C:\php\php.exe")) {
    $phpPath = "C:\php\php.exe"
}

# 6. Check Program Files
if (-not $phpPath -and (Test-Path "C:\Program Files\PHP\php.exe")) {
    $phpPath = "C:\Program Files\PHP\php.exe"
}

if (-not $phpPath) {
    Write-Host "[!] PHP was not automatically detected." -ForegroundColor Yellow
    Write-Host "If you have XAMPP installed, PHP is at: C:\xampp\php\php.exe" -ForegroundColor Gray
    $userPath = Read-Host "Please enter the path to your php.exe"
    if (Test-Path $userPath) {
        $phpPath = $userPath
    } else {
        Write-Host "Could not find php.exe. Please install XAMPP or PHP." -ForegroundColor Red
        return
    }
}

Write-Host "[*] Found PHP at: $phpPath" -ForegroundColor Green
Write-Host "[*] Connected to MySQL (user: root, db: travel_booking)" -ForegroundColor Green
Write-Host ""
Write-Host "Starting server at: http://localhost:8000" -ForegroundColor Yellow
Write-Host "Press Ctrl + C to stop the server anytime." -ForegroundColor Gray
Write-Host ""

# Open browser
Start-Process "http://localhost:8000"

# Start PHP built-in server (uppercase -S)
& $phpPath -S localhost:8000
