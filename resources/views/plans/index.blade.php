<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Paiement | Kalisso</title>
  <link rel="shortcut icon" href="https://kalisso.com/site_kali_icon.png" type="image/png" title="icon">
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="subscription/assets/css/pricing-plan.css">
</head>
<body>
  <main>
    <div class="container m-auto py-lg-5">
      <h2 class="text-center pricing-table-title">Inscription à <span class="text-danger">kalisso.com</span></h2>
      
       <p class="text-light b text-center h6">

        Vous êtes ici parce que vous avez indiqué lors de votre inscription vouloir vendre sur <span class="text-danger">kalisso.com</span>
      </p>
     

      <div class="tab-content pricing-tab-content" id="pricing-tab-content">
        
        <div class="tab-pane active p-auto"  id="monthly" role="tabpanel" aria-labelledby="yearly-tab">
          <div class="row">
           
            <div class="col-md-4 offset-md-4">
              <div class="card pricing-card">
                <div class="card-body ">
                  <h3 class="pricing-plan-title d-flex  align-items-center">Création Boutiques en ligne <span
                      class="badge badge-pill offer-badge mr-0 ml-auto">90% réduction</span></h3>
                  <p class="h1 pricing-plan-original-cost"><del>{{presentPrice(10000)}}</del></p>
                  <p class="h1 pricing-plan-cost">{{presentPrice(1000)}}</p>
                  <ul class="pricing-plan-features">
                    <li>100 produits héberger</li>
                    <li>Accès K-panel</li>
                    <li>Gestion de stock</li>
                    <li>Suivie de commandes en temps réel</li>
                    <li>Notification par SMS et par Email</li>
                   
                  </ul>
                   <?php
                      $acid="167";
                      $key = "eb53195f1b3a37c5d4330bcac3e05b28b3926c26";
                      $token = "46fd45e4160e46ab9221f481e5149ecd3c90eac6";
                      $sign = md5($token . $key);
                      $signature = $sign;
                      $currency = "XAF";
                      $amount = 1000 + 45;
                      $datetrans = date('Y-m-d H:i:s');
                      $emailId = "caviaros123@gmail.com";
                      $successurl="https://kalisso.com/merci";
                      $cancelurl="https://kalisso.com/erreur";
                      $reference = rand();

                    
                  ?>

                    <form action="https://epaycongo.com/payment" method="POST" >
                      @csrf
                      <input type="hidden" name="amount" value="{{ $amount }}" />
                      <input type="hidden" name="signature" value="{{ $sign }}" />
                      <input type="hidden" name="acid" value="{{ $acid }}" />
                      <input type="hidden" name="emailId" value="{{ $emailId }}" />
                      <input type="hidden" name="successurl" value="{{ $successurl }}" />
                      <input type="hidden" name="cancelurl" value="{{ $cancelurl }}" />
                      <input type="hidden" name="currency" value="{{ $currency }}" />
                      <input type="hidden" name="Reference" value="{{ $reference }}" />

                      <button type="submit" name="submit" value="submit" class="btn col-md-12 offset-md-12 pricing-plan-purchase-btn">Je Confirme</button>
                    </form>
                    <?php
                        if (isset($_POST)) {

                              try {
                                  \DB::table('transactions')->insert([
                                    'reference' => $reference,
                                    'amount' => $amount,
                                    'status' => 'En attente',
                                    'user' => auth()->id(),
                                    'created_at'=> NOW(),
                                    'updated_at'=> NOW()
                                ]);
                              } catch (Exception $e) {
                                echo '<script language="javascript">';
                                echo 'alert('.$e.')';
                                echo '</script>';
                                
                              }
                               
                            
                          }
                        

                      ?>
                  <div class="text-center">
                    <a href="/vendre" class="pricing-plan-link">En savoir plus</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     <p class="text-light b text-center mt-3 mb-4 h4">
        Votre incription est unique <br>
        <small>Vous serez redirigé vers une page de paiement</small>
      </p>

    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>


