<?php
include 'includes/header.php';

// Authorization Check: If session doesn't exist, block entry and bounce back to login gate
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <div class="alert alert-success" style="margin-top: 30px;">
        🛡️ Server-Side Verification: Session State Verified Active!
    </div>
    
    <div style="background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <h1>Welcome Back, Customizer!</h1>
        <p>Current Active Session Identity: <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong></p>
        <p>Assigned Operational Role: <span style="background: #edf2f7; padding: 3px 8px; border-radius: 4px; font-weight: bold; color: #2b6cb0;"><?php echo htmlspecialchars($_SESSION['role']); ?></span></p>
        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 20px 0;">
        <h3>Core Store Control Systems (Week 4 Production Base)</h3>
        <p>Your server-side architecture and page states are handling tracking requirements cleanly. You can now use the navigation bar components to seamlessly hop between states or test logging out entirely.</p>
    </div>
</div>

</body>
</html>