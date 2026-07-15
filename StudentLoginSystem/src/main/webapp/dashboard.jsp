<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px;">
    <%
        // Prevent browser caching so users can't go back after logging out
        response.setHeader("Cache-Control", "no-cache, no-store, must-revalidate");
        
        // Grab current session user
        String currentUser = (String) session.getAttribute("user");
        
        // If no user is in the session, kick them back to the login page!
        if (currentUser == null) {
            response.sendRedirect("login.jsp");
            return;
        }
    %>

    <div style="max-width: 600px; margin: 50px auto; padding: 30px; border: 1px solid #28a745; background-color: white; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);">
        <h1 style="color: #28a745; margin-top: 0;">Welcome, <%= currentUser %>! 👋</h1>
        <p style="font-size: 16px; color: #555;">You have successfully logged in and established a secure session.</p>
        
        <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0; border-left: 5px solid #17a2b8;">
            <h3 style="margin-top: 0; color: #17a2b8;">Session Diagnostics (Debug Metrics)</h3>
            <p style="margin: 5px 0; font-family: monospace;"><strong>Session ID:</strong> <%= session.getId() %></p>
            <p style="margin: 5px 0; font-family: monospace;"><strong>Creation Time:</strong> <%= new java.util.Date(session.getCreationTime()) %></p>
        </div>

        <!-- Secure Logout form -->
        <form action="LogoutServlet" method="POST">
            <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 10px 20px; font-size: 16px; border-radius: 4px; cursor: pointer; transition: 0.2s;">
                Secure Logout
            </button>
        </form>
    </div>
</body>
</html>