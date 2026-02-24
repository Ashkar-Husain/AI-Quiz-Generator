// Sidebar Toggle
const sidebar = document.getElementById('sidebar');
const toggleBtn = document.getElementById('toggleSidebar');
const mobileToggle = document.getElementById('mobileToggle');

toggleBtn.addEventListener('click', function () {
    sidebar.classList.toggle('collapsed');
    const icon = this.querySelector('i');
    if (sidebar.classList.contains('collapsed')) {
        icon.classList.remove('fa-chevron-left');
        icon.classList.add('fa-chevron-right');
    } else {
        icon.classList.remove('fa-chevron-right');
        icon.classList.add('fa-chevron-left');
    }
});

// Mobile Toggle
mobileToggle.addEventListener('click', function () {
    sidebar.classList.toggle('active');
});

// Close sidebar when clicking outside on mobile
document.addEventListener('click', function (event) {
    if (window.innerWidth <= 768 && !sidebar.contains(event.target) && !mobileToggle.contains(event
        .target)) {
        sidebar.classList.remove('active');
    }
});

// Dropdown Toggle
const dropdownToggle = document.getElementById('dropdownToggle');
const dropdownMenu = document.getElementById('dropdownMenu');
const dropdownCaret = dropdownToggle.querySelector('.dropdown-caret i');

dropdownToggle.addEventListener('click', function (e) {
    e.stopPropagation();
    dropdownMenu.classList.toggle('show');

    if (dropdownMenu.classList.contains('show')) {
        dropdownCaret.classList.remove('fa-chevron-down');
        dropdownCaret.classList.add('fa-chevron-up');
    } else {
        dropdownCaret.classList.remove('fa-chevron-up');
        dropdownCaret.classList.add('fa-chevron-down');
    }
});

// Close dropdown when clicking outside
document.addEventListener('click', function () {
    dropdownMenu.classList.remove('show');
    dropdownCaret.classList.remove('fa-chevron-up');
    dropdownCaret.classList.add('fa-chevron-down');
});

// Prevent dropdown from closing when clicking inside it
dropdownMenu.addEventListener('click', function (e) {
    e.stopPropagation();
});

// Menu item active state
const menuItems = document.querySelectorAll('.menu-item');
menuItems.forEach(item => {
    item.addEventListener('click', function () {
        menuItems.forEach(i => i.classList.remove('active'));
        this.classList.add('active');

        // Close sidebar on mobile after clicking a menu item
        if (window.innerWidth <= 768) {
            sidebar.classList.remove('active');
        }
    });
});
