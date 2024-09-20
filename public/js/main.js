// Function untuk search
function performSearch(searchInputId) {
    const searchQuery = document.getElementById(searchInputId).value;
    const url = new URL(window.location.href);
    url.searchParams.set('search', searchQuery);
    window.location.href = url.toString();
}

// Event listener untuk DOMContentLoaded
document.addEventListener('DOMContentLoaded', function () {
    // Reset the search field on page load
    const searchInput = document.querySelector('input[data-search-input]');
    if (searchInput) {
        searchInput.value = window.searchValue || '';
    }
    // Function untuk search
    function performSearch(searchInputId) {
        const searchQuery = document.getElementById(searchInputId).value;
        const url = new URL(window.location.href);
        url.searchParams.set('search', searchQuery);
        window.location.href = url.toString();
    }
    
    // Event listener untuk DOMContentLoaded
    document.addEventListener('DOMContentLoaded', function () {
        // Reset the search field on page load
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.value = window.searchValue || '';
        }
    
        // Menampilkan pesan sukses jika ada
        if (window.sessionSuccess) {
            alert(window.sessionSuccess);
        }
    
        // Menampilkan pesan kesalahan jika ada
        if (window.sessionError) {
            alert(window.sessionError);
        }
    });
    // Menampilkan pesan sukses jika ada
    if (window.sessionSuccess) {
        alert(window.sessionSuccess);
    }

    // Menampilkan pesan sukses jika ada
    if (window.successMessage) {
        alert(window.successMessage);
    }

    // Menampilkan pesan kesalahan jika ada
    if (window.errorMessage) {
        alert(window.errorMessage);
    }

    // Menampilkan pesan sukses dari session
    const sessionSuccess = "{{ session('success') }}";
    if (sessionSuccess) {
        alert(sessionSuccess);
    }

    // Menampilkan pesan kesalahan dari session
    const sessionError = "{{ session('error') }}";
    if (sessionError) {
        alert(sessionError);
    }
});

// Function untuk konfirmasi penghapusan
function confirmDeletion(event, form) {
    event.preventDefault();
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        form.submit();
    }
}