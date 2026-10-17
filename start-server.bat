@echo off
setlocal enabledelayedexpansion
title WanderWise Travel Booking - Local Server

echo =======================================================
echo     WanderWise Travel Booking - Starting Server
echo =======================================================
echo.

set "PHP_CMD="

:: 1. Check if php is in current project folder (portable php)
if exist "%~dp0php\php.exe" (
    set "PHP_CMD=%~dp0php\php.exe"
    goto :START_SERVER
)

:: 2. Check if php is already in PATH
where php >nul 2>&1
if %ERRORLEVEL% equ 0 (
    set "PHP_CMD=php"
    goto :START_SERVER
)

:: 2. Check XAMPP standard path
if exist "C:\xampp\php\php.exe" (
    set "PHP_CMD=C:\xampp\php\php.exe"
    goto :START_SERVER
)

:: 3. Check Laragon path
for /d %%D in ("C:\laragon\bin\php\*") do (
    if exist "%%D\php.exe" (
        set "PHP_CMD=%%D\php.exe"
        goto :START_SERVER
    )
)

:: 4. Check WAMP path
for /d %%D in ("C:\wamp64\bin\php\*") do (
    if exist "%%D\php.exe" (
        set "PHP_CMD=%%D\php.exe"
        goto :START_SERVER
    )
)

:: 5. Check C:\php
if exist "C:\php\php.exe" (
    set "PHP_CMD=C:\php\php.exe"
    goto :START_SERVER
)

:: 6. Check Program Files
if exist "C:\Program Files\PHP\php.exe" (
    set "PHP_CMD=C:\Program Files\PHP\php.exe"
    goto :START_SERVER
)

:: If not found automatically
echo [!] PHP was not found in standard paths (C:\xampp\php, C:\laragon, C:\wamp64, C:\php).
echo.
echo Please enter the full path to your php.exe:
echo Example: C:\xampp\php\php.exe
echo.
set /p "USER_PHP=Enter path (or press Enter to exit): "
if exist "%USER_PHP%" (
    set "PHP_CMD=%USER_PHP%"
    goto :START_SERVER
)

echo.
echo [!] Could not locate php.exe.
echo Please install XAMPP from https://www.apachefriends.org/ or PHP from https://windows.php.net/download/
pause
exit /b 1

:START_SERVER
echo [*] Located PHP: "%PHP_CMD%"
echo [*] Database configured for MySQL (user: root, db: travel_booking)
echo.
echo Starting web server at: http://localhost:8000
echo Press Ctrl+C in this window anytime to stop the server.
echo.

:: Automatically launch default web browser after 1.5 seconds
start "" http://localhost:8000

:: Run PHP built-in server with uppercase -S
"%PHP_CMD%" -S localhost:8000

pause
