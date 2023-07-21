function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var passwordVisibilityToggle = document.getElementById("password-toggle");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      passwordVisibilityToggle.textContent = "Ocultar contraseña";
    } else {
      passwordInput.type = "password";
      passwordVisibilityToggle.textContent = "Mostrar contraseña";
    }
  }

  function submitForm(event) {
    event.preventDefault();
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
  
    if ((username === "Malia" && password === "12345") || (username === "kubo" && password === "kuboks")) {
      window.location.href = "../Paginas/Main.html";
    } else {
      alert("Credenciales incorrectas. Por favor, inténtalo de nuevo.");
      document.getElementById("username").value = "";
      document.getElementById("password").value = "";
    }
  }