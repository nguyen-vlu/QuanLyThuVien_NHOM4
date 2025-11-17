document.addEventListener('DOMContentLoaded', function(){
  const searchInput = document.getElementById('site-search');
  if (searchInput){
    searchInput.addEventListener('keypress', function(e){
      if (e.key === 'Enter'){
        const q = encodeURIComponent(this.value.trim());
        if (q.length) window.location.href = 'ThuVien.php?q=' + q;
      }
    });
  }

  document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', (e) => {
      const f = e.target.files[0];
      const name = f ? f.name : '';
      if (name) {
        let l = e.target.nextElementSibling;
        if (l) l.textContent = name;
      }
    });
  });
});
