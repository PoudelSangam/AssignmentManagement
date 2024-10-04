
$(document).ready(function() {
    const assignmentList = $("#assignmentList");
    const filterOptions = $("#filter-options");
   const page = $("#page").val();

    // Hide filter options by default
    filterOptions.addClass("hidden");

    // Function to fetch assignments
    function fetchAssignments(search = '0', subject = '0', status = '0',page='1') {
        const url = `https://poudelsangam.com.np/Assignment/fetch_assignments.php`;
        const cacheBuster = new Date().getTime(); // Cache buster

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                search: search,
                subject: subject,
                status: status,
                page:page,
                _: cacheBuster // Add cache buster parameter
            },
            success: function(response) {
                console.log('Fetched assignments:', response); // Debugging line
                try {
                    assignmentList.html(response);
                } catch (e) {
                    console.error('Error processing response:', e);
                    assignmentList.html('<p class="text-red-500">Error processing response.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching assignments:', error); // Debugging line
                assignmentList.html(`<p class="text-red-500">Error fetching assignments: ${error}</p>`);
            }
        });
    }

    // Event listeners for search and filters
    $("#apply-filters").on("click", function() {
        const filterSubject = $("#filter-subject").val().toLowerCase();
        const filterStatus = $("#filter-status").val().toLowerCase();
        fetchAssignments('0', filterSubject, filterStatus,'1');
    });

    $("#search-button").on("click", function() {
        const searchInput = $("#search-input").val().toLowerCase() || '';
        fetchAssignments(searchInput, '0', '0','1');
    });

    // Toggle filter options visibility
    $("#filter-button").on("click", function() {
        filterOptions.toggleClass("hidden");
    });

    // Initial fetch to display assignments on page load
    fetchAssignments('0','0','0',page);

    // Auto-refresh every 1 minutes (300000 milliseconds)
    setInterval(fetchAssignments, 300000);
});







