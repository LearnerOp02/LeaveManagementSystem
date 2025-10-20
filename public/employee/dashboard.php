<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employee Profile | Leave Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
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
        background: radial-gradient(
            circle at 15% 70%,
            rgba(99, 102, 241, 0.25) 0%,
            transparent 40%
          ),
          radial-gradient(
            circle at 85% 30%,
            rgba(129, 140, 248, 0.2) 0%,
            transparent 40%
          ),
          radial-gradient(
            circle at 50% 20%,
            rgba(79, 70, 229, 0.15) 0%,
            transparent 40%
          );
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
        padding: 1.25rem 3rem;
        display: flex;
        justify-content: space-between;
        width: 100%;
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
        background: linear-gradient(
          135deg,
          var(--primary),
          var(--primary-light)
        );
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
        background: linear-gradient(
          90deg,
          transparent,
          rgba(255, 255, 255, 0.1),
          transparent
        );
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
        background: linear-gradient(
          135deg,
          var(--primary),
          var(--primary-light)
        );
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-primary);
        font-size: 1rem;
        font-weight: 600;
        transition: var(--transition);
        box-shadow: var(--shadow-sm), inset 0 1px 0 rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.1);
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

      .page-header {
        margin-bottom: 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-primary);
        letter-spacing: -0.025em;
        position: relative;
        display: inline-block;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      }

      .page-title::after {
        content: "";
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--primary);
        border-radius: 2px;
        transition: var(--transition);
      }

      .page-title:hover::after {
        width: 100%;
      }

      .container {
        max-width: 1400px;
        margin: 0 auto;
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
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

      /* Profile and bank sections */
      .profile-section,
      .bank-section {
        background: var(--dark-surface);
        backdrop-filter: blur(24px) saturate(180%);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: var(--shadow-xl), 0 0 0 1px rgba(255, 255, 255, 0.05),
          inset 0 1px 0 rgba(255, 255, 255, 0.1);
        border: 1px solid var(--dark-border);
        transition: var(--transition);
        height: fit-content;
        position: relative;
        overflow: hidden;
      }

      .profile-section::before,
      .bank-section::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
          to bottom right,
          rgba(99, 102, 241, 0.1),
          rgba(129, 140, 248, 0.05),
          transparent
        );
        transform: rotate(-15deg);
        z-index: -1;
      }

      .profile-section:hover,
      .bank-section:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5),
          0 0 0 1px rgba(255, 255, 255, 0.1),
          inset 0 1px 0 rgba(255, 255, 255, 0.15);
      }

      .section-header {
        margin-bottom: 2.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
      }

      .profile-pic {
        width: 100px;
        height: 100px;
        background: linear-gradient(
          135deg,
          var(--primary),
          var(--primary-light)
        );
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-primary);
        font-size: 2.25rem;
        font-weight: 600;
        box-shadow: var(--shadow-lg), inset 0 1px 0 rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
        transition: var(--transition);
      }

      .profile-pic:hover {
        transform: scale(1.05);
      }

      .profile-pic::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
          90deg,
          transparent,
          rgba(255, 255, 255, 0.3),
          transparent
        );
        animation: shine 3s infinite;
      }

      @keyframes shine {
        0% {
          left: -100%;
        }
        100% {
          left: 100%;
        }
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
        background: linear-gradient(
          135deg,
          var(--primary),
          var(--primary-light)
        );
        border-radius: 3px;
        transition: var(--transition);
      }

      .section-header h2:hover::after {
        width: 100%;
      }

      /* Form styling */
      .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.75rem;
      }

      .form-group {
        margin-bottom: 1.5rem;
      }

      .form-label {
        display: block;
        font-size: 0.9375rem;
        font-weight: 500;
        color: var(--text-secondary);
        margin-bottom: 0.75rem;
      }

      .form-input,
      .form-select {
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

      .form-input:focus,
      .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25),
          inset 0 1px 3px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
      }

      .form-input:invalid {
        border-color: var(--error);
      }

      .form-input::placeholder {
        color: var(--text-muted);
      }

      /* Button styling */
      .save-button {
        padding: 1.1rem 2.5rem;
        border: none;
        border-radius: 14px;
        background: linear-gradient(
          135deg,
          var(--primary),
          var(--primary-light)
        );
        color: var(--text-primary);
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-md), 0 0 0 1px rgba(255, 255, 255, 0.05);
        margin-top: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        font-family: "Inter", sans-serif;
      }

      .save-button::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
          90deg,
          transparent,
          rgba(255, 255, 255, 0.3),
          transparent
        );
        transition: var(--transition);
      }

      .save-button:hover::before {
        left: 100%;
      }

      .save-button:hover {
        background: linear-gradient(
          135deg,
          var(--primary-dark),
          var(--primary)
        );
        box-shadow: var(--shadow-lg), 0 0 0 1px rgba(255, 255, 255, 0.1);
        transform: translateY(-3px);
      }

      .save-button:active {
        transform: translateY(0);
        box-shadow: var(--shadow-md);
      }

      .save-button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
      }

      .button-content {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
      }

      .spinner {
        width: 18px;
        height: 18px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: var(--text-primary);
        animation: spin 1s linear infinite;
        display: none;
      }

      @keyframes spin {
        to {
          transform: rotate(360deg);
        }
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

      .profile-section,
      .bank-section {
        animation: slideUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1),
          floatContainer 8s ease-in-out infinite;
      }

      /* Responsive adjustments */
      @media (max-width: 1200px) {
        .container {
          grid-template-columns: 1fr;
          max-width: 800px;
        }

        .profile-section,
        .bank-section {
          padding: 2rem;
        }
      }

      @media (max-width: 768px) {
        .navbar {
          padding: 1rem 2rem;
          width: 100%;
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

        .profile-pic {
          width: 80px;
          height: 80px;
          font-size: 1.75rem;
        }

        .section-header {
          flex-direction: column;
          align-items: flex-start;
          gap: 1.25rem;
        }
      }

      @media (max-width: 576px) {
        .navbar {
          padding: 1rem 1.5rem;
          width: 100%;
          flex-direction: column;
          gap: 1rem;
        }

        .navbar.scrolled {
          padding: 0.75rem 1.5rem;
        }

        .nav-links {
          gap: 1rem;
        }

        .nav-button {
          padding: 0.5rem 1rem;
          font-size: 0.9rem;
        }

        .page-title {
          font-size: 1.75rem;
        }

        .profile-section,
        .bank-section {
          padding: 1.5rem;
        }

        .section-header h2 {
          font-size: 1.5rem;
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

        .profile-section,
        .bank-section {
          animation: none !important;
        }
      }
    </style>
  </head>

  <body>
    <div class="particles" id="particles"></div>

    <nav class="navbar" id="navbar">
      <a href="emplanding.html" class="navbar-brand">
        <div class="navbar-logo">📅</div>
        <span class="navbar-title">Leave Manager</span>
      </a>

      <div class="nav-links">
        <a href="emplanding.php"
          ><button class="nav-button active">Profile</button></a
        >
        <a href="empleave.php"><button class="nav-button">Leave</button></a>
      </div>

      <div class="user-profile" id="userProfile">
        <div class="user-avatar" id="profileInitials">JD</div>
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
        <section class="profile-section">
          <div class="section-header">
            <div class="profile-pic" id="profilePic">👤</div>
            <h2>Personal Information</h2>
          </div>

          <div class="form-grid">
            <div class="form-group">
              <label for="fullName" class="form-label">Full Name</label>
              <input
                type="text"
                id="fullName"
                class="form-input"
                placeholder="John Doe"
              />
            </div>

            <div class="form-group">
              <label for="email" class="form-label">Email</label>
              <input
                type="email"
                id="email"
                class="form-input"
                placeholder="john.doe@example.com"
              />
            </div>

            <div class="form-group">
              <label for="password" class="form-label">Password</label>
              <input
                type="password"
                id="password"
                class="form-input"
                placeholder="Leave blank to keep current"
              />
            </div>

            <div class="form-group">
              <label for="phone" class="form-label">Phone Number</label>
              <input
                type="tel"
                id="phone"
                class="form-input"
                placeholder="+1 (555) 123-4567"
              />
            </div>

            <div class="form-group">
              <label for="dob" class="form-label">Date of Birth</label>
              <input type="date" id="dob" class="form-input" />
            </div>

            <div class="form-group">
              <label for="gender" class="form-label">Gender</label>
              <select id="gender" class="form-select">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>
          </div>

          <button class="save-button" id="saveProfile">
            <span class="spinner" id="profileSpinner"></span>
            Save Changes
          </button>
        </section>

        <section class="bank-section">
          <div class="section-header">
            <h2>Bank Details</h2>
          </div>

          <div class="form-grid">
            <div class="form-group">
              <label for="accountName" class="form-label"
                >Account Holder Name</label
              >
              <input
                type="text"
                id="accountName"
                class="form-input"
                placeholder="John Doe"
              />
            </div>

            <div class="form-group">
              <label for="accountNumber" class="form-label"
                >Account Number</label
              >
              <input
                type="text"
                id="accountNumber"
                class="form-input"
                placeholder="1234567890"
              />
            </div>

            <div class="form-group">
              <label for="ifsc" class="form-label">IFSC Code</label>
              <input
                type="text"
                id="ifsc"
                class="form-input"
                placeholder="ABCD0123456"
              />
            </div>

            <div class="form-group">
              <label for="bankName" class="form-label">Bank Name</label>
              <input
                type="text"
                id="bankName"
                class="form-input"
                placeholder="Example Bank"
              />
            </div>

            <div class="form-group">
              <label for="branch" class="form-label">Branch Name</label>
              <input
                type="text"
                id="branch"
                class="form-input"
                placeholder="Main Branch"
              />
            </div>
          </div>

          <button class="save-button" id="saveBank">
            <span class="spinner" id="bankSpinner"></span>
            Update Bank Details
          </button>
        </section>
      </div>
    </div>

    <script>
      /** ---------------------------
   * Background Particles
   ---------------------------- */
      function createParticles() {
        const container = document.getElementById("particles");
        const count = 20;

        for (let i = 0; i < count; i++) {
          const particle = document.createElement("div");
          particle.className = "particle";

          // Random styles
          Object.assign(particle.style, {
            width: `${Math.random() * 25 + 5}px`,
            height: `${Math.random() * 25 + 5}px`,
            left: `${Math.random() * 100}%`,
            top: `${Math.random() * 100}%`,
            animationDelay: `${Math.random() * 25}s`,
            animationDuration: `${Math.random() * 15 + 25}s`,
          });

          container.appendChild(particle);
        }
      }

      /** ---------------------------
   * Fetch Employee Data
   ---------------------------- */
      async function fetchEmployeeData() {
        try {
          const response = await fetch("fetch_info.php");
          if (!response.ok) throw new Error("Network error");

          const data = await response.json();
          if (!data.success) {
            return showToast(
              "Failed to load data: " + (data.message || "Error"),
              "error"
            );
          }

          // Fill personal info
          const u = data.user;
          document.getElementById("fullName").value = u.name || "";
          document.getElementById("email").value = u.email || "";
          document.getElementById("phone").value = u.phone || "";
          document.getElementById("dob").value = u.date_of_birth || "";
          document.getElementById("gender").value = u.gender || "male";

          // Fill bank info
          document.getElementById("accountName").value =
            u.account_holder_name || "";
          document.getElementById("accountNumber").value =
            u.account_number || "";
          document.getElementById("ifsc").value = u.ifsc_code || "";
          document.getElementById("bankName").value = u.bank_name || "";
          document.getElementById("branch").value = u.branch_name || "";

          updateProfileInitials(u.name);
        } catch (err) {
          showToast("Error fetching data: " + err.message, "error");
        }
      }

      /** ---------------------------
   * Update Profile
   ---------------------------- */
      async function updateProfile() {
        const btn = document.getElementById("saveProfile");
        const spinner = document.getElementById("profileSpinner");

        btn.disabled = true;
        spinner.style.display = "inline-block";

        const formData = {
          name: document.getElementById("fullName").value.trim(),
          email: document.getElementById("email").value.trim(),
          password: document.getElementById("password").value.trim(),
          phone: document.getElementById("phone").value.trim(),
          date_of_birth: document.getElementById("dob").value,
          gender: document.getElementById("gender").value,
        };

        try {
          const res = await fetch("update_profile.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(formData),
          });
          const result = await res.json();

          if (result.success) {
            showToast("Profile updated successfully!");
            updateProfileInitials(formData.name);
          } else {
            showToast(result.message || "Failed to update profile", "error");
          }
        } catch (err) {
          showToast("Error updating profile: " + err.message, "error");
        } finally {
          btn.disabled = false;
          spinner.style.display = "none";
        }
      }

      /** ---------------------------
   * Update Bank Details
   ---------------------------- */
      async function updateBankDetails() {
        const btn = document.getElementById("saveBank");
        const spinner = document.getElementById("bankSpinner");

        btn.disabled = true;
        spinner.style.display = "inline-block";

        const formData = {
          account_holder_name: document
            .getElementById("accountName")
            .value.trim(),
          account_number: document.getElementById("accountNumber").value.trim(),
          ifsc_code: document.getElementById("ifsc").value.trim(),
          bank_name: document.getElementById("bankName").value.trim(),
          branch_name: document.getElementById("branch").value.trim(),
        };

        try {
          const res = await fetch("update_bank.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(formData),
          });
          const result = await res.json();

          if (result.success) {
            showToast("Bank details updated successfully!");
          } else {
            showToast(
              result.message || "Failed to update bank details",
              "error"
            );
          }
        } catch (err) {
          showToast("Error updating bank details: " + err.message, "error");
        } finally {
          btn.disabled = false;
          spinner.style.display = "none";
        }
      }

      /** ---------------------------
   * Helpers
   ---------------------------- */
      function updateProfileInitials(fullName) {
        if (!fullName) return;
        const names = fullName.trim().split(" ");
        const initials =
          names[0][0] + (names.length > 1 ? names[names.length - 1][0] : "");
        document.getElementById("profileInitials").textContent = initials;
        document.getElementById("profilePic").textContent = initials;
      }

      function showToast(message, type = "success") {
        document.querySelectorAll(".toast").forEach((t) => t.remove());
        const toast = document.createElement("div");
        toast.className = `toast ${type === "error" ? "toast-error" : ""}`;
        toast.innerHTML =
          (type === "success"
            ? '<i class="fas fa-check-circle"></i>'
            : '<i class="fas fa-exclamation-circle"></i>') +
          `<span>${message}</span>`;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
      }

      /** ---------------------------
   * DOM Ready
   ---------------------------- */
      document.addEventListener("DOMContentLoaded", () => {
        createParticles();
        fetchEmployeeData();

        // Navbar scroll effect
        const navbar = document.getElementById("navbar");
        window.addEventListener("scroll", () => {
          navbar.classList.toggle("scrolled", window.scrollY > 10);
        });

        // Dropdown
        const userProfile = document.getElementById("userProfile");
        const userDropdown = document.getElementById("userDropdown");

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

        // Form events
        document
          .getElementById("saveProfile")
          .addEventListener("click", updateProfile);
        document
          .getElementById("saveBank")
          .addEventListener("click", updateBankDetails);
      });
    </script>
  </body>
</html>
