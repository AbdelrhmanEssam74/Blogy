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

    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const publishAlert = document.getElementById('publishAlert');
        const publishLink = document.getElementById('publishLink');

        // Show the alert if the user has no posts
        @if(auth()->user() && auth()->user()->role_id === 4 )
            publishAlert.style.display = 'flex';
        @else
            publishAlert.style.display = 'none';
        @endif

        // Handle click on the publish link
        publishLink.addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = '{{ route("articles.create-first") }}';
        });
    });

    function dismissAlert() {
        const publishAlert = document.getElementById('publishAlert');
        publishAlert.style.display = 'none';
    }


</script>
