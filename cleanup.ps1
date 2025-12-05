# Cleanup Script - Remove old PHP files
Write-Host "================================" -ForegroundColor Cyan
Write-Host "  Cleanup Old PHP Files" -ForegroundColor Cyan
Write-Host "================================" -ForegroundColor Cyan
Write-Host ""

$confirm = Read-Host "This will delete PHP files and folders. Continue? (y/n)"

if ($confirm -ne "y" -and $confirm -ne "Y") {
    Write-Host "Cleanup cancelled." -ForegroundColor Yellow
    exit
}

Write-Host ""
Write-Host "Starting cleanup..." -ForegroundColor Yellow
Write-Host ""

# Folders to delete
$folders = @("api", "config", "controllers", "models", "views")
foreach ($folder in $folders) {
    if (Test-Path $folder) {
        Write-Host "Deleting folder: $folder" -ForegroundColor Red
        Remove-Item -Recurse -Force $folder
    }
}

# PHP files
$phpFiles = @("index.php")
foreach ($file in $phpFiles) {
    if (Test-Path $file) {
        Write-Host "Deleting file: $file" -ForegroundColor Red
        Remove-Item -Force $file
    }
}

# SQL files
$sqlFiles = Get-ChildItem -Filter "*.sql" -ErrorAction SilentlyContinue
foreach ($file in $sqlFiles) {
    Write-Host "Deleting file: $($file.Name)" -ForegroundColor Red
    Remove-Item -Force $file.FullName
}

# Recovery files
$recoveryFiles = @("GIT_RECOVERY.md", "RECOVERY_COMMANDS.txt", "recovery.ps1")
foreach ($file in $recoveryFiles) {
    if (Test-Path $file) {
        Write-Host "Deleting file: $file" -ForegroundColor Red
        Remove-Item -Force $file
    }
}

# Old documentation
$oldDocs = @(
    "DEMO_MODE_README.md",
    "VERCEL_DEPLOYMENT.md",
    "VERCEL_READY.md",
    "DEPLOYMENT_SUMMARY.md",
    "DEPLOYMENT_CHECKLIST.md",
    "QUICK_START_DEMO.md",
    "QUICK_DEPLOY.txt",
    "README_DEMO.txt",
    "DEPLOY_BUTTON.md",
    "PERUBAHAN_MODE_DEMO.md",
    "CHANGELOG.md",
    "TEST_DEMO_DATA.md",
    "TEST_ENDPOINTS.md",
    "BUGFIX_SUMMARY.md"
)
foreach ($file in $oldDocs) {
    if (Test-Path $file) {
        Write-Host "Deleting file: $file" -ForegroundColor Red
        Remove-Item -Force $file
    }
}

# Old config files
$oldConfigs = @("package.json", ".env.example", ".vercelignore", "public/.htaccess")
foreach ($file in $oldConfigs) {
    if (Test-Path $file) {
        Write-Host "Deleting file: $file" -ForegroundColor Red
        Remove-Item -Force $file
    }
}

# Clean public folder (keep only if needed)
if (Test-Path "public") {
    $keepPublic = Read-Host "Delete public folder? (y/n)"
    if ($keepPublic -eq "y" -or $keepPublic -eq "Y") {
        Write-Host "Deleting folder: public" -ForegroundColor Red
        Remove-Item -Recurse -Force public
    }
}

Write-Host ""
Write-Host "================================" -ForegroundColor Green
Write-Host "  Cleanup Complete!" -ForegroundColor Green
Write-Host "================================" -ForegroundColor Green
Write-Host ""

Write-Host "Remaining files:" -ForegroundColor Cyan
Get-ChildItem -File | Select-Object Name | Format-Table -AutoSize

Write-Host ""
Write-Host "Next steps:" -ForegroundColor Yellow
Write-Host "1. Test locally: python -m http.server 8000" -ForegroundColor White
Write-Host "2. Commit changes: git add . && git commit -m 'Pure static version'" -ForegroundColor White
Write-Host "3. Deploy: vercel --prod" -ForegroundColor White
Write-Host ""
