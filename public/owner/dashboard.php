<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Employee Directory | Leave Manager</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    :root {
      --primary: #6366f1;
      --primary-dark: #4f46e5;
      --primary-light: #818cf8;
      --dark-bg: #0f172a;
      --dark-surface: rgba(30, 41, 59, 0.4);
      --dark-card: rgba(51, 65, 85, 0.3);
      --dark-border: rgba(255, 255, 255, 0.1);
      --text-primary: #f1f5f9;
      --text-secondary: #cbd5e1;
      --text-muted: #94a3b8;
      --success: #10b981;
      --error: #ef4444;
      --warning: #f59e0b;
      --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
      --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.2),
        0 2px 4px -2px rgba(0, 0, 0, 0.1);
      --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.3),
        0 4px 6px -4px rgba(0, 0, 0, 0.2);
      --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.4),
        0 8px 10px -6px rgba(0, 0, 0, 0.2);
      --border-radius: 16px;
      --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI",
        Roboto, sans-serif;
      background: linear-gradient(135deg, #0f172a, #1e293b, #334155);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      position: relative;
      overflow-x: hidden;
      color: var(--text-primary);
    }

    /* Enhanced animated background */
    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: radial-gradient(circle at 15% 70%,
          rgba(99, 102, 241, 0.25) 0%,
          transparent 40%),
        radial-gradient(circle at 85% 30%,
          rgba(129, 140, 248, 0.2) 0%,
          transparent 40%),
        radial-gradient(circle at 50% 20%,
          rgba(79, 70, 229, 0.15) 0%,
          transparent 40%);
      z-index: -1;
      animation: backgroundShift 20s ease-in-out infinite alternate;
    }

    @keyframes backgroundShift {
      0% {
        opacity: 0.7;
        transform: scale(1) rotate(0deg);
      }

      50% {
        opacity: 0.9;
      }

      100% {
        opacity: 0.7;
        transform: scale(1.05) rotate(1deg);
      }
    }

    /* Enhanced glowing particles */
    .particles {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      overflow: hidden;
    }

    .particle {
      position: absolute;
      background: rgba(99, 102, 241, 0.4);
      border-radius: 50%;
      animation: float 25s infinite linear;
      opacity: 0;
      filter: blur(1px);
    }

    .particle:nth-child(2n) {
      background: rgba(129, 140, 248, 0.3);
    }

    .particle:nth-child(3n) {
      background: rgba(79, 70, 229, 0.3);
    }

    @keyframes float {
      0% {
        transform: translateY(0) translateX(0) rotate(0deg);
        opacity: 0;
      }

      10% {
        opacity: 0.6;
      }

      90% {
        opacity: 0.3;
      }

      100% {
        transform: translateY(-100vh) translateX(100vw) rotate(360deg);
        opacity: 0;
      }
    }

    /* Enhanced Navbar styling */
    .navbar {
      background: rgba(30, 41, 59, 0.6);
      backdrop-filter: blur(24px) saturate(180%);
      width: 100%;
      padding: 1.25rem 3rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: var(--shadow-lg), 0 0 0 1px rgba(255, 255, 255, 0.05);
      border-bottom: 1px solid var(--dark-border);
      position: sticky;
      top: 0;
      z-index: 100;
      transition: var(--transition);
    }

    .navbar.scrolled {
      padding: 0.75rem 3rem;
      background: rgba(30, 41, 59, 0.8);
    }

    .navbar-brand {
      display: flex;
      align-items: center;
      gap: 1rem;
      text-decoration: none;
    }

    .navbar-logo {
      width: 42px;
      height: 42px;
      background: linear-gradient(135deg,
          var(--primary),
          var(--primary-light));
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--text-primary);
      font-size: 1.25rem;
      box-shadow: var(--shadow-md), inset 0 1px 0 rgba(255, 255, 255, 0.2);
      transition: var(--transition);
    }

    .navbar:hover .navbar-logo {
      transform: rotate(15deg) scale(1.1);
    }

    .navbar-title {
      color: var(--text-primary);
      font-weight: 700;
      font-size: 1.5rem;
      letter-spacing: -0.5px;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .nav-links {
      display: flex;
      gap: 2rem;
      position: relative;
    }

    .nav-button {
      background: none;
      border: none;
      color: var(--text-secondary);
      padding: 0.75rem 1.5rem;
      border-radius: 50px;
      cursor: pointer;
      font-weight: 500;
      font-size: 1rem;
      transition: var(--transition);
      position: relative;
      overflow: hidden;
      font-family: "Inter", sans-serif;
      backdrop-filter: blur(5px);
    }

    .nav-button::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg,
          transparent,
          rgba(255, 255, 255, 0.1),
          transparent);
      transition: var(--transition);
    }

    .nav-button:hover::before {
      left: 100%;
    }

    .nav-button::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 0;
      height: 3px;
      background: var(--primary);
      transition: var(--transition);
      border-radius: 3px;
    }

    .nav-button:hover::after {
      width: 80%;
    }

    .nav-button.active {
      color: var(--text-primary);
      background: rgba(99, 102, 241, 0.2);
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1),
        0 0 0 1px rgba(255, 255, 255, 0.05);
    }

    .nav-button.active::after {
      width: 80%;
      background: var(--primary);
    }

    /* User profile dropdown */
    .user-profile {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      position: relative;
      cursor: pointer;
    }

    .user-avatar {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: linear-gradient(135deg,
          var(--primary),
          var(--primary-light));
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--text-primary);
      font-size: 1rem;
      font-weight: 600;
      transition: var(--transition);
      box-shadow: var(--shadow-sm), inset 0 1px 0 rgba(255, 255, 255, 0.1);
      border: 2px solid rgba(255, 255, 255, 0.1);
      font-family: "Inter", sans-serif;
    }

    .user-avatar:hover {
      transform: scale(1.1);
      box-shadow: var(--shadow-md);
    }

    .dropdown-menu {
      position: absolute;
      top: calc(100% + 10px);
      right: 0;
      background: var(--dark-surface);
      backdrop-filter: blur(24px) saturate(180%);
      border-radius: var(--border-radius);
      box-shadow: var(--shadow-xl), 0 0 0 1px rgba(255, 255, 255, 0.05);
      border: 1px solid var(--dark-border);
      padding: 0.75rem 0;
      min-width: 200px;
      z-index: 101;
      opacity: 0;
      visibility: hidden;
      transform: translateY(-10px);
      transition: var(--transition);
    }

    .dropdown-menu.active {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .dropdown-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 1.5rem;
      color: var(--text-secondary);
      text-decoration: none;
      font-size: 0.95rem;
      transition: var(--transition);
    }

    .dropdown-item:hover {
      background: rgba(255, 255, 255, 0.05);
      color: var(--text-primary);
    }

    .dropdown-item i {
      width: 20px;
      text-align: center;
      font-size: 1rem;
    }

    /* Main content container */
    .content-container {
      flex: 1;
      padding: 2rem 3rem;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      width: 100%;
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 2.5rem;
      animation: slideUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px) scale(0.95);
      }

      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    /* Employee list and add employee sections */
    .employee-list-section,
    .add-employee-section {
      background: var(--dark-surface);
      backdrop-filter: blur(24px) saturate(180%);
      border-radius: 24px;
      padding: 2.5rem;
      box-shadow: var(--shadow-xl), 0 0 0 1px rgba(255, 255, 255, 0.05),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
      border: 1px solid var(--dark-border);
      transition: var(--transition);
      position: relative;
      overflow: hidden;
    }

    .employee-list-section::before,
    .add-employee-section::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(to bottom right,
          rgba(99, 102, 241, 0.1),
          rgba(129, 140, 248, 0.05),
          transparent);
      transform: rotate(-15deg);
      z-index: -1;
    }

    .employee-list-section:hover,
    .add-employee-section:hover {
      transform: translateY(-5px);
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5),
        0 0 0 1px rgba(255, 255, 255, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.15);
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
    }

    .section-header h2 {
      font-size: 1.75rem;
      font-weight: 700;
      color: var(--text-primary);
      letter-spacing: -0.025em;
      position: relative;
      padding-bottom: 0.5rem;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .section-header h2::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 50px;
      height: 3px;
      background: linear-gradient(135deg,
          var(--primary),
          var(--primary-light));
      border-radius: 3px;
      transition: var(--transition);
    }

    .section-header h2:hover::after {
      width: 100%;
    }

    /* Add employee button */
    .add-employee-btn {
      background: linear-gradient(135deg,
          var(--primary),
          var(--primary-light));
      color: var(--text-primary);
      border: none;
      padding: 0.9rem 1.75rem;
      border-radius: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      font-size: 0.9375rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-family: "Inter", sans-serif;
      box-shadow: var(--shadow-md), 0 0 0 1px rgba(255, 255, 255, 0.05);
      position: relative;
      overflow: hidden;
    }

    .add-employee-btn:hover {
      background: linear-gradient(135deg,
          var(--primary-dark),
          var(--primary));
      box-shadow: var(--shadow-lg), 0 0 0 1px rgba(255, 255, 255, 0.1);
      transform: translateY(-3px);
    }

    .add-employee-btn::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg,
          transparent,
          rgba(255, 255, 255, 0.3),
          transparent);
      transition: var(--transition);
    }

    .add-employee-btn:hover::before {
      left: 100%;
    }

    /* Employee table styling */
    .employee-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1.5rem;
    }

    .employee-table th {
      text-align: left;
      padding: 1rem 1.25rem;
      font-size: 0.9375rem;
      color: var(--text-secondary);
      font-weight: 600;
      border-bottom: 1px solid var(--dark-border);
    }

    .employee-table td {
      padding: 1.25rem 1.25rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      vertical-align: middle;
      transition: var(--transition);
    }

    .employee-table tr:last-child td {
      border-bottom: none;
    }

    .employee-table tr {
      transition: var(--transition);
      cursor: pointer;
    }

    .employee-table tr:hover {
      background: rgba(255, 255, 255, 0.05);
    }

    .employee-table tr:hover td {
      transform: translateX(5px);
    }

    .employee-avatar {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: linear-gradient(135deg,
          var(--primary),
          var(--primary-light));
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--text-primary);
      font-weight: 600;
      font-size: 1rem;
      box-shadow: var(--shadow-sm), inset 0 1px 0 rgba(255, 255, 255, 0.1);
      flex-shrink: 0;
      transition: var(--transition);
      margin-right: 1rem;
    }

    .employee-avatar:hover {
      transform: scale(1.1);
    }

    .employee-name {
      display: flex;
      align-items: center;
      font-weight: 600;
      color: var(--text-primary);
    }

    .employee-credentials {
      font-size: 0.8125rem;
      color: var(--text-muted);
      margin-top: 0.25rem;
    }

    .status-badge {
      padding: 0.5rem 0.9rem;
      border-radius: 20px;
      font-size: 0.8125rem;
      font-weight: 600;
      display: inline-block;
      text-transform: capitalize;
      backdrop-filter: blur(10px);
      box-shadow: var(--shadow-sm), inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }

    .status-active {
      background: rgba(16, 185, 129, 0.2);
      color: var(--success);
    }

    .status-inactive {
      background: rgba(239, 68, 68, 0.2);
      color: var(--error);
    }

    /* Form styling */
    .form-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .form-group {
      margin-bottom: 1.25rem;
    }

    .form-group label {
      display: block;
      font-size: 0.9375rem;
      font-weight: 500;
      color: var(--text-secondary);
      margin-bottom: 0.75rem;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 1rem 1.25rem;
      border: 1.5px solid var(--dark-border);
      border-radius: 14px;
      font-size: 1rem;
      color: var(--text-primary);
      background: var(--dark-card);
      backdrop-filter: blur(10px);
      transition: var(--transition);
      outline: none;
      font-family: "Inter", sans-serif;
      box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .form-group input:focus,
    .form-group select:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25),
        inset 0 1px 3px rgba(0, 0, 0, 0.2);
      transform: translateY(-2px);
    }

    .form-group input::placeholder {
      color: var(--text-muted);
    }

    /* Button styling */
    .generate-btn {
      background: rgba(255, 255, 255, 0.1);
      color: var(--text-primary);
      border: none;
      padding: 1rem 1.5rem;
      border-radius: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      font-size: 1rem;
      width: 100%;
      margin-bottom: 1.5rem;
      font-family: "Inter", sans-serif;
      backdrop-filter: blur(5px);
      box-shadow: var(--shadow-sm), 0 0 0 1px rgba(255, 255, 255, 0.05);
    }

    .generate-btn:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: translateY(-2px);
      box-shadow: var(--shadow-md), 0 0 0 1px rgba(255, 255, 255, 0.1);
    }

    .submit-btn {
      background: linear-gradient(135deg,
          var(--primary),
          var(--primary-light));
      color: var(--text-primary);
      border: none;
      padding: 1.1rem 2.5rem;
      border-radius: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      font-size: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-family: "Inter", sans-serif;
      box-shadow: var(--shadow-md), 0 0 0 1px rgba(255, 255, 255, 0.05);
      position: relative;
      overflow: hidden;
    }

    .submit-btn:hover:not(:disabled) {
      background: linear-gradient(135deg,
          var(--primary-dark),
          var(--primary));
      box-shadow: var(--shadow-lg), 0 0 0 1px rgba(255, 255, 255, 0.1);
      transform: translateY(-3px);
    }

    .submit-btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
      transform: none !important;
    }

    .submit-btn::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg,
          transparent,
          rgba(255, 255, 255, 0.3),
          transparent);
      transition: var(--transition);
    }

    .submit-btn:hover:not(:disabled)::before {
      left: 100%;
    }

    /* Credentials display */
    .credentials-display {
      background: rgba(0, 0, 0, 0.2);
      padding: 1.5rem;
      border-radius: 14px;
      margin-top: 1.5rem;
      font-family: monospace;
      border: 1px solid var(--dark-border);
      transition: var(--transition);
      backdrop-filter: blur(10px);
    }

    .credentials-display:hover {
      border-color: var(--primary);
      transform: translateY(-2px);
    }

    .credentials-display div {
      margin-bottom: 0.75rem;
      color: var(--text-primary);
    }

    /* Toast notification */
    .toast {
      position: fixed;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      background: var(--dark-surface);
      backdrop-filter: blur(24px) saturate(180%);
      color: var(--text-primary);
      padding: 1rem 2rem;
      border-radius: var(--border-radius);
      z-index: 1000;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      box-shadow: var(--shadow-xl), 0 0 0 1px rgba(255, 255, 255, 0.05);
      border-left: 4px solid var(--success);
      animation: fadeIn 0.3s, fadeOut 0.3s 2.7s forwards;
    }

    .toast-error {
      border-left: 4px solid var(--error);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateX(-50%) translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
      }
    }

    @keyframes fadeOut {
      to {
        opacity: 0;
        transform: translateX(-50%) translateY(20px);
      }
    }

    /* Floating animation for sections */
    @keyframes floatContainer {
      0% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-8px);
      }

      100% {
        transform: translateY(0px);
      }
    }

    .employee-list-section,
    .add-employee-section {
      animation: slideUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1),
        floatContainer 8s ease-in-out infinite;
    }

    /* Responsive adjustments */
    @media (max-width: 1200px) {
      .container {
        max-width: 1000px;
      }
    }

    @media (max-width: 768px) {
      .navbar {
        padding: 1rem 2rem;
      }

      .navbar.scrolled {
        padding: 0.75rem 2rem;
      }

      .content-container {
        padding: 1.5rem 2rem;
      }

      .form-grid {
        grid-template-columns: 1fr;
      }

      .employee-table {
        display: block;
        overflow-x: auto;
      }

      .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1.25rem;
      }

      .add-employee-btn {
        width: 100%;
        justify-content: center;
      }
    }

    @media (max-width: 576px) {
      .navbar {
        padding: 1rem 1.5rem;
        flex-direction: column;
        gap: 1rem;
      }

      .navbar.scrolled {
        padding: 0.75rem 1.5rem;
      }

      .nav-button {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
      }

      .employee-list-section,
      .add-employee-section {
        padding: 1.5rem;
      }

      .section-header h2 {
        font-size: 1.5rem;
      }

      .employee-table th,
      .employee-table td {
        padding: 0.75rem;
      }

      .employee-name {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
      }

      .employee-avatar {
        margin-right: 0;
        margin-bottom: 0.5rem;
      }
    }

    /* Accessibility improvements */
    @media (prefers-reduced-motion: reduce) {

      *,
      *::before,
      *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }

      .employee-list-section,
      .add-employee-section {
        animation: none !important;
      }
    }
  </style>
</head>

<body>
  <div class="particles" id="particles"></div>

  <nav class="navbar" id="navbar">
    <a href="ownerlanding.html" class="navbar-brand">
      <div class="navbar-logo">📅</div>
      <span class="navbar-title">Leave Manager</span>
    </a>

    <div class="nav-links">
      <a href="ownerlanding.php"><button class="nav-button active">List</button></a>
      <a href="ownerleave.php"><button class="nav-button">Leave</button></a>
    </div>

    <div class="user-profile" id="userProfile">
      <div class="user-avatar" id="profileInitials">O</div>
      <div class="dropdown-menu" id="userDropdown">
        <a href="../logout.php" class="dropdown-item">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
      </div>
    </div>
  </nav>
  <div class="content-container">
    <div class="container">
      <section class="employee-list-section">
        <div class="section-header">
          <h2>Employee Directory</h2>
          <button class="add-employee-btn" id="showAddForm">
            <i class="fas fa-plus"></i>
            Add Employee
          </button>
        </div>

        <table class="employee-table">
          <thead>
            <tr>
              <th>Employee</th>
              <th>Email</th>
              <th>Phone no</th>
              <th>Gender</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="employee-name">
                  <div class="employee-avatar">JD</div>
                  <div>John Doe</div>
                </div>
              </td>
              <td>john.doe@company.com</td>
              <td>555-123-4567</td>
              <td>Male</td>
              <td><span class="status-badge status-active">Active</span></td>
            </tr>
            <tr>
              <td>
                <div class="employee-name">
                  <div class="employee-avatar">JS</div>
                  <div>Jane Smith</div>
                </div>
              </td>
              <td>jane.smith@company.com</td>
              <td>555-987-6543</td>
              <td>Female</td>
              <td><span class="status-badge status-active">Active</span></td>
            </tr>
          </tbody>
        </table>
      </section>

      <section class="add-employee-section" id="addEmployeeSection" style="display: none">
        <div class="section-header">
          <h2>Add New Employee</h2>
        </div>
        <form id="addEmployeeForm">
          <div class="form-grid">
            <!-- Full Name -->
            <div class="form-group">
              <label for="firstName">Full Name</label>
              <input type="text" id="firstName" required placeholder="Enter full name (With Space)" />
            </div>

            <!-- Gender -->
            <div class="form-group">
              <label for="gender">Gender</label>
              <select id="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>

            <!-- Phone -->
            <div class="form-group">
              <label for="phoneno">Phone No</label>
              <input type="text" id="phoneno" required placeholder="Enter phone number" />
            </div>

            <!-- Role -->
            <div class="form-group">
              <label for="role">Role</label>
              <select id="role" required>
                <option value="">Select Role</option>
                <option value="employee">Employee</option>
                <option value="owner">Owner</option>
              </select>
            </div>

            <!-- Date of Birth -->
            <div class="form-group">
              <label for="dob">Date of Birth</label>
              <input type="date" id="dob" required />
            </div>

            <!-- ✅ Bank Details Section -->
            <div class="form-group">
              <label for="accountHolder">Account Holder Name</label>
              <input type="text" id="accountHolder" required placeholder="Enter account holder name" />
            </div>

            <div class="form-group">
              <label for="accountNumber">Account Number</label>
              <input type="text" id="accountNumber" required placeholder="Enter account number" />
            </div>

            <div class="form-group">
              <label for="ifsc">IFSC Code</label>
              <input type="text" id="ifsc" required placeholder="Enter IFSC code" />
            </div>

            <div class="form-group">
              <label for="bankName">Bank Name</label>
              <input type="text" id="bankName" required placeholder="Enter bank name" />
            </div>

            <div class="form-group">
              <label for="branchName">Branch Name</label>
              <input type="text" id="branchName" required placeholder="Enter branch name" />
            </div>
          </div>

          <!-- Generate Credentials -->
          <button type="button" class="generate-btn" id="generateCredentials">
            <i class="fas fa-key"></i>
            Generate Email & Password
          </button>

          <!-- Display Credentials -->
          <div class="credentials-display" id="credentialsDisplay" style="display: none">
            <div><strong>Generated Credentials:</strong></div>
            <div>Email: <span id="generatedEmail"></span></div>
            <div>Password: <span id="generatedPassword"></span></div>
          </div>

          <!-- Submit -->
          <button type="submit" class="submit-btn" id="submitEmployee" disabled>
            <i class="fas fa-user-plus"></i>
            Add Employee
          </button>
        </form>
      </section>
    </div>
  </div>
  <script>
    // Create animated background particles
    function createParticles() {
      const particlesContainer = document.getElementById("particles");
      const particleCount = 20;

      for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement("div");
        particle.classList.add("particle");

        const size = Math.random() * 25 + 5;
        const posX = Math.random() * 100;
        const posY = Math.random() * 100;
        const delay = Math.random() * 25;
        const duration = Math.random() * 15 + 25;

        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${posX}%`;
        particle.style.top = `${posY}%`;
        particle.style.animationDelay = `${delay}s`;
        particle.style.animationDuration = `${duration}s`;

        particlesContainer.appendChild(particle);
      }
    }

    // Toast notification
    function showToast(message, type = "success") {
      document.querySelectorAll(".toast").forEach((t) => t.remove());

      const toast = document.createElement("div");
      toast.className = `toast ${type === "error" ? "toast-error" : ""}`;
      const icon =
        type === "success"
          ? '<i class="fas fa-check-circle"></i>'
          : '<i class="fas fa-exclamation-circle"></i>';

      toast.innerHTML = `${icon}<span>${message}</span>`;
      document.body.appendChild(toast);

      setTimeout(() => toast.remove(), 3000);
    }

    // Fetch employees list
    async function loadUserInfo() {
      try {
        const response = await fetch("employee_list.php", {
          credentials: "include",
        });
        if (!response.ok) throw new Error("Network error");

        const data = await response.json();
        if (data.success && data.data) {
          const employees = data.data;
          const userRole = data.user_role;

          const employeeTable = document.querySelector(
            ".employee-table tbody"
          );
          employeeTable.innerHTML = "";

          employees.forEach((emp) => {
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
            <td>
              <div class="employee-name">
                <div class="employee-avatar">${emp.initials}</div>
                <div>${emp.name}</div>
              </div>
            </td>
            <td>${emp.email}</td>
            <td>${emp.phone || "N/A"}</td>
            <td>${emp.gender || "N/A"}</td>
            <td><span class="status-badge status-active">Active</span></td>
          `;
            employeeTable.appendChild(newRow);
          });
        } else {
          document.getElementById("profileInitials").textContent = "NA";
        }
      } catch (err) {
        console.error("Failed to load user info:", err);
        document.getElementById("profileInitials").textContent = "NA";
      }
    }

    // Add new employee via backend
    async function addEmployee(formData) {
      try {
        const response = await fetch("add_employee.php", {
          method: "POST",
          body: formData,
          credentials: "include",
        });

        const result = await response.json();

        if (result.success) {
          showToast("Employee added successfully!");
          return true;
        } else {
          showToast(result.message || "Error adding employee", "error");
          return false;
        }
      } catch (error) {
        console.error("Error adding employee:", error);
        showToast("Network error adding employee", "error");
        return false;
      }
    }

    document.addEventListener("DOMContentLoaded", () => {
      createParticles();
      loadUserInfo();

      const navbar = document.getElementById("navbar");
      const navButtons = document.querySelectorAll(".nav-button");
      const showAddFormBtn = document.getElementById("showAddForm");
      const addEmployeeSection =
        document.getElementById("addEmployeeSection");
      const generateCredentialsBtn = document.getElementById(
        "generateCredentials"
      );
      const addEmployeeForm = document.getElementById("addEmployeeForm");
      const submitEmployeeBtn = document.getElementById("submitEmployee");
      const credentialsDisplay =
        document.getElementById("credentialsDisplay");
      const employeeTable = document.querySelector(".employee-table tbody");
      const userProfile = document.getElementById("userProfile");
      const userDropdown = document.getElementById("userDropdown");

      // Navbar scroll effect
      window.addEventListener("scroll", () =>
        navbar.classList.toggle("scrolled", window.scrollY > 10)
      );

      // Nav buttons
      navButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
          navButtons.forEach((b) => b.classList.remove("active"));
          btn.classList.add("active");
          if (btn.textContent === "Leave")
            window.location.href = "ownerleave.html";
        });
      });

      // Toggle add form
      showAddFormBtn.addEventListener("click", () => {
        const isHidden = addEmployeeSection.style.display === "none";
        addEmployeeSection.style.display = isHidden ? "block" : "none";
        showAddFormBtn.innerHTML = isHidden
          ? '<i class="fas fa-times"></i> Cancel'
          : '<i class="fas fa-plus"></i> Add Employee';
      });

      // Generate credentials
      generateCredentialsBtn.addEventListener("click", () => {
        const fullName = document.getElementById("firstName").value.trim();

        if (!fullName) {
          showToast("Please enter full name first", "error");
          return;
        }

        // Split the full name into parts
        const nameParts = fullName.split(" ");
        let firstName = nameParts[0].toLowerCase();
        let lastName =
          nameParts.length > 1
            ? nameParts[nameParts.length - 1].toLowerCase()
            : "";

        // Generate email and password
        const email = `${firstName}${lastName ? "." + lastName : ""
          }@company.com`;
        const password = `${firstName}${Math.floor(
          100 + Math.random() * 900
        )}`;

        document.getElementById("generatedEmail").textContent = email;
        document.getElementById("generatedPassword").textContent = password;
        credentialsDisplay.style.display = "block";
        submitEmployeeBtn.disabled = false;

        showToast("Credentials generated successfully");
      });

      // Submit employee form
      addEmployeeForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append("name", document.getElementById("firstName").value);
        formData.append("gender", document.getElementById("gender").value);
        formData.append("phone", document.getElementById("phoneno").value);
        formData.append("role", document.getElementById("role").value);
        formData.append("dob", document.getElementById("dob").value);
        formData.append(
          "accountHolder",
          document.getElementById("accountHolder").value
        );
        formData.append(
          "accountNumber",
          document.getElementById("accountNumber").value
        );
        formData.append("ifsc", document.getElementById("ifsc").value);
        formData.append(
          "bankName",
          document.getElementById("bankName").value
        );
        formData.append(
          "branchName",
          document.getElementById("branchName").value
        );
        formData.append(
          "email",
          document.getElementById("generatedEmail").textContent
        );
        formData.append(
          "password",
          document.getElementById("generatedPassword").textContent
        );

        submitEmployeeBtn.innerHTML =
          '<i class="fas fa-spinner fa-spin"></i> Adding...';
        submitEmployeeBtn.disabled = true;

        const success = await addEmployee(formData);

        if (success) {
          addEmployeeForm.reset();
          credentialsDisplay.style.display = "none";
          addEmployeeSection.style.display = "none";
          showAddFormBtn.innerHTML =
            '<i class="fas fa-plus"></i> Add Employee';
          // Reload the employee list
          loadUserInfo();
        }

        submitEmployeeBtn.innerHTML =
          '<i class="fas fa-user-plus"></i> Add Employee';
        submitEmployeeBtn.disabled = false;
      });

      // Dropdown toggle
      userProfile.addEventListener("click", (e) => {
        e.stopPropagation();
        userDropdown.classList.toggle("active");
      });

      document.addEventListener("click", (e) => {
        if (!userProfile.contains(e.target))
          userDropdown.classList.remove("active");
      });

      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") userDropdown.classList.remove("active");
      });

      // Adjust height
      function adjustHeight() {
        const navbarHeight = document.querySelector(".navbar").offsetHeight;
        document.querySelector(
          ".content-container"
        ).style.maxHeight = `calc(100vh - ${navbarHeight}px)`;
      }
      window.addEventListener("resize", adjustHeight);
      adjustHeight();
    });
  </script>
</body>

</html>