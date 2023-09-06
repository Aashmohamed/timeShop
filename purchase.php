<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Integartion (Stripe)</title>
    <link rel="stylesheet" href="./css/_style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<br/>
   <h3 style="background:transparent;color:white;">Payment Gateway Integartion Using PHP (Stripe)</h3>
    <br/>
     <div class="row">
        
        <div class="col-md-3">
            <div class="card">
               <div class="card-header">Leonovo ProArt</div> 
               <div class="card-body">
                    <img src="./Laptops/first.jpg"/>
                    <input type="hidden" name="image_src" id="image_src" value="./Laptops/first.jpg"/>
                    
               </div> 
               <div class="card-footer">
               <span>ProArt Lenovo</span>
                    <span>&#8377;&nbsp;35,000.00 </span>
                    <input type="submit" name="submit" value="check-in" class="buy_now"/>
                    <input type="hidden" name="price"  id="price" value="35,000.00"/>
                    <input type="hidden" name="item_name" id="item_name" value="ProArt Lenovo"/>   
               </div>   
            </div>
        </div>
        <div class="col-md-3">
          <div class="card">
                    <div class="card-header">Leonovo Slim3</div> 
                    <div class="card-body">
                         <img src="./Laptops/second.jpg"/>
                         <input type="hidden" name="image_src"  id="image_src" value="./Laptops/second.jpg"/>
                    </div>
                    <div class="card-footer">
                    <span>Leonovo Slim3</span>
                    <span>&#x20B9; &nbsp;29,490.00 </span>
                    <input type="submit" name="submit" value="check-in" class="buy_now"/>
                    <input type="hidden" name="price" id="price" value="29,490.00"/>
                    <input type="hidden" name="item_name" id="item_name" value="Leonovo Slim3"/>     
                    </div>    
          </div>
        </div>
        <div class="col-md-3">
            <div class="card">
               <div class="card-header">Leonovo S540</div> 
               <div class="card-body">
                    <img src="./Laptops/fifth.jpg" width="1000" height="1000"/>
                    <input type="hidden" name="image_src" id="image_src" value="./Laptops/fifth.jpg"/>
               </div>    
               <div class="card-footer">
               <span>Leonovo S540</span>
                    <span>&#x20B9; &nbsp;48,490.00 </span>
                    <input type="submit" name="submit" value="check-in" class="buy_now"/>
                    <input type="hidden" name="price"  id="price" value="48,490.00"/>
                    <input type="hidden" name="item_name" id="item_name" value="Leonovo S540"/>  
               </div>
            </div>
        </div>
        <div class="col-md-3">
        <div class="card">
        <div class="card-header">Leonovo Yoga</div> 
               <div class="card-body">
                    <img src="./Laptops/yoga.jpg" width="1000" height="1000"/>
                    <input type="hidden" name="image_src" id="image_src" value="./Laptops/yoga.jpg"/>
               </div> 
               <div class="card-footer">
               <span>Leonovo Yoga</span>
               <span>&#x20B9; &nbsp;33,300.00 </span>
               <input type="submit" name="submit" value="check-in" class="buy_now"/>
               <input type="hidden" name="price" id="price" value="33,300.00"/>
               <input type="hidden" name="item_name" id="item_name" value="Leonovo Yoga"/>
               </div> 
            </div>
        </div>
       
        </div>
   </div>
   <script>
        $(document).ready(function(){
           $(".buy_now").on('click',function(e){
                e.preventDefault();
                    var image_src = $(this).closest(".card").find("#image_src").attr("value");
                    var item_name = $(this).closest(".card").find("#item_name").attr("value");
                    var price = $(this).closest(".card").find("#price").attr("value");
                    var dt = '&image='+image_src+'&item_name='+item_name+'&price='+price;
                    var url = 'http://localhost/stripe/checkout.php?'+dt; 
                    
                    $.ajax({
                         url:url,
                         method:'GET',
                         success:function(){
                              window.location.href=url;
                         }
                    });
                   
                    
           });
          
        });
   </script>
</body>
</html>