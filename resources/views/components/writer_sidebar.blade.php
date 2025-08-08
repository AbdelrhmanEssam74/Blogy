<div class="luxury-sidebar">
        <!-- Sidebar Menu -->
    <nav class="luxury-sidebar-menu">
        <div class="luxury-menu-section">
            <div class="luxury-menu-title">MAIN</div>
            <a href="/writer/dashboard" class="luxury-menu-item active">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a href="/writer/articles" class="luxury-menu-item">
                <i class="bi bi-file-text"></i>
                <span>My Articles</span>
                <span class="luxury-menu-badge">24</span>
            </a>
            <a href="/writer/analytics" class="luxury-menu-item">
                <i class="bi bi-bar-chart"></i>
                <span>Analytics</span>
            </a>
        </div>

        <div class="luxury-menu-section">
            <div class="luxury-menu-title">CONTENT</div>
            <a href="/writer/articles/create" class="luxury-menu-item">
                <i class="bi bi-plus-circle"></i>
                <span>New Article</span>
            </a>
            <a href="/writer/drafts" class="luxury-menu-item">
                <i class="bi bi-file-earmark"></i>
                <span>Drafts</span>
                <span class="luxury-menu-badge">3</span>
            </a>
            <a href="/writer/scheduled" class="luxury-menu-item">
                <i class="bi bi-calendar"></i>
                <span>Scheduled</span>
            </a>
        </div>

        <div class="luxury-menu-section">
            <div class="luxury-menu-title">SETTINGS</div>
            <a href="/writer/profile" class="luxury-menu-item">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
            <a href="/writer/notifications" class="luxury-menu-item">
                <i class="bi bi-bell"></i>
                <span>Notifications</span>
                <span class="luxury-menu-badge">5</span>
            </a>
            <a href="/writer/settings" class="luxury-menu-item">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </div>
    </nav>
</div>

<style>
    :root {
        --luxury-sidebar-width: 200px;
        --luxury-sidebar-collapsed-width: 80px;
        --luxury-gold: #c9a668;
        --luxury-dark: #1a1a1a;
        --luxury-light: #f8f5f0;
        --luxury-border: #e0d6c2;
        --luxury-text: #333333;
        --luxury-meta: #6c757d;
    }
    .luxury-sidebar {
        flex: 0 0 var(--luxury-sidebar-width); /* Fixed width from your variable */
    }

    .luxury-sidebar {
        width: var(--luxury-sidebar-width);
        height: 100vh;
        left: 0;
        top: 0;
        background-color: white;
        display: flex;
        flex-direction: column;
        transition: width 0.3s ease;
    }

    .luxury-sidebar-menu {
        flex: 1;
        padding: 1.5rem 0;
    }

    .luxury-menu-section {
        margin-bottom: 1.5rem;
    }

    .luxury-menu-title {
        padding: 0.5rem 1.5rem;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--luxury-meta);
        margin-bottom: 0.5rem;
    }

    .luxury-menu-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        color: var(--luxury-text);
        text-decoration: none;
        transition: all 0.2s ease;
        position: relative;
    }

    .luxury-menu-item i {
        font-size: 1.1rem;
        margin-right: 1rem;
        color: var(--luxury-meta);
        flex-shrink: 0;
    }

    .luxury-menu-item span {
        white-space: nowrap;
    }

    .luxury-menu-item:hover {
        background-color: var(--luxury-light);
        color: var(--luxury-dark);
    }

    .luxury-menu-item:hover i {
        color: var(--luxury-gold);
    }

    .luxury-menu-item.active {
        background-color: rgba(201, 166, 104, 0.1);
        color: var(--luxury-dark);
        border-left: 3px solid var(--luxury-gold);
    }

    .luxury-menu-item.active i {
        color: var(--luxury-gold);
    }

    .luxury-menu-badge {
        margin-left: auto;
        background-color: var(--luxury-gold);
        color: white;
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
        border-radius: 10px;
    }

    .luxury-sidebar-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--luxury-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .luxury-user-profile {
        display: flex;
        align-items: center;
    }

    .luxury-user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 0.75rem;
    }

    .luxury-user-name {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--luxury-dark);
        line-height: 1.2;
    }

    .luxury-user-role {
        font-size: 0.75rem;
        color: var(--luxury-meta);
    }

    .luxury-logout-btn {
        color: var(--luxury-meta);
        font-size: 1.25rem;
        transition: color 0.2s ease;
    }

    .luxury-logout-btn:hover {
        color: var(--luxury-gold);
    }

    /* Collapsed state */
    .luxury-sidebar.collapsed {
        width: var(--luxury-sidebar-collapsed-width);
    }

    .luxury-sidebar.collapsed .luxury-sidebar-logo span,
    .luxury-sidebar.collapsed .luxury-menu-title,
    .luxury-sidebar.collapsed .luxury-menu-item span,
    .luxury-sidebar.collapsed .luxury-menu-badge,
    .luxury-sidebar.collapsed .luxury-user-info,
    .luxury-sidebar.collapsed .luxury-user-name,
    .luxury-sidebar.collapsed .luxury-user-role {
        display: none;
    }

    .luxury-sidebar.collapsed .luxury-menu-item {
        justify-content: center;
        padding: 0.75rem 0;
    }

    .luxury-sidebar.collapsed .luxury-menu-item i {
        margin-right: 0;
    }

    .luxury-sidebar.collapsed .luxury-sidebar-footer {
        justify-content: center;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .luxury-sidebar {
            width: var(--luxury-sidebar-collapsed-width);
        }

        .luxury-sidebar-logo span,
        .luxury-menu-title,
        .luxury-menu-item span,
        .luxury-menu-badge,
        .luxury-user-info,
        .luxury-user-name,
        .luxury-user-role {
            display: none;
        }

        .luxury-menu-item {
            justify-content: center;
            padding: 0.75rem 0;
        }

        .luxury-menu-item i {
            margin-right: 0;
        }

        .luxury-sidebar-footer {
            justify-content: center;
        }

        .luxury-sidebar-toggle {
            display: block;
        }

        .luxury-sidebar.expanded {
            width: var(--luxury-sidebar-width);
        }

        .luxury-sidebar.expanded .luxury-sidebar-logo span,
        .luxury-sidebar.expanded .luxury-menu-title,
        .luxury-sidebar.expanded .luxury-menu-item span,
        .luxury-sidebar.expanded .luxury-menu-badge,
        .luxury-sidebar.expanded .luxury-user-info,
        .luxury-sidebar.expanded .luxury-user-name,
        .luxury-sidebar.expanded .luxury-user-role {
            display: block;
        }

        .luxury-sidebar.expanded .luxury-menu-item {
            justify-content: flex-start;
            padding: 0.75rem 1.5rem;
        }

        .luxury-sidebar.expanded .luxury-menu-item i {
            margin-right: 1rem;
        }

        .luxury-sidebar.expanded .luxury-sidebar-footer {
            justify-content: space-between;
        }
    }
</style>

<script>
    // Toggle sidebar collapse/expand
    document.querySelector('.luxury-sidebar-toggle').addEventListener('click', function() {
        document.querySelector('.luxury-sidebar').classList.toggle('expanded');
    });
</script>
