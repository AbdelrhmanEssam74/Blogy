<div class="publish-alert" id="publishAlert">
    <div class="alert-content">
        <p class="text-center">
            <i class="fa-notdog fa-solid fa-pencil"></i> Want to share your ideas?
            <a href="#" class="underline" id="publishLink">Publish your first article</a>
            and join our growing community of writers!
        </p>
    </div>
    <button class="btn-close" aria-label="Close" onclick="dismissAlert()">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>
    </button>
</div>

<!-- The Modal -->
<div id="publishModal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Publish Your Article</h2>
        <p>Ready to share your ideas with our community? Fill out the form below to get started!</p>

        <form id="articleForm">
            <div class="form-group">
                <label for="articleTitle">Title</label>
                <input type="text" id="articleTitle" placeholder="Enter your article title" required>
            </div>

            <div class="form-group">
                <label for="articleContent">Content</label>
                <textarea id="articleContent" rows="6" placeholder="Write your article here..." required></textarea>
            </div>
{{--     upload article image--}}
            <div class="form-group">
                <label for="articleImage">Upload Image</label>
                <input type="file" id="articleImage" accept="image/*">
                <small class="form-text text-muted">Add an image to enhance your article.</small>
            </div>

            <div class="form-group">
                <label for="articleTags">Tags (comma separated)</label>
                <input type="text" id="articleTags" placeholder="e.g., technology, writing, tips">
            </div>

            <button type="submit" class="submit-btn">Submit Article</button>
        </form>
    </div>
</div>

<style>
    .publish-alert {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #d6f9ff;
        padding: 15px 40px 15px 20px;
        border: none;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        gap: 15px;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        animation: slideUp 0.5s ease-out;
    }

    .publish-alert p {
        text-align: center;
        margin: 0;
        font-size: 16px;
        color: #333;
        font-weight: 500;
    }

    .publish-alert a {
        color: #2563eb;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .publish-alert a:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }

    .btn-close {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        border-radius: 50%;
        transition: all 0.2s ease;
        color: #6b7280;
    }

    .btn-close:hover {
        background-color: #f3f4f6;
        color: #4b5563;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1100;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        animation: fadeIn 0.3s;
    }

    .modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 25px;
        border-radius: 8px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        position: relative;
    }

    .modal-close {
        position: absolute;
        right: 20px;
        top: 15px;
        font-size: 28px;
        font-weight: bold;
        color: #aaa;
        cursor: pointer;
    }

    .modal-close:hover {
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .form-group textarea {
        resize: vertical;
    }

    .submit-btn {
        background-color: #2563eb;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: background-color 0.3s;
        width: 100%;
    }

    .submit-btn:hover {
        background-color: #1d4ed8;
    }

    /* Animations */
    @keyframes slideUp {
        from {
            transform: translateY(100%);
        }
        to {
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }

    @media (max-width: 640px) {
        .publish-alert {
            padding: 12px 36px 12px 16px;
        }

        .publish-alert p {
            font-size: 14px;
        }

        .modal-content {
            margin: 10% auto;
            width: 95%;
        }
    }
</style>

<script>
    // Alert dismissal
    function dismissAlert() {
        const alert = document.getElementById('publishAlert');
        alert.style.animation = 'fadeOut 0.3s ease-out';
        setTimeout(() => {
            alert.style.display = 'none';
            localStorage.setItem('alertDismissed', 'true');
        }, 250);
    }

    // Modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Check if alert was dismissed
        if (localStorage.getItem('alertDismissed') === 'true') {
            document.getElementById('publishAlert').style.display = 'none';
        }

        // Get modal elements
        const modal = document.getElementById('publishModal');
        const publishLink = document.getElementById('publishLink');
        const closeBtn = document.querySelector('.modal-close');

        // Open modal when publish link is clicked
        publishLink.addEventListener('click', function(e) {
            e.preventDefault();
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        });

        // Close modal when X is clicked
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        // Form submission
        document.getElementById('articleForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Here you would normally send the data to your server
            alert('Article submitted! (This is a demo)');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
            dismissAlert(); // Optionally dismiss the alert after submission
        });
    });
</script>
