document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('add-assignment').addEventListener('click', function(e) {
        e.preventDefault();
        loadContent('add_assignment.php');
    });

    document.getElementById('add-note').addEventListener('click', function(e) {
        e.preventDefault();
        loadContent('add_note.php');
    });

    document.getElementById('add-notice').addEventListener('click', function(e) {
        e.preventDefault();
        loadContent('add_notice.php');
    });

    document.getElementById('menu-toggle').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('wrapper').classList.toggle('toggled');
    });
});

function loadContent(page) {
    fetch(`../src/components/${page}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('content').innerHTML = html;
        });
}
