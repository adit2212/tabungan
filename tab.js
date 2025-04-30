   // Modal functionality
   const modal = document.getElementById('recordModal');
   const addBtn = document.getElementById('addBtn');
   const closeModal = document.getElementById('closeModal');
   const cancelBtn = document.getElementById('cancelBtn');

   addBtn.addEventListener('click', () => {
       document.getElementById('modalTitle').textContent = 'Tambah Pencatatan Baru';
       modal.style.display = 'flex';
   });

   closeModal.addEventListener('click', () => {
       modal.style.display = 'none';
   });

   cancelBtn.addEventListener('click', () => {
       modal.style.display = 'none';
   });

   window.addEventListener('click', (e) => {
       if (e.target === modal) {
           modal.style.display = 'none';
       }
   });

   // Edit buttons functionality
//    const editButtons = document.querySelectorAll('.btn-warning');
//    editButtons.forEach(button => {
//        button.addEventListener('click', () => {
//            document.getElementById('modalTitle').textContent = 'Edit Pencatatan';
//            modal.style.display = 'flex';
//            // Here you would populate the form with existing data
//        });
//    });

   const editButtons = document.querySelectorAll('.btn-warning');
editButtons.forEach(button => {
    button.addEventListener('click', () => {
        const id = button.getAttribute('data-id');
        document.getElementById('modalTitle').textContent = 'Edit Pencatatan';
        modal.style.display = 'flex';
        
        // Mengambil data via AJAX
        fetch('get_data.php?id=' + id)
            .then(response => response.json())
            .then(data => {
                // Isi form modal dengan data yang diterima
                document.getElementById('inputNama').value = data.nama;
                document.getElementById('inputKeterangan').value = data.keterangan;
                // dst untuk field lainnya
                document.getElementById('dataId').value = id; // input hidden untuk menyimpan ID
            });
    });
});

   // Search functionality
   const searchInput = document.querySelector('.search-box input');
   searchInput.addEventListener('input', (e) => {
       const searchTerm = e.target.value.toLowerCase();
       const rows = document.querySelectorAll('tbody tr');
       
       rows.forEach(row => {
           const text = row.textContent.toLowerCase();
           if (text.includes(searchTerm)) {
               row.style.display = '';
           } else {
               row.style.display = 'none';
           }
       });
   });