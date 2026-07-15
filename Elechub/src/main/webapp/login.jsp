<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%
    // Safely retrieve cookies without performing any page redirects
    String savedUser = "";
    String theme = "light"; // Default theme
    
    Cookie[] cookies = request.getCookies();
    if (cookies != null) {
        for (Cookie c : cookies) {
            if ("rememberedUser".equals(c.getName())) {
                savedUser = c.getValue();
            }
            if ("preferredTheme".equals(c.getName())) {
                theme = c.getValue();
            }
        }
    }
%>
<!DOCTYPE html>
<html>
<head>
    <title>Elechub | Electronics Portal Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: <%= "dark".equals(theme) ? "#121212" : "#f0f2f5" %>;
            color: <%= "dark".equals(theme) ? "#ffffff" : "#333333" %>;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: <%= "dark".equals(theme) ? "#1e1e1e" : "#ffffff" %>;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            width: 360px;
            border-top: 5px solid #00d2fc;
        }
        .brand-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .brand-header h1 {
            margin: 0;
            font-size: 2em;
            color: #00d2fc;
            letter-spacing: 1px;
        }
        .brand-header p {
            margin: 5px 0 0;
            font-size: 0.9em;
            color: #888;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 0.9em;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid <%= "dark".equals(theme) ? "#444" : "#ccc" %>;
            border-radius: 6px;
            background-color: <%= "dark".equals(theme) ? "#2d2d2d" : "#ffffff" %>;
            color: <%= "dark".equals(theme) ? "#ffffff" : "#333333" %>;
            font-size: 1em;
        }
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #00d2fc;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 0.9em;
        }
        .checkbox-group input { width: auto; }
        .btn {
            background: linear-gradient(135deg, #00d2fc 0%, #0076f5 100%);
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1em;
            transition: opacity 0.2s;
        }
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>

<div class="login-container">
    <div class="brand-header">
        <h1>Elechub</h1>
        <p>Premium Electronics Management Portal</p>
    </div>
    
    <form action="LoginServlet" method="POST">
        <div class="form-group">
            <label for="username">Username / Email:</label>
            <input type="text" id="username" name="username" value="<%= savedUser %>" placeholder="Enter your username" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>
        </div>

        <div class="form-group">
            <label for="theme">Portal Theme:</label>
            <select id="theme" name="theme">
                <option value="light" <%= "light".equals(theme) ? "selected" : "" %>>Light Interface</option>
                <option value="dark" <%= "dark".equals(theme) ? "selected" : "" %>>Dark Interface</option>
            </select>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" id="rememberMe" name="rememberMe" value="true" <%= !savedUser.isEmpty() ? "checked" : "" %>>
            <label for="rememberMe">Remember Me on this device</label>
        </div>

        <button type="submit" class="btn">Access Portal</button>
    </form>
</div>

</body>
</html>