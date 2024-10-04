 showLoadingAnimation();
    
        // Get elements
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('mySidebar');
        const overlay = document.getElementById('overlay');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        // Add click event listener to the mobile menu button
        mobileMenuButton.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // Function to toggle the sidebar
        function toggleSidebar() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }
          
          
          
          
          
  window.addEventListener('load', () => {
  // Show loader while the app is initializing
  //  showLoadingAnimation();
    hideLoadingAnimation();
    showAppContent();
    // Simulating 3 seconds of loading
})

// Show/hide notification overlay
document.getElementById('notificationButton').addEventListener('click', function() {
    const overlay = document.getElementById('notificationOverlay');
    overlay.classList.toggle('hidden');
});

document.getElementById('closeOverlayButton').addEventListener('click', function() {
    const overlay = document.getElementById('notificationOverlay');
    overlay.classList.add('hidden');
});


function showLoadingAnimation() {
  document.getElementById('loading-animation').style.display = 'flex';
}

function hideLoadingAnimation() {
  document.getElementById('loading-animation').style.display = 'none';
}

function showAppContent() {
  document.getElementById('app-content').style.display = 'block';
}


// Fetch notifications using jQuery AJAX
function fetchNotifications() {
    $.ajax({
        url: 'https://poudelsangam.com.np/Assignment/send_notification/show_notification_in_header.php',  // Backend endpoint to fetch notifications
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Pass the notifications array to the updateNotifications function
            updateNotifications(data.notifications);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching notifications:', errorThrown);
        }
    });
}

// Function to get relative time (e.g., "1 min ago", "2 hours ago")
function timeAgo(timestamp) {
    const now = new Date();
    const then = new Date(timestamp);
    const seconds = Math.floor((now - then) / 1000);
    const interval = Math.floor(seconds / 31536000);

    if (interval > 1) return `${interval} years ago`;
    if (interval === 1) return '1 year ago';
    const month = Math.floor(seconds / 2592000);
    if (month > 1) return `${month} months ago`;
    if (month === 1) return '1 month ago';
    const week = Math.floor(seconds / 604800);
    if (week > 1) return `${week} weeks ago`;
    if (week === 1) return '1 week ago';
    const day = Math.floor(seconds / 86400);
    if (day > 1) return `${day} days ago`;
    if (day === 1) return '1 day ago';
    const hour = Math.floor(seconds / 3600);
    if (hour > 1) return `${hour} hours ago`;
    if (hour === 1) return '1 hour ago';
    const minute = Math.floor(seconds / 60);
    if (minute > 1) return `${minute} minutes ago`;
    if (minute === 1) return '1 minute ago';
    return 'just now';
}
function updateNotifications(notifications) {
    const notificationList = $('#notificationList');
    const notificationBadge = $('#notificationBadge');
    notificationList.empty(); // Clear existing notifications

    // Update the badge count
    if (notifications.length > 0) {
        notificationBadge.text(notifications.length);
        notificationBadge.removeClass('hidden'); // Show the badge
    } else {
        notificationBadge.addClass('hidden'); // Hide the badge if no notifications
    }

    // Populate notification list
    if (notifications.length === 0) {
        notificationList.append('<li class="border-b py-2 text-gray-700">No new notifications</li>');
    } else {
        notifications.forEach(function(notification) {
            const relativeTime = timeAgo(notification.time);
            notificationList.append('<li class="border-b py-3 text-gray-700">' + notification.message + '<br> <span class="text-gray-500 text-sm">' + relativeTime + '</span></li>');
        });
    }
}
fetchNotifications(); // Fetch notifications when required
