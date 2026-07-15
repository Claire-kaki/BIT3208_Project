package com.elechub;

import java.io.IOException;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.Cookie;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import jakarta.servlet.http.HttpSession;

@WebServlet("/LoginServlet")
public class LoginServlet extends HttpServlet {
    private static final long serialVersionUID = 1L;

    protected void doPost(HttpServletRequest request, HttpServletResponse response) 
            throws ServletException, IOException {
        
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        String theme = request.getParameter("theme");
        String rememberMe = request.getParameter("rememberMe");

        // 1. Validation check
        if (username != null && !username.trim().isEmpty() && "admin123".equals(password)) {
            
            // 2. Create HttpSession & save attributes (As required by Exercise 2)
            HttpSession session = request.getSession(true); 
            session.setAttribute("user", username.trim());
            session.setAttribute("loginTime", new java.util.Date().toString());

            // 3. Create Theme Preference Cookie (As required by Exercise 2)
            Cookie themeCookie = new Cookie("preferredTheme", theme);
            themeCookie.setMaxAge(7 * 24 * 60 * 60); // Save for 7 days
            response.addCookie(themeCookie);

            // 4. Create "Remember Me" Cookie (As required by the Assignment)
            Cookie rememberCookie = new Cookie("rememberedUser", username.trim());
            if ("true".equals(rememberMe)) {
                rememberCookie.setMaxAge(7 * 24 * 60 * 60); // Save for 7 days
            } else {
                rememberCookie.setMaxAge(0); // Delete cookie if unchecked
            }
            response.addCookie(rememberCookie);

            // Redirect to the dashboard page
            response.sendRedirect("dashboard.jsp");
            
        } else {
            // Redirect back to login with an error message
            response.sendRedirect("login.jsp?error=invalid");
        }
    }
}