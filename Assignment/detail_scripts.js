document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const assignmentId = urlParams.get("id");
    const assignmentContainer = document.getElementById("assignment-container");

    function fetchAssignmentDetail(id) {
        const currentDate = new Date();
        const url = `https://poudelsangam.com.np/Assignment/fetch_assignment_detail.php?id=${id}&_=${currentDate.getTime()}`;

        fetch(url, {
            headers: {
                'Cache-Control': 'no-cache, no-store, must-revalidate',
                'Pragma': 'no-cache',
                'Expires': '0'
            }
        })
        .then(response => response.json())
        .then(assignment => {
            renderAssignmentDetail(assignment);
        })
        .catch(error => {
            console.error('Error fetching assignment details:', error);
        });
    }

    function renderAssignmentDetail(assignment) {
        const currentDate = new Date();
        const deadlineDate = new Date(assignment['dead-line']);
        const timeDiff = deadlineDate - currentDate;
        const remainingDays = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

        let statusClass = "";
        let statusText = "";

        if (remainingDays < 0) {
            statusClass = "bg-red-100 text-red-700";
            statusText = "Overdue";
        } else if(remainingDays === 0){
             statusClass = "bg-yellow-100 text-yellow-700";
            statusText = "Due is Today";
        } else {
            statusClass = "bg-green-100 text-green-700";
            statusText = "Ongoing";
        }

        assignmentContainer.className = `bg-white shadow-lg rounded-lg p-3 border-2 border-gray-200 ${statusClass}`;

        assignmentContainer.innerHTML = `
            <div class="mb-4">
                <h2 class="text-2xl font-semibold mb-2">Subject: ${assignment.subject} Assignment ${assignment.assignment_number}</h2>
                <p class="text-gray-700">Status: ${statusText}</p>
                <p class="text-gray-700">Deadline: ${deadlineDate.toDateString()}</p>
            </div>
            <div>
                <h3 class="text-xl font-medium mb-2">Question:</h3>
                <pre class="bg-gray-100 p-4 rounded-lg break-words whitespace-pre-wrap text-sm md:text-base text-justify">
                    ${assignment.assignment_question}
                </pre>
            </div>
        `;
    }

    fetchAssignmentDetail(assignmentId);
});
