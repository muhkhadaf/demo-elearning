document.addEventListener('DOMContentLoaded', function(){
  if (window.lucide && typeof window.lucide.createIcons === 'function') {
    window.lucide.createIcons();
  }
  var back = document.getElementById('backButton');
  if (back) {
    back.addEventListener('click', function(e){
      e.preventDefault();
      var role = (back.getAttribute('data-role') || '').toLowerCase();
      var page = 'login';
      if (role === 'admin') page = 'admin';
      else if (role === 'teacher') page = 'teacher';
      else if (role === 'student') page = 'student';
      window.location.href = 'index.php?page=' + page;
    });
  }
});

document.addEventListener('click', function(e){
  if(e.target && e.target.matches('[data-confirm]')){
    if(!confirm(e.target.getAttribute('data-confirm'))) e.preventDefault();
  }
});