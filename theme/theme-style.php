<style>
    * {
      font-family: "Poppins", sans-serif;
    }
    ::selection {
      background-color: white;
      color: #000;
      border-radius: 50%;
    }
    .form-control:focus,
    .form-control:active {
      outline: none;
      box-shadow: none;
    }

    .form-control:focus {
      border-color: #fff;
      box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
    }

    select.form-select:focus,
    select.form-select:active {
      outline: none;
      box-shadow: none;
    }

    select.form-select:focus {
      border-color: #fff;
      box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
    }
    .loader {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    .loader p {
      margin-top: 10px;
    }
</style>