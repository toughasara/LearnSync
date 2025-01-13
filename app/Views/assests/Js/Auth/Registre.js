document.addEventListener('DOMContentLoaded', function() {
    const studentBtn = document.getElementById('studentBtn');
    const teacherBtn = document.getElementById('teacherBtn');
    const studentForm = document.getElementById('studentForm');
    const teacherForm = document.getElementById('teacherForm');

    studentBtn.addEventListener('click', function() {
        studentBtn.classList.add('active');
        teacherBtn.classList.remove('active');
        studentForm.style.display = 'block';
        teacherForm.style.display = 'none';
    });

    teacherBtn.addEventListener('click', function() {
        teacherBtn.classList.add('active');
        studentBtn.classList.remove('active');
        teacherForm.style.display = 'block';
        studentForm.style.display = 'none';
    });
});