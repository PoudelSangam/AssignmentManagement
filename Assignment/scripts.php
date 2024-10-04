<?php
session_start();
$semester = $_SESSION['semester'];
$intake_year = $_SESSION['intake_year'];
$faculty = $_SESSION['faculty'];
$college = $_SESSION['college'];
?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const assignmentList = document.getElementById("assignment-list");
    const noDataFoundAlert = document.getElementById("no-data-found");
    const filterOptions = document.getElementById("filter-options");

    // Hide filter options by default
    filterOptions.classList.add("hidden");

    // Get PHP session variables
    const semester = "<?php echo $semester; ?>";
    const intakeYear = "<?php echo $intake_year; ?>";
    const faculty = "<?php echo $faculty; ?>";
    const college = "<?php echo $college; ?>";

    function fetchAssignments(search = '0', subject = '0', status = '0') {
        const url = `https://poudelsangam.com.np/Assignment/fetch_assignments.php?search=${encodeURIComponent(search)}&subject=${encodeURIComponent(subject)}&status=${encodeURIComponent(status)}&semester=${encodeURIComponent(semester)}&intake_year=${encodeURIComponent(intakeYear)}&faculty=${encodeURIComponent(faculty)}&college=${encodeURIComponent(college)}`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(assignments => {
                console.log('Fetched assignments:', assignments); // Debugging line
                renderAssignments(assignments);
            })
            .catch(error => {
                console.error('Error fetching assignments:', error); // Debugging line
                assignmentList.innerHTML = `<p class="text-red-500">Error fetching assignments: ${error.message}</p>`;
            });
    }

    function renderAssignments(assignments) {
        assignmentList.innerHTML = "";
        noDataFoundAlert.style.display = "none";

        if (assignments.length === 0) {
            noDataFoundAlert.style.display = "block";
            return;
        }

        assignments.forEach(assignment => {
            const currentDate = new Date();
            const deadlineDate = new Date(assignment['dead-line']);
            const timeDiff = deadlineDate - currentDate;
            const remainingDays = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

            const assignmentDiv = document.createElement("div");
            assignmentDiv.className = "bg-white rounded-lg overflow-hidden shadow-lg mb-4 mx-auto w-4/5";

            if (remainingDays < 0) {
                assignmentDiv.classList.add("bg-red-100");
            } else if (remainingDays === 0) {
                assignmentDiv.classList.add("bg-yellow-100");
            } else {
                assignmentDiv.classList.add("bg-green-100");
            }

            assignmentDiv.innerHTML = `
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">${assignment.subject}</div>
                    <p class="text-gray-700 text-base">Assignment ${assignment.assignment_number}</p>
                    <p class="text-gray-700 text-base">Deadline: ${assignment['dead-line']}</p>
                    <p class="text-gray-700 text-base">Remaining Days: ${remainingDays > 0 ? remainingDays + ' day(s)' : 'Closed'}</p>
                </div>
                <div class="px-6 py-4 text-center">
                    <button class="primary hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        onclick="window.location.href='assignment_detail.php?id=${assignment.id}'">
                        View Assignment
                    </button>
                </div>
            `;

            assignmentList.appendChild(assignmentDiv);
        });
    }

    document.getElementById("apply-filters").addEventListener("click", () => {
        const filterSubject = document.getElementById("filter-subject").value.toLowerCase();
        const filterStatus = document.getElementById("filter-status").value.toLowerCase();
       
        fetchAssignments('0', filterSubject, filterStatus);
    });

    document.getElementById("search-button").addEventListener("click", () => {
        const searchInput = document.getElementById("search-input").value.toLowerCase() || '';
        fetchAssignments(searchInput, '0', '0');
    });

    // Toggle filter options visibility with transition
    document.getElementById("filter-button").addEventListener("click", () => {
        if (filterOptions.classList.contains("hidden")) {
            filterOptions.classList.remove("hidden");
            filterOptions.classList.add("block");
        } else {
            filterOptions.classList.remove("block");
            filterOptions.classList.add("hidden");
        }
    });

    fetchAssignments();
});
</script>
