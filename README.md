# 🎓 eLearning Platform - Pure Static Demo

Aplikasi eLearning berbasis web yang berjalan 100% di client-side tanpa backend. Perfect untuk demo dan presentasi!

## ✨ Fitur

- ✅ **Pure Static** - Tidak perlu server/backend
- ✅ **Fast Loading** - Instant page load
- ✅ **Responsive** - Mobile-friendly design
- ✅ **Demo Mode** - Data statis untuk demo
- ✅ **3 Role** - Admin, Teacher, Student
- ✅ **LocalStorage Auth** - Session management
- ✅ **Toast Notifications** - User feedback
- ✅ **Modern UI** - Tailwind CSS + Lucide Icons

## 🚀 Quick Start

### Opsi 1: Deploy ke Vercel (Recommended)

[![Deploy with Vercel](https://vercel.com/button)](https://vercel.com/new/clone?repository-url=https://github.com/yourusername/elearning-demo)

### Opsi 2: Jalankan Lokal

```bash
# Buka dengan live server atau
python -m http.server 8000
# atau
php -S localhost:8000
```

Buka: `http://localhost:8000`

## 🔑 Kredensial Login

| Role | Username | Password |
|------|----------|----------|
| **Admin** | `admin` | `admin123` |
| **Guru** | `teacher1` atau `teacher2` | `teacher123` |
| **Siswa** | `student1`, `student2`, `student3` | `student123` |

## 📁 Struktur Project

```
elearning-demo/
├── index.html          # Entry point
├── js/
│   ├── app.js         # Main application
│   ├── auth.js        # Authentication
│   ├── data.js        # Demo data (JSON)
│   ├── router.js      # Client-side routing
│   ├── toast.js       # Notifications
│   └── components.js  # UI components
├── vercel.json        # Vercel config
└── README.md          # This file
```

## 🎯 Teknologi

- **HTML5** - Markup
- **JavaScript (Vanilla)** - Logic
- **Tailwind CSS** - Styling (CDN)
- **Lucide Icons** - Icons (CDN)
- **LocalStorage** - Session management
- **Hash Routing** - SPA navigation

## 📊 Data Demo

### Users
- 1 Admin
- 3 Guru
- 5 Siswa

### Academic Data
- 2 Tahun Ajaran
- 3 Kelas
- 5 Mata Pelajaran
- 5 Jadwal Mengajar
- 3 Materi
- 3 Tugas
- 3 Pengumpulan

## 🎨 Fitur per Role

### 👨‍💼 Admin
- Dashboard dengan statistik
- Lihat data guru
- Lihat data siswa
- Lihat data kelas
- Lihat mata pelajaran

### 👨‍🏫 Guru
- Dashboard jadwal mengajar
- Lihat materi per kelas
- Lihat tugas per kelas
- Simulasi upload materi
- Simulasi buat tugas

### 👨‍🎓 Siswa
- Dashboard mata pelajaran
- Lihat materi
- Lihat tugas
- Simulasi kumpul tugas
- Lihat nilai

## 🔧 Customization

### Ubah Data Demo
Edit `js/data.js`:
```javascript
const DemoData = {
    users: { ... },
    teachers: [ ... ],
    students: [ ... ],
    // dst
};
```

### Ubah Warna
Edit Tailwind config di `index.html`:
```javascript
tailwind.config = {
    theme: {
        extend: {
            colors: {
                brand: { ... }
            }
        }
    }
}
```

## 📱 Browser Support

- ✅ Chrome/Edge (latest)
- ✅ Firefox (latest)
- ✅ Safari (latest)
- ✅ Mobile browsers

## 🚀 Deployment

### Vercel
```bash
vercel --prod
```

### Netlify
```bash
netlify deploy --prod
```

### GitHub Pages
Push ke repository dan enable GitHub Pages

## ⚠️ Limitations

Karena pure static:
- ❌ Tidak ada persistent storage
- ❌ Data reset setiap refresh
- ❌ Tidak ada file upload/download real
- ❌ Tidak ada email notifications
- ✅ Perfect untuk demo & presentasi!

## 🎯 Use Cases

- ✅ Demo aplikasi untuk client
- ✅ Presentasi fitur
- ✅ Prototype UI/UX
- ✅ Testing frontend
- ✅ Portfolio project

## 📖 Documentation

- [MIGRATION_TO_STATIC.md](MIGRATION_TO_STATIC.md) - Migration guide
- [TOAST_NOTIFICATION.md](TOAST_NOTIFICATION.md) - Toast system docs

## 🤝 Contributing

Contributions welcome! Feel free to:
- Report bugs
- Suggest features
- Submit pull requests

## 📄 License

MIT License - Free to use for any purpose

## 🎉 Credits

- **Tailwind CSS** - Styling
- **Lucide Icons** - Icons
- **Vercel** - Hosting

---

**Made with ❤️ for demo purposes**

**Live Demo**: [Your Vercel URL]
