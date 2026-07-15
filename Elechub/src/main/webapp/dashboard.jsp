<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%
    // 1. Safe Security Check: Grab the session if it exists
    HttpSession activeSession = request.getSession(false);
    
    // If there is no session or no user attribute, redirect safely to login.jsp
    if (activeSession == null || activeSession.getAttribute("user") == null) {
        response.sendRedirect("login.jsp");
        return; 
    }

    // 2. Safe Attribute Retrieval (Prevents NullPointerExceptions)
    String username = "Operator";
    Object userObj = activeSession.getAttribute("user");
    if (userObj != null) {
        username = userObj.toString();
    }

    String loginTime = "N/A";
    Object timeObj = activeSession.getAttribute("loginTime");
    if (timeObj != null) {
        loginTime = timeObj.toString();
    }

    String sessionId = activeSession.getId();

    // 3. Safe Cookie Reading
    String theme = "light"; // Default
    Cookie[] cookies = request.getCookies();
    if (cookies != null) {
        for (Cookie c : cookies) {
            if ("preferredTheme".equals(c.getName())) {
                theme = c.getValue();
            }
        }
    }
%>
<!DOCTYPE html>
<html>
<head>
    <title>Elechub | Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: <%= "dark".equals(theme) ? "#121212" : "#f0f2f5" %>;
            color: <%= "dark".equals(theme) ? "#ffffff" : "#333333" %>;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
        }
        .dashboard-card {
            background-color: <%= "dark".equals(theme) ? "#1e1e1e" : "#ffffff" %>;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            width: 600px;
            border-top: 5px solid #00d2fc;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid <%= "dark".equals(theme) ? "#2d2d2d" : "#eaeaea" %>;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header h2 {
            margin: 0;
            color: #00d2fc;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }
        .stat-box {
            background-color: <%= "dark".equals(theme) ? "#2d2d2d" : "#f8f9fa" %>;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid <%= "dark".equals(theme) ? "#3e3e3e" : "#e2e8f0" %>;
        }
        .stat-box span {
            font-size: 0.85em;
            color: #888;
            text-transform: uppercase;
        }
        .stat-box div {
            font-size: 1.4em;
            font-weight: bold;
            margin-top: 5px;
        }
        .diagnostics {
            background-color: <%= "dark".equals(theme) ? "#252525" : "#e9ecef" %>;
            padding: 20px;
            border-radius: 8px;
            font-size: 0.9em;
            line-line-height: 1.6;
            margin-bottom: 25px;
        }
        .diagnostics h4 {
            margin-top: 0;
            color: #0076f5;
        }
        .btn-logout {
            display: block;
            text-align: center;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.2s;
        }
        .btn-logout:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="dashboard-card">
    <div class="header">
        <h2>Elechub Console</h2>
        <span>Operator: <strong><%= username %></strong></span>
    </div>

    <!-- Simulated Electronics Inventory Metrics -->
    <div class="stats-grid">
        <div class="stat-box">
            <span>Total Stock</span>
            <div style="color: #00d2fc;">1,420</div>
        </div>
        <div class="stat-box">
            <span>Active Orders</span>
            <div style="color: #28a745;">12</div>
        </div>
        <div class="stat-box">
            <span>Out of Stock</span>
            <div style="color: #dc3545;">3</div>
        </div>
    </div>

    <!-- Active Session Diagnostics Section -->
    <div class="diagnostics">
        <h4>Session and Security Diagnostics</h4>
        <div><strong>Active Session ID:</strong> <%= sessionId %></div>
        <div><strong>Login Timestamp:</strong> <%= loginTime %></div>
        <div><strong>Loaded UI Preference:</strong> <%= theme.toUpperCase() %> MODE</div>
    </div>

    <a href="LogoutServlet" class="btn-logout">Exit Elechub Portal</a>
</div>

</body>
</html>