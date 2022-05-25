<?php
session_start();
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/pricing.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <h1 class="header">Choose a plan that's right for you</h1>
    <div class="row">
      <div class="col" id="shadow">
        <p class="duration">Monthly</p>
        <p class="currency">₦1,000</p>
        <ul class="list-group">
          <li class="listelement"><i class="bi bi-check-circle-fill"></i> 24-7 unlimited access to doctors</li>
          <li class="listelement""> <i class=" bi bi-check-circle-fill"></i> 24-7 unlimited access to wellness experts
          </li>
          <li class="listelement""> <i class=" bi bi-check-circle-fill"></i> Medication delivery, where available</li>
          <li class="listelement""> <i class=" bi bi-check-circle-fill"></i> Referrals & appointment booking, if
            applicable</li>
        </ul>
        <div class="wrapper">
        <button type="button" onclick="paystack('<?=$email;?>', 1000);" class="button">Subscribe</button>
        </div>
      </div>
      <div class="col" id="shadow">
        <p class="duration">Quarterly</p>
        <p class="currency">₦2,500</p>
        <ul class="list-group">
          <li class="listelement"><i class="bi bi-check-circle-fill"></i> 24-7 unlimited access to doctors</li>
          <li class="listelement""> <i class=" bi bi-check-circle-fill"></i> 24-7 unlimited access to wellness experts
          </li>
          <li class="listelement""> <i class=" bi bi-check-circle-fill"></i> Medication delivery, where available</li>
          <li class="listelement""> <i class=" bi bi-check-circle-fill"></i> Referrals & appointment booking, if
            applicable</li>
        </ul>
        <div class="wrapper">
        <button type="button" onclick="paystack('<?=$email;?>', 2500);" class="button">Subscribe</button>
        </div>
      </div>
      <div class="col" id="shadow">
        <p class="duration">Bi-annual</p>
        <p class="currency">₦4,000</p>
        <ul class="list-group">
          <li class="listelement"><i class="bi bi-check-circle-fill"></i> 24-7 unlimited access to doctors</li>
          <li class="listelement""> <i class=" bi bi-check-circle-fill"></i> 24-7 unlimited access to wellness experts
          </li>
          <li class="listelement""> <i class=" bi bi-check-circle-fill"></i> Medication delivery, where available</li>
          <li class="listelement""> <i class=" bi bi-check-circle-fill"></i> Referrals & appointment booking, if
            applicable</li>
        </ul>
        <div class="wrapper">
        <button type="button" onclick="paystack('<?=$email;?>', 4000);" class="button">Subscribe</button>
        </div>
      </div>
      <div class="col" id="shadow">
        <div class="box">
          <div class="ribbon"><span>POPULAR</span></div>
        </div>
        <p class="duration">Annual</p>
        <p class="currency">₦6,000</p>
        <ul class="list-group">
          <li class="listelement"><i class="bi bi-check-circle-fill"></i> 24-7 unlimited access to doctors</li>
          <li class="listelement""> <i class=" bi bi-check-circle-fill"></i> 24-7 unlimited access to wellness experts
          </li>
          <li class="listelement""> <i class=" bi bi-check-circle-fill"></i> Medication delivery, where available</li>
          <li class="listelement""> <i class=" bi bi-check-circle-fill"></i> Referrals & appointment booking, if
            applicable</li>
        </ul>
        <div class="wrapper">
          <button type="button" onclick="paystack('<?=$email;?>', 6000);" class="button">Subscribe</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://js.paystack.co/v1/inline.js"></script>

  <script>
    function paystack(email, amount) {
      let handler = PaystackPop.setup({
        key: "pk_test_f85660fe9954a882f0820480c2339d1d785a92b5", // Replace with your public key
        email: email,
        amount: amount * 100,
        ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you gene
        onClose: function () {
          alert('Window closed.');
        },
        callback: function (response) {
          let message = 'Payment complete! Reference: ' + response.reference;
          alert(message);
        }
      });
    handler.openIframe();
    }
  </script>
</body>

</html>