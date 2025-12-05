// Demo Data - Static JSON data for demo mode
const DemoData = {
    // Users with hardcoded credentials
    users: {
        'admin': { id: 1, username: 'admin', password: 'admin123', role: 'admin', name: 'Administrator' },
        'teacher1': { id: 2, username: 'teacher1', password: 'teacher123', role: 'teacher', name: 'Budi Santoso, S.Pd', teacherId: 1 },
        'teacher2': { id: 3, username: 'teacher2', password: 'teacher123', role: 'teacher', name: 'Siti Nurhaliza, M.Pd', teacherId: 2 },
        'student1': { id: 4, username: 'student1', password: 'student123', role: 'student', name: 'Andi Wijaya', studentId: 1 },
        'student2': { id: 5, username: 'student2', password: 'student123', role: 'student', name: 'Dewi Lestari', studentId: 2 },
        'student3': { id: 6, username: 'student3', password: 'student123', role: 'student', name: 'Rudi Hartono', studentId: 3 }
    },

    // Teachers
    teachers: [
        { id: 1, name: 'Budi Santoso, S.Pd', nip: '198501012010011001', email: 'budi@demo.com' },
        { id: 2, name: 'Siti Nurhaliza, M.Pd', nip: '198703152012012002', email: 'siti@demo.com' },
        { id: 3, name: 'Ahmad Dahlan, S.Pd', nip: '199001202015011003', email: 'ahmad@demo.com' }
    ],

    // Students
    students: [
        { id: 1, name: 'Andi Wijaya', nis: '2023001', email: 'andi@demo.com', classId: 1 },
        { id: 2, name: 'Dewi Lestari', nis: '2023002', email: 'dewi@demo.com', classId: 1 },
        { id: 3, name: 'Rudi Hartono', nis: '2023003', email: 'rudi@demo.com', classId: 1 },
        { id: 4, name: 'Maya Sari', nis: '2023004', email: 'maya@demo.com', classId: 2 },
        { id: 5, name: 'Bima Sakti', nis: '2023005', email: 'bima@demo.com', classId: 2 }
    ],

    // Academic Years
    academicYears: [
        { id: 1, label: '2023/2024', isActive: true },
        { id: 2, label: '2024/2025', isActive: false }
    ],

    // Classes
    classes: [
        { id: 1, name: 'X IPA 1', academicYearId: 1, homeroomTeacherId: 1 },
        { id: 2, name: 'X IPA 2', academicYearId: 1, homeroomTeacherId: 2 },
        { id: 3, name: 'XI IPA 1', academicYearId: 1, homeroomTeacherId: null }
    ],

    // Subjects
    subjects: [
        { id: 1, name: 'Matematika' },
        { id: 2, name: 'Fisika' },
        { id: 3, name: 'Kimia' },
        { id: 4, name: 'Biologi' },
        { id: 5, name: 'Bahasa Indonesia' }
    ],

    // Class Subjects (Teaching Assignments)
    classSubjects: [
        { id: 1, classId: 1, subjectId: 1, teacherId: 1, day: 'Senin', startTime: '07:00', endTime: '08:30' },
        { id: 2, classId: 1, subjectId: 2, teacherId: 2, day: 'Selasa', startTime: '08:30', endTime: '10:00' },
        { id: 3, classId: 1, subjectId: 3, teacherId: 1, day: 'Rabu', startTime: '10:15', endTime: '11:45' },
        { id: 4, classId: 2, subjectId: 1, teacherId: 2, day: 'Kamis', startTime: '07:00', endTime: '08:30' },
        { id: 5, classId: 2, subjectId: 4, teacherId: 1, day: 'Jumat', startTime: '08:30', endTime: '10:00' }
    ],

    // Materials
    materials: [
        { id: 1, classSubjectId: 1, title: 'Materi Aljabar Linear', description: 'Pengenalan aljabar linear dan matriks', fileName: 'demo_material_1.pdf', createdAt: '2024-01-15 10:00:00' },
        { id: 2, classSubjectId: 1, title: 'Latihan Soal Matematika', description: 'Kumpulan soal latihan', fileName: 'demo_material_2.pdf', createdAt: '2024-01-20 14:30:00' },
        { id: 3, classSubjectId: 2, title: 'Hukum Newton', description: 'Materi tentang hukum gerak Newton', fileName: 'demo_material_3.pdf', createdAt: '2024-01-18 09:00:00' }
    ],

    // Assignments
    assignments: [
        { id: 1, classSubjectId: 1, title: 'Tugas Matriks', description: 'Selesaikan soal-soal matriks pada buku halaman 45-50', dueDate: '2024-02-01', attachment: null, createdAt: '2024-01-15 10:00:00' },
        { id: 2, classSubjectId: 2, title: 'Laporan Praktikum Fisika', description: 'Buat laporan hasil praktikum gerak lurus', dueDate: '2024-02-05', attachment: 'demo_assignment_2.pdf', createdAt: '2024-01-18 11:00:00' },
        { id: 3, classSubjectId: 3, title: 'Tugas Kimia Organik', description: 'Analisis struktur molekul organik', dueDate: '2024-02-10', attachment: null, createdAt: '2024-01-22 13:00:00' }
    ],

    // Submissions
    submissions: [
        { id: 1, assignmentId: 1, studentId: 1, fileName: 'demo_submission_1.pdf', submittedAt: '2024-01-28 15:30:00', score: 85, feedback: 'Bagus, tapi perlu lebih teliti' },
        { id: 2, assignmentId: 1, studentId: 2, fileName: 'demo_submission_2.pdf', submittedAt: '2024-01-29 10:00:00', score: 90, feedback: 'Sangat baik!' },
        { id: 3, assignmentId: 2, studentId: 1, fileName: 'demo_submission_3.pdf', submittedAt: '2024-02-03 16:00:00', score: null, feedback: null }
    ],

    // Helper methods
    getTeacherById(id) {
        return this.teachers.find(t => t.id === id);
    },

    getStudentById(id) {
        return this.students.find(s => s.id === id);
    },

    getClassById(id) {
        return this.classes.find(c => c.id === id);
    },

    getSubjectById(id) {
        return this.subjects.find(s => s.id === id);
    },

    getClassSubjectsByTeacherId(teacherId) {
        return this.classSubjects.filter(cs => cs.teacherId === teacherId).map(cs => ({
            ...cs,
            className: this.getClassById(cs.classId)?.name,
            subjectName: this.getSubjectById(cs.subjectId)?.name
        }));
    },

    getClassSubjectsByStudentId(studentId) {
        const student = this.getStudentById(studentId);
        if (!student) return [];
        return this.classSubjects.filter(cs => cs.classId === student.classId).map(cs => ({
            ...cs,
            className: this.getClassById(cs.classId)?.name,
            subjectName: this.getSubjectById(cs.subjectId)?.name,
            teacherName: this.getTeacherById(cs.teacherId)?.name
        }));
    },

    getMaterialsByClassSubjectId(classSubjectId) {
        return this.materials.filter(m => m.classSubjectId === classSubjectId);
    },

    getAssignmentsByClassSubjectId(classSubjectId) {
        return this.assignments.filter(a => a.classSubjectId === classSubjectId);
    },

    getSubmissionsByAssignmentId(assignmentId) {
        return this.submissions.filter(s => s.assignmentId === assignmentId).map(s => ({
            ...s,
            studentName: this.getStudentById(s.studentId)?.name
        }));
    },

    getSubmissionsByStudentId(studentId) {
        return this.submissions.filter(s => s.studentId === studentId);
    },

    getStudentsByClassId(classId) {
        return this.students.filter(s => s.classId === classId);
    },

    // Stats for admin dashboard
    getStats() {
        return {
            teachers: this.teachers.length,
            students: this.students.length,
            classes: this.classes.length,
            subjects: this.subjects.length
        };
    }
};
