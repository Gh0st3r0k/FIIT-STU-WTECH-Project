<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact</title>

  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/general/contact/contact.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>

  <header>
    @include('layouts.header')
  </header>

  <section id="main-content">
    <div class="container">
      <div class="card text-center pt-3">
        <h2 class="mb-3">About Us</h2>
        <p class="mb-4">
          InfyGo is a platform created to simplify your shopping experience. Whether you're looking for everyday essentials or something unique, we aim to make your journey smooth and enjoyable.
        </p>

        <h2 class="mb-2">Contact Us</h2>
        <p class="mb-4">
          Have questions or feedback? We'd love to hear from you!
        </p>

        <form class="mb-3">
          <div class="mb-3">
            <label for="nameInput" class="form-label text-start d-block">Name</label>
            <input type="text" class="form-control" id="nameInput" placeholder="Name" />
          </div>

          <div class="mb-3">
            <label for="surnameInput" class="form-label text-start d-block">Surname</label>
            <input type="text" class="form-control" id="surnameInput" placeholder="Surname" />
          </div>

          <div class="mb-3">
            <label for="emailInput" class="form-label text-start d-block">Email</label>
            <input type="email" class="form-control" id="emailInput" placeholder="Email" />
          </div>

          <div class="mb-3">
            <label for="messageInput" class="form-label text-start d-block">Message</label>
            <textarea class="form-control" id="messageInput" rows="3" placeholder="Message"></textarea>
          </div>

          <button type="submit" class="btn btn-dark w-100">Submit</button>
        </form>

        <p class="mb-4">
          <strong>Email:</strong> support@infygo.com<br>
          <strong>Phone:</strong> +421 987 654 321<br>
          <strong>Address:</strong> Bratislava, Slovakia, FIIT STU<br>
        </p>
        <p class="mb-4">
          You can also reach us via social media using the links below.
        </p>

        <img src="{{ asset('img/GveMoney.png') }}" alt="Money" class="content-image mt-4">
        <a href="https://imgflip.com/i/7tmpqp">Source foto</a>
      </div>
    </div>
  </section>

  @include('layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
