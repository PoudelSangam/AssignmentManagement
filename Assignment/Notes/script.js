document.addEventListener('DOMContentLoaded', () => {
  // Load previously saved results if they exist
  if (localStorage.getItem('searchResults')) {
    const savedResults = JSON.parse(localStorage.getItem('searchResults'));
    displaySubjectDetails(savedResults);
  }

  // Event listener for the search button
  document.getElementById('search-button').addEventListener('click', searchSubjects);

  // Search when Enter key is pressed
  document.getElementById('search-input').addEventListener('keyup', (event) => {
    if (event.key === 'Enter') {
      searchSubjects();
    }
  });

  // Populate the dropdown with static subjects from JSON
  populateSubjects();
  
  // Function to populate the subjects dropdown
function populateSubjects() {
  const subjectSelect = document.getElementById('subject');
  const semesterNumber = "Semester " + semester;
  const subjectList = subjects[faculty]?.[curriculumType]?.[semesterNumber] || [];

  subjectList.forEach(subject => {
    const option = document.createElement('option');
    option.value = subject;
    option.textContent = subject;
    subjectSelect.appendChild(option);
  });
}

  // Event listener for subject selection
  document.getElementById('subject').addEventListener('change', function() {
    const selectedSubject = this.value;
    if (selectedSubject) {
      fetchSubjectDetails(selectedSubject, faculty, semester);
    }
  });
});

// Function to search subjects from the database
function searchSubjects() {
  const searchQuery = document.getElementById('search-input').value;

  $.ajax({
    url: 'backend.php',
    type: 'POST',
    data: { subject: searchQuery, faculty: '', semester: '' },
    dataType: 'json', // Specify that we expect JSON
    success: function(response) {
      // Save search results in localStorage
      localStorage.setItem('searchResults', JSON.stringify(response));
      displaySubjectDetails(response);
    },
    error: function() {
      console.error('Error fetching search results.');
    }
  });
}

// Function to fetch subject details
function fetchSubjectDetails(subject, faculty, semester) {
  $.ajax({
    url: 'backend.php',
    type: 'POST',
    data: { subject: subject, faculty: faculty, semester: 'Semester ' + semester },
    dataType: 'json', // Specify that we expect JSON
    success: function(response) {
      // Save search results in localStorage
      localStorage.setItem('searchResults', JSON.stringify(response));
      displaySubjectDetails(response);
    },
    error: function(xhr, status, error) {
      console.error('Error fetching subject details:', error);
    }
  });
}

// Function to display subject details
function displaySubjectDetails(details) {
  const resultsContainer = document.getElementById('search-results');
  resultsContainer.innerHTML = '';  // Clear previous results

  if (details.error) {
    const errorMessage = document.createElement('div');
    errorMessage.className = 'text-red-500 font-semibold text-center';
    errorMessage.textContent = details.error;
    resultsContainer.appendChild(errorMessage);
    return;
  }

  if (!Array.isArray(details)) {
    console.error("Expected an array but got:", details);
    return;
  }

  resultsContainer.className = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-4';

  details.forEach(detail => {
    if (!detail.subject || !detail.description) {
      console.warn("Missing subject or description in detail:", detail);
      return;
    }

    const detailItem = document.createElement('div');
    detailItem.className = 'block bg-gradient-to-r from-blue-50 via-white to-blue-50 rounded-xl overflow-hidden shadow-lg mb-6  hover:shadow-xl duration-300';

    detailItem.innerHTML = `
      <div class="px-8 py-6 relative">
        <h2 class="font-bold text-2xl mb-4 text-gray-900">${detail.title}</h2>
        <p class="text-gray-600 mb-4">${detail.description}</p>
        <span class="absolute top-1 right-4 text-white bg-blue-600 rounded-full px-3 py-1 text-xs font-semibold">${detail.subject}</span>
        <div class="flex justify-between mt-4">
          <!-- View Button -->
          <a href="show_pdf.php?faculty=${encodeURIComponent(detail.faculty)}&semester=${encodeURIComponent(detail.semester)}&subject=${encodeURIComponent(detail.subject)}&id=${encodeURIComponent(detail.pdf_name)}" 
             class="flex items-center text-blue-500 hover:text-blue-700 transition duration-200">
             
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 eye" viewBox="0 0 24 24" fill="currentColor">
  <g>
    <path d="M12 4.5C7.305 4.5 3.283 7.168 1.5 11.25a10.963 10.963 0 001.563 2.805c.885 1.163 2.088 2.17 3.437 2.887C7.282 17.832 9.622 18.75 12 18.75c4.695 0 8.717-2.668 10.5-6.75a10.963 10.963 0 00-1.563-2.805c-.885-1.163-2.088-2.17-3.437-2.887C16.718 6.168 14.378 5.25 12 5.25c-2.378 0-4.718.918-6.188 2.478A9.99 9.99 0 003 12c0 1.322.272 2.597.812 3.738.54 1.14 1.304 2.167 2.188 3a9.887 9.887 0 006 2.25 9.887 9.887 0 006-2.25c.884-.833 1.648-1.86 2.188-3A9.929 9.929 0 0021 12c0-1.322-.272-2.597-.812-3.738-.54-1.14-1.304-2.167-2.188-3A9.887 9.887 0 0012 4.5zm0 3.75c1.655 0 3 1.345 3 3s-1.345 3-3 3-3-1.345-3-3 1.345-3 3-3z" />
  </g>
  <!-- Pupil (for blinking effect) -->
  <circle class="pupil" cx="12" cy="12" r="3" fill="black" />
</svg>
            View
          </a>
          
          

         <!-- Download Button (Trigger via JS) -->
<button onclick="handleDownloadClick(this, '${detail.faculty}', '${detail.semester}', '${detail.subject}', '${detail.pdf_name}')"
    class="flex items-center text-green-500 hover:text-green-700 transition duration-200 relative">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
        <path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v8.69l2.72-2.72a.75.75 0 111.06 1.06l-4 4a.75.75 0 01-1.06 0l-4-4a.75.75 0 011.06-1.06l2.72 2.72V3a.75.75 0 01.75-.75z" clip-rule="evenodd" />
        <path fill-rule="evenodd" d="M3.75 18a.75.75 0 01.75-.75h15a.75.75 0 010 1.5h-15a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
    </svg>
    <span class="text">Download</span>
    <div class="spinner hidden absolute inset-0 mx-auto my-auto flex justify-center items-center">
        <div class="animate-ping h-2 w-2 rounded-full bg-green-500"></div>
        <div class="percentage absolute text-green-700 font-semibold">0%</div>
    </div>
</button>

      </div>
      </div>
    `;

    // Append the card to the container
    resultsContainer.appendChild(detailItem);
  });
}

// Function to download PDF via JavaScript
function downloadPDF(faculty, semester, subject, pdfName) {
  const downloadUrl = `https://poudelsangam.com.np/Assignment/Notes/file/${encodeURIComponent(faculty)}/${encodeURIComponent(semester)}/${encodeURIComponent(subject)}/${encodeURIComponent(pdfName)}`;
  const link = document.createElement('a');
  link.href = downloadUrl;
  link.setAttribute('download', pdfName);
  document.body.appendChild(link);
  link.click();
  link.remove();
}
function handleDownloadClick(button, faculty, semester, subject, pdfName) {
        const spinner = button.querySelector('.spinner');
        const text = button.querySelector('.text');
        const percentage = button.querySelector('.percentage');

        // Show spinner, hide text, and reset percentage
        spinner.classList.remove('hidden');
        text.classList.add('hidden');
        percentage.textContent = '0%';

        // Simulate the download process and update the percentage
        let downloadProgress = 0;
        const downloadInterval = setInterval(() => {
            downloadProgress += 10; // Increase progress by 10%
            percentage.textContent = `${downloadProgress}%`;

            // Once download is 100%, stop and reset
            if (downloadProgress >= 100) {
                clearInterval(downloadInterval);

                // Simulate download completion action
                downloadPDF(faculty, semester, subject, pdfName);

                // Hide spinner, show text, and reset percentage
                spinner.classList.add('hidden');
                text.classList.remove('hidden');
            }
        }, 200); // Adjust the interval timing as needed for realistic progress
    }
