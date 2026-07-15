package com.portal;
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
        
        // 1. Retrieve the form inputs
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        String rememberMe = request.getParameter("rememberMe");

     // 2. Simple validation (Ensure username is not empty and password is correct)
        if (username != null && !username.trim().isEmpty() && "admin123".equals(password)) {
            
            // 3. Create session on the server
            HttpSession session = request.getSession();
            session.setAttribute("user", username);
            
            // 4. "Remember Me" Cookie feature (Saves for 7 days if checked)
            if ("true".equals(rememberMe)) {
                Cookie userCookie = new Cookie("savedUser", username);
                userCookie.setMaxAge(60 * 60 * 24 * 7); 
                response.addCookie(userCookie);
            }
            
            // 5. Redirect to dashboard
            response.sendRedirect("dashboard.jsp");
            
        } else {
            // Send back to login page with an error
            request.setAttribute("errorMessage", "Username cannot be empty!");
            request.getRequestDispatcher("login.jsp").forward(request, response);
        }
    }
}