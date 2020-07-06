const login = {
  username: document.querySelector("#login-username"),
  password: document.querySelector("#login-password"),
  submit: document.querySelector("#login"),
};

const register = {
  username: document.querySelector("#register-username"),
  email: document.querySelector("#register-email"),
  password: document.querySelector("#register-password"),
  confirmPassword: document.querySelector("#register-confirm-password"),
  submit: document.querySelector("#register"),
};

const errorRegisterDialog = {
  mainLog: document.querySelector(".main-log"),
  username: document.querySelector("#error-register-username"),
  email: document.querySelector("#error-register-email"),
  password: document.querySelector("#error-register-password"),
  confirmPassword: document.querySelector("#error-register-confirm-password"),
};

const errorLoginDialog = {
  username: document.querySelector("#error-login-username"),
  password: document.querySelector("#error-login-password"),
};

const errorFormat = "2px solid var(--error-background)";

const clearFields = () => {
  for (let key in register) {
    register[key].value = "";
  }
};

const validateLogin = (e, login) => {
  if (!(login.username.value && login.password.value)) {
    e.preventDefault();
    for (let key in login) {
      login[key].style.border = errorFormat;
    }
  } else {
    for (let key in login) {
      login[key].style.border = "none";
    }
  }
};

const validateRegister = (e, register) => {
  e.preventDefault();

  for (let key in register) {
    register[key].style.border = "none";
  }

  if (
    !(
      register.username.value &&
      register.email.value &&
      register.password.value &&
      register.confirmPassword.value
    )
  ) {
    for (let key in register) {
      register[key].style.border = errorFormat;
    }
  } else {
    const { username, email, password, confirmPassword } = register;
    let noErrors = true;

    if (/^[a-zA-Z0-9_]*$/.test(username.value) === false) {
      errorRegisterDialog.username.style.display = "block";
      errorRegisterDialog.username.textContent =
        "Your username must only use alphanumeric and underscores.";
      username.style.border = errorFormat;
      noErrors = false;
    } else {
      errorRegisterDialog.username.style.display = "none";
      username.style.border = "none";
    }

    if (/\S+@\S+\.\S+/.test(email.value) === false) {
      errorRegisterDialog.email.style.display = "block";
      errorRegisterDialog.email.textContent = "Your email must be valid.";
      email.style.border = errorFormat;
      noErrors = false;
    } else {
      errorRegisterDialog.email.style.display = "none";
      email.style.border = "none";
    }

    if (password.value.length < 8) {
      errorRegisterDialog.password.style.display = "block";
      errorRegisterDialog.password.textContent =
        "Your password must be at least 8 characters.";
      password.style.border = errorFormat;
      noErrors = false;
    } else {
      errorRegisterDialog.password.style.display = "none";
      password.style.border = "none";
    }

    if (confirmPassword.value !== password.value) {
      errorRegisterDialog.confirmPassword.style.display = "block";
      errorRegisterDialog.confirmPassword.textContent =
        "Your confirmed password must be equal to entered password.";
      confirmPassword.style.border = errorFormat;
      noErrors = false;
    } else {
      errorRegisterDialog.confirmPassword.style.display = "none";
      confirmPassword.style.border = "none";
    }

    if (noErrors) {
      sendToDatabase(register);
    }
  }
};

const serverRegisterResponse = (response) => {
  for (let key in errorRegisterDialog) {
    errorRegisterDialog[key].style.display = "none";
  }

  for (let key in errorRegisterDialog) {
    if (response.hasOwnProperty(key)) {
      errorRegisterDialog[key].style.display = "block";

      if (key === "mainLog") {
        if (response[key][0] === "error") {
          errorRegisterDialog[key].style.backgroundColor =
            "var(--error-background)";
          errorRegisterDialog[key].style.color = "var(--error-color)";
          errorRegisterDialog[key].textContent = response[key][1];
        } else {
          errorRegisterDialog[key].style.backgroundColor =
            "var(--success-background)";
          errorRegisterDialog[key].style.color = "var(--success-color)";
          errorRegisterDialog[key].textContent = response[key][1];

          clearFields();
        }
      } else {
        errorRegisterDialog[key].textContent = response[key];
      }
    }
  }
};

const sendToDatabase = (form) => {
  const formData = new FormData();
  const url =
    "http://localhost:8080/PHP/Mini%20projects/PHP%20Login%20and%20Registration%20Form/processRegister.php";

  for (let key in form) {
    formData.append(key, form[key].value);
  }

  fetch(url, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => serverRegisterResponse(data))
    .catch((error) => console.log(error));
};

login.submit.addEventListener("click", (e) => validateLogin(e, login));
register.submit.addEventListener("click", (e) => validateRegister(e, register));
