# 🧹 Cleanup Guide - Hapus File Lama

## File & Folder yang Harus Dihapus

### ❌ Folder PHP (Tidak diperlukan lagi)
```
api/
config/
controllers/
models/
views/
public/ (kecuali public/js/app.js jika ada)
```

### ❌ File PHP
```
index.php
```

### ❌ File Database
```
database.sql
siakad_mdt.sql
update_nis_nip.sql
update_schedule.sql
```

### ❌ File Recovery (Sudah tidak relevan)
```
GIT_RECOVERY.md
RECOVERY_COMMANDS.txt
recovery.ps1
```

### ❌ File Dokumentasi Lama
```
DEMO_MODE_README.md (versi PHP)
VERCEL_DEPLOYMENT.md (versi PHP)
VERCEL_READY.md (versi PHP)
DEPLOYMENT_SUMMARY.md (versi PHP)
DEPLOYMENT_CHECKLIST.md (versi PHP)
QUICK_START_DEMO.md (versi PHP)
QUICK_DEPLOY.txt (versi PHP)
README_DEMO.txt (versi PHP)
DEPLOY_BUTTON.md (versi PHP)
PERUBAHAN_MODE_DEMO.md (versi PHP)
CHANGELOG.md (versi PHP)
TEST_DEMO_DATA.md (versi PHP)
TEST_ENDPOINTS.md (versi PHP)
BUGFIX_SUMMARY.md (versi PHP)
```

### ❌ File Config Lama
```
package.json (versi PHP)
.env.example (versi PHP)
.vercelignore (versi PHP)
public/.htaccess
```

## ✅ File yang Harus Tetap Ada

### HTML
```
index.html
```

### JavaScript
```
js/app.js
js/auth.js
js/data.js
js/router.js
js/toast.js
js/components.js
```

### Config
```
vercel.json (versi baru - static)
```

### Documentation
```
README.md (versi baru)
MIGRATION_TO_STATIC.md
TOAST_NOTIFICATION.md (jika masih relevan)
CLEANUP.md (file ini)
```

### Git
```
.git/
.gitignore
```

## 🚀 Cara Cleanup

### Opsi 1: Manual (Recommended)

```powershell
# Hapus folder
Remove-Item -Recurse -Force api
Remove-Item -Recurse -Force config
Remove-Item -Recurse -Force controllers
Remove-Item -Recurse -Force models
Remove-Item -Recurse -Force views

# Hapus file PHP
Remove-Item index.php

# Hapus file SQL
Remove-Item database.sql -ErrorAction SilentlyContinue
Remove-Item siakad_mdt.sql -ErrorAction SilentlyContinue
Remove-Item update_*.sql -ErrorAction SilentlyContinue

# Hapus file recovery
Remove-Item GIT_RECOVERY.md -ErrorAction SilentlyContinue
Remove-Item RECOVERY_COMMANDS.txt -ErrorAction SilentlyContinue
Remove-Item recovery.ps1 -ErrorAction SilentlyContinue

# Hapus dokumentasi lama
Remove-Item DEMO_MODE_README.md -ErrorAction SilentlyContinue
Remove-Item VERCEL_*.md -ErrorAction SilentlyContinue
Remove-Item DEPLOYMENT_*.md -ErrorAction SilentlyContinue
Remove-Item QUICK_*.* -ErrorAction SilentlyContinue
Remove-Item README_DEMO.txt -ErrorAction SilentlyContinue
Remove-Item DEPLOY_BUTTON.md -ErrorAction SilentlyContinue
Remove-Item PERUBAHAN_MODE_DEMO.md -ErrorAction SilentlyContinue
Remove-Item CHANGELOG.md -ErrorAction SilentlyContinue
Remove-Item TEST_*.md -ErrorAction SilentlyContinue
Remove-Item BUGFIX_SUMMARY.md -ErrorAction SilentlyContinue

# Hapus config lama
Remove-Item package.json -ErrorAction SilentlyContinue
Remove-Item .env.example -ErrorAction SilentlyContinue
Remove-Item .vercelignore -ErrorAction SilentlyContinue
```

### Opsi 2: Buat Project Baru (Cleanest)

```powershell
# Buat folder baru
mkdir elearning-static
cd elearning-static

# Copy file yang diperlukan
Copy-Item ../elearningmdt/index.html .
Copy-Item -Recurse ../elearningmdt/js .
Copy-Item ../elearningmdt/vercel.json .
Copy-Item ../elearningmdt/README.md .
Copy-Item ../elearningmdt/.gitignore .

# Init git baru
git init
git add .
git commit -m "Initial commit - Pure static demo"
git remote add origin https://github.com/yourusername/elearning-demo.git
git push -u origin main
```

## ✅ Verifikasi Setelah Cleanup

Struktur akhir harus seperti ini:

```
elearning-demo/
├── .git/
├── .gitignore
├── index.html
├── js/
│   ├── app.js
│   ├── auth.js
│   ├── data.js
│   ├── router.js
│   ├── toast.js
│   └── components.js
├── vercel.json
├── README.md
├── MIGRATION_TO_STATIC.md
└── CLEANUP.md
```

## 🧪 Test Setelah Cleanup

```bash
# Test lokal
python -m http.server 8000

# Buka browser
http://localhost:8000

# Test login
# Admin: admin / admin123
# Teacher: teacher1 / teacher123
# Student: student1 / student123
```

## 🚀 Deploy Setelah Cleanup

```bash
# Commit changes
git add .
git commit -m "Cleanup: Remove PHP files, pure static now"

# Push
git push origin main

# Deploy to Vercel
vercel --prod
```

## 📊 Size Comparison

**Before (PHP version)**:
- ~100+ files
- ~50+ MB (with vendor)
- Requires PHP runtime

**After (Static version)**:
- ~10 files
- ~100 KB
- Pure HTML/JS/CSS

## 🎉 Benefits

1. **Faster**: No server processing
2. **Cheaper**: Free hosting everywhere
3. **Simpler**: No backend complexity
4. **Portable**: Works anywhere
5. **Secure**: No server vulnerabilities

---

**Status**: Ready for cleanup
**Next**: Deploy to Vercel
