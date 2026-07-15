<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
    <title>Student Portal - Login</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f9;">
    <div style="margin: 80px auto; width: 320px; padding: 25px; border: 1px solid #ccc; background: white; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);">
        <h2 style="text-align: center; color: #333;">Student Login</h2>
        
        <%-- Show error message if login failed --%>
        <% if(request.getAttribute("errorMessage") != null) { %>
            <p style="color: red; text-align: center; font-size: 14px;"><%= request.getAttribute("errorMessage") %></p>
        <% } %>

        <form action="LoginServlet" method="POST">
            <label style="font-weight: bold;">Username:</label><br>
            <input type="text" name="username" style="width: 93%; padding: 8px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px;" required><br><br>
            
            <label style="font-weight: bold;">Password:</label><br>
            <input type="password" name="password" style="width: 93%; padding: 8px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px;" required><br><br>
            
            <input type="checkbox" name="rememberMe" value="true"> Remember Me<br><br>
            
            <button type="submit" style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">Login</button>
        </form>
    </div>
</body>
</html>