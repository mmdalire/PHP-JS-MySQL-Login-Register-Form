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

const validateLogin = (e, login) => {
  const { username, password } = login;
  if (
    username.value === "" ||
    username.value === null ||
    password.value === "" ||
    password.value === null
  ) {
    e.preventDefault();
    document.querySelector("#error-login-username").style.display = "block";
    document.querySelector("#error-login-username").textContent =
      "You must complete all fields!";
  } else {
    document.querySelector("#error-login-username").style.display = "none";
  }
};

login.submit.addEventListener("click", (e) => validateLogin(e, login));
register.submit.addEventListener("click", (e) => valdateRegister(e, register));
