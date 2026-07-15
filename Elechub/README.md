# ElecHub - Premium Electronics Management Portal

ElecHub is a lightweight, responsive Java Web Application showcasing secure, client-side and server-side state management using **Jakarta Servlets**, **JSP**, and **Apache Tomcat v10.1**.

This module represents **Assignment 2**, implementing advanced state tracking, customized user interfaces, and session diagnostics.

---

## 🚀 Key Features

*   **Dynamic Theme Preference:** Uses client-side cookies (`preferredTheme`) to instantly toggle and persist Light and Dark interfaces based on the user's selection.
*   **Persistent Form Autofill:** Remembers the operator's identity via a `rememberedUser` cookie, automatically populating credentials on subsequent visits.
*   **Server-Side Security:** Employs dynamic `HttpSession` checks to lock down the admin console, preventing unauthorized URL bypasses.
*   **Session Diagnostics Console:** Renders live, diagnostic metadata including:
    *   **Active Session ID** (JSESSIONID)
    *   **Login Timestamp** (EAT/Local standard)
    *   **Theme UI Preferences**
*   **Simulated Inventory Metrics:** Real-time visual tracking of *Total Stock*, *Active Orders*, and *Out of Stock* items.

---

## 📂 Directory Map

```text
Elechub/
├── src/main/java/com/elechub/
│   ├── LoginServlet.java    # Authenticates user, assigns cookies & initiates HttpSession
│   └── LogoutServlet.java   # Invalidates the session and handles secure redirection
└── src/main/webapp/
    ├── login.jsp            # Light/Dark login form with automated cookie parsing
    └── dashboard.jsp        # Secure console displaying operational diagnostics
